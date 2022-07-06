<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function create()
    {
        return view('articles.create');
    }

    public function show(Articles $article)
    {
        return view('articles.show', compact('article'));
    }

    public function store()
    {
        $this->validate(request(), [
            'code' => 'bail|required|unique:articles|max:20|regex:/^[0-9A-Za-z_-]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'content' => 'required',
        ]);

        Articles::create(request()->all());

        return redirect('/');
    }
}
