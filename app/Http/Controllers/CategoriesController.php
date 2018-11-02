<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\MOdels\Topic;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        //读取分类下的话题并且每页20条
        $topics = Topic::where('category_id', $category->id)->paginate(20);

        return view('topics.index', compact('topics', 'category'));
    }
}
