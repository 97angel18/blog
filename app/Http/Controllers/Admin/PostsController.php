<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::allowed()->get();
        return view('admin.posts.index',compact('posts'));
    }
    public function store(Request $request)
    {
        $this->authorize('create', new Post);
        $this->validate($request ,['title' => 'required|min:3']);

        // $post = Post::create($request->only('title'));
        $post = Post::create($request->all());

        return redirect()->route('admin.posts.edit',$post);
    }
    public function edit(Post $post)
    {

        $this->authorize('update',$post);
        return view('admin.posts.edit',[
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }
    public function update(StorePostsRequest $request, Post $post){
        $this->authorize('update',$post);
        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()->route('admin.posts.edit',$post)->with('flash', 'Su publicación ha sido guardada');
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('flash','La publicación ha sido eliminada');
    }
}
