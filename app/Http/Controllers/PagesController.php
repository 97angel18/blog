<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;


class PagesController extends Controller
{
    public function home(){
        $query = Post::published();
        if(request('month'))
        {
            $query->whereMonth('published_at',request('month'));
        }
        if(request('year'))
        {
            $query->whereYear('published_at',request('year'));
        }
        $posts = $query->paginate();
        return view('pages.home',compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        $archive = Post::published()->byYearAndMonth()->get();
        return view('pages.archive',[
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::take(7)->get(),
            'posts'=> Post::latest('published_at')->take(5)->get(),
            'archive' => $archive,
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
