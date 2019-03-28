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
            @error('password')<a style="display: inline-block;" href="{{ route('password.forgot') }}">忘記密碼?</a>
        @endFormGroup
            

        <div class="form-group">
            <label class="loginMg">
                {!! Form::checkbox('remember') !!}保持登入
            </label>
        </div>

        {!! Form::submit('登入', ['class' => 'btn btn-primary btn-block']) !!}
        
    {!! Form::close() !!}
@endsection

