<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Link;
use App\Models\User;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, Link $link, User $user)
    {
        // 读取分类ID关联的话题，并按每20条分页
      $topics = $topic->withOrder($request->order)
                      ->where('category_id', $category->id)
                      ->with('user', 'category')->paginate(20);
        // 传参变量话题和分类到模板中
        // 活跃用户列表
        $active_users = $user->getAciveUsers();
        // 资源链接
        $links = $link->getAllCached();
        return view('topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
