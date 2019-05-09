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
                    {!! Form::text('name', session('githubData.name'), ['class' => 'form-control regMg', 'required', 'placeholder' => 'John Doe']) !!}
                    @error('name')
                @endFormGroup
                */
            @endphp

            @formGroup('username')
                {!! Form::text('username', session('githubData.username'), ['class' => 'form-control regMg', 'required', 'placeholder' => '請輸入暱稱']) !!}
                @error('username')
            @endFormGroup

            @formGroup('email')
                {!! Form::email('email', session('githubData.email'), ['class' => 'form-control regMg', 'required', 'placeholder' => '請輸入Email']) !!}
                @error('email')
            @endFormGroup

            @formGroup('password')
                {!! Form::password('password', ['class' => 'form-control regMg', 'required', 'placeholder' => '請輸入密碼']) !!}
                @error('password')
            @endFormGroup

             @formGroup('password')
                {!! Form::password('password_confirmation', ['class' => 'form-control regMg', 'required', 'placeholder' => '請再輸入一次密碼']) !!}
                @error('password_confirmation')
            @endFormGroup
            
            @formGroup('rules')
                <label>
                    {!! Form::checkbox('rules') !!}
                    &nbsp; 已閱讀並同意 
                    <a style="cursor: pointer;" data-toggle="modal" data-target="#rule">網站規則</a>
                </label>
                @error('rules')

                <label>
                    {!! Form::checkbox('terms') !!}
                    &nbsp; 已閱讀並同意 
                    <a style="cursor: pointer;" data-toggle="modal" data-target="#term">免責聲明</a> 
                    及 
                    <a style="cursor: pointer;" data-toggle="modal" data-target="#privacy">隱私權政策</a>
                </label>
                @error('rules')
            @endFormGroup

            {!! Form::hidden('github_id', '0') !!}
            {!! Form::hidden('github_username', '') !!}
            {!! Form::submit('註冊', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    @endif
@endsection
