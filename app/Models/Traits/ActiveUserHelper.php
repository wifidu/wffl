<?php
namespace App\Models\Traits;

use App\Models\Reply;
use App\Models\Topic;
use Arr;
use Cache;
use Carbon\Carbon;
use DB;

trait ActiveUserHelper
{
    // 用于存放临时用户数据
    protected $users = [];

    // 配置信息
    protected $topic_weight = 4; // 话题权重
    protected $reply_weight = 1; // 回复权重
    protected $pass_days    = 7; // 多少天发表过内容
    protected $user_number  = 6; // 取出来多少用户

    // 缓存相关配置
    protected $cache_key = 'wffl_active_users';
    protected $cache_expire_in_seconds = 65 * 60;

    public function getAciveUsers()
    {
        // 尝试从缓存中取出cache_key对应的数据．如果能取到，便直接返回数据．
        // 否则运行匿名函数中的代码来取出来活跃用户的数据，返回时同时做了缓存．
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function(){
            return $this->calculateActiveUsers();
        });
    }

    public function calculateAndCacheActiveUsers()
    {
        // 取得活跃用户列表
        $active_users = $this->calculateActiveUsers();
        // 缓存
        $this->cacheActiveUsers($active_users);
    }

    public function calculateActiveUsers()
    {
        $this->calculateTopicScore();
        $this->calculateReplyScore();

        // 数组按照得分排序
        $users = Arr::sort($this->users, function ($user){
            return $user['score'];
        });

        // 我们需要的是排序，高分靠前，第二个参数为保持数组的key不变
        $users = array_reverse($users, true);

        // 只获取我们想要的数量
        $users = array_slice($users, 0, $this->user_number, true);

        // 新建一个空集合
        $active_users = collect();
        foreach ($users as $user_id => $user){
            $user = $this->find($user_id);
            if ($user){
                $active_users->push($user);
            }
        }

        return $active_users;
    }

    public function calculateTopicScore()
    {
        // 从话题数据表里取出限定时间范围内，有发表过话题的用户
        // 并且同时取出用户此段时间内发布话题的数量
        $topic_users = Topic::query()->select(DB::raw('user_id, count(*) as topic_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('user_id')
                        ->get();
        // 根据话题数量计算得分
        foreach ($topic_users as $value){
            $this->users[$value->user_id]['score'] = $value->topic_count * $this->topic_weight;
        }
    }

    public function calculateReplyScore()
    {
        // 从回复数据表里取出限定时间范围内，有发表过回复的用户
        // 并且同时取出用户此段时间内发布回复的数量
        $reply_users = Reply::query()->select(DB::raw('user_id, count(*) as reply_count'))
                        ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                        ->groupBy('user_id')
                        ->get();
        // 根据回复数量计算得分
        foreach ($reply_users as $value){
            $reply_score = $value->reply_count * $this->reply_weight;
            if (isset($this->users[$value->user_id])){
                $this->users[$value->user_id]['score'] += $reply_score;
            }else{
                $this->users[$value->user_id]['score'] = $reply_score;
            }
        }
    }

    public function cacheActiveUsers($active_users)
    {
        // 将数据放入缓存中
        Cache::put($this->cache_key, $active_users, $this->cache_expire_in_seconds);
    }


}
?>
