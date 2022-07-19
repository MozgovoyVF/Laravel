<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Messages;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $articles = Article::latest()->get();
        } else {
            $articles = Article::latest()->where(['published' => true])->get();

            if (auth()->check()) {
                $articlesHidden = auth()->user()->articles()->where(['published' => false])->get();
                $articles = $articles->merge($articlesHidden);
            }
        }

        $articles = $articles->sortBy(
            ['published', 'desc'],
            ['created_at', 'asc'],
        );

        return view('index', compact('articles'));
    }

    public function about()
    {
        return view('about');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'bail|required|max:30|regex:/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/',
            'message' => 'required|min:5|max:100',
        ]);

        Messages::create(request()->all());

        return redirect('/');
    }
}
