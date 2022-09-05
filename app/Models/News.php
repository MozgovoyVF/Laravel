<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'News';
    protected $fillable = [
        'title',
        'description',
        'content'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            cache()->tags(['news'])->flush();
        });
        static::updated(function() {
            cache()->tags(['news'])->flush();
        });
        static::deleted(function() {
            cache()->tags(['news'])->flush();
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }
}
