@title($archive->subject())

@extends('layouts.default')

@section('content')
    <div class="row blog">
            @include('layouts._alerts')
            <!-- <div class="edde">
                @can(App\Policies\ArchivePolicy::UPDATE, $archive)
                    <a class="btn"href="{{ route('archives.edit', $archive->slug()) }}">
                        編輯
                    </a>
                @endcan
    
                @can(App\Policies\ArchivePolicy::DELETE, $archive)
                    <a class="btn" href="#" data-toggle="modal" data-target="#deleteArchive">
                        刪除
                    </a>
    
                    @include('_partials._delete_modal', [
                        'id' => 'deleteArchive',
                        'route' => ['archives.delete', $archive->slug()],
                        'title' => '刪除文章',
                        'body' => '<p>確定要刪除文章嗎?</p>',
                    ])
                @endcan
            </div> -->

        <!--div class="col-md-3 blogTitle" style="margin-top: 1%;">
        
                <div class="dropdown">
                    <a class="dropdown-toggle" role="button" data-target="#titleTable" data-toggle="collapse" aria-expanded="false">
                        優分析專欄 <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i>
                    </a>
                    <div class="dropdown-menu" aria-expanded="false"id="titleTable">
                        <a class="dropdown-item" href="{{ route('blogs') }}" >
                            全部
                        <a>
                    @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                            <a href="{{ route('blogs.tag', $tag->slug()) }}"
                            class="dropdown-item {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                                {{ $tag->name() }} 
                            </a>
                    @endforeach
                    </div>
                </div>
        </div-->
        <div class="col-md-9 blogContent" style="margin-top: 15px; width: 1140px; margin-left: 15px;">
            <div class="panel" style="border:none !important; margin: 3% 5% 3% !important;">
                <div class="panel-heading">
                    <!-- @include('blogs.archives.info.tags') -->
                    <div class="thread-info-author showTitle">
                        <a href="{{ route('blogs', $archive->slug()) }}" class="thread-info-link formTitle">{{ $archive->subject() }}</a>
                    </div>
                    <div style="float:right;">
                        <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="fb-share-button" data-layout="button">分享</a>
                    </div>
                    <div class="thread-info-author" style="display: inline-block; ">
                        {{ $archive->createdAt() }} 
                    </div>
                </div>

                <div class="panel-body forum-content">
                    {!! $archive->body() !!}
                </div>

                <div class="fbPad" style="float: left;">
                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="fb-share-button" data-layout="button">分享</a>
                </div>
                
                <div class="thread-info-author authorName" style="text-align: right; display: block;">                      
                    <div class="thread-info-link" style="padding-right:3px; font-size: 18px; color: #393939;">{{ $archive->author()->username() }}</div> 
                </div>
            </div>

            <div style="border-bottom: 2px solid #e9e9e9; padding-top: 3%;">留言</div>
            @foreach ($archive->replies() as $reply)
                <div style="padding-top: 15px; padding-left: 15px; border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:2px dashed #e9e9e9 !important;">
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
                        @include('blogs.archives.info.avatar', ['user' => $reply->author()])

                        <div class="timeReply">
                            
                            在{{ $reply->createdAt()->diffForHumans() }} 留言

                        </div>

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
                @if ($archive->isConversationOld())
                 
                    <p class="text-center">
                        最後的留言已經超過6個月!
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

                        {!! Form::hidden('replyable_id', $archive->id()) !!}
                        {!! Form::hidden('replyable_type', 'archives') !!}
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
    </div>
@endsection
