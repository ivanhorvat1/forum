@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">Create a new discussion</div>

        <div class="card-body">
            <form action="{{ route('discussions.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="alert text-danger">*{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="channel">Pick a channel</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Ask a question</label>
                    <textarea name="content_form" id="content" class="form-control" cols="30" rows="5">{{ old('content_form') }}</textarea>
                    @if ($errors->has('content_form'))
                        <div class="alert text-danger">*{{ $errors->first('content_form') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">Create discussion</button>
                </div>
            </form>
        </div>
    </div>
@endsection
