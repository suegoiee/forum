@title('編輯留言')

@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    {!! Form::open(['route' => ['replies.update', $reply->id()], 'method' => 'PUT']) !!}
        @formGroup('body')
            {!! Form::textarea('body', $reply->body(), ['class' => 'form-control ckeditor', 'required']) !!}
            @error('body')
        @endFormGroup

        {!! Form::submit('編輯', ['class' => 'btn btn-primary btn-block','style' => 'width: auto !important; display:inline-block;' ]) !!}
        <a href="{{ route_to_reply_able($reply->replyAble()) }}" class="btn btn-primary btn-block" style = "width: auto !important; display:inline-block; float:right; margin-top:0;">取消</a>
    {!! Form::close() !!}
@endsection
