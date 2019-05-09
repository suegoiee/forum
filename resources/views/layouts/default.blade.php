@extends('layouts.base')

@section('body')
    <div class="container forumPadding" style="min-height: calc(100% - 70px); padding-left: 0px; padding-right: 0px; padding-top: 85px;">
        @include('layouts._alerts')

        @yield('content')
    </div>
@endsection
