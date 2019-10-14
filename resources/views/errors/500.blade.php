@title('發生錯誤')

@extends('layouts.base', ['disableAds' => true])

@section('body')
    <div class="jumbotron text-center">
        <h1>{{ $title }}</h1>
        <p>
            請繼續瀏覽其他 <a href="{{env('APP_URL')}}">優分析論壇</a> 的內容，我們會盡速處理。
        </p>
    </div>
@endsection
