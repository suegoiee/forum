@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
            <a  class="print" onclick="convert()" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
        </div>
        
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;">
        <h1 style="text-align:center;margin-top: 0;">{{$PageSubtitle}}</h1>
        <h2 style="margin-top: 0;"><b>{{$stock_code . ' - ' . $stock_name}}</b></h2>
        <div class="container" style="margin:5% auto;">
            <div class="container" id="Outer"></div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var data = @json($data);
            var canvasId = @json($url);
            dataFactoryC(data, canvasId, false);
        }
    </script>
@endsection