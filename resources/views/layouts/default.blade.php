@extends('layouts.base')

@section('body')
    <div class="container forumPadding" style="min-height: calc(100% - 70px); padding-left: 0px; padding-right: 0px; padding-top: 70px;">
        @include('layouts._alerts')

        @yield('content')
    </div>
        @include('layouts._footer')
@endsection
