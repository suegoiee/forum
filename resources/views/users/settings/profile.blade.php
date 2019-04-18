@title('帳號設定')

@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open(['route' => 'settings.profile.update', 'method' => 'PUT', 'class' => 'form-horizontal formSet']) !!}
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3" style="margin-left:0%;">
                    <img src="/images/icon/userSetting.svg" style="width:40px;">
                    </div>
                </div>

                @formGroup('name')
                    {!! Form::label('姓名', null, ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::text('name', Auth::user()->name(), ['class' => 'form-control', 'required']) !!}
                        @error('name')
                    </div>
                @endFormGroup

                @formGroup('email')
                    {!! Form::label('Email', null, ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::email('email', Auth::user()->emailAddress(), ['class' => 'form-control', 'required']) !!}
                        @error('email')
                    </div>
                @endFormGroup

                @formGroup('username')
                    {!! Form::label('暱稱 (對外公開)', null, ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::text('username', Auth::user()->username(), ['class' => 'form-control', 'required']) !!}
                        @error('username')
                    </div>
                @endFormGroup

                @formGroup('bio')
                    {!! Form::label('自我介紹', null, ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::textarea('bio', Auth::user()->bio(), ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160, 'style' => 'height:auto !important;']) !!}
                        <span class="help-block">簡介字數少於160字!</span>
                        @error('bio')
                    </div>
                @endFormGroup

                <div class="form-group">
                    <div class="col-md-offset-3 ">
                        {!! Form::submit('儲存', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
