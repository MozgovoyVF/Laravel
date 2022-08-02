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
            $articles = Article::orderBy('published', 'desc')->orderBy('created_at', 'asc')->simplePaginate(20);
        } else {
            if (auth()->check()) {
                $articles = Article::orderBy('published', 'desc')->orderBy('created_at', 'asc')
                    ->where('published', true)
                    ->orWhere(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where('published', false);
                    })->simplePaginate(10);
            } else {
                $articles = Article::orderBy('published', 'desc')->orderBy('created_at', 'asc')->where(['published' => true])->simplePaginate(10);
            }
        }

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
