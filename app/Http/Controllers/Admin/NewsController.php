<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreateRequest;
use App\Models\News;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->simplePaginate(20);

        return view('admin.news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsCreateRequest $request,  News $news)
    {
        $validate = $request->only('title', 'description', 'content');

        $news->update($validate);

        $tags = $request->collect('tags')->keyBy(function ($item) {
            return $item;
        });;
        
        $newsTags = $news->tags->keyBy('name');

        $syncTags = collect($newsTags->intersectByKeys($tags));
        $tagsToAttach = $tags->diffKeys($newsTags);

        $tagsMerged = $syncTags->merge($tagsToAttach);

        app(TagsSynchronizer::class)->sync($tagsMerged, $news);

        flash()->overlay('Статья ' . $news->title . ' успешно обновлена', 'Успешно!');

        return redirect(route('admin.news.index'));
    }

    public function destroy(News $news)
    {
        $news->delete();

        flash()->overlay('Статья ' . $news->title . ' успешно удалена', 'Успешно!');

        return redirect(route('admin.news.index'));
    }

    public function store(NewsCreateRequest $request)
    {
        $tags = $request->collect('tags')->keyBy(function ($item) {
            return $item;
        });

        $news = News::create($request->only('title', 'description', 'content'));

        app(TagsSynchronizer::class)->sync($tags, $news);

        flash()->overlay('Статья успешно создана', 'Успешно!');

        return redirect(route('admin.news.index'));
    }
}
