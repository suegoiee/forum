@title('沒有找到此頁面')

@extends('layouts.base', ['disableAds' => true])

@section('body')
    <div class="jumbotron text-center" style="padding-top: 100px;">
        <h1>{{ $title }}</h1>
        <p>所尋求的頁面並未找到</p>
    </div>
@endsection
