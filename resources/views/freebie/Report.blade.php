@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
            <a  class="print" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
        </div>
        <h1 style="text-align:center; margin-top: 0; margin-bottom: 5px;">{{$PageSubtitle}}</h1>
        <h2 style="text-align:center; margin-top: 0; margin-bottom: 5px;"><b>{{$stock_code . ' - ' . $stock_name}}</b></h2>
    </div>
    <div class="container" id="CanvasBaseMap" style="margin-left: 0;padding-left: 0;">
        <div class="container" style="padding-left: 0; padding-right: 0;">
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