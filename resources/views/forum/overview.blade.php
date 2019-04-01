@php($subTitle = isset($activeTag) ? $activeTag->name() : null)
@title('討論區' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="row forum">
        <div class="col-lg-3">
            {{ Form::open(['route' => 'forum', 'method' => 'GET']) }}
                <div class="form-group">
                    {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => '搜尋主題','style' => 'width:100%;' ]) }}
                </div>
            {{ Form::close() }}

            @include('layouts._ads._forum_sidebar')

            <h3>分類</h3>
            <div class="list-group">
                <a href="{{ route('forum') }}" class="list-group-item {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}">All</a>

                @foreach (App\Models\Tag::orderBy('name')->get() as $tag)
                    <a href="{{ route('forum.tag', $tag->slug()) }}"
                       class="list-group-item{{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                        {{ $tag->name() }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-lg-9 chat-bg">
            <a class="btn btn-block" href="{{ route('threads.create') }}">發表文章</a>
            @include('layouts._ads._bsa-cpc')

            @if (count($threads))
                @foreach ($threads as $thread)
                    <div class="panel panel-default chat-bd">
                        <div class="panel-heading thread-info">
                            <h4 class="media-heading">{{ $thread->subject() }}</h4>
                            @include('forum.threads.info.tags')
                        </div>

                        <div class="panel-body chat-bg">
                            <a href="{{ route('thread', $thread->slug()) }}">
                                <span class="badge pull-right">{{ count($thread->replies()) }}</span>
                                <p>{{ $thread->excerpt() }}</p>
                            </a>
                        </div>
                            @if (count($thread->replies()))
                                @include('forum.threads.info.avatar', ['user' => $thread->replies()->last()->author()])
                            @else
                                @include('forum.threads.info.avatar', ['user' => $thread->author()])
                            @endif
                            <div class="thread-info-author">
                                @if (count($thread->replies()))
                                    @php($lastReply = $thread->replies()->last())
                                    <a href="{{ route('profile', $lastReply->author()->username()) }}" class="thread-info-link">{{ $lastReply->author()->name() }}</a> replied
                                    {{ $lastReply->createdAt()->diffForHumans() }}
                                @else
                                    <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link">{{ $thread->author()->name() }}</a> posted
                                    {{ $thread->createdAt()->diffForHumans() }}
                                @endif
                            </div>
                    </div>
                @endforeach

                <div class="text-center">
                    {!! $threads->render() !!}
                </div>
            @else
                <div class="alert alert-info text-center">
                    沒有找到相關主題!
                    <a href="{{ route('threads.create') }}" class="alert-link">建立新的主題</a>
                </div>
            @endif
        </div>
    </div>
@endsection
