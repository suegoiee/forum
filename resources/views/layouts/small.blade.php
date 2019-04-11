@extends('layouts.base', ['disableAds' => $disableAds ?? true])

@section('body')
    <div class="container" style="min-height: calc(100vh - 150px);">
        <div class="row loginForm">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="images/logo_colour.svg" style="width: 80%; margin: 5% auto 8%;">
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
