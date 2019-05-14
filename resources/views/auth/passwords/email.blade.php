@title('忘記密碼')

@extends('layouts.small')

@section('small-content')
    <p>{{ Session::get('status', '忘記密碼了嗎？輸入 Email 重新設定！') }}</p>

    {!! Form::open(['route' => 'password.forgot.post']) !!}
        @formGroup('email')
            {!! Form::email('email', null, ['class' => 'inputText', 'required','placeholder' => '請輸入Email']) !!}
            @error('email')
        @endFormGroup

        {!! Form::submit('重設密碼', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
@endsection
