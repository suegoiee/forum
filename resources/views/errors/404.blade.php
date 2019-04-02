@title('Page not found')

@extends('layouts.base', ['disableAds' => true])

@section('body')
    <div class="jumbotron text-center">
        <h1>{{ $title }}</h1>
        <p>所尋求的頁面並未找到</p>
    </div>
@endsection
