@php($subTitle = isset($activeTag) ? $activeTag->name() : null)
@title('討論區' . (isset($subTitle) ? ' ▸ ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
    <div class="forumTit" style="display: inline-block; background-color: #e9e9e9; position: fixed; z-index: 3; width: 1180px; padding-top: 20px;">
        <h1 style="float: left; line-height: 31px; margin-top: 0;">{{ $title }}</h1>
        {{ Form::open(['route' => 'forum', 'method' => 'GET', 'class' => 'search-article','style' => 'padding: 0; float: left;']) }}
            <div class="form-group">
                {{ Form::text('search', $search ?? null, ['class' => 'form-control search-article', 'placeholder' => '搜尋文章' ]) }}
            </div>
        {{ Form::close() }}
        <div style="text-align:right;">
            <a class="btn" style="margin-right: 8px;" href="{{ route('threads.create') }}">發表文章</a>
        </div>
    </div>
    <!-- <div class="placardText">
        <a class="" data-toggle="modal" data-target="#placard"><i class="fas fa-bell"></i></a>
            @include('_partials._placard_modal')
    </div> -->
    <div class="row forum forumTop">
    
    @include('layouts._alerts')

        <div class="col-md-3">

            @include('layouts._ads._forum_sidebar')

            <div class="formDrop">
                <a class="dropdownTitle" role="button" data-target="#titleTable" data-toggle="collapse" aria-expanded="false">
                    所有分類 <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i>
                </a>
                <div class="dropdownMenu forumTitle collapse" aria-expanded="false" id="titleTable">
                    <a class="dropdownItem {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}" href="{{ route('forum') }}">全部<a>
                    @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                        <a href="{{ route('forum.tag', $tag->slug()) }}" class="dropdownItem {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }} ">
                                {{ $tag->name() }}
                        </a>
                    @endforeach
                </div>
                
            </div>
        </div>
        <div class="col-md-9">
            @include('layouts._ads._bsa-cpc')
            @if (count($threads))
                @foreach ($threads as $thread)
                    @if(Gate::check(App\Policies\ThreadPolicy::ISVIP, [$thread, App\Models\CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get()]) || Gate::check(App\Policies\UserPolicy::MASTER, [App\User::class, $thread->tags()[0]->id]))
                        <div class="panel panel-default" style="margin-top: 3% !important;">
                            <div class="panel-heading">
                                <div class="thread-info-author">
                                    @if($thread->banThread())
                                        <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link thread-entrance">{{trans('forum.threads.banned.title')}}</a>
                                    @else
                                        <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link thread-entrance">{{ $thread->subject() }}</a>
                                    @endif
                                </div>
                                @include('forum.threads.info.tags')
                            </div>

                            <div class="panel-body">
                                <a href="{{ route('thread', $thread->slug()) }}">
                                    <span class="badge pull-right" style="margin-right: 15px;">{{ count($thread->replies()) }}</span>
                                    @if($thread->banThread())
                                        <p class="thread-entrance">{{trans('forum.threads.banned.body')}}</p>
                                    @else
                                        <p class="thread-entrance">{!! str_limit(strip_tags($thread->body), 100) !!}</p>
                                    @endif
                                </a>
                            </div>
                            
                            <div class="thread-info-author authorName" style="text-align: right; display: block;">
                                @if (count($thread->replies()))
                                    @include('forum.threads.info.avatar', ['user' => $thread->replies()->last()->author()])
                                @else
                                    @include('forum.threads.info.avatar', ['user' => $thread->author()])
                                @endif
                                    <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="padding-right:3px;">{{ $thread->author()->username() }}</a> 在
                                    {{ $thread->createdAt()->diffForHumans() }} 發文
                            </div>
                        </div>
                    @elseif(empty(App\Models\CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get()[0]))
                        <div class="panel panel-default" style="margin-top: 3% !important;">
                            <div class="panel-heading">
                                <div class="thread-info-author">
                                    @if($thread->banThread())
                                        <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link thread-entrance">{{trans('forum.threads.banned.title')}}</a>
                                    @else
                                        <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link thread-entrance">{{ $thread->subject() }}</a>
                                    @endif
                                </div>
                                @include('forum.threads.info.tags')
                            </div>

                            <div class="panel-body">
                                <a href="{{ route('thread', $thread->slug()) }}">
                                    <span class="badge pull-right" style="margin-right: 15px;">{{ count($thread->replies()) }}</span>
                                    @if($thread->banThread())
                                        <p class="thread-entrance">{{trans('forum.threads.banned.body')}}</p>
                                    @else
                                        <p class="thread-entrance">{!! str_limit(strip_tags($thread->body), 100) !!}</p>
                                    @endif
                                </a>
                            </div>
                            
                            <div class="thread-info-author authorName" style="text-align: right; display: block;">
                                @if (count($thread->replies()))
                                    @include('forum.threads.info.avatar', ['user' => $thread->replies()->last()->author()])
                                @else
                                    @include('forum.threads.info.avatar', ['user' => $thread->author()])
                                @endif
                                    <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="padding-right:3px;">{{ $thread->author()->username() }}</a> 在
                                    {{ $thread->createdAt()->diffForHumans() }} 發文
                            </div>
                        </div>
                    @endif
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
