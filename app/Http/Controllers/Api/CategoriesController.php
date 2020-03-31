<?php

/*
 * @author weifan
 * Tuesday 31st of March 2020 10:34:41 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        CategoryResource::wrap('data');
        return CategoryResource::collection(Category::all());
    }
}
