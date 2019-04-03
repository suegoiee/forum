@title('我的文章')

@extends('layouts.default')

@section('content')
    <h3>{{ Auth::user()->name() }}</h3>

<div style="background-color:#fff; padding: 10px 15px; margin-top: 2%;">
    <div class="row" style="border-bottom: 2px dashed #e9e9e9;">
        <div class="col-md-6">
            <div class="panel panel-default panel-counter" style="text-align:center; background-color:#fff !important;">
                <div class="panel-heading" style="color:#545454 !important; background-color:#fff !important;">發文數</div>
                <div class="panel-body" style="color:#ffa500; font-size:2.2rem; width:100% !important; margin-left: 0;">{{ Auth::user()->countThreads() }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default panel-counter" style="text-align:center; background-color:#fff !important;">
                <div class="panel-heading" style="color:#545454 !important; background-color:#fff !important;">回應數</div>
                <div class="panel-body" style="color:#ffa500; font-size:2.2rem; width:100% !important; margin-left: 0;">{{ Auth::user()->countReplies() }}</div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="panel panel-default panel-counter">
                <div class="panel-heading" style="color:#545454 !important;">解決</div>
                <div class="panel-body" style="color:#ffa500; font-size:2.2rem; width:100% !important; margin-left: 0;">{{ Auth::user()->countSolutions() }}</div>
            </div>
        </div> -->
    </div>


    @include('users._latest_content', ['user' => Auth::user()])
</div>
@endsection
