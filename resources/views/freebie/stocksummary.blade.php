@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.base')

@section('body')
<div class="container forumPadding" style="min-height: calc(100% - 70px); padding-left: 0px; padding-right: 0px; padding-top: 100px; width:100%;">
    <a class="sideBtn" data-toggle="collapse" href="#sideBtn" role="button" aria-expanded="false" aria-controls="sideBtn"><i class="fas fa-bars"></i></a>
        <ul class="collapse" id="sideBtn">
            <li class="rightbtnA rightbtn" type="button" name="Submit" value="CompanyInfocontainer"> 公司基本資料 </li>
            <li class="rightbtnB rightbtn" type="button" name="Submit" value="Newscontainer"> 個股新聞 </li>
            <li class="rightbtnC rightbtn" type="button" name="Submit" value="DailyStockPriceAreaChartWithDisplayOuter"> 股價走勢 </li>
            <li class="rightbtnD rightbtn" type="button" name="Submit" value="StockPriceVSEPSOuter"> 每股盈餘VS股價 </li>
        </ul>
    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
        </div>
        <h2 style="text-align:center; margin-top: 0; margin-bottom: 1%;">{{$PageSubtitle}}</h2>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0; overflow-y: scroll; height: 670px; width:100%; margin-top: 0; margin-left: 0;">
        <div class="container" style="background-color: #e9e9e9; padding-left: 0; padding-right: 0;">
            <a  class="downloadSummary" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
            <div class="container" id="CompanyInfocontainer" style="margin:0 auto 100px;"> 
                <h1 style="margin-top: 1%; margin-bottom: 0; font-size: 30px;">公司基本資料</h1>
                <h2 style="margin-top: 5px; margin-bottom: 0; padding-bottom: 5px; font-size: 25px;">
                    <b>{{$CompanyInfo['data']['stock_code'] . ' - ' . $CompanyInfo['data']['stock_name']}}</b>
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
            <a  class="downloadSummary" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                @include('_partials._catchChart_modal', [
                    'id' => 'catch',
                ])
            <div class="container" id="Newscontainer" style="margin:0 auto 100px;">
                <h1 style="margin-top: 1%; margin-bottom: 0; font-size: 30px;">個股新聞</h1>
                <h2 style="margin-top: 0; margin-bottom: 5px; padding-top:10px; padding-bottom: 5px; font-size: 25px;">
                    <b>{{$CompanyInfo['data']['stock_code'] . ' - ' . $CompanyInfo['data']['stock_name']}}</b>
                </h2>
                <div id="News">
                    <ul id="lists" class="list-group"></ul>
                    <ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>
                </div>
            </div>
            <div class="container" style="margin:0 auto 100px;">
                <a  class="downloadTable" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="DailyStockPriceAreaChartWithDisplayOuter"></div>
            </div>
            <div class="container" style="margin:0 auto 50px;">
                <a  class="downloadTable" style="cursor: pointer;" data-toggle="modal" data-target="#catch"><i class="fas fa-file-download"></i></a>
                    @include('_partials._catchChart_modal', [
                        'id' => 'catch',
                    ])
                <div class="container" id="StockPriceVSEPSOuter"></div>
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