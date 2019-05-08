@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
            <a  class="print" onclick="convert()" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
        </div>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;">
        <h1 style="text-align:center; margin-top: 0; margin-bottom: 5px;">{{$PageSubtitle}}</h1>
        <h2 style="text-align:center; margin-top: 0; margin-bottom: 5px;"><b id="stockTitle"></b></h2>
    </div>
    <script>
        window.onload=function () {
            if(!getCookie("stockCode") || getCookie("stockCode") == 'undefined'){
                var stockCode = '1101';
            }
            else{
                var stockCode = getCookie("stockCode");
            }
            dataFactory('https://cronjob.uanalyze.com.tw/fetch/StatementOfFinancialPosition/'+stockCode, false);
        };
    </script>
@endsection