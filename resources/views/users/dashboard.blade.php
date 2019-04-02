@title('Dashboard')

@extends('layouts.default')

@section('content')
    <h3> {{ Auth::user()->name() }}</h3>


    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-counter">
                <div class="panel-heading" style="color:#545454 !important;">發表主題</div>
                <div class="panel-body" style="color:#ffa500; font-size:2.2rem; width:100% !important; margin-left: 0;">{{ Auth::user()->countThreads() }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default panel-counter">
                <div class="panel-heading" style="color:#545454 !important;">回應</div>
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
@endsection
