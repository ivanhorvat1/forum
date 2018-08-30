@extends('layouts.app')

@section('content')
    <br><div class="card">
        <div class="card-header">
            <img src="{{ $d->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
            <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
        </div>
        <div class="card-body">
            <h4 class="text-center">
                <b>{{ $d->title }}</b>
            </h4>
            <hr>
            <p class="text-center">
                {{ $d->content }}
            </p>
        </div>
        <div class="card-footer">
            <p>
                {{ $d->replies->count() }} Replies
            </p>
        </div>
    </div>
    @foreach($d->replies as $r)
        <br><div class="card">
            <div class="card-header">
                <img src="{{ $r->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
                <span>{{ $r->user->name }}, <b>{{ $r->created_at->diffForHumans() }}</b></span>
            </div>
            <div class="card-body">
                <p class="text-center">
                    {{ $r->content }}
                </p>
            </div>
            <div class="card-footer">
                @if($r->is_liked_by_auth_user())
                    <a href="/" class="btn btn-danger">Unlinke</a>
                @else
                    <a href="/" class="btn btn-danger">Like</a>
                @endif
            </div>
        </div>
    @endforeach

    <br><div class="card">
        <div class="card-body">
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
        </div>
    </div>
@endsection
