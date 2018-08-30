@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)
        <br><div class="card">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
                <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-info btn-sm float-right" style="margin-left: 8px">View</a>
                @if($d->hasBestAnswer())
                    <span class="btn btn-success float-right btn-sm">closed</span>
                @else
                    <span class="btn btn-danger float-right btn-sm">open</span>
                @endif
            </div>
            <div class="card-body">
                <h4 class="text-center">
                    <b>{{ $d->title }}</b>
                </h4>
                <p class="text-center">
                    {{ str_limit($d->content, 50) }}
                </p>
            </div>
            <div class="card-footer">
                <span>
                    @if($d->replies->count() == 1)
                        {{ $d->replies->count() }} Reply
                    @else
                        {{ $d->replies->count() }} Replies
                    @endif
                </span>
                <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="btn btn-light float-right btn-sm">{{ $d->channel->title }}</a>
            </div>
    @endforeach
    <br>
    <div class="float-right">
        {{ $discussions->links() }}
    </div>
@endsection
