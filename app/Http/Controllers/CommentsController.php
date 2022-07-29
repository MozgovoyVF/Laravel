<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request , Article $article)
    {
        $comment = $request->validate([
            'message' => 'required|min:5|max:100',
        ]);

        $comment['article_id'] = $article->id;
        $comment['user_id'] = auth()->id();

        Comment::create($comment);

        flash()->overlay('Комментарий успешно отправлен', 'Успешно!');

        return back();
    }
}
