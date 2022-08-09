<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Messages;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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

    public function interesting()
    {
        $data = [];
        $data['Общее количество статей'] = Article::all()->count();
        $data['Общее количество новостей'] = News::all()->count();
        $data['ФИО автора, у которого больше всего статей на сайте'] = User::withCount('articles')->orderByDesc('articles_count')->limit(1)->value('name');

        $data['Самая длинная статья'] = DB::table('articles')->select(['code', 'title'])->selectRaw('LENGTH(content) as sum')->orderByDesc('sum')->first();
        $data['Самая короткая статья'] = DB::table('articles')->select(['code', 'title'])->selectRaw('LENGTH(content) as sum')->orderBy('sum', 'asc')->first();
        $data['Средние количество статей у активных пользователей'] = DB::table('users')->rightJoin('articles', 'users.id', '=', 'articles.user_id')->select(DB::raw('count(*) as articles_count, email'))->groupBy('email')->havingRaw('count(*) > ?', [0])->get()->avg('articles_count');
        $data['Самая непостоянная статья'] = DB::table('articles')->join('article_histories', 'articles.id', 'article_histories.article_id')->selectRaw('count(*) as changes_count, code, title')->groupBy('articles.id')->orderBy('changes_count', 'desc')->first();
        $data['Самая обсуждаемая статья'] = Article::select(['code', 'title'])->withCount('comments as comment_count')->orderByDesc('comment_count')->first();
        // dd($data);
        return view('interesting', compact('data'));
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
