<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index()
    {
        $discussion = Discussion::orderBy('created_at', 'desc')->paginate(3);

        return view('forum', ['discussions' => $discussion]);
    }
}
