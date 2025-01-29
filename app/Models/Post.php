<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sluggable, SoftDeletes;

    protected $fillable = ['title','meta_desc','content','excerpt','category_id','thumb'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'=>'title'
            ]
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getPostDate($format = 'd F , Y'): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s',(string)$this->created_at)->format($format);
    }

    public function getPostThumb(): string
    {
        // {{$post->thumb ? asset($post->thumb) : asset('no-images.png')}}" alt="{{$post->title}}
        return $this->thumb ? asset($this->thumb) : asset('no-images.png');
    }

}
