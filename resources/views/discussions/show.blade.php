@extends('layouts.app')

@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <img src="{{ $d->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
            <span>{{ $d->user->name }} <b>( {{ $d->user->points }} :points)</b></span>
            @if($d->hasBestAnswer())
                <span class="btn btn-success float-right btn-sm">closed</span>
            @else
                <span class="btn btn-danger float-right btn-sm">open</span>
            @endif
            @if(Auth::id() == $d->user->id)
                @if(!$d->hasBestAnswer())
                    <a href="{{ route('discussion.edit', ['slug' => $d->slug]) }}"
                       class="btn btn-info btn-sm float-right"
                       style="margin-right: 8px">Edit</a>
                @endif
            @endif
            @if($d->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch', ['id' => $d->id]) }}" class="btn btn-light btn-sm float-right"
                   style="margin-right: 8px">unwatch</a>
            @else
                <a href="{{ route('discussion.watch', ['id' => $d->id]) }}" class="btn btn-light btn-sm float-right"
                   style="margin-right: 8px">watch</a>
            @endif
        </div>
        <div class="card-body">
            <h4 class="text-center">
                <b>{{ $d->title }}</b>
            </h4>
            <hr>
            <p class="text-center">
                {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($d->content) !!}
            </p>
            <hr>
            @if($best_answer)
                <div class="text-center" style="padding: 40px">
                    <h3>Best answer</h3>
                    <div class="card">
                        <div class="card-header alert-success">
                            <img src="{{ $best_answer->user->avatar }}" width="50px" height="50px"
                                 style="border-radius: 50%">&nbsp;&nbsp;
                            <span>{{ $best_answer->user->name }} <b>( {{ $best_answer->user->points }}
                                    :points)</b></span>
                        </div>
                        <div class="card-body">
                            {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($best_answer->content) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
                <span>
                    @if($d->replies->count() == 1)
                        {{ $d->replies->count() }} Reply
                    @else
                        {{ $d->replies->count() }} Replies
                    @endif
                </span>
            <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}"
               class="btn btn-light float-right btn-sm">{{ $d->channel->title }}</a>
        </div>
    </div>
    @foreach($d->replies as $r)
        <br>
        <div class="card">
            <div class="card-header">
                <img src="{{ $r->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
                <span>{{ $r->user->name }} <b>( {{ $r->user->points }} :points)</b></span>
                @if(!$best_answer)
                    @if(Auth::id() == $d->user->id)
                        <a href="{{ route('discussion.best.answer',['id' => $r->id]) }}"
                           class="btn btn-sm btn-warning float-right">Mark as best answer</a>
                    @endif
                @endif
                @if(Auth::id() == $r->user->id)
                    @if($r->best_answer)
                        <a href="{{ route('discussion.unmark.best.answer',['id' => $r->id]) }}"
                           class="btn btn-sm btn-warning float-right">Unmark as best answer</a>
                    @endif
                @endif
                @if(Auth::id() == $r->user->id)
                    @if(!$r->best_answer)
                        <a href="{{ route('reply.edit',['id' => $r->id]) }}"
                           class="btn btn-sm btn-info float-right" style="margin-right: 8px">edit</a>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <p class="text-center">
                    {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($r->content) !!}
                </p>
                <span class="text-info">likes: {{ $r->likes->count() }}</span>
            </div>
            <div class="card-footer">
                @if($r->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike', ['id' => $r->id]) }}" class="btn btn-danger btn-xs">Unlinke</a>
                @else
                    <a href="{{ route('reply.like', ['id' => $r->id]) }}" class="btn btn-primary btn-xs">Like</a>
                @endif
            </div>
        </div>
    @endforeach

    <br>
    <div class="card">
        <div class="card-body">
            @if(Auth::check())
                <form action="{{ route('discussions.reply', ['id' => $d->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn float-right" type="submit">Leave a reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h2>Sign in to leave a reply</h2>
                </div>
            @endif
        </div>
    </div><br>
@endsection
