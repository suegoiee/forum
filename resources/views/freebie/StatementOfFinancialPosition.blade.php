@title('Stocksummary' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
        </div>
        <h2 style="text-align:center;"><b id="stockTitle"></b></h2>
        <h4 style="text-align:center;">資產負債表</h4>
    </div>
    <div class="container" id="CanvasBaseMap"></div>
    <script>
        window.onload=function () {
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/StatementOfFinancialPosition/2204', false);
        };
    </script>
@endsection