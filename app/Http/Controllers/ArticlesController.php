<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSend;
use App\Events\UpdateEvent;
use App\Http\Requests\ArticlesCreateRequest;
use App\Http\Requests\ArticlesUpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function create()
    {
        return view('articles.create');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function store(ArticlesCreateRequest $request)
    {
        $validate = $request->validated();
        $published = $request->boolean('published');
        
        $validate['published'] = (int) $published;

        Article::create($validate);

        return redirect('/');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(ArticlesUpdateRequest $request, Article $article)
    {
        $validate = $request->validated();
        $published = $request->boolean('published');
        
        $validate['published'] = (int) $published;

        $article->update($validate);

        event(new UpdateEvent($validate));

        return redirect('/');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/');
    }
}
