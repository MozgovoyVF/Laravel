<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function feedback()
    {
        $messages = Messages::latest()->get();

        return view('admin.feedback', compact('messages'));
    }
}
