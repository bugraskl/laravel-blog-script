<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        if (request()->has('writer')) {
            $posts = \App\Models\Post::where('user_id', request('writer'))->orderBy('id', 'desc')->paginate(6);
            return view('home', compact('posts'));
        }
        
        if (request()->has('category')) {
            $posts = \App\Models\Post::where('category_id', request('category'))->orderBy('id', 'desc')->paginate(6);
            return view('home', compact('posts'));
        }

        $posts = \App\Models\Post::orderBy('id', 'desc')->paginate(6);
        return view('home', compact('posts'));
    }

}
