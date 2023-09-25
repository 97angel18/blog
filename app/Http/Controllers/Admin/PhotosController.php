<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;


class PhotosController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(),[
            'photo'=>'required|image|max:2048',
        ]);
        $post->photos()->create(['url' => request()->file('photo')->store('posts','public')]);

    }
    public function destroy(Photo $photo){
        $photo->delete();
        return back()->with('flash','Foto eliminada');
    }
}
