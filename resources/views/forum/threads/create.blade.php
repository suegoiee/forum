@title('Create your thread')

@extends('layouts.default')

@section('content')
    <h1 style="font-size:25px; color:#393939;">建立主題</h1>

    <div class="alert" style="background-color:none; color:#ef5350;">
        <p> 
            請先嘗試使用
            <a href="{{ route('forum') }}" style="color:#ef5350; font-weight:bolder;">搜索框</a> 查詢您的問題及確保在建立討論主題前閱讀
            <a href="{{ route('rules') }}" style="color:#ef5350; font-weight:bolder;">論壇規則</a>。
        </p>
    </div>

    @include('forum.threads._form', ['route' => 'threads.store'])
@endsection
