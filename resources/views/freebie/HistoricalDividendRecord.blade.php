@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
        </div>
        <h2 style="text-align:center;"><b id="stockTitle"></b></h2>
        <h4 style="text-align:center;">{{$PageSubtitle}}</h4>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;"></div>
    <script>
        window.onload=function () {
            if(!getCookie("stockCode") || getCookie("stockCode") == 'undefined'){
                var stockCode = '1101';
            }
            else{
                var stockCode = getCookie("stockCode");
            }
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/HistoricalDividendRecord/'+stockCode, false);
        };
    </script>
@endsection