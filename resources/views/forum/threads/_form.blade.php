{!! Form::open(['route' => $route, 'method' => $method ?? 'POST','class' => 'buildThread']) !!}
    @formGroup('subject')
        {!! Form::label('標題') !!}
        {!! Form::text('subject', isset($thread) ? $thread->subject() : null, ['class' => 'inputText', 'required', 'maxlength' => '60']) !!}
        <span class="help-block">字數不可超過60字!</span>
        @error('subject')
    @endFormGroup

    @formGroup('body')
        {!! Form::label('內容') !!}
        {!! Form::textarea('body', isset($thread) ? $thread->body() : null, ['class' => 'inputText', 'required']) !!}
        @error('body')
    @endFormGroup

    @formGroup('tags')
        {!! Form::label('分類') !!}
        {!! Form::select('tags[]', $tags->pluck('name', 'id'), isset($thread) ? $thread->tags()->pluck('id')->toArray() : [], ['class' => 'inputText']) !!}
        <!--class => 'selectize', 'multiple'-->
        <span class="help-block">只能選擇一個分類!</span>
        @error('tags')
    @endFormGroup

    {!! Form::submit(isset($thread) ? '確定' : '發文', ['class' => 'btn','style' => 'width: auto !important;float:right; display:inline-block;' ]) !!}
    <a href="{{ isset($thread) ? route('thread', $thread->slug()) : route('forum') }}" class="cancel" style = "width: auto !important; display:inline-block;  margin-top:0;">取消</a>
{!! Form::close() !!}
