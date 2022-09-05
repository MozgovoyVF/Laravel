<?php

namespace App\Models;

use App\Events\ArticleUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Article extends Model
{
    public $guarded = [];

    protected $dispatchesEvents = [
        'updated' => ArticleUpdate::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article) {
            $after = $article->getDirty();
            $article->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after)
            ]);
        });

        static::created(function() {
            cache()->tags(['articles'])->flush();
        });
        static::updated(function() {
            cache()->tags(['articles'])->flush();
        });
        static::deleted(function() {
            cache()->tags(['articles'])->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')->withPivot(['before', 'after'])->withTimestamps();
    }

    use HasFactory;
}
