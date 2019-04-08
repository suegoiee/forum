@title('登入')

@extends('layouts.small')

@section('small-content')
    {!! Form::open(['route' => 'login.post']) !!}
        @formGroup('email')
            {!! Form::label('') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'required', ' placeholder' => '信箱地址']) !!}
            @error('email')
        @endFormGroup

        @formGroup('password')
            {!! Form::label('') !!}
            {!! Form::password('password', ['class' => 'form-control', 'required',' placeholder' => '密碼']) !!}
            @error('password')<a style="display: inline-block;" href="{{ route('password.forgot') }}">忘記密碼?</a>
        @endFormGroup


        <!--div class="form-group">
            <label class="loginMg">
                {!! Form::checkbox('remember') !!}保持登入
            </label>
        </div-->

        {!! Form::submit('Login', ['class' => 'btn btn-primary btn-block']) !!}
        <!--a href="{{ route('login.github') }}" class="btn btn-default btn-block">
            <i class="fa fa-github"></i> Github
        </a-->
    {!! Form::close() !!}
@endsection

