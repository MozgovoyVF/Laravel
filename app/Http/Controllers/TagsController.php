<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function articles(Tag $tag)
    {
        $articles = Cache::tags(['articles'])->remember('user_articles|' . $tag->name, 3600, function () use ($tag) {
            return $tag->articles()->with('tags')->simplePaginate(10);
        });

        return view('index', compact('articles'));
    }

    public function news(Tag $tag)
    {
        $news = Cache::tags(['news'])->remember('user_news|' . $tag->name, 3600, function () use ($tag) {
            return $tag->news()->with('tags')->simplePaginate(10);
        });

        return view('news.index', compact('news'));
    }
}
