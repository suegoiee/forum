@title($thread->subject())

@extends('layouts.default')

@section('content')
    <div class="row blog">
        <div class="col-md-3 blogTitle">
            {{ Form::open(['route' => 'blogs', 'method' => 'GET']) }}
                <div class="form-group">
                    {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => '搜尋文章','style' => 'width:100%;' ]) }}
                </div>
            {{ Form::close() }}
        
            <div class="dropdown">
                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">優分析專欄</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('blogs') }}" >全部<a>
                    @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                            <a href="{{ route('blogs.tag', $tag->slug()) }}"
                            class="dropdown-item {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                                {{ $tag->name() }}
                            </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9 blogContent" style="margin-top: 5%;">

            @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                <a class="btn btn-default btn-block" style="margin-top: 5px;" href="{{ route('archives.edit', $thread->slug()) }}">
                    編輯
                </a>
            @endcan

            @can(App\Policies\ThreadPolicy::DELETE, $thread)
                <a class="btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#deleteThread">
                    刪除
                </a>

                @include('_partials._delete_modal', [
                    'id' => 'deleteThread',
                    'route' => ['archives.delete', $thread->slug()],
                    'title' => '刪除文章',
                    'body' => '<p>確定要刪除文章嗎?</p>',
                ])
            @endcan
            <p style="display:inline-block;"></p>
            <div class="panel panel-default" style="border:none !important; margin: 3% 5% 3% !important;">
                <div class="panel-heading thread-info">
                    <div class="thread-info-author headLabel">
                        <a href="{{ route('blogs', $thread->slug()) }}" class="thread-info-link formTitle">{{ $thread->subject() }}</a>
                    </div>
                    @include('blogs.archives.info.tags')
                </div>

                <div class="thread-info-author" style="display: inline-block; width: 100%;">
                    {{ $thread->createdAt()->diffForHumans() }} 
                </div>

                <div class="panel-body forum-content">
                    {!! $thread->body() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
