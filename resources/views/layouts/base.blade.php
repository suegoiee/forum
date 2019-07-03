<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
    <META HTTP-EQUIV="expires" CONTENT="0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($author)) 
        <meta name="author" content="{{$author}}">
    @endif
    <meta name="copyright" content="優分析 UAnalyze 商拓財經有限公司">
    <meta name="url" content="https://forum.uanalyze.com.tw/forum">
    <meta name="Description" content="{{ isset($description) ? strip_tags($description):'投資新手都來這裡發問，投資高手都在這裡分享；股票價值計算機＋完整股市數據，讓你輕鬆學以致用' }}">
    <!-- google plus -->
    <link rel="author" href="{{ isset($thread) ? route('profile', $thread->author()->username()) : '' }}">
    <link rel="publisher" href="{{ isset($thread) ? route('profile', $thread->author()->username()) : '' }}">
    <!-- google -->
    <meta itemprop="name" content="優分析">
    <meta itemprop="image:width" content="600">
    <meta itemprop="image:height" content="314">
    <meta itemprop="image" content="">
    <meta itemprop="description" content="{{ isset($description) ? strip_tags($description) : '投資新手都來這裡發問，投資高手都在這裡分享；股票價值計算機＋完整股市數據，讓你輕鬆學以致用' }}">
    <!-- facebook -->
    <meta property="og:title" content="優分析 - {{ isset($title) ? $title : '' }}" >
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    <meta property="og:image" content="">
    <meta property="og:description" content="{{ isset($description) ? strip_tags($description):'投資新手都來這裡發問，投資高手都在這裡分享；股票價值計算機＋完整股市數據，讓你輕鬆學以致用' }}" >
    <!-- twitter -->
    <meta name="twitter:title" content="優分析 - {{ isset($title) ? $title : '' }}"> 
    <meta name="twitter:description" content="{{ isset($description) ? strip_tags($description):'投資新手都來這裡發問，投資高手都在這裡分享；股票價值計算機＋完整股市數據，讓你輕鬆學以致用' }}"> 
    <meta name="twitter:image:width" content="600">
    <meta name="twitter:image:height" content="315">
    <meta name="twitter:image:src" content="{{env('APP_URL')}}/images/logo_colour.png">
    <!-- end meta -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTIC_ID')}}"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', "{{env('GOOGLE_ANALYTIC_ID')}}");
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{env("GOOGLE_TAG_MANAGER_ID")}}');</script>
    <!-- End Google Tag Manager -->

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '565813480491289'); 
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=565813480491289&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} - {{ isset($title) ? $title.'  ' : '' }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

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
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{env('GOOGLE_TAG_MANAGER_ID')}}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="app" style="height: 100%;">
    @include('layouts._nav')

    @yield('body')

    @include('layouts._footer')
</div>

<script src="{{ mix('js/app.js') }}"></script>
<!--for development-->
<!--link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'-->
<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"-->
<!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/js/Highcharts-7.1.1/code/highcharts.js"></script>
<script src="/js/Highcharts-7.1.1/code/highcharts-more.js"></script>
<script src="/js/Highcharts-7.1.1/code/modules/series-label.js"></script>
<script src="/js/Highcharts-7.1.1/code/modules/exporting.js"></script>
<script src="/js/Highcharts-7.1.1/code/modules/export-data.js"></script>
<script src="/js/dropdownTitle.js"></script>
<script src="/js/ckfinder/ckfinder.js"></script>
<script src="/js/errorode.js"></script>
<script src="/js/addToge.js"></script>
<script src="/js/cal.js"></script>
<script src="/js/formCheck.js"></script>
<script src="/js/npv.js"></script>
<script src="/js/navBar.js"></script>
<script src="/js/freebie.js"></script>
<script src="/js/NewComponent.js"></script>
<script type="text/javascript" src="/js/html2canvas.js"></script>
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
            CKEDITOR.config.extraPlugins = 'youtube,justify,colorbutton';
            CKEDITOR.config.youtube_responsive = true;
        }
    });
</script>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));



    /*axios.get('https://cronjob.uanalyze.com.tw/fetch/CompanyInfo/1101')
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
        });*/
</script>

<!--end of for development-->


    @include('layouts._intercom')
    @yield('js_tail')
</body>
</html>
