<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;


class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];
    protected $fillable=[
        'title',
        'body',
        'iframe',
        'excerpt',
        'published_at',
        'category_id',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }
    public function getRouteKeyName()
    {
        return "url";
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos() : HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopePublished($query) : void
    {
        $query->with(['owner','category','tags','photos'])
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->where('published_at','<=', Carbon::now());
    }

    public function scopeAllowed($query)
    {
        if(Auth::user()->can('viewAny'))
        {
            return $query;
        }
        return $query->where('user_id',Auth::id());
    }


    // protected function Title():Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($title) => [
    //             'title' => $title,
    //             'url'=> Str::slug($title)
    //         ]
    //     );
    // }

    public function scopebyYearAndMonth($query)
    {
        return $query->selectRaw('year(published_at) as year')
                    ->selectRaw('month(published_at) as month')
                    ->selectRaw('monthName(published_at) as monthName')
                    ->selectRaw('count(*) as posts')
                    ->groupBy('year','month','monthName')
                    ->orderBy('published_at');
    }

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    public static function create(array $attributes = [])
    {

        $attributes['user_id'] = Auth::id();
        $post = static::query()->create($attributes);

        $post->generateUrl();
        return $post;

    }
    public function generateUrl()
    {
        $url = Str::slug($this->title);
        if($this->whereUrl($url)->exists())
        {
            $url = "{$url}-{$this->id}";
        }
        $this->url = $url;

        return $this->save();

    }

    protected function PublishedAt(): Attribute
    {
        return Attribute::make(
            set: fn ($published_at) => $published_at ? Carbon::parse($published_at) : null,
        );
    }

    protected function CategoryId():Attribute
    {
        return Attribute::make(
            set: fn($category) => Category::find($category)
                                    ? $category
                                    : Category::create(['name' =>$category])->id,
        );
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        return $this->tags()->sync($tagIds);
    }

    public function viewType($home = '')
    {
        if($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() > 1):
            return $home === 'home'  ? 'posts.carousel-preview': 'posts.carousel';
        elseif ($this->iframe):
            return 'posts.iframe';
        else:
            return 'posts.text';
        endif;
    }
}
