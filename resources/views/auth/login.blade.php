@title('登入')

@extends('layouts.small')

@section('small-content')
<button class="btn btn-block google" onclick="javascript:location.href='http://dev-www.uanalyze.com.tw/google/auth'"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1024px-Google_%22G%22_Logo.svg.png" class="googleImg"></button>
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

        {!! Form::submit('登入', ['class' => 'btn btn-primary btn-block']) !!}
        <!--a href="{{ route('login.github') }}" class="btn btn-default btn-block">
            <i class="fa fa-github"></i> Github
        </a-->
    {!! Form::close() !!}
@endsection