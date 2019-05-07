@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
        </div>
        <h1 style="text-align:center;">{{$PageSubtitle}}</h1>
        <h2 style="text-align:center;"><b>{{$stock_code . ' - ' . $stock_name}}</b></h2>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;"></div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var chartData = @json($sideTable);
            var canvasId = @json($url);
            //console.log(chartData);
            dataFactoryC(chartData, canvasId, false);
        }
    </script>
@endsection