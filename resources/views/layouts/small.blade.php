@extends('layouts.base', ['disableAds' => $disableAds ?? true])

@section('body')
    <div class="container forumPadding" style="min-height: calc(100% - 70px); padding-top: 85px;">
        <div class="row loginForm">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{env('APP_URL')}}/images/logo_light.svg" style="width: 80%; margin: 5% auto;">
                        <div>
                            <span style="letter-spacing: 20px; font-size: 22px; text-align: center; color: #545454; margin-left: 20px;">台股 •</span>
                            <span style="letter-spacing: 20px; font-size: 22px; color: #545454; margin-left: 15px;">優分析</span>
                        </div>
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
    @include('layouts._footer')
@endsection
