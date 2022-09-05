<?php

namespace App\Http\Controllers\Admin;

use App\Events\ArticleUpdate;
use App\Events\UpdateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesUpdateRequest;
use App\Models\Article;
use App\Models\Messages;
use App\Services\Pushall;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published', 'desc')->orderBy('created_at', 'asc')->simplePaginate(20);

        return view('admin/articles/index', compact('articles'));
    }

    public function feedback()
    {
        $messages = Messages::latest()->get();

        return view('admin.feedback', compact('messages'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
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
        app(Pushall::class)->send('Статья ' . $article->title . ' создана в ' . $article->created_at);

        event(new UpdateEvent($validate));

        flash()->overlay('Статья "' . $validate['title'] . '" успешно обновлена', 'Успешно!');

        return redirect('/admin/articles');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        flash()->overlay('Статья "' . $article->title . '" успешно удалена', 'Успешно!');

        return redirect('/');
    }
}
