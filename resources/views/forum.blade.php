@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)
        <br><div class="card">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" width="50px" height="50px" style="border-radius: 50%">&nbsp;&nbsp;&nbsp;
                <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-info float-right">View</a>
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
                <p>
                    {{ $d->replies->count() }} Replies
                </p>
            </div>
        </div>
    @endforeach
    <br>
    <div class="float-right">
        {{ $discussions->links() }}
    </div>
@endsection
