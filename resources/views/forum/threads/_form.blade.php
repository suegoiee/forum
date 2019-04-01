{!! Form::open(['route' => $route, 'method' => $method ?? 'POST']) !!}
    @formGroup('subject')
        {!! Form::label('討論主題') !!}
        {!! Form::text('subject', isset($thread) ? $thread->subject() : null, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
        <span class="help-block">字數不可超過60字.</span>
        @error('subject')
    @endFormGroup

    @formGroup('body')
        {!! Form::label('內容') !!}
        {!! Form::textarea('body', isset($thread) ? $thread->body() : null, ['class' => 'form-control wysiwyg', 'required']) !!}
        @error('body')
    @endFormGroup

    @formGroup('tags')
        {!! Form::label('標註') !!}
        {!! Form::select('tags[]', $tags->pluck('name', 'id'), isset($thread) ? $thread->tags()->pluck('id')->toArray() : [], ['class' => 'form-control selectize', 'multiple']) !!}
        <span class="help-block">可以選擇三個標註.</span>
        @error('tags')
    @endFormGroup

    {!! Form::submit(isset($thread) ? 'Update Thread' : '建立主題', ['class' => 'btn btn-primary btn-block','style' => 'width:30% !important; margin-left:35%;' ]) !!}
    <a href="{{ isset($thread) ? route('thread', $thread->slug()) : route('forum') }}" class="btn btn-primary btn-block" style = "width:30% !important; margin-left:35%;">取消</a>
{!! Form::close() !!}
