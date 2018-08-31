@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">Update a reply</div>

        <div class="card-body">
            <form action="{{ route('reply.update', ['id' => $reply->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="content">Answer a question</label>
                    <textarea name="content_form" id="content" class="form-control" cols="30" rows="5">{{ $reply->content }}</textarea>
                    @if ($errors->has('content_form'))
                        <div class="alert text-danger">*{{ $errors->first('content_form') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">Save reply changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
