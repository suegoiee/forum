@extends('layouts.base', ['disableAds' => $disableAds ?? true])

@section('body')
    <div class="container forumPadding" style="min-height: calc(100% - 70px); padding-top: 100px;">
        <div class="row loginForm">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{env('APP_URL')}}/images/logo_colour.svg" style="width: 80%; margin: 5% auto 8%;">
                        <br/>
                        {{ $title }}
                    </div>
                    @include('layouts._alerts')
                    <div class="panel-body">
                        @yield('small-content')
                    </div>
                </div>

                @yield('small-content-after')
            </div>
        </div>
    </div>
@endsection
