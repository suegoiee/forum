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
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;">
        <div>
            <div>
                <table class="table" style="text-align:center;"><tr id="canvasLabel"></tr></table>
            </div>
            <div class="container">
                <div>
                    <div class="btn-group RightButtonGroup" style="display:inline-block; position:relative; float:right;" role="group" aria-label="...">
                        <button type="button" class="btn btn-default buttonLastTen ActiveChartControlButton">近十筆</button>
                        <button type="button" class="btn btn-default buttonEntire">全部</button>
                        <button type="button" class="btn btn-default buttonCustomize" data-toggle="collapse" data-target="#customizeRange">自訂</button>
                        <div id="customizeRange" class="collapse">
                            <div class="timeS">
                                <label>從 ： </label>
                                <div class="select">
                                    <select class="rangeStartSelect"></select>
                                </div>
                            </div>
                            <div class="timeE">
                                <label>至 ： </label>
                                <div class="select">
                                    <select class="rangeEndSelect"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="canvas"></div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var chartData = @json($data);
            drawChart("canvas", '', chartData[1], chartData[0]);
            drawDisplay("canvas", chartData[2]);
        }
    </script>
@endsection