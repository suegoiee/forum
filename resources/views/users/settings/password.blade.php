@title('密碼更改')

@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {{ Form::open(['route' => 'settings.password.update', 'method' => 'PUT', 'class' => 'form-horizontal formSet']) }}
                @if (Auth::user()->hasPassword())
                    @formGroup('current_password')
                        {!! Form::label('現在密碼', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-12">
                            {!! Form::password('current_password', ['class' => 'inputText', 'required']) !!}
                            @error('current_password')
                        </div>
                    @endFormGroup
                @endif

                @formGroup('password')
                    {!! Form::label('password', '新的密碼', ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::password('password', ['class' => 'inputText', 'required']) !!}
                        @error('password')
                    </div>
                @endFormGroup

                @formGroup('password_confirmation')
                    {!! Form::label('password_confirmation', '再次輸入新的密碼', ['class' => 'col-md-3 control-label']) !!}

                    <div class="col-md-12">
                        {!! Form::password('password_confirmation', ['class' => 'inputText', 'required']) !!}
                    </div>
                @endFormGroup

                <div class="form-group">
                    <div style="padding-top:2%; text-align: center;">
                        {!! Form::submit('儲存', ['class' => 'btn btn-primary save']) !!}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
