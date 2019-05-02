@title($PageSubtitle . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')

    <div class="container" style="padding-left: 0; padding-right: 0;">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar" aria-label="search">
        </div>
        <h1 style="text-align:center;">{{$PageSubtitle}}</h1>
        <h2 style="text-align:center;"><b>{{$CompanyInfo['data']['stock_code'] . ' - ' . $CompanyInfo['data']['stock_name']}}</b></h2>
    </div>
    <div class="container" id="CanvasBaseMap" style="padding-left: 0; padding-right: 0;">
        <div class="container">
            <div class="container" id="CompanyInfocontainer">
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
            <div class="container" id="Newscontainer">
                <div id="News">
                    <ul id="lists" class="list-group"></ul>
                    <ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>
                </div>
            </div>
        </div>
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
            <div id="DailyStockPriceAreaChartWithDisplay"></div>
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
            <div id="StockPriceVSEPS"></div>
        </div>
    </div>
    <script>
        window.onload=function () {
            var stockCode = {{Request::route('StockCode')}};
            var NewsData = @json($News['data']['data']);
            drawNews(NewsData);
            var DailyStockPriceAreaChartWithDisplay = @json($DailyStockPriceAreaChartWithDisplay);
            var StockPriceVSEPS = @json($StockPriceVSEPS);
            drawChart("DailyStockPriceAreaChartWithDisplay", '', DailyStockPriceAreaChartWithDisplay[1], DailyStockPriceAreaChartWithDisplay[0]);
            drawDisplay("DailyStockPriceAreaChartWithDisplay", DailyStockPriceAreaChartWithDisplay[2]);
            drawChart("StockPriceVSEPS", '', StockPriceVSEPS[1], StockPriceVSEPS[0]);
            drawDisplay("StockPriceVSEPS", StockPriceVSEPS[2]);
        }
    </script>
@endsection