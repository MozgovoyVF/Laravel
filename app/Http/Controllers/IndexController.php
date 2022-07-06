<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Messages;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Articles::latest()->where(['published' => true])->get();

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
