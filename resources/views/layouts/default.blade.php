@extends('layouts.base')

@section('body')
    <div class="container" style="min-height: calc(100vh - 100px); padding-left: 0px; padding-right: 0px;">
        @include('layouts._alerts')

        @yield('content')
    </div>
@endsection
