{!! Form::open(['route' => $route, 'method' => $method ?? 'POST']) !!}
    @formGroup('subject')
        {!! Form::label('標題') !!}
        {!! Form::text('subject', isset($archive) ? $archive->subject() : null, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
        <span class="help-block">字數不可超過60字!</span>
        @error('subject')
    @endFormGroup

    @formGroup('body')
        {!! Form::label('內容') !!}
        {!! Form::textarea('body', isset($archive) ? $archive->body() : null, ['class' => 'form-control', 'required']) !!}
        @error('body')
    @endFormGroup

    @formGroup('tags')
        {!! Form::label('分類') !!}
        {!! Form::select('tags[]', $tags->pluck('name', 'id'), isset($archive) ? $archive->tags()->pluck('id')->toArray() : [], ['class' => 'form-control']) !!}
        <!--class => 'selectize', 'multiple'-->
        <span class="help-block">只能選擇一個分類!</span>
        @error('tags')
    @endFormGroup

    {!! Form::submit(isset($archive) ? '確定' : '發文', ['class' => 'btn btn-primary','style' => 'width: auto !important;float:right; display:inline-block;' ]) !!}
    <a href="{{ isset($archive) ? route('archives', $archive->slug()) : route('blogs') }}" class="btn btn-primary btn-block" style = "width: auto !important; display:inline-block;  margin-top:0;">取消</a>
{!! Form::close() !!}
