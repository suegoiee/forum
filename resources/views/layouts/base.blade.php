<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' | ' : '' }} {{ config('app.name') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosanstc.css">

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
    @include('layouts._favicons')
    @include('layouts._cookie_consent')
    @include('layouts._google_analytics')

    @unless ($disableAds ?? false)
        @include('layouts._ads._ad_sense')
    @endunless
</head>
<body class="{{ $bodyClass ?? '' }}">

<div id="app">
    @include('layouts._nav')

    @yield('body')

    @include('layouts._footer')
</div>

<script src="{{ mix('js/app.js') }}"></script>
    <!--for development-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/freebie.js"></script>
    <script src="/js/errorode.js"></script>
    <script src="/js/addToge.js"></script>
    <script src="/js/cal.js"></script>
    <script src="/js/formCheck.js"></script>
    <script src="/js/npv.js"></script>
    <!--end of for development-->

@include('layouts._intercom')

</body>
</html>
