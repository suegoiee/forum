@title('Stocksummary' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
        </div>
        <h2 style="text-align:center;"><b id="stockTitle"></b></h2>
        <h4 style="text-align:center;">融券餘額與融券使用率</h4>
    </div>
    <div class="container" id="CanvasBaseMap"></div>
    <script>
        window.onload=function () {
            if(!getCookie("stockCode")){
                var stockCode = '1101';
            }
            else{
                var stockCode = getCookie("stockCode");
            }
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/ShortInterestVSShortSellUtilization/'+stockCode, false);
        };
    </script>
@endsection