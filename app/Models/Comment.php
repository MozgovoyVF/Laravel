<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'article_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function article()
    {
        $this->belongsTo(Article::class);
    }
}
