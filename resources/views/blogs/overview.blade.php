@php($subTitle = isset($activeTag) ? $activeTag->name() : null)
@title('優分析專欄' . (isset($subTitle) ? ' ▸ ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="row blog"  style=" margin-top: 15px;">
        @can(App\Policies\ArchivePolicy::CREATE, App\Models\Archive::class)
            <div style="text-align:right;" class="buildText">
                <a class="btn" href="{{ route('archives.create') }}">撰寫專欄</a>
            </div>
        @endcan
        <div class="col-md-3 blogTitle">
            {{ Form::open(['route' => 'blogs', 'method' => 'GET']) }}
                <div class="form-group">
                    {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => '搜尋文章','style' => 'width:100%;' ]) }}
                </div>
            {{ Form::close() }}

            <!--div class="dropdown">
                <a class="dropdown-toggle" role="button" data-target="#titleTable" data-toggle="collapse" aria-expanded="false">
                    <span>優分析專欄<span> <i class="far fa-plus-square"></i><i class="far fa-minus-square"></i>
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
            </div-->
        </div>
        <div class="col-md-9 blogContent">

            @if (count($archives))
                @foreach ($archives as $archive)
                    <div class="panel chat-bd" style="height:auto; margin: 3% 5% 3% !important; border:none !important;">
                        <div class="panel-heading">
                                @include('blogs.archives.info.tags')
                            <div class="thread-info-author" style="text-overflow: ellipsis; width: 100%; white-space: nowrap; overflow: hidden;">
                                <a href="{{ route('archives', $archive->slug()) }}" class="thread-info-link">{{ $archive->subject() }}</a>
                            </div>
                        </div>
                        <div class="thread-info-author" style="display: block;">
                                {{ $archive->createdAt() }} 
                        </div>

                        <div class="panel-body">
                            {!! str_limit(strip_tags($archive->body), 100) !!}
                        </div>
                    </div>
                        <div class="thread-info-author authorName" style="text-align: right; display: block;">                      
                            <div class="thread-info-link" style="padding-right:3px; font-size: 18px; color: #393939;">{{ $archive->author()->username() }}</div> 
                        </div>
                    <hr style="border-color: #e9e9e9; margin-top: 0;">
                @endforeach

                <div class="text-center">
                    {!! $archives->render() !!}
                </div>
            @else
                <div class="alert text-center" style="color: #545454;">
                    沒有找到相關專欄!
                </div>
            @endif
        </div>
    </div>


@endsection
