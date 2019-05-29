@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.base')

@section('body')
<div class="container forumPadding" style="min-height: calc(100% - 70px); padding-left: 0px; padding-right: 0px; padding-top: 65px;">
    <div class="container summaryTop" style="padding-left: 0; padding-right: 0; background-color: #e9e9e9; position: fixed; z-index: 5;">
        <div class="input-group mb-3" style="padding-top: 20px;">
            <h2 style="margin-top: 5px; display: inline-block; float: left;" id="info_type">{{$PageSubtitle}}</h2>
            <input type="text" class="form-control" style=" margin-left: 30px;" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
            <ul id="sideBtn">
                <li class="rightbtn" type="button" name="Submit" style="cursor:pointer"><a href="#stockChart" class="rightbtnD"> 每股盈餘VS股價</a> </li>
                <li class="rightbtn" type="button" name="Submit" style="cursor:pointer"><a href="#dailyChart" class="rightbtnC"> 股價走勢</a> </li>
                <li class="rightbtn" type="button" name="Submit" style="cursor:pointer"><a href="#getNews" class="rightbtnB"> 個股新聞</a> </li>
                <li class="rightbtn" type="button" name="Submit" style="cursor:pointer"><a href="#getInfo" class="rightbtnA"> 公司基本資料</a> </li>
            </ul>
        </div>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0; margin-top: 70px;">
        <div class="container" style="background-color: #e9e9e9; padding-left: 0; padding-right: 0;">
            <div id="getInfo">
                <a class="btn downloadSummary downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="CompanyInfocontainer" style="padding-right: 30px; padding-left: 0;">
                    <h1 style="margin-top: 30px; margin-bottom: 0; padding-left: 30px;">公司基本資料</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px; padding-left: 30px;">
                        {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                    </h2>
                    <div id="CompanyInfo" style="padding-left: 30px;">
                        <table class="table table-bordered" style="width:100%; table-layout: fixed; word-wrap: break-word; border-collapse: initial;">
                            <tbody id="infoTable" style="font-size:13px">
                                <tr>
                                    <th><b>公司名稱</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['CompanyNameChinese']}}</td>
                                </tr>
                                <tr>
                                    <th><b>最新股本</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['NumberOfSharesIssued']}}</td>
                                </tr>
                                <tr>
                                    <th><b>掛牌類別</b></th>
                                    <td>{{$CompanyInfo['data']['data']['Market']}}</td>
                                    <th><b>成立日期</b></th>
                                    <td>{{$CompanyInfo['data']['data']['DateOfIncorporation']}}</td>
                                </tr>
                                <tr>
                                    <th><b>類股</b></th>
                                    <td>{{$CompanyInfo['data']['data']['Sector']}}</td>
                                    <th><b>掛牌日期</b></th>
                                    <td>{{$CompanyInfo['data']['data']['DateOfListing']}}</td>
                                </tr>
                                <tr>
                                    <th><b>董事長</b></th>
                                    <td>{{$CompanyInfo['data']['data']['Chairman']}}</td>
                                    <th><b>總經理</b></th>
                                    <td>{{$CompanyInfo['data']['data']['CEO']}}</td>
                                </tr>
                                <tr>
                                    <th><b>發言人</b></th>
                                    <td>{{$CompanyInfo['data']['data']['Speaker']}}</td>
                                    <th><b>代理發言人</b></th>
                                    <td>{{$CompanyInfo['data']['data']['DeputySpeaker']}}</td>
                                </tr>
                                <tr>
                                    <th><b>資本額(仟元)</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['PaidUpCapital']}}</td>
                                </tr>
                                <tr>
                                    <th><b>私募股數</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['PrivateEquityShares']}}</td>
                                </tr>
                                <tr>
                                    <th><b>經營業務內容</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['HistoryAndOrganization']}}</td>
                                </tr>
                                <tr>
                                    <th><b>公司住址</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['CompanyAddress']}}</td>
                                </tr>
                                <tr>
                                    <th><b>公司電話</b></th>
                                    <td>{{$CompanyInfo['data']['data']['CompanyContactNumber']}}</td>
                                    <th><b>傳真</b></th>
                                    <td>{{$CompanyInfo['data']['data']['CompanyFax']}}</td>
                                </tr>
                                <tr>
                                    <th><b>公司網址</b></th>
                                    <td>{{$CompanyInfo['data']['data']['CompanyWebsite']}}</td>
                                    <th><b>email</b></th>
                                    <td>{{$CompanyInfo['data']['data']['CompanyEmailAddress']}}</td>
                                </tr>
                                <tr>
                                    <th><b>英文地址</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['CompanyAddressEnglish']}}</td>
                                </tr>
                                <tr>
                                    <th><b>股票過戶機構</b></th>
                                    <td colspan="3">{{$CompanyInfo['data']['data']['TransferAgency']}}</td>
                                </tr>
                                <tr>
                                    <th><b>過戶機構地址</b></th>
                                    <td>{{$CompanyInfo['data']['data']['TransferAgencyAddress']}}</td>
                                    <th><b>過戶機構電話</b></th>
                                    <td>{{$CompanyInfo['data']['data']['TransferAgencyTel']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="getNews">
                <a  class="btn downloadSummary downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="Newscontainer" style="padding-left: 30px; padding-right: 30px;">
                    <h1 style="margin-top: 30px; margin-bottom: 0;">個股新聞</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px;">
                        {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                    <div id="News">
                        <ul id="lists" class="list-group"></ul>
                        <ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>
                    </div>
                </div>
            </div>
            <div class="container" id="dailyChart" style=" padding-left: 0;">
                <a class="btn downloadTable downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="DailyStockPriceAreaChartWithDisplayOuter">
                    <h1 style="margin-top: 30px; margin-bottom: 0; padding-left: 15px;">股價走勢</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px; padding-left: 15px;">
                        {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                    </h2>
                </div>
            </div>
            <div class="container" id="stockChart" style=" padding-left: 0;">
                <a class="btn downloadTable downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="StockPriceVSEPSOuter">
                    <h1 style="margin-top: 30px; margin-bottom: 0; padding-left: 15px;">每股盈餘VS股價</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px; padding-left: 15px;">
                        {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var NewsData = @json($News['data']['data']);
            drawNews(NewsData);
            var DailyStockPriceAreaChartWithDisplay = @json($DailyStockPriceAreaChartWithDisplay);
            var StockPriceVSEPS = @json($StockPriceVSEPS);
            var canvasId = @json($url);
            var canvasId2 = @json($url2);
            dataFactoryC(DailyStockPriceAreaChartWithDisplay, canvasId, true);
            dataFactoryC(StockPriceVSEPS, canvasId2, true);
        }
    </script>
    @include('layouts._footer')
</div>
@endsection