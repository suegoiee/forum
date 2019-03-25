@title('註冊')

@extends('layouts.small')

@section('small-content')
    @if (! session()->has('githubData') && false)
        <p>To register, we require you to login with your Github account. After login you can choose your password in the settings screen.</p>

        <a href="{{ route('login.github') }}" class="btn btn-default btn-block">
            <i class="fa fa-github"></i> Github
        </a>
    @else
        {!! Form::open(['route' => 'register.post']) !!}
            @php 
                /*
                @formGroup('name')
                    {!! Form::text('name', session('githubData.name'), ['class' => 'form-control', 'required', 'placeholder' => 'John Doe']) !!}
                    @error('name')
                @endFormGroup
                */
            @endphp

            @formGroup('username')
                {!! Form::text('username', session('githubData.username'), ['class' => 'form-control', 'required', 'placeholder' => '請輸入暱稱']) !!}
                @error('username')
            @endFormGroup

            @formGroup('email')
                {!! Form::email('email', session('githubData.email'), ['class' => 'form-control', 'required', 'placeholder' => '請輸入E-mail']) !!}
                @error('email')
            @endFormGroup

            @formGroup('password')
                {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => '請輸入密碼']) !!}
                @error('password')
            @endFormGroup

             @formGroup('password')
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'placeholder' => '請再輸入一次密碼']) !!}
                @error('password_confirmation')
            @endFormGroup
            
            @formGroup('rules')
                <label>
                    {!! Form::checkbox('rules') !!}
                    &nbsp; 已閱讀並同意 <a href="{{ route('rules') }}" target="_blank">網站規則</a>
                </label>
                @error('rules')

                <label>
                    {!! Form::checkbox('terms') !!}
                    &nbsp; 已閱讀並同意 <a href="{{ route('terms') }}" target="_blank">服務條款</a> 及 <a href="{{ route('privacy') }}" target="_blank">隱私權保護政策</a>.
                </label>
                @error('rules')
            @endFormGroup

            {!! Form::hidden('github_id', '0') !!}
            {!! Form::hidden('github_username', '') !!}
            {!! Form::submit('Register', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    @endif
@endsection
