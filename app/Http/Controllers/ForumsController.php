<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index()
    {
        switch (request('filter')){
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->paginate(3);
                break;

            case 'solved':
                $answered = array();
                foreach (Discussion::all() as $d)
                {
                    if($d->hasBestAnswer())
                    {
                        array_push($answered, $d);
                    }
                }
                $results = new Paginator($answered, 3);
                break;

            case 'unsolved':
                $unanswered = array();
                foreach (Discussion::all() as $d)
                {
                    if(!$d->hasBestAnswer())
                    {
                        array_push($unanswered, $d);
                    }
                }

                $results = new Paginator($unanswered, 3);
                $results->setPath('forum?filter=unsolved');
                break;

            default:
                $results = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }

        return view('forum', ['discussions' => $results]);
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel')->with('discussions', $channel->discussions()->paginate(5));
    }
}
