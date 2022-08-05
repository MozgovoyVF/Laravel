<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function article(Request $request , Article $article)
    {
        $comment = $request->validate([
            'message' => 'required|min:5|max:100',
        ]);

        $comment['user_id'] = auth()->id();

        $comment = Comment::create($comment);

        $article->comments()->save($comment);

        flash()->overlay('Комментарий успешно отправлен', 'Успешно!');

        return back();
    }

    public function news(Request $request , News $news)
    {
        $comment = $request->validate([
            'message' => 'required|min:5|max:100',
        ]);

        $comment['user_id'] = auth()->id();

        $comment = Comment::create($comment);

        $news->comments()->save($comment);

        flash()->overlay('Комментарий успешно отправлен', 'Успешно!');

        return back();
    }
}
