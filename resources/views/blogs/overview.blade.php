@php($subTitle = isset($activeTag) ? $activeTag->name() : null)
@title('優分析專欄' . (isset($subTitle) ? ' ▸ ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="row blog">
        @can(App\Policies\ArchivePolicy::CREATE, App\Models\Archive::class)
            <div style="text-align:right;" class="buildText">
                <a class="btnBuild" href="{{ route('archives.create') }}">撰寫專欄</a>
            </div>
        @endcan
        <div class="col-md-3 blogTitle">
            {{ Form::open(['route' => 'blogs', 'method' => 'GET']) }}
                <div class="form-group">
                    {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => '搜尋文章','style' => 'width:100%;' ]) }}
                </div>
            {{ Form::close() }}

            <div class="dropdown">
                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    優分析專欄
                    <span style="color:#545454">{{ $count }}</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('blogs') }}" >全部<a>
                @foreach (App\Models\Tag::orderBy('id')->get() as $tag)
                        <a href="{{ route('blogs.tag', $tag->slug()) }}"
                        class="dropdown-item {{ isset($activeTag) && $tag->matches($activeTag) ? ' active' : '' }}">
                            {{ $tag->name() }}
                        </a>
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9 blogContent">

            @if (count($archives))
                @foreach ($archives as $archive)
                    <div class="panel panel-default chat-bd" style="height:auto; margin: 3% 5% 3% !important; border:none !important;">
                        <div class="panel-heading thread-info">
                            <div class="thread-info-author headLabel">
                                <a href="{{ route('archives', $archive->slug()) }}" class="thread-info-link">{{ $archive->subject() }}</a>
                            </div>
                            @include('blogs.archives.info.tags')
                        </div>
                        <div class="thread-info-author" style="display: block;">
                                {{ $archive->createdAt() }} 
                        </div>
                        <div class="panel-body chat-bg">
                            {!! str_limit(strip_tags($archive->body), 100) !!}
                        </div>
                    </div>
                    <hr style="border-color: #e9e9e9;">
                @endforeach

                <div class="text-center">
                    {!! $archives->render() !!}
                </div>
            @else
                <div class="alert text-center" style="color: #545454;">
                    沒有找到相關文章!
                    @can(App\Policies\ArchivePolicy::CREATE, App\Models\Archive::class)
                        <a href="{{ route('archives.create') }}" style="color: #545454;" class="alert-link">發表新的文章</a>
                    @endcan
                </div>
            @endif
        </div>
    </div>


@endsection
