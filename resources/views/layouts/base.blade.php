<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
    <META HTTP-EQUIV="expires" CONTENT="0">
    <meta name="Description" content="投資新手都來這裡發問，投資高手都在這裡分享；股票價值計算機＋完整股市數據，讓你輕鬆學以致用">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} - {{ isset($title) ? $title.'  ' : '' }}</title>

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
    <script src="/js/exporting.js"></script>
    <script src="/js/export-data.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <!--script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/ckfinder/ckfinder.js"></script>
    <script src="/js/freebie.js"></script>
    <script src="/js/errorode.js"></script>
    <script src="/js/addToge.js"></script>
    <script src="/js/cal.js"></script>
    <script src="/js/formCheck.js"></script>
    <script src="/js/npv.js"></script>
    <script src="/js/navBar.js"></script>
    <script>
        $(document).ready(function() {
            if($("textarea[name='body']").length){
                CKEDITOR.replace('body', {});
                CKEDITOR.config.language='zh';
                CKEDITOR.config.height=400;
                CKEDITOR.config.extraPlugins = 'uploadimage';
                CKEDITOR.config.uploadUrl = '{{url("ckeditor/images")}}',
                CKEDITOR.config.filebrowserImageUploadUrl= '{{url("ckeditor/images")}}',
                CKEDITOR.config.removeButtons='About',
                CKEDITOR.config.extraPlugins = 'youtube,justify';
                CKEDITOR.config.youtube_responsive = true;
            }
        });
    </script>
<!--end of for development-->


    @include('layouts._intercom')
    @yield('js_tail')
</body>
</html>
