@title('登入')

@extends('layouts.small')

@section('small-content')
<div style="width:auto;">        
    <div class="btn btn-block facebook" id="facebook_login_btn"><img class="facebookImg" src="https://pro.uanalyze.com.tw/assets/img/Facebook/f-Logo_Assets/F_Logo_Online_09_2018/Color/SVG/flogo_RGB_HEX-1024.svg"></div>
    ‧
    <div class="btn btn-block google" onclick="javascript:location.href='https://forum.uanalyze.com.tw/google/auth'"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1024px-Google_%22G%22_Logo.svg.png" class="googleImg"></div>
</div>
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
    {!! Form::open(['route' => 'facebook.login.post','id'=>'facebook_form']) !!}
        @csrf
        <input type="hidden" name="email">
        <input type="hidden" name="password">
        <input type="hidden" name="username">
    {!! Form::close() !!}
@endsection
@section('js_tail')
    <script src="/js/facebook.js"></script>
    <script>
        $(function(){
            $('#facebook_login_btn').click(function(event){
                event.preventDefault();
                FBLogin('#facebook_form');
            });
        });
    </script>
@endsection