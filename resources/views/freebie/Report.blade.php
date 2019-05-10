@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0; margin-top: 15px;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
            <a  class="print" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
        </div>
    </div>
    <div class="container" id="CanvasBaseMap" style="margin-left: 0;padding-left: 0;">
        <div class="container" style="padding-left: 0; padding-right: 0;">
            <h1 style="margin-top: 15px; margin-bottom: 0; padding-left: 15px;" id="info_type">{{$PageSubtitle}}</h1>
            <h2 style="margin-top: 10px; margin-bottom: 10px; padding-left: 15px;" id="stock_title">{{$stock_code . ' - ' . $stock_name}}</h2>
            <div class="container" id="Outer" style="margin-left: 0;"></div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var chartData = @json($data);
            var canvasId = @json($url);
            //console.log(chartData);
            dataFactoryC(chartData, canvasId, false);
        }
    </script>
@endsection