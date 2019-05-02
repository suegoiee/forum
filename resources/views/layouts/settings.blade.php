@extends('layouts.base')

@section('body')
    <div class="container forumPadding" style="min-height: calc(100% - 70px); padding-top: 5%;">
        <div class="row">
            <div class="col-lg-3 accountA">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ active('settings.profile') }}">
                                <a style="text-align:center;" href="{{ route('settings.profile') }}">帳號設定</a>
                            </li>
                            <li class="{{ active('settings.password') }}">
                                <a style="text-align:center;" href="{{ route('settings.password') }}">密碼更改</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 accountB">
                @include('layouts._alerts')

                @yield('content')
            </div>
        </div>
    </div>
@endsection
