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
        <h1 style="text-align:center; margin-top: 0; margin-bottom: 5px;">{{$PageSubtitle}}</h1>
        <h2 style="text-align:center; margin-top: 0; margin-bottom: 5px;"><b>{{$stock_code . ' - ' . $stock_name}}</b></h2>
        <div class="container">
            <div class="container" id="MonthlyRevenue_sorting_tablecontainer">
                <div id="MonthlyRevenue_sorting_table">
                    <table id="example" class="table table-striped"></table>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var chartData = @json($data);
            drawTableB(chartData[1], chartData[0]);
        }
    </script>
@endsection