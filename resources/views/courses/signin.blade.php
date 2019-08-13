@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="col-md-9 ">
            <h1>個人資訊</h1>
            {!! Form::open(['route' => 'forum', 'method' => $method ?? 'POST','class' => 'buildThread']) !!}
                @formGroup('subject')
                    {!! Form::label('真實姓名') !!}
                    {!! Form::text('name', null, ['class' => 'inputText', 'required']) !!}
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('性別') !!}
                    {!! Form::select('sex', array('1' => '男', '2' => '女'), '1') !!}
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('聯絡信箱') !!}
                    {!! Form::email('email', null, ['class' => 'inputText', 'required']) !!}
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('連絡電話') !!}
                    {!! Form::number('phone', null, ['class' => 'inputText', 'required']) !!}
                    <span class="help-block">請輸入完整電話 (例:0987654321)</span>
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('投資經驗') !!}
                    {!! Form::select('experience', array('1' => '一年以下', '2' => '一 ~ 三年', '3' => '三 ~ 五年', '4' => '五年以上'), '1') !!}
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('活動資訊來源') !!}
                    {!! Form::select('source', array('1' => 'Facebook', '2' => '朋友介紹', '3' => '電視', '4' => '其他'), '1') !!}
                @endFormGroup
                @formGroup('subject')
                    {!! Form::label('報名人數') !!}
                    {!! Form::number('signinamount', null, ['class' => 'inputText', 'required', 'min' => "1"]) !!}
                @endFormGroup
                @formGroup('body')
                    {!! Form::label('備註') !!}
                    {!! Form::text('comment', null, ['class' => 'inputText', 'required']) !!}
                @endFormGroup

                {!! Form::submit(isset($thread) ? '前往付費網頁' : '前往付費網頁', ['class' => 'btn','style' => 'width: auto !important;float:right; display:inline-block;' ]) !!}
                <a href="{{ isset($thread) ? route('thread', $thread->slug()) : route('forum') }}" class="cancel" style = "width: auto !important; display:inline-block;  margin-top:0;">取消</a>
            {!! Form::close() !!}
        </div>
        <div class="col-md-3">
            <h1>課程資訊</h1>
            <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
                <h2>課程名稱: {{$course->name}}</h2>
                <h2>原價: </h2>
                <h2>方案價: </h2>
            </div>
        </div>
    </div>
@endsection
