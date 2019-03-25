@title('登入')

@extends('layouts.small')

@section('small-content')
    {!! Form::open(['route' => 'login.post']) !!}
        @formGroup('username')
            {!! Form::label('') !!}
            {!! Form::text('username', null, ['class' => 'form-control', 'required']) !!}
            @error('username')
        @endFormGroup

        @formGroup('password')
            {!! Form::label('') !!}
            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
            @error('password')
        @endFormGroup

        <div class="form-group">
            <label>
                {!! Form::checkbox('remember') !!} 保持登入
            </label>
            <br/>
            <a href="{{ route('password.forgot') }}">忘記密碼?</a>
        </div>

        {!! Form::submit('登入', ['class' => 'btn btn-primary btn-block']) !!}
        
        <a href="{{ route('login.github') }}" class="btn btn-default btn-block">
            註冊
        </a>
    {!! Form::close() !!}
@endsection

