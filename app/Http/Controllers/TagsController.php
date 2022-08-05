<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function articles(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->simplePaginate(10);

        return view('index', compact('articles'));
    }

    public function news(Tag $tag)
    {
        $news = $tag->news()->with('tags')->simplePaginate(10);

        return view('news.index', compact('news'));
    }
}
