@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.base')

@section('body')
<div class="container forumPadding" style="min-height: calc(100% - 70px); padding-left: 0px; padding-right: 0px; padding-top: 85px; width:100%;">
    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <h2 style="text-align: left; margin-top: 0;">{{$PageSubtitle}}</h2>
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
            <ul id="sideBtn">
                <li class="rightbtn" type="button" name="Submit" value="CompanyInfocontainer" style="cursor:pointer"> 公司基本資料 </li>
                <li class="rightbtn" type="button" name="Submit" value="Newscontainer" style="cursor:pointer"> 個股新聞 </li>
                <li class="rightbtn" type="button" name="Submit" value="DailyStockPriceAreaChartWithDisplayOuter" style="cursor:pointer"> 股價走勢 </li>
                <li class="rightbtn" type="button" name="Submit" value="StockPriceVSEPSOuter" style="cursor:pointer"> 每股盈餘VS股價 </li>
            </ul>
        </div>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0; overflow-y: scroll; height: 65vh; width:100%;">
        <div class="container" style="background-color: #e9e9e9; padding-left: 0; padding-right: 0;">
            <a class="downloadSummary downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
            <div class="container" id="CompanyInfocontainer" style="margin:0 auto 100px; padding-left: 30px; padding-right: 30px;"> 
                <h1 style="margin-top: 15px; margin-bottom: 0;">公司基本資料</h1>
                <h2 style="margin-top: 10px; margin-bottom: 10px;">
                    {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                </h2>
                <div id="CompanyInfo">
                    <table class="table table-bordered" style="width:100%; table-layout: fixed; word-wrap: break-word;">
                        <tbody id="infoTable" style="font-size:13px">
                            <tr>
                                <td><b>公司名稱</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['CompanyNameChinese']}}</td>
                            </tr>
                            <tr>
                                <td><b>最新股本</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['NumberOfSharesIssued']}}</td>
                            </tr>
                            <tr>
                                <td><b>掛牌類別</b></td>
                                <td>{{$CompanyInfo['data']['data']['Market']}}</td>
                                <td style=""><b>成立日期</b></td>
                                <td>{{$CompanyInfo['data']['data']['DateOfIncorporation']}}</td>
                            </tr>
                            <tr>
                                <td><b>類股</b></td>
                                <td>{{$CompanyInfo['data']['data']['Sector']}}</td>
                                <td><b>掛牌日期</b></td>
                                <td>{{$CompanyInfo['data']['data']['DateOfListing']}}</td>
                            </tr>
                            <tr>
                                <td><b>董事長</b></td>
                                <td>{{$CompanyInfo['data']['data']['Chairman']}}</td>
                                <td><b>總經理</b></td>
                                <td>{{$CompanyInfo['data']['data']['CEO']}}</td>
                            </tr>
                            <tr>
                                <td><b>發言人</b></td>
                                <td>{{$CompanyInfo['data']['data']['Speaker']}}</td>
                                <td><b>代理發言人</b></td>
                                <td>{{$CompanyInfo['data']['data']['DeputySpeaker']}}</td>
                            </tr>
                            <tr>
                                <td><b>資本額(仟元)</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['PaidUpCapital']}}</td>
                            </tr>
                            <tr>
                                <td><b>私募股數</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['PrivateEquityShares']}}</td>
                            </tr>
                            <tr>
                                <td><b>經營業務內容</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['HistoryAndOrganization']}}</td>
                            </tr>
                            <tr>
                                <td><b>公司住址</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['CompanyAddress']}}</td>
                            </tr>
                            <tr>
                                <td><b>公司電話</b></td>
                                <td>{{$CompanyInfo['data']['data']['CompanyContactNumber']}}</td>
                                <td><b>傳真</b></td>
                                <td>{{$CompanyInfo['data']['data']['CompanyFax']}}</td>
                            </tr>
                            <tr>
                                <td><b>公司網址</b></td><td>{{$CompanyInfo['data']['data']['CompanyWebsite']}}</td>
                                <td><b>email</b></td>
                                <td>{{$CompanyInfo['data']['data']['CompanyEmailAddress']}}</td>
                            </tr>
                            <tr>
                                <td><b>英文地址</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['CompanyAddressEnglish']}}</td>
                            </tr>
                            <tr>
                                <td><b>股票過戶機構</b></td>
                                <td colspan="3">{{$CompanyInfo['data']['data']['TransferAgency']}}</td>
                            </tr>
                            <tr>
                                <td><b>過戶機構地址</b></td>
                                <td>{{$CompanyInfo['data']['data']['TransferAgencyAddress']}}</td>
                                <td><b>過戶機構電話</b></td>
                                <td>{{$CompanyInfo['data']['data']['TransferAgencyTel']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a  class="downloadSummary downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
            <div class="container" id="Newscontainer" style="margin:0 auto 100px; padding-left: 30px; padding-right: 30px;">
                <h1 style="margin-top: 15px; margin-bottom: 0;">個股新聞</h1>
                <h2 style="margin-top: 10px; margin-bottom: 10px;">
                    {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                <div id="News">
                    <ul id="lists" class="list-group"></ul>
                    <ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>
                </div>
            </div>
            <div class="container" style="margin:0 auto 100px;">
                <a  class="downloadTable downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="DailyStockPriceAreaChartWithDisplayOuter">
                    <h1 style="margin-top: 15px; margin-bottom: 0;">股價走勢</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px;">
                        {{$CompanyInfo['data']['stock_name'] . '  ' . $CompanyInfo['data']['stock_code']}}
                    </h2>
                </div>
            </div>
            <div class="container" style="margin:0 auto 50px;">
                <a  class="downloadTable downloadImg" style="cursor: pointer;" data-toggle="modal" data-target="#catch">下載</a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="StockPriceVSEPSOuter">
                    <h1 style="margin-top: 15px; margin-bottom: 0;">每股盈餘VS股價</h1>
                    <h2 style="margin-top: 10px; margin-bottom: 10px;">
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
</div>
@endsection