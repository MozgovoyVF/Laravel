<?php

namespace App\Http\Controllers;

use App\Events\UpdateEvent;
use App\Http\Requests\ArticlesCreateRequest;
use App\Http\Requests\ArticlesUpdateRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $validate = Arr::except($validate, 'tags');

        $article = Article::create($validate);

        $tags = $request->collect('tags')->keyBy(function ($item) {
            return $item;
        });

        app(TagsSynchronizer::class)->sync($tags, $article);

        flash()->overlay('Статья "' . $validate['title'] . '" успешно создана', 'Успешно!');

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

        $validate = Arr::except($validate, 'tags');

        $tags = $request->collect('tags')->keyBy(function ($item) {
            return $item;
        });;

        $articleTags = $article->tags->keyBy('name');

        $syncTags = collect($articleTags->intersectByKeys($tags));
        $tagsToAttach = $tags->diffKeys($articleTags);

        $tagsMerged = $syncTags->merge($tagsToAttach);

        $article->update($validate);

        app(TagsSynchronizer::class)->sync($tagsMerged, $article);

        event(new UpdateEvent($validate));

        flash()->overlay('Статья "' . $validate['title'] . '" успешно обновлена', 'Успешно!');

        return redirect('/');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        flash()->overlay('Статья "' . $article->title . '" успешно удалена', 'Успешно!');

        return redirect('/');
    }
}
