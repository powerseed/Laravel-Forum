<?php

namespace App\Http\Controllers;

use App\Category;
use App\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Request $request)
    {
        $topics = Topic::withOrder($request->order)->where('category_id', $request->category)->with('user', 'category')->paginate(20);
        return view('topics.show', compact('topics', 'category'));
    }
}
