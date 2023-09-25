<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function show (Post $post)
    {
        if($post->isPublished() || Auth::check())
        {
            return view('posts.show',compact('post'));
        }
        abort(404);
    }
}
