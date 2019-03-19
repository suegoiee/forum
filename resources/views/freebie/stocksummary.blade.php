@title('Stocksummary' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="股票代碼或名稱" id="searchBar">
        </div>
        <h2 style="text-align:center;"><b id="stockTitle"></b></h2>
        <h4 style="text-align:center;">個股摘要</h4>
    </div>
    <div class="container" id="DailyStockPriceAreaChartWithDisplayBaseMap"></div>
    <div class="container" id="StockPriceVSEPSBaseMap"></div>
    <div class="container" style="position:relative; float:top;">
        <div class="container" style="width:50%; position:relative; float:left;">
            <h3>公司基本資料</h3>
            <table class="table table-bordered" style="width:100%; table-layout: fixed; word-wrap: break-word;">
                <tbody id="infoTable" style="font-size:13px">
                    <tr id="row1"></tr>
                    <tr id="row2"></tr>
                    <tr id="row3"></tr>
                    <tr id="row4"></tr>
                    <tr id="row5"></tr>
                    <tr id="row6"></tr>
                    <tr id="row7"></tr>
                    <tr id="row8"></tr>
                    <tr id="row9"></tr>
                    <tr id="row10"></tr>
                    <tr id="row11"></tr>
                    <tr id="row12"></tr>
                    <tr id="row13"></tr>
                    <tr id="row14"></tr>
                    <tr id="row15"></tr>
                </tbody>
            </table>
        </div>
        <div class="container" id="newsContainer" style="width:50%; position:relative; float:left;"></div>
    </div>
    
    <script>
        var chart_data = [];
        var chart_type = [];
        var chart_series_name = [];
        var display = [];
        var dateRange = [];
        var yLabels = [];
        var stock_name;
        var yaxis = [];

        jQuery(document).ready(function($) {
            var DailyStockPriceAreaChartWithDisplayNames = ['raw80030'];
            var StockPriceVSEPSNames = ['9750', 'ua90042_cp'];
            dataFactory('StockPriceVSEPS', 'http://cronjob.uanalyze.com.tw/fetch/StockPriceVSEPS/1101', StockPriceVSEPSNames, false, true);
            dataFactory('DailyStockPriceAreaChartWithDisplay', 'https://cronjob.uanalyze.com.tw/fetch/DailyStockPriceAreaChartWithDisplay/1101', DailyStockPriceAreaChartWithDisplayNames, true, false);
            infoTable('1101');
            drawNews('1101');
            //drawTable('1101');
            $.getJSON('http://cronjob.uanalyze.com.tw/fetch/StockPool',function(data){
                var availableTags = [];
                for(var i = 0; i < data['data'].length; i++){
                    availableTags.push({
                        'id' : data['data'][i]['stock_code'], 
                        'value' : data['data'][i]['stock_code'] + '-' + data['data'][i]['stock_name']
                    });
                }
                $( "#searchBar" ).autocomplete({
                    source: function(request, response) {
                        var results = $.ui.autocomplete.filter(availableTags, request.term);
                        response(results.slice(0, 3));
                    },
                    select: function (e, ui) {
                        var stockCode = ui['item']['id'];
                        $("#searchBar").val(stockCode);
                        dataFactory('StockPriceVSEPS', 'http://cronjob.uanalyze.com.tw/fetch/StockPriceVSEPS/'+stockCode, StockPriceVSEPSNames, false, true);
                        dataFactory('DailyStockPriceAreaChartWithDisplay', 'https://cronjob.uanalyze.com.tw/fetch/DailyStockPriceAreaChartWithDisplay/'+stockCode, DailyStockPriceAreaChartWithDisplayNames, true, false);
                        infoTable(stockCode);
                        drawNews(stockCode);
                        //drawTable(stockCode);
                    }
                });
            });

            function drawTable(stock_code){
                $("#tableContainer").empty();
                $("#tableContainer").append('<table id="example" class="table table-striped"></table>');
                $.getJSON('https://cronjob.uanalyze.com.tw/fetch/InstitutionalInvestorsNet/'+stock_code, function(data){
                    var newsData = [];
                    var tmp = [];
                    for(var i in data['data']['data']){
                        tmp = [data['data']['data'][i]['row_title_center'], data['data']['data'][i]['raw80050_0'], data['data']['data'][i]['raw80053_1'], data['data']['data'][i]['raw80062_2'], data['data']['data'][i]['raw80063_3']];
                        newsData.push(tmp);
                    }
                    $('#example').DataTable({
                        data: newsData,
                        columns: [
                            { title: data['data']['column_title'][0]['row_title_center'] },
                            { title: data['data']['column_title'][1]['raw80050_0'] },
                            { title: data['data']['column_title'][2]['raw80053_1'] },
                            { title: data['data']['column_title'][3]['raw80062_2'] },
                            { title: data['data']['column_title'][4]['raw80063_3'] }
                        ]
                    });
                });
            }

            function drawNews(stock_code){
                $("#newsContainer").empty();
                $("#newsContainer").append('<h3>個股新聞</h3><ul id="lists" class="list-group"></ul><ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>');
                $.getJSON('https://cronjob.uanalyze.com.tw/fetch/News/'+stock_code, function(data){
                    var news = [];
                    var tmp = data['data']['data'];
                    for(var i in tmp){
                        news.push('<li class="list-group-item"><a class="news-title" href="'+ data['data']['data'][i]['link'] +'" data-category="'+ data['data']['data'][i]['category'] +'">'+ data['data']['data'][i]['title'] +'</a>&nbsp&nbsp&nbsp<small class="margin-left-10 text-colour-white">'+ data['data']['data'][i]['date'] +'</small></li>');
                    }

                    $('#pagination-demo').twbsPagination({
                        totalPages: Math.ceil(i/10),
                        visiblePages: 4,
                        next: '>>',
                        prev: '<<',
                        onPageClick: function (event, page) {
                            //fetch content and render here
                            $('#lists').empty();
                            for(var j = page*10-10; j < page*10; j++){
                                $('#lists').append(news[j]);
                            }
                        }
                    });
                });
            }
        });


        function buttonEngine(){
            $(document).on('click', ".buttonLastTen", function(){
                //var tmp_chart_data = chart_data.slice(-10);
                var tmp_canvas = $(this).attr('value');
                var tmp_datatype = $('#'+tmp_canvas+'DataType').val();
                var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas][tmp_datatype], yaxis[tmp_canvas], -10);
                drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
            });
            $(document).on('click', ".buttonEntire", function(){
                var tmp_canvas = $(this).attr('value');
                var tmp_datatype = $('#'+tmp_canvas+'DataType').val();
                var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas][tmp_datatype], yaxis[tmp_canvas], 'all');
                drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
            });
            $(document).on('click', ".buttonCustomize", function(){
                var tmp_canvas = $(this).attr('value');
                $("#customizeRange"+tmp_canvas).collapse("toggle");
            });
            $(".rangeStartSelect").change(function(){
                console.log('a');
                var tmp_canvas = $(this).attr('value');
                var tmp_datatype = $('#'+tmp_canvas+'DataType').val();
                var rangeEnd = $("#rangeEndSelect"+tmp_canvas).find(":selected").val();
                var rangeStart = $("#rangeStartSelect"+tmp_canvas).find(":selected").val();
                tmp_silce = rangeStart - dateRange[tmp_canvas][tmp_datatype].length - 1;
                var tmp_Range = dateRange[tmp_canvas][tmp_datatype].slice(tmp_silce);
                stockDateRange(tmp_canvas, tmp_Range, 'refreshEnd', rangeStart);
                if(parseInt(rangeStart) < parseInt(rangeEnd)){
                    var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas][tmp_datatype], yaxis[tmp_canvas], rangeStart, rangeEnd);
                    drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
                }
            });
            $(".rangeEndSelect").change(function(){
                var tmp_canvas = $(this).attr('value');
                var tmp_datatype = $('#'+tmp_canvas+'DataType').val();
                var rangeEnd = $("#rangeEndSelect"+tmp_canvas).find(":selected").val();
                var rangeStart = $("#rangeStartSelect"+tmp_canvas).find(":selected").val();
                var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas][tmp_datatype], yaxis[tmp_canvas], rangeStart, rangeEnd);
                console.log(tmp_canvas, 'refreshEnd', rangeStart);
                drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
            });

            /**
                annual quater switch button
            */
            $(document).on('click', ".buttonQuater", function(){
                var tmp_canvas = $(this).attr('value');
                $('#'+tmp_canvas+'DataType').val('PeriodData');
                var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas]['PeriodData'], yaxis[tmp_canvas], 'all');
                drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
            });
            $(document).on('click', ".buttonYear", function(){
                var tmp_canvas = $(this).attr('value');
                $('#'+tmp_canvas+'DataType').val('YearData');
                var tmp_chart_data = seriesGenerator(chart_type[tmp_canvas], chart_series_name[tmp_canvas], chart_data[tmp_canvas]['YearData'], yaxis[tmp_canvas], 'all');
                drawLineChart(tmp_canvas, tmp_chart_data, stock_name, yLabels[tmp_canvas]);
            });
        }


        /**
            inital data
         */
        function dataFactory(canvas, stock_url, line_amount_name, display_add, datatype_add){
            var display_table = '';
            var datatype_button_group = '';
            var data_type = 'Data';
            if(display_add){
                display_table = '<table class="table" style="width:100%; text-align:center;"><tr id="'+canvas+'Label"></tr></table>';
            }
            if(datatype_add){
                var datatype_button_group = '<div class="btn-group" role="group" aria-label="..." style="position:relative; float:left;"><button type="button" class="btn btn-default buttonQuater" value="'+canvas+'">季度</button><button type="button" class="btn btn-default buttonYear" value="'+canvas+'">年度</button></div>';
                var data_type = 'YearData';
            }
            $("#"+canvas+"BaseMap").empty();
            $("#"+canvas+"BaseMap").append(display_table+'<div class="container"><input type="text" id="'+canvas+'DataType" style="display:none" value="'+data_type+'">'+datatype_button_group+'<div class="btn-group" role="group" aria-label="..." style="position:relative; float:right;"><button type="button" class="btn btn-default buttonLastTen" value="'+canvas+'">近十筆</button><button type="button" class="btn btn-default buttonEntire" value="'+canvas+'">全部</button><button type="button" class="btn btn-default buttonCustomize" value="'+canvas+'">自訂</button></div><div id="customizeRange'+canvas+'" class="collapse" style="width:100%; position:relative; float:right;"><div style="position:relative; width:30%; float: left; margin-left:10%"> 從 :<select class="form-control rangeStartSelect" value="'+canvas+'" id="rangeStartSelect'+canvas+'"></select></div><div style="position:relative; width:30%; float: left; margin-left:20%"> 至 :<select class="form-control rangeEndSelect" value="'+canvas+'" id="rangeEndSelect'+canvas+'"></select></div></div></div><div id="'+canvas+'" style="position:relative; float:top;"></div>');
            $.getJSON(stock_url,function(data){
                tmp_chart_data = [];
                chart_data[canvas] = [];
                chart_data[canvas]['Data'] = [];
                chart_data[canvas]['YearData'] = [];
                chart_data[canvas]['PeriodData'] = [];
                chart_series_name[canvas] = [];
                chart_type[canvas] = [];
                yLabels[canvas] = [];
                dateRange[canvas] = [];
                yaxis[canvas] = [];
                $("#stockTitle").empty();
                $("#stockTitle").append(data['data']['stock_name']);
                var result_data = [];
                var tmp_Range = [];
                var tmp_format = [];
                tmp_Range['Data'] = [];
                tmp_Range['YearData'] = [];
                tmp_Range['PeriodData'] = [];
                var tmp_opposite = [];
                for(var j = 0; j < line_amount_name.length; j++){
                    result_data['Data'] = [];
                    result_data['YearData'] = [];
                    result_data['PeriodData'] = [];
                    dateRange[canvas]['Data'] = [];
                    dateRange[canvas]['YearData'] = [];
                    dateRange[canvas]['PeriodData'] = [];
                    if(data['data']['data'][line_amount_name[j]]['Data']){
                        for (var i in data['data']['data'][line_amount_name[j]]['Data']) {
                            var tmp = i.substr(0, 4)+'/'+i.substr(4, 2)+'/'+i.substr(6, 2);
                            var tmp_date = new Date(tmp).getTime()+86400000;
                            result_data['Data'].push([tmp_date, data['data']['data'][line_amount_name[j]]['Data'][i]]);
                            tmp_Range['Data'].push(tmp);
                            tmp_format.push(data['data']['data'][line_amount_name[j]]['UnitRef']);
                        }
                        result_data['Data'].sort();
                        tmp_Range['Data'].forEach(function (value) {
                            if (dateRange[canvas]['Data'].indexOf(value) == -1) {
                                dateRange[canvas]['Data'].push(value);
                            }
                        });
                    }
                    if(data['data']['data'][line_amount_name[j]]['YearData']){
                        for (var i in data['data']['data'][line_amount_name[j]]['YearData']) {
                            var tmp = i.substr(0, 4);
                            var tmp_date = new Date(tmp).getTime()+86400000;
                            result_data['YearData'].push([tmp_date, data['data']['data'][line_amount_name[j]]['YearData'][i]]);
                            tmp_Range['YearData'].push(tmp);
                            tmp_format.push(data['data']['data'][line_amount_name[j]]['UnitRef']);
                        }
                        result_data['YearData'].sort();
                        tmp_Range['YearData'].forEach(function (value) {
                            if (dateRange[canvas]['YearData'].indexOf(value) == -1) {
                                dateRange[canvas]['YearData'].push(value);
                            }
                        });
                    }
                    if(data['data']['data'][line_amount_name[j]]['PeriodData']){
                        for (var i in data['data']['data'][line_amount_name[j]]['PeriodData']) {
                            var tmp = i.substr(0, 4)+'/'+i.substr(5, 2)*3;
                            var tmp_date = new Date(tmp).getTime()+86400000;
                            result_data['PeriodData'].push([tmp_date, data['data']['data'][line_amount_name[j]]['PeriodData'][i]]);
                            tmp_Range['PeriodData'].push(tmp);
                            tmp_format.push(data['data']['data'][line_amount_name[j]]['UnitRef']);
                        }
                        result_data['PeriodData'].sort();
                        tmp_Range['PeriodData'].forEach(function (value) {
                            if (dateRange[canvas]['PeriodData'].indexOf(value) == -1) {
                                dateRange[canvas]['PeriodData'].push(value);
                            }
                        });
                    }
                    chart_type[canvas].push(data['data']['data'][line_amount_name[j]]['Style']);
                    chart_series_name[canvas].push(data['data']['data'][line_amount_name[j]]['ChineseAccount']);
                    chart_data[canvas]['Data'].push(result_data['Data']);
                    chart_data[canvas]['YearData'].push(result_data['YearData']);
                    chart_data[canvas]['PeriodData'].push(result_data['PeriodData']);
                }
                stock_name = data['data']['data'][line_amount_name[0]]['ChineseAccount'];
                display = data['data']['display'];
                var format = [];
                tmp_format.forEach(function (value) {
                    if (format.indexOf(value) == -1) {
                        format.push(value);
                        if(tmp_opposite.length == 0){
                            tmp_opposite.push(false);
                        }
                        else{
                            tmp_opposite.push(true);
                        }
                    }
                });
                for(var i = 0; i < tmp_format.length; i++){
                    yaxis[canvas].push(i);
                }
                yLabels[canvas] = yLabelGenerator(format, tmp_opposite);
                var chartData = seriesGenerator(chart_type[canvas], chart_series_name[canvas], chart_data[canvas][data_type], yaxis[canvas], 'all');
                drawLineChart(canvas, chartData, stock_name, yLabels[canvas], display);
                stockDateRange(canvas, dateRange[canvas][data_type]);
            });
            buttonEngine();
        }


        /**
            costumize data range button
         */
        function stockDateRange(canvas, dateRange, refreshEnd, startFrom){
            if(refreshEnd){
                $("#rangeEndSelect"+canvas).empty();
                for(var i in dateRange){
                    if(i == 0){
                        $("#rangeEndSelect"+canvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                    }
                    else{
                        var tmp_value = parseInt(startFrom) + parseInt(i) + parseInt(1);
                        $("#rangeEndSelect"+canvas).append('<option class="rangeEndOption" value="'+tmp_value+'">'+dateRange[i]+'</option>');
                    }
                }
            }
            else{
                $("#rangeStartSelect"+canvas).empty();
                $("#rangeEndSelect"+canvas).empty();
                for(var i in dateRange){
                    if(i == 0){
                        $("#rangeStartSelect"+canvas).append('<option class="rangeStartOption" value="'+i+'" selected="selected">'+dateRange[i]+'</option>');
                        $("#rangeEndSelect"+canvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                    }
                    else{
                        var j = parseInt(i) + 1;
                        $("#rangeStartSelect"+canvas).append('<option class="rangeStartOption" value="'+i+'">'+dateRange[i]+'</option>');
                        $("#rangeEndSelect"+canvas).append('<option class="rangeEndOption" value="'+j+'">'+dateRange[i]+'</option>');
                    }
                }
            }
        }


/**
        基準線
        yAxis: {
            title: {
                text: 'Exchange rate'
            },
            plotLines: [{
                value: minRate,
                color: 'green',
                dashStyle: 'shortdash',
                width: 2,
                label: {
                text: 'Last quarter minimum'
                }
            }, {
                value: maxRate,
                color: 'red',
                dashStyle: 'shortdash',
                width: 2,
                label: {
                text: 'Last quarter maximum'
                }
            }]
        }
 */
        function drawLineChart(canvas, series, title, yLabel, display){
            if(display){
                $("#DailyStockPriceAreaChartWithDisplayLabel").empty();
                $.each(display, function(index, val) {
                    $("#DailyStockPriceAreaChartWithDisplayLabel").append('<td>' + val.ChineseAccount + '<br/><b><h4>' +val.Data + '</h4></b></td>');
                });
            }
            Highcharts.chart(canvas, {
                title: {
                    text: title
                },yAxis: yLabel,
                xAxis: {
                    type: 'date',
                    labels: {
                        formatter: function() {
                            return this.value.toString().substring(0, 6);
                        }
                    }
                },series: series
                ,tooltip:{
                    borderWidth: 0,
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%Y/%m/%e', new Date(this.x)) + '<br/>' +
                            this.y + '(元)';
                    }
                }
            });
        }
        

        /**
            generate data series for highchart
         */
        function seriesGenerator(type, name, data, yaxis, sliceStart, sliceEnd){
            var seriestData = [];
            if(sliceStart == 'all'){
                for(var i in type){
                    seriestData.push({
                        type: type[i],
                        name: name[i],
                        data: data[i],
                        yAxis: yaxis[i],
                        label: { enabled : false }
                    });
                }
            }
            else if(sliceStart == -10){
                for(var i in type){
                    seriestData.push({
                        type: type[i],
                        name: name[i],
                        data: data[i].slice(sliceStart),
                        yAxis: yaxis[i],
                        label: { enabled : false }
                    });
                }
            }
            else{
                for(var i in type){
                    seriestData.push({
                        type: type[i],
                        name: name[i],
                        data: data[i].slice(sliceStart, sliceEnd),
                        yAxis: yaxis[i],
                        label: { enabled : false }
                    });
                }
            }
            return seriestData;
        }

        /**
            y axis label generator
         */
        function yLabelGenerator(formats, opposite){
            var yLabel = [];
            for(var i in formats){
                yLabel.push({
                    labels: {
                        format: '{value}'+formats[i]
                    },
                    title: {
                        text: formats[i]
                    },
                    opposite: opposite[i]
                });
            }
            return yLabel;
        }

        /**
            company infomation table
         */
        function infoTable(stock_code){
            $.getJSON('https://cronjob.uanalyze.com.tw/fetch/CompanyInfo/'+stock_code, function(data){
                $("#row1").empty();
                $("#row1").append('<td><b>公司名稱</b></td><td colspan="3">' + data['data']['data']['CompanyNameChinese'] + '</td>');
                $("#row2").empty();
                $("#row2").append('<td><b>最新股本</b></td><td colspan="3">' + data['data']['data']['NumberOfSharesIssued'] + '</td>');
                $("#row3").empty();
                $("#row3").append('<td><b>掛牌類別</b></td><td>' + data['data']['data']['Market'] + '</td><td style=""><b>成立日期</b></td><td>' + data['data']['data']['DateOfIncorporation'] + '</td>');
                $("#row4").empty();
                $("#row4").append('<td><b>類股</b></td><td>' + data['data']['data']['Sector'] + '</td><td><b>掛牌日期</b></td><td>' + data['data']['data']['DateOfListing'] + '</td>');
                $("#row5").empty();
                $("#row5").append('<td><b>董事長</b></td><td>' + data['data']['data']['Chairman'] + '</td><td><b>總經理</b></td><td>' + data['data']['data']['CEO'] + '</td>');
                $("#row6").empty();
                $("#row6").append('<td><b>發言人</b></td><td>' + data['data']['data']['Speaker'] + '</td><td><b>代理發言人</b></td><td>' + data['data']['data']['DeputySpeaker'] + '</td>');
                $("#row7").empty();
                $("#row7").append('<td><b>資本額(仟元)</b></td><td colspan="3">' + data['data']['data']['PaidUpCapital'] + '</td>');
                $("#row8").empty();
                $("#row8").append('<td><b>私募股數</b></td><td colspan="3">' + data['data']['data']['PrivateEquityShares'] + '</td>');
                $("#row9").empty();
                $("#row9").append('<td><b>經營業務內容</b></td><td colspan="3">' + data['data']['data']['HistoryAndOrganization'] + '</td>');
                $("#row10").empty();
                $("#row10").append('<td><b>公司住址</b></td><td colspan="3">' + data['data']['data']['CompanyAddress'] + '</td>');
                $("#row11").empty();
                $("#row11").append('<td><b>公司電話</b></td><td>' + data['data']['data']['CompanyContactNumber'] + '</td><td><b>傳真</b></td><td>' + data['data']['data']['CompanyFax'] + '</td>');
                $("#row12").empty();
                $("#row12").append('<td><b>公司網址</b></td><td>' + data['data']['data']['CompanyWebsite'] + '</td><td><b>email</b></td><td>' + data['data']['data']['CompanyEmailAddress'] + '</td>');
                $("#row13").empty();
                $("#row13").append('<td><b>英文地址</b></td><td colspan="3">' + data['data']['data']['CompanyAddressEnglish'] + '</td>');
                $("#row14").empty();
                $("#row14").append('<td><b>股票過戶機構</b></td><td colspan="3">' + data['data']['data']['TransferAgency'] + '</td>');
                $("#row15").empty();
                $("#row15").append('<td><b>過戶機構地址</b></td><td>' + data['data']['data']['TransferAgencyAddress'] + '</td><td><b>過戶機構電話</b></td><td>' + data['data']['data']['TransferAgencyTel'] + '</td>');
            });
        }
        
    </script>

@endsection