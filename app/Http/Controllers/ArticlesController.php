<?php

namespace App\Http\Controllers;

use App\Events\UpdateEvent;
use App\Http\Requests\ArticlesCreateRequest;
use App\Http\Requests\ArticlesUpdateRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\ArticlesChanges;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

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
        $validate['user_id'] = auth()->id();

        $validate = Arr::except($validate, 'tags');

        $article = Article::create($validate);

        $tags = $request->collect('tags')->keyBy(function ($item) {
            return $item;
        });

        app(TagsSynchronizer::class)->sync($tags, $article);

        flash()->overlay('Статья "' . $validate['title'] . '" успешно создана', 'Успешно!');

        User::where(['id' => 3])->first()->notify(new ArticlesChanges($article));

        return redirect('/');
    }

    public function edit(Article $article)
    {
        if (Gate::none(['update', 'delete'], $article)) {
            abort(403);
        }

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

        User::where(['id' => 3])->first()->notify(new ArticlesChanges($article));

        flash()->overlay('Статья "' . $validate['title'] . '" успешно обновлена', 'Успешно!');

        return redirect('/');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        User::where(['id' => 3])->first()->notify(new ArticlesChanges($article));

        flash()->overlay('Статья "' . $article->title . '" успешно удалена', 'Успешно!');

        return redirect('/');
    }
}
