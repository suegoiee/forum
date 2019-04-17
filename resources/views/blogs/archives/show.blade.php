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
                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    優分析專欄
                    <span style="color:#545454">( {{ $count }} )</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('blogs') }}" >
                        全部
                        <span>( {{ $count }} )</span>
                    <a>
                    @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                            <a href="{{ route('blogs.tag', $tag->slug()) }}"
                            class="dropdown-item {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                                {{ $tag->name() }}
                                <span>( {{ count($tag->$archives) }} )</span>
                            </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9 blogContent" style="margin-top: 5%;">

            @can(App\Policies\ArchivePolicy::UPDATE, $archive)
                <a class="btn btn-default btn-block" style="margin-top: 5px;" href="{{ route('archives.edit', $archive->slug()) }}">
                    編輯
                </a>
            @endcan

            @can(App\Policies\ArchivePolicy::DELETE, $archive)
                <a class="btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#deleteArchive">
                    刪除
                </a>

                @include('_partials._delete_modal', [
                    'id' => 'deleteArchive',
                    'route' => ['archives.delete', $archive->slug()],
                    'title' => '刪除文章',
                    'body' => '<p>確定要刪除文章嗎?</p>',
                ])
            @endcan
            <p style="display:inline-block;"></p>
            <div class="panel panel-default" style="border:none !important; margin: 3% 5% 3% !important;">
                <div class="panel-heading thread-info">
                    <div class="thread-info-author headLabel">
                        <a href="{{ route('blogs', $archive->slug()) }}" class="thread-info-link formTitle">{{ $archive->subject() }}</a>
                    </div>
                    @include('blogs.archives.info.tags')
                </div>

                <div class="thread-info-author" style="display: inline-block; width: 100%;">
                    {{ $archive->createdAt()->diffForHumans() }} 
                </div>

                <div class="panel-body forum-content">
                    {!! $archive->body() !!}
                </div>

                <div class="thread-info-author authorName" style="text-align: right; display: block;">                      
                    <div class="thread-info-link" style="padding-right:3px;">{{ $archive->author()->username() }}</div> 
                </div>
            </div>

        </div>
    </div>
@endsection
