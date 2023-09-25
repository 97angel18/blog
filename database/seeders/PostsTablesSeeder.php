<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('posts');
        Post::truncate();
        Category::truncate();
        Tag::truncate();

        $category = new Category;
        $category->name = "Categoria 1";
        $category->save();

        $category = new Category;
        $category->name = "Categoria 2";
        $category->save();

        $post = new Post;
        $post->title = "Mi primer post";
        $post->url = Str::slug('Mi primer post');
        $post->excerpt= "Extracto de mi primer post";
        $post->body = "<p>Contenido de mi primer post</p>";
        $post->published_at = Carbon::now();
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 1']));

        $post = New Post;
        $post->title = "Mi segundo post";
        $post->url = Str::slug('Mi segundo post');
        $post->excerpt= "Extracto de mi segundo post";
        $post->body = "<p>Contenido de mi segundo post</p>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 2']));

        $post = New Post;
        $post->title = "Mi tercer post";
        $post->url = Str::slug('Mi tercer post');
        $post->excerpt= "Extracto de mi tercer post";
        $post->body = "<p>Contenido de mi tercer post</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 1;
        $post->user_id = 2;
        $post->save();


        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 3']));

        $post = New Post;
        $post->title = "Mi cuarto post";
        $post->url = Str::slug('Mi cuarto post');
        $post->excerpt= "Extracto de mi cuarto post";
        $post->body = "<p>Contenido de mi cuarto post</p>";
        $post->published_at = Carbon::now();
        $post->category_id = 2;
        $post->user_id = 2;
        $post->save();


        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 4']));
    }
}
