@title('登入')

@extends('layouts.small')

@section('small-content')
<div style="width:auto;">        
    <!--div class="btn-block facebook" id="facebook_login_btn"><img class="facebookImg" src="{{ asset('images/flogo_RGB_HEX-1024.39f3afcf.svg') }}"></div-->
    <div class="btn-block facebook" onclick="javascript:location.href='{{env('APP_URL')}}/facebook/auth'"><img class="facebookImg" src="{{ asset('images/flogo_RGB_HEX-1024.39f3afcf.svg') }}"></div>
    ‧
    <div class="btn-block google" onclick="javascript:location.href='{{env('APP_URL')}}/google/auth'"> <img src="{{ asset('images/Google__G__Logo.686f8efa.svg') }}" class="googleImg"></div>
</div>
    {!! Form::open(['route' => 'login.post']) !!}
        @formGroup('email')
            {!! Form::text('email', null, ['class' => 'inputText', 'required', ' placeholder' => '信箱地址']) !!}
            @error('email')
        @endFormGroup

        @formGroup('password')
            {!! Form::password('password', ['class' => 'inputText', 'required',' placeholder' => '密碼']) !!}
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