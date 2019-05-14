@title($archive->subject())

@extends('layouts.default')

@section('content')
    <div class="row blog">

            <div class="edde">
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
            </div>

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
        <div class="col-md-9 blogContent" style="margin-top: 15px; width: 100% !important;">
            <div class="panel panel-default" style="border:none !important; margin: 3% 5% 3% !important;">
                <div class="panel-heading thread-info">
                    @include('blogs.archives.info.tags')
                    <div class="thread-info-author headLabel showTitle">
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

                <div style="float: left;">
                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="fb-share-button" data-layout="button">分享</a>
                </div>
                
                <div class="thread-info-author authorName" style="text-align: right; display: block;">                      
                    <div class="thread-info-link" style="padding-right:3px; font-size: 18px; color: #393939;">{{ $archive->author()->username() }}</div> 
                </div>
            </div>

        </div>
    </div>
@endsection
