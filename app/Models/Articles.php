<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    public $guarded = [];

    public function getRouteKeyName()
    {
        return 'code';
    }

    use HasFactory;
}
