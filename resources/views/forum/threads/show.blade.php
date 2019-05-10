@title($thread->subject())

@extends('layouts.default')

@section('content')
    <div class="row forum">
        <div class="col-md-3">

            <h3>@include('forum.threads.info.tags')</h3>
            <div class="formDrop"  style="margin-top: 6%;">
                <a class="dropdownTitle" role="button" data-target="#titleTable" data-toggle="collapse" aria-expanded="false">
                    所有分類 <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i>
                </a>
                <div class="dropdownMenu forumTitle collapse" id="titleTable">
                    <a class="dropdownItem {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}" href="{{ route('forum') }}">全部<a>
                @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                    @if(count($thread->tags()) == 0)
                        <a href="{{ route('forum.tag', $tag->slug()) }}" class="dropdownItem">
                            {{ $tag->name() }}
                        </a>
                    @else
                        @if($thread->tags()[0]["id"] != $tag->id())
                            <a href="{{ route('forum.tag', $tag->slug()) }}" class="dropdownItem">
                                {{ $tag->name() }}
                            </a>
                        @else
                            <a href="{{ route('forum.tag', $tag->slug()) }}" class="dropdownItem active">
                                {{ $tag->name() }}
                            </a>
                        @endif
                    @endif
                @endforeach
                </div>
            </div>

            <!--a class="btn btn-link btn-block" id="build" href="{{ route('forum') }}">
            <img src="/images/icon/back.svg">
            </a-->

            @include('layouts._ads._forum_sidebar')
        </div>
        <div style="text-align:right;">
            @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                <a class="btn_Build" style="margin-top: 2%;" href="{{ route('threads.edit', $thread->slug()) }}">
                    編輯
                </a>
            @endcan

            @can(App\Policies\ThreadPolicy::UNSUBSCRIBE, $thread)
                <a class="btn_Build" style="margin-top: 2%;" href="{{ route('threads.unsubscribe', $thread->slug()) }}">
                    取消追蹤
                </a>
            @elsecan(App\Policies\ThreadPolicy::SUBSCRIBE, $thread)
                <a class="btn_Build" style="margin-top: 2%;" href="{{ route('threads.subscribe', $thread->slug()) }}">
                    追蹤
                </a>
            @endcan

            @can(App\Policies\ThreadPolicy::DELETE, $thread)
                <a class=" btn_Build" style="margin-top: 2%;" href="#" data-toggle="modal" data-target="#deleteThread">
                    刪除
                </a>

                @include('_partials._delete_modal', [
                    'id' => 'deleteThread',
                    'route' => ['threads.delete', $thread->slug()],
                    'title' => '刪除文章',
                    'body' => '<p>確定要刪除文章及留言嗎?</p>',
                ])
            @endcan
        </div>    
        <div class="col-md-9" style=" margin-top: 15px;">
            <div class="panel panel-default" style="border:none !important; padding-top:2%; padding-left:0 !important;margin-top: 0 !important;">
                <div class="panel-heading thread-info" style="border-bottom: 2px dashed #e9e9e9;">
                    <div class="thread-info-author headLabel showTitle">
                        <h3>{{ $thread->subject() }}</h3>
                    </div>
                    <div class="showTag">
                        @include('forum.threads.info.tags')
                    </div>
                    <div style="position: absolute; display: contents;" class="fb-share-button" >
                        <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="fb-share-button" data-layout="button">分享</a>
                    </div>
                    
                </div>

                <div class="panel-body forum-content">
                    {!! $thread->body() !!}
                </div>

                <div class="thread-info-author authorName" style="text-align: right; display: inline-block; width: 100%;">

                <div style="float: left;" class="fb-share-button" >
                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="fb-share-button" data-layout="button">分享</a>
                </div>
                    @include('forum.threads.info.avatar', ['user' => $thread->author()])
                    <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="display: inline-block; padding-right:5px;">{{ $thread->author()->username() }}</a>
                    在 {{ $thread->createdAt()->diffForHumans() }} 發文
                </div>
            </div>

            @include('layouts._ads._bsa-cpc')

            <div style="border-bottom: 2px solid #e9e9e9; padding-top: 3%;">留言</div>
            @foreach ($thread->replies() as $reply)
                <div style="padding-top: 2%; border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:2px dashed #e9e9e9 !important;" class="panel {{ $thread->isSolutionReply($reply) ? 'panel-success' : 'panel-default' }}">
                    <div class="thread-info-author authorName">
                            <a href="{{ route('profile', $reply->author()->username()) }}" class="thread-info-link" style="padding-right:3px; display: inline-block;">
                                <i class="far fa-comment-dots"></i> {{ $reply->author()->username() }}
                            </a> 
                    </div>    
                    <div class="thread-info-author headLabel">

                    {!! $reply->body !!}
                        
                    </div>
                    @can(App\Policies\ReplyPolicy::UPDATE, $reply)
                            <div class="thread-info-tags" style="float:right">
                                <a class="btn-xs" style="line-height: 0.5;" href="{{ route('replies.edit', $reply->id()) }}">
                                    <img src="/images/icon/edit.svg" style="width:16px;">
                                </a>
                                <a class="btn-xs" style="line-height: 0.5;" href="#" data-toggle="modal" data-target="#deleteReply{{ $reply->id() }}">
                                    <img src="/images/icon/recycling-bin.svg" style="width:16px;">
                                </a>
                            </div>
                    @endcan

                    <div class="forum-content">
                        @include('forum.threads.info.avatar', ['user' => $reply->author()])

                        <div class="timeReply">
                            
                            在{{ $reply->createdAt()->diffForHumans() }} 留言

                            @if ($thread->isSolutionReply($reply))
                                <span class="label label-primary thread-info-badge">
                                    解決
                                </span>
                            @endif
                        </div>
                        @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                            <div class="pull-right" style="font-size: 20px">
                                @if ($thread->isSolutionReply($reply))
                                    <a href="#" data-toggle="modal" data-target="#unmarkSolution">
                                        <i class="fa fa-times-circle-o text-danger"></i>
                                    </a>

                                    @include('_partials._update_modal', [
                                        'id' => 'unmarkSolution',
                                        'route' => ['threads.solution.unmark', $thread->slug()],
                                        'title' => 'Unmark As Solution',
                                        'body' => '<p>Confirm to unmark this reply as the solution for <strong>"'.e($thread->subject()).'"</strong>.</p>',
                                    ])
                                @else
                                    <a class="text-success" href="#" data-toggle="modal" data-target="#markSolution{{ $reply->id() }}">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>

                                    @include('_partials._update_modal', [
                                        'id' => "markSolution{$reply->id()}",
                                        'route' => ['threads.solution.mark', $thread->slug(), $reply->id()],
                                        'title' => 'Mark As Solution',
                                        'body' => '<p>Confirm to mark this reply as the solution for <strong>"'.e($thread->subject()).'"</strong>.</p>',
                                    ])
                                @endif
                            </div>
                        @endcan

                    </div>
                </div>

                @include('_partials._delete_modal', [
                    'id' => "deleteReply{$reply->id()}",
                    'route' => ['replies.delete', $reply->id()],
                    'title' => '刪除留言',
                    'body' => '<p>確定要刪除留言？</p>',
                ])
            @endforeach

            @can(App\Policies\ReplyPolicy::CREATE, App\Models\Reply::class)
                @if ($thread->isConversationOld())
                 
                    <p class="text-center">
                        最後的留言已經超過6個月! 如果有相同問題， 請在 <a href="{{ route('threads.create') }}">新增文章</a> 
                    </p>
                @else
                   

                    <div class="remind">
                            請在留言前確認已了解 
                            <a style="color:#ffa500; font-weight:bolder; cursor: pointer;" data-toggle="modal" data-target="#rule">論壇規則</a>。
                                @include('_partials._rule_modal', [
                                    'id' => 'rule',
                                ])
                    </div>

                    
                    {!! Form::open(['route' => 'replies.store']) !!}
                        @formGroup('body')
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'required', 'style' => 'height:100% !important;margin-bottom: 0 !important; border-top: 1px dashed #e9e9e9 !important;border:none ; border-radius: 0;']) !!}
                            @error('body')
                        @endFormGroup

                        {!! Form::hidden('replyable_id', $thread->id()) !!}
                        {!! Form::hidden('replyable_type', 'threads') !!}
                        {!! Form::submit('留言', ['class' => 'btn btn-primary btn-block','id' => 'btnReply' ,'style' => 'width:auto !important; margin-top:2%; margin-bottom:2%; margin-left: auto;' ]) !!}
                    {!! Form::close() !!}
                @endif
            @endcan

            @if (Auth::guest())
               
                <p class="text-center">
                    <a style="color: #ffa500;" href="{{ route('login') }}">登入</a> 加入討論吧!
                </p>
            @endif
        </div>
        @include('layouts._footer')
    </div>
@endsection
