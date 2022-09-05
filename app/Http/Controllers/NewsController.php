<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $news = Cache::tags(['news'])->remember('user_news|' . auth()->id(), 3600, function () {
                return News::latest()->simplePaginate(20);
            });
        } else {
            $news = Cache::tags(['news'])->remember('user_news', 3600, function () {
                return News::latest()->simplePaginate(10);
            });
        }

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        Cache::tags(['news'])->remember('news|' . $news->id, 3600, function () use ($news) {
            return $news;
        });
        return view('news.show', compact('news'));
    }
}
