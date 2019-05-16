@title('編輯留言')

@extends('layouts.default')

@section('content')
    <h1 style="font-size: 20px;">{{ $title }}</h1>
    {!! Form::open(['route' => ['replies.update', $reply->id()], 'method' => 'PUT', 'class' => 'reEdit']) !!}
        @formGroup('body')
            {!! Form::textarea('body', $reply->body(), ['class' => 'form-control', 'required']) !!}
            @error('body')
        @endFormGroup

        {!! Form::submit('確定', ['class' => 'btn btn-primary btn-block','style' => 'width: auto !important; display:inline-block; float:right;' ]) !!}
        <a href="{{ route_to_reply_able($reply->replyAble()) }}" class="btn btn-primary btn-block" style = "width: auto !important; display:inline-block; margin-top:0;">取消</a>
    {!! Form::close() !!}
@endsection
