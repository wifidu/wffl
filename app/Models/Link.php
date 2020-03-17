<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['title', 'link'];
    public $cache_key = 'wffl_links';
    protected $cache_expire_in_seconds = 1440 * 60;

    public function getAllCached()
    {
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function(){
            return $this->all();
        });
    }
}
