@title($thread->subject())

@extends('layouts.default')

@section('content')
    <div class="row forum">
        <div class="col-lg-3">

            <h3>分類</h3>
            <div class="list-group">
                <a href="{{ route('forum') }}" class="list-group-item {{ active('forum*', ! isset($activeTag) || $activeTag === null) }}">所有分類</a>

                @foreach (App\Models\Tag::orderBy('name')->get() as $tag)
                    @if ($tag->id() != $thread->tags()[0]["id"])
                        <a href="{{ route('forum.tag', $tag->slug()) }}" class="list-group-item">
                            {{ $tag->name() }}
                        </a>
                    @else
                        <a href="{{ route('forum.tag', $tag->slug()) }}" class="list-group-item active">
                            {{ $tag->name() }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!--a class="btn btn-link btn-block" id="build" href="{{ route('forum') }}">
            <img src="/images/icon/back.svg">
            </a-->

            @include('layouts._ads._forum_sidebar')
        </div>
        <div class="col-lg-9">

            @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                <a class="btn btn-default btn-block" style="margin-top: 5px;" href="{{ route('threads.edit', $thread->slug()) }}">
                    編輯
                </a>
            @endcan

            @can(App\Policies\ThreadPolicy::UNSUBSCRIBE, $thread)
                <a class="btn btn-primary btn-block" href="{{ route('threads.unsubscribe', $thread->slug()) }}">
                    取消追蹤
                </a>
            @elsecan(App\Policies\ThreadPolicy::SUBSCRIBE, $thread)
                <a class="btn btn-primary btn-block" href="{{ route('threads.subscribe', $thread->slug()) }}">
                    追蹤
                </a>
            @endcan

            @can(App\Policies\ThreadPolicy::DELETE, $thread)
                <a class="btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#deleteThread">
                    刪除
                </a>

                @include('_partials._delete_modal', [
                    'id' => 'deleteThread',
                    'route' => ['threads.delete', $thread->slug()],
                    'title' => 'Delete Thread',
                    'body' => '<p>Are you sure you want to delete this thread and its replies? This cannot be undone.</p>',
                ])
            @endcan
            <p style="display:inline-block;"></p>
            <div class="panel panel-default" style="border:none !important; padding-top:2%; padding-left:0 !important;">
                <div class="panel-heading thread-info" style="border-bottom: 2px dashed #e9e9e9;">
                    <div class="thread-info-author headLabel">
                        <a href="{{ route('thread', $thread->slug()) }}" class="thread-info-link formTitle">{{ $thread->subject() }}</a>
                    </div>
                    @include('forum.threads.info.tags')
                </div>

                <div class="panel-body forum-content">
                    @md($thread->body())
                </div>

                <div class="thread-info-author authorName" style="float: right; display: inline-flex;">
                    @include('forum.threads.info.avatar', ['user' => $thread->author()])
                    <a href="{{ route('profile', $thread->author()->username()) }}" class="thread-info-link" style="padding-right:5px;">{{ $thread->author()->name() }}</a>
                    在 {{ $thread->createdAt()->diffForHumans() }} 發文
                </div>
            </div>

            @include('layouts._ads._bsa-cpc')

            <div style="border-bottom: 2px solid #e9e9e9; padding-top: 3%;">回應</div>
            @foreach ($thread->replies() as $reply)
                <div style="border:none !important;" class="panel {{ $thread->isSolutionReply($reply) ? 'panel-success' : 'panel-default' }}">
                    <div class="thread-info-author headLabel">

                    @md($reply->body())
                        @can(App\Policies\ReplyPolicy::UPDATE, $reply)
                            <div class="thread-info-tags" style="float:right">
                                <a class="btn btn-default btn-xs" href="{{ route('replies.edit', $reply->id()) }}">
                                    <img src="/images/icon/edit.svg" style="width:16px;">
                                </a>
                                <a class="btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#deleteReply{{ $reply->id() }}">
                                    <img src="/images/icon/recycling-bin.svg" style="width:16px;">
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="forum-content">
                        @include('forum.threads.info.avatar', ['user' => $reply->author()])

                        <div class="thread-info-author authorName" style="border-bottom: 2px dashed #e9e9e9;">
                            <a href="{{ route('profile', $reply->author()->username()) }}" class="thread-info-link" style="padding-right:3px;">
                                {{ $reply->author()->name() }}
                            </a> 在
                            {{ $reply->createdAt()->diffForHumans() }} 回應

                            @if ($thread->isSolutionReply($reply))
                                <span class="label label-primary thread-info-badge">
                                    Solution
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
                    'title' => 'Delete Reply',
                    'body' => '<p>確定要刪除回應？還沒回應完成.</p>',
                ])
            @endforeach

            @can(App\Policies\ReplyPolicy::CREATE, App\Models\Reply::class)
                @if ($thread->isConversationOld())
                 
                    <p class="text-center">
                        The last reply to this thread was more than six months ago. Please consider <a href="{{ route('threads.create') }}">opening a new thread</a> if you have a similar question.
                    </p>
                @else
                   

                    <div class="remind">
                        <p>
                            請在回應前確認已了解 <a href="{{ route('rules') }}">論壇規則</a>.
                        </p>
                    </div>

                    
                    {!! Form::open(['route' => 'replies.store']) !!}
                        @formGroup('body')
                            {!! Form::textarea('body', null, ['class' => 'form-control wysiwyg', 'required', 'style' => 'height:100% !important; border-top: 1px dashed #e9e9e9 !important;border:none ; border-radius: 0;']) !!}
                            @error('body')
                        @endFormGroup

                        {!! Form::hidden('replyable_id', $thread->id()) !!}
                        {!! Form::hidden('replyable_type', 'threads') !!}
                        {!! Form::submit('回應', ['class' => 'btn btn-primary btn-block','id' => 'btnReply' ,'style' => 'width:auto !important; margin-top:2%; margin-bottom:2%;' ]) !!}
                    {!! Form::close() !!}
                @endif
            @endcan

            @if (Auth::guest())
               
                <p class="text-center">
                    <a href="{{ route('login') }}">登入</a> 加入討論吧!
                </p>
            @endif
        </div>
    </div>
@endsection
