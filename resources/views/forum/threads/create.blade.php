@title('發表文章')

@extends('layouts.default')

@section('content')
    <h1 style="font-size:20px; color:#393939;">發表文章</h1>

    <div class="alert" style="background: rgba(255,255,255,0.9);border-left: 3px solid #0084ff;color: #393939;box-shadow: 2px 2px 2px 0px rgba(2%,2%,4%,0.12);">
            <i class="fas fa-info-circle" style="color: #0084ff; padding-right: 1%;"></i>
            請先嘗試使用
            <a href="{{ route('forum') }}" style="color:#ffa500; font-weight:bolder;">搜索框</a> 查詢您的問題並確認在發表文章前已瞭解
            <a style="color:#ffa500; font-weight:bolder; cursor: pointer;" data-toggle="modal" data-target="#rule">論壇規則</a>。
                    @include('_partials._rule_modal', [
                        'id' => 'rule',
                    ])
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #0084ff;">&times;</button>
    </div>

    @include('forum.threads._form', ['route' => 'threads.store'])
@endsection
