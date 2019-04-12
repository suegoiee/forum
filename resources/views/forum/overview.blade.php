@php($subTitle = isset($activeTag) ? $activeTag->name() : null)
@title('討論區' . (isset($subTitle) ? ' ▸ ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="row forum">
        <div class="col-md-3">
            {{ Form::open(['route' => 'forum', 'method' => 'GET']) }}
                <div class="form-group">
                    {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => '搜尋文章','style' => 'width:100%;' ]) }}
                </div>
            {{ Form::close() }}

            @include('layouts._ads._forum_sidebar')

            <h3>分類</h3>
            <div class="list-group">
                <a href="{{ route('forum') }}" class="list-group-item {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}">所有分類</a>

                @foreach (App\Models\Tag::orderBy('name')->get() as $tag)
                    <a href="{{ route('forum.tag', $tag->slug()) }}"
                       class="list-group-item{{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                        {{ $tag->name() }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 chat-bg">
            <a class="btn btn-block" href="{{ route('threads.create') }}">發表文章</a>
            @include('layouts._ads._bsa-cpc')

            <p style="display: inline-block;"></p>
            @if (count($threads))
                @foreach ($threads as $thread)
                    <div class="panel panel-default chat-bd" style="height:auto; margin-bottom: 3% !important; margin-top: 3% !important;">
                        <div class="panel-heading thread-info">
                            <div class="thread-info-author headLabel">
                                <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link">{{ $thread->subject() }}</a>
                            </div>
                            @include('forum.threads.info.tags')
                        </div>

                        <div class="panel-body chat-bg">
                            <a href="{{ route('thread', $thread->slug()) }}">
                                <span class="badge pull-right">{{ count($thread->replies()) }}</span>
                                <p>{!! str_limit(strip_tags($thread->body), 100) !!}</p>
                            </a>
                        </div>
                        
                        <div class="thread-info-author authorName" style="text-align: right; display: block;">
                        @if (count($thread->replies()))
                            @include('forum.threads.info.avatar', ['user' => $thread->replies()->last()->author()])
                        @else
                            @include('forum.threads.info.avatar', ['user' => $thread->author()])
                        @endif
                            @if (count($thread->replies()))
                                @php($lastReply = $thread->replies()->last())
                                 最後更新於
                                {{ $lastReply->createdAt()->diffForHumans() }}
                            @else
                                <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="padding-right:3px;">{{ $thread->author()->name() }}</a> 在
                                {{ $thread->createdAt()->diffForHumans() }} 發文
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    {!! $threads->render() !!}
                </div>
            @else
                <div class="alert text-center" style="color: #545454;">
                    沒有找到相關文章!
                    <a href="{{ route('threads.create') }}" style="color: #545454;" class="alert-link">發表新的文章</a>
                </div>
            @endif
        </div>
    </div>
@endsection
