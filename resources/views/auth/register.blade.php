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
                    {!! Form::text('name', session('githubData.name'), ['class' => 'inputText', 'required', 'placeholder' => 'John Doe']) !!}
                    @error('name')
                @endFormGroup
                */
            @endphp

            @formGroup('username')
                {!! Form::text('username', session('githubData.username'), ['class' => 'inputText', 'required', 'placeholder' => '請輸入暱稱']) !!}
                @error('username')
            @endFormGroup

            @formGroup('email')
                {!! Form::email('email', session('githubData.email'), ['class' => 'inputText', 'required', 'placeholder' => '請輸入Email']) !!}
                @error('email')
            @endFormGroup

            @formGroup('password')
                {!! Form::password('password', ['class' => 'inputText', 'required', 'placeholder' => '請輸入密碼']) !!}
                @error('password')
            @endFormGroup

             @formGroup('password')
                {!! Form::password('password_confirmation', ['class' => 'inputText', 'required', 'placeholder' => '請再輸入一次密碼']) !!}
                @error('password_confirmation')
            @endFormGroup
            

            {!! Form::hidden('github_id', '0') !!}
            {!! Form::hidden('github_username', '') !!}
            {!! Form::submit('註冊', ['class' => 'btn btn-primary btn-block']) !!}
            @formGroup('rules')
                <label>
                    <span style="color: #ef5350;">按下註冊代表已同意</span>
                    <a style="cursor: pointer; padding: 0;" data-toggle="modal" data-target="#rule">網站規則</a>
                </label>
            @endFormGroup
        {!! Form::close() !!}
    @endif
@endsection
