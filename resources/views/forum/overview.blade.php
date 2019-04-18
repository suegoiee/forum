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

            <div class="dropdown formDrop">
                <a class="dropdownTitle" role="button" data-target="#titleTable" data-toggle="collapse" aria-expanded="false">
                    所有主題
                </a>
                <div class="dropdownMenu forumTitle" aria-expanded="false" id="titleTable">
                    <a class="dropdownItem {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}" href="{{ route('forum') }}">全部<a>
                @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                    <a href="{{ route('forum.tag', $tag->slug()) }}"
                        class="dropdownItem {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }} ">
                            {{ $tag->name() }}
                    </a>
                @endforeach
                </div>
            </div>
        </div>
        <div style="text-align:right;margin-top: 1%;">
            <a class="btn_Build" href="{{ route('threads.create') }}">發表文章</a>
        </div>
        <div class="col-md-9 chat-bg">
            @include('layouts._ads._bsa-cpc')

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
                                <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="padding-right:3px;">{{ $thread->author()->username() }}<span style="font-size:12px;font-weight: 100;">(對外公開)</span></a> 在
                                {{ $thread->createdAt()->diffForHumans() }} 發文
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
