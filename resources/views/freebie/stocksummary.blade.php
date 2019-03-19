@title('Stocksummary' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
        </div>
        <h2 style="text-align:center;"><b id="stockTitle"></b></h2>
        <h4 style="text-align:center;">個股資料</h4>
    </div>
    <div class="container" id="CanvasBaseMap"></div>
    <script>
        window.onload=function () {
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/CompanyInfo/2204', false);
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/News/2204', false);
        }
        /*jQuery(function ($) {
            dataFactory('http://cronjob.uanalyze.com.tw/fetch/MonthlyRevenue_sorting_table/2204', false);
        });*/
    </script>
@endsection