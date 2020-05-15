<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return redirect()->route('topics.index', ['order' => 'last_replied']);
    }
}
