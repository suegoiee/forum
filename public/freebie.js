
/**總成 */
var chart_data = [];
var chart_type = [];
var chart_series_name = [];
var display = [];
var dateRange = [];
var yLabels = [];
var stock_name;
var yaxis = [];
var dataType = [];
    function dataFactory(stock_url, ClearCanvas){
        stockPool(stock_url);
        var datatype_button_group = '';
        var IdForCanvas = stock_url.substring(stock_url.lastIndexOf("/", stock_url.lastIndexOf("/") - 1) + 1, stock_url.lastIndexOf("/"));
        chart_data[IdForCanvas] = [];
        dataType = 'Data';
        $.getJSON(stock_url,function(data){
            var title = data.data.stock_name;
            var refLine = [];
            var DisPlayLabel = false;
            var DisPlayLabel = false;
            var PYButton = false;
            if(data.data.display){
                display = data.data.display;
                DisPlayLabel = true;
            }
            if(data.data.refline){
                refLine = refLineGenerator(data.data.refline);
            }
            $("#stockTitle").empty();
            $("#stockTitle").append(title);

            /**純圖表 */
            if(data.data.type == 'chart'){
                var TmpData = data.data.data;
                var outer_ch = '';
                $.each(TmpData, function(key1, val1) {
                    chart_data[IdForCanvas] .push(val1);
                });
                if(chart_data[IdForCanvas][0].YearData){
                    dataType = 'YearData';
                    PYButton = true;
                }
                chart_data[IdForCanvas] = DataStandardization(chart_data[IdForCanvas]);
                ContainerGenerator(PYButton, true, DisPlayLabel, IdForCanvas, ClearCanvas);
                seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas);
            }

            /**新聞 */
            if(data.data.type == 'link_list'){
                var tmp = data.data.data;
                $.each(tmp, function(key1, val1) {
                    chart_data[IdForCanvas] .push(val1);
                });
                ContainerGenerator(PYButton, false, DisPlayLabel, IdForCanvas, ClearCanvas);
                drawNews(chart_data[IdForCanvas], IdForCanvas);
            }

            /**表格 */
            if(data.data.type == 'sorting_table'){
                var tmp0 = data.data;
                ContainerGenerator(PYButton, false, DisPlayLabel, IdForCanvas, ClearCanvas);
                drawTable(tmp0, IdForCanvas);
            }

            /**公司基本資料 */
            if(data.data.type == 'table'){
                var tmp0 = data.data;
                ContainerGenerator(PYButton, false, DisPlayLabel, IdForCanvas, ClearCanvas);
                infoTable(tmp0, IdForCanvas);
            }

            /**報表 */
            else if(data.data.type == 'table_chart'){
                var tmp0 = data.data.data;
                var sideTable = '<div class="btn-group-vertical" style="width:100%">';
                var first = true;
                $.each(tmp0, function(key1, val1) {
                    var tmp_outer_ch = val1.ChineseAccount;
                    chart_data[IdForCanvas][key1] = [];
                    var childLayers = findchild(val1);
                    /**報表左側控制 第一層按鈕 */
                    sideTable = sideTable + '<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#'+key1+'" value="'+key1+'">'+tmp_outer_ch+'</button>';
                    sideTable = sideTable + '<div id="'+key1+'" class="collapse">';
                    for(var i = 0; i < childLayers; i++){
                        val1 = val1.Child;
                        sideTable += '<div class="btn-group-vertical ChartTableButtonParent" style="width:100%" value="'+key1+'">';
                        $.each(val1, function(key2, val2){
                            chart_data[IdForCanvas][key1][key2] = [];
                            if(val2.Combo){
                                $.each(val2.Combo, function(key3, val3){
                                    if(val3.YearData){
                                        dataType = 'YearData';
                                    }
                                    chart_data[IdForCanvas][key1][key2].push(val3);
                                });
                            }
                            else{
                                if(val2.YearData){
                                    dataType = 'YearData';
                                }
                                chart_data[IdForCanvas][key1][key2].push(val2);
                            }
                            chart_data[IdForCanvas][key1][key2] = DataStandardization(chart_data[IdForCanvas][key1][key2]);
                            var active = '';
                            if(i == 0 && first == true){
                                first = false;
                                active = 'ChartActive';
                            }
                            /**報表左側控制 第二層按鈕 */
                            sideTable = sideTable + '<button type="button" class="btn btn-success drawTableChart '+active+'" value="'+key2+'">'+val2.ChineseAccount+'</button>';
                        });
                        sideTable += '</div>';
                    }
                    sideTable = sideTable + '</div>';
                });
                sideTable = sideTable + '</div>';
                var display_table = '<table class="table" style="width:100%; text-align:center;"><tr id="'+IdForCanvas+'Label"></tr></table>';
                if(dataType != 'Data'){
                    var PYButton = true;
                }
                ContainerGenerator(PYButton, true, DisPlayLabel, IdForCanvas, ClearCanvas);
                $("#"+IdForCanvas+"table").width("20%");
                $("#"+IdForCanvas+"table").css('float', 'left');
                $("#"+IdForCanvas).width("80%");
                $("#"+IdForCanvas).css('float', 'left');
                $("#"+IdForCanvas+"table").append(sideTable);
                for(var i in chart_data[IdForCanvas]){
                    for(var j in chart_data[IdForCanvas][i]){
                        dataType = 'Data';
                        if(chart_data[IdForCanvas][i][j][0]['YearData']){
                            dataType = 'YearData';
                        }
                        seriesGenerator(chart_data[IdForCanvas][i][j], dataType, refLine, outer_ch, display, IdForCanvas);
                        break;
                    }
                    break;
                }
            }
            drawTableChart(refLine, outer_ch, display, IdForCanvas);
            stockDateRange(IdForCanvas, dataType);
            buttonEngine(refLine, outer_ch, display, IdForCanvas);
        });
    }
    

    /**股票搜尋器 */
    function stockPool(stock_url){
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
                    dataFactory(stock_url.slice(0, -4)+stockCode, true);
                }
            });
        });
    }

    /**表格列表 */
    function drawTable(data, IdForCanvas){
        $("#"+IdForCanvas).append('<table id="example" class="table table-striped"></table>');
        var TableData = [];
        var TableTitle = [];
        var tmp = [];
        for(var i in data['data']){
            $.each(data['data'][i], function(key, val){
                tmp.push(val);
            })
            TableData.push(tmp);
        }
        var tmp = [];
        for(var i in data['column_title']){
            $.each(data['column_title'][i], function(key, val){
                TableTitle.push({title: val});
            })
        }
        $('#example').DataTable({
            data: TableData,
            columns: TableTitle
        });
    }

    /**新聞列表 */
    function drawNews(data, IdForCanvas){
        $("#"+IdForCanvas).width("50%");
        $("#"+IdForCanvas).append('<h3>個股新聞</h3><ul id="lists" class="list-group"></ul><ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>');
        var news = [];
        for(var i in data){
            news.push('<li class="list-group-item"><a class="news-title" href="'+ data[i]['link'] +'" data-category="'+ data[i]['category'] +'">'+ data[i]['title'] +'</a>&nbsp&nbsp&nbsp<small class="margin-left-10 text-colour-white">'+ data[i]['date'] +'</small></li>');
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
    }

    /**公司基本資料 */
    function infoTable(data, IdForCanvas){
        var row1 = '<tr><td><b>公司名稱</b></td><td colspan="3">' + data['data']['CompanyNameChinese'] + '</td></tr>';
        var row2 = '<tr><td><b>最新股本</b></td><td colspan="3">' + data['data']['NumberOfSharesIssued'] + '</td></tr>';
        var row3 = '<tr><td><b>掛牌類別</b></td><td>' + data['data']['Market'] + '</td><td style=""><b>成立日期</b></td><td>' + data['data']['DateOfIncorporation'] + '</td></tr>';
        var row4 = '<tr><td><b>類股</b></td><td>' + data['data']['Sector'] + '</td><td><b>掛牌日期</b></td><td>' + data['data']['DateOfListing'] + '</td></tr>';
        var row5 = '<tr><td><b>董事長</b></td><td>' + data['data']['Chairman'] + '</td><td><b>總經理</b></td><td>' + data['data']['CEO'] + '</td></tr>';
        var row6 = '<tr><td><b>發言人</b></td><td>' + data['data']['Speaker'] + '</td><td><b>代理發言人</b></td><td>' + data['data']['DeputySpeaker'] + '</td></tr>';
        var row7 = '<tr><td><b>資本額(仟元)</b></td><td colspan="3">' + data['data']['PaidUpCapital'] + '</td></tr>';
        var row8 = '<tr><td><b>私募股數</b></td><td colspan="3">' + data['data']['PrivateEquityShares'] + '</td></tr>';
        var row9 = '<tr><td><b>經營業務內容</b></td><td colspan="3">' + data['data']['HistoryAndOrganization'] + '</td></tr>';
        var row10 = '<tr><td><b>公司住址</b></td><td colspan="3">' + data['data']['CompanyAddress'] + '</td></tr>';
        var row11 = '<tr><td><b>公司電話</b></td><td>' + data['data']['CompanyContactNumber'] + '</td><td><b>傳真</b></td><td>' + data['data']['CompanyFax'] + '</td></tr>';
        var row12 = '<tr><td><b>公司網址</b></td><td>' + data['data']['CompanyWebsite'] + '</td><td><b>email</b></td><td>' + data['data']['CompanyEmailAddress'] + '</td></tr>';
        var row13 = '<tr><td><b>英文地址</b></td><td colspan="3">' + data['data']['CompanyAddressEnglish'] + '</td></tr>';
        var row14 = '<tr><td><b>股票過戶機構</b></td><td colspan="3">' + data['data']['TransferAgency'] + '</td></tr>';
        var row15 = '<tr><td><b>過戶機構地址</b></td><td>' + data['data']['TransferAgencyAddress'] + '</td><td><b>過戶機構電話</b></td><td>' + data['data']['TransferAgencyTel'] + '</td></tr>';
        var BasicInfo = '<h3>公司基本資料</h3><table class="table table-bordered" style="width:100%; table-layout: fixed; word-wrap: break-word;"><tbody id="infoTable" style="font-size:13px">'+row1+row2+row3+row4+row5+row6+row7+row8+row9+row10+row11+row12+row13+row14+row15+'</tbody></table>';
        $("#"+IdForCanvas).width("50%");
        $("#"+IdForCanvas).append(BasicInfo);
    }

    /**底層子類別 */
    function findchild(data){
        var layers = 0;
        if(data.Child){
            layers++;
            findchild(data.Child);
            return layers;
        }
        else{
            return layers;
        }
    }

    /**框架產生器 */
    function ContainerGenerator(PYButton, AmountButton, DisPlayLabel, IdForCanvas, ClearCanvas){
        var display_table = '';
        var RecentTenButton = '';
        var WholeDateButton = '';
        var CostumizeDateButton = '';
        var CostumizeDateStart = '';
        var CostumizeDateEnd = '';
        var PeriodButton = '';
        var YearButton = '';
        /**上方 */
        if(DisPlayLabel){
            display_table = '<table class="table" style="width:100%; text-align:center;"><tr id="'+IdForCanvas+'Label"></tr></table>';
        }

        /**上排資料數量按鈕 */
        if(AmountButton){
            RecentTenButton = '<button type="button" class="btn btn-default buttonLastTen" value="'+IdForCanvas+'">近十筆</button>';
            WholeDateButton = '<button type="button" class="btn btn-default buttonEntire" value="'+IdForCanvas+'">全部</button>';
            CostumizeDateButton = '<button type="button" class="btn btn-default buttonCustomize" value="'+IdForCanvas+'">自訂</button>';
            CostumizeDateStart = '從 :<select class="form-control rangeStartSelect rangeStartSelect'+IdForCanvas+'" value="'+IdForCanvas+'"></select>';
            CostumizeDateEnd = '至 :<select class="form-control rangeEndSelect rangeEndSelect'+IdForCanvas+'" value="'+IdForCanvas+'"></select>';
        }

        /**季/年按鈕 */
        if(PYButton){
            PeriodButton = '<button type="button" class="btn btn-default buttonQuater" value="'+IdForCanvas+'">季度</button>';
            YearButton = '<button type="button" class="btn btn-default buttonYear" value="'+IdForCanvas+'">年度</button>';
        }
        /**框架 */
        var ChartContainer = '<div id="'+IdForCanvas+'"></div>';
        var SideTableContainer = '<div id="'+IdForCanvas+'table"></div>';

        /**總成 */
        var container = display_table+'<div class="container"><div class="container"><div class="btn-group" role="group" aria-label="..." style="position:relative; float:left;">'+PeriodButton+YearButton+'</div><div class="btn-group" role="group" aria-label="..." style="position:relative; float:right;">'+RecentTenButton + WholeDateButton + CostumizeDateButton +'</div></div><div class="container"><div id="customizeRange'+IdForCanvas+'" class="collapse" style="width:100%; position:relative; float:right;"><div style="position:relative; width:30%; float: left; margin-left:10%"> '+CostumizeDateStart+'</div><div style="position:relative; width:30%; float: left; margin-left:20%">'+CostumizeDateEnd+'</div></div></div><div id="'+IdForCanvas+'container" style="position:relative; float:top;">'+SideTableContainer+ChartContainer+'</div></div>';
        
        if(ClearCanvas){
            $("#CanvasBaseMap").empty();
        }
        $("#CanvasBaseMap").append(container);
    }

    /**圖表資料生產器 */
    function seriesGenerator(data, dataType, refLine, title, display, IdForCanvas, sliceHead, sliceEnd){
        var seriestData = [];
        var xData = [];
        var unit = [];
        var yAxisLocate = [];
        for(var i in data){
            if (unit.indexOf(data[i]['UnitRef']) == -1) {
                unit.push(data[i]['UnitRef']);
                yAxisLocate.push(parseInt(i));
            }
            else{
                yAxisLocate.push(getKeyByValue(unit, data[i]['UnitRef']));
            }
        }
        xData.sort();
        for(var i in data){
            var tmpData = data[i][dataType];
            if(sliceHead == -10){
                tmpData = data[i][dataType].slice(-10);
            }
            else if(sliceEnd){
                tmpData = data[i][dataType].slice(sliceHead, sliceEnd);
            }
            seriestData.push({
                type: data[i]['Style'],
                name: data[i]['UnitRef'],
                data: tmpData,
                yAxis: yAxisLocate[i],
                label: { enabled : false }
            });
        }
        var yLabel = yLabelGenerator(unit, refLine);
        drawChart(IdForCanvas, title, yLabel, seriestData);
        drawDisplay(IdForCanvas, display);
    }
    
    /**資料一致化 */
    function DataStandardization(data){
        var xData = [];
        var xData2 = [];
        for(var i in data){
            if(data[i]['YearData']){
                dataType = 'YearData';
                $.each(data[i]['YearData'], function(key, val){
                    if (xData.indexOf(key) == -1) {
                        xData.push(key);
                    }
                });
                $.each(data[i]['PeriodData'], function(key, val){
                    if (xData2.indexOf(key) == -1) {
                        xData2.push(key);
                    }
                });
            }
            else{
                $.each(data[i]['Data'], function(key, val){
                    if (xData.indexOf(key) == -1) {
                        xData.push(key);
                    }
                });
            }
        }
        xData.sort();
        xData2.sort();
        for(var i in data){
            var yData = [];
            var yData2 = [];
            if(data[i]['YearData']){
                $.each(data[i]['YearData'], function(key, val){
                    yData.push([key, val]);
                });
                $.each(xData, function (key, val) {
                    if (data[i]['YearData'][val] === undefined) {
                        yData.push([val, null]);
                    }
                });
                $.each(data[i]['PeriodData'], function(key, val){
                    yData2.push([key, val]);
                });
                $.each(xData2, function (key, val) {
                    if (data[i]['PeriodData'][val] === undefined) {
                        yData2.push([val, null]);
                    }
                });
                yData.sort();
                yData2.sort();
                data[i]['YearData'] = yData;
                data[i]['PeriodData'] = yData2;
            }
            else{
                $.each(data[i]['Data'], function(key, val){
                    yData.push([key, val]);
                });
                $.each(xData, function (key, val) {
                    if (data[i]['Data'][val] === undefined) {
                        yData.push([val, null]);
                    }
                });
                yData.sort();
                data[i]['Data'] = yData;
            }
        }
        return data;
    }
    
    /**Y軸生產器 */
    function yLabelGenerator(formats, refline){
        var yLabel = [];
        if(!refline){
            var refline = [];
        }
        for(var i in formats){
            yLabel.push({
                labels: {
                    format: '{value}'+formats[i]
                },
                title: {
                    text: formats[i]
                },
                opposite: i%2,
                plotLines: refline
            });
        }
        return yLabel;
    }

    /**X軸生產器 */
    function xLabelGenerator(data){
        var tmpXLabel = [];
        tmpXLabel.push({
            categories: data
        });
        return tmpXLabel;            
    }

    /**基準線生產器 */
    function refLineGenerator(data){
        var tmp_refLine = [];
        $.each(data, function(key, val) {
            tmp_refLine.push({
                value: val.Data,
                color: 'green',
                dashStyle: val.Style,
                width: 2,
                label: {
                    text: val.ChineseAccount
                }
            });
        });
        return tmp_refLine;
    }

    /**畫上方顯示板 */
    function drawDisplay(canvas, display){
        $("#"+canvas+"Label").empty();
        $.each(display, function(index, val) {
            $("#"+canvas+"Label").append('<td>' + val.ChineseAccount + '<br/><b><h4>' +val.Data + '</h4></b></td>');
        });
    }

    /**畫圖表 */
    function drawChart(canvas, title, yLabel, series){
        Highcharts.chart(canvas, {
            title: {
                text: title
            },yAxis: yLabel,
            xAxis: {
                type: 'category',
                uniqueNames: true
            },
            series: series,
            tooltip:{
                borderWidth: 0,
                formatter: function() {
                    return '<b>' + this.series.name + '</b><br/>' + this.series.data[this.x]['name'] + '<br/>' +
                        this.y + '(元)';
                }
            }
        });
    }

    /**用值找KEY */
    function getKeyByValue(object, value) {
        var result = parseInt(Object.keys(object).find(key => object[key] === value));
        return result;
    }

    /**報表左側控制 按鈕 */
    function drawTableChart(refLine, outer_ch, display, IdForCanvas){
        $(document).on('click', ".drawTableChart", function(){
            var key1 = $(this).parent('.ChartTableButtonParent').attr('value');
            var key2 = $(this).val();
            $(".ChartActive").removeClass("ChartActive");
            $(this).addClass('ChartActive');
            stockDateRange(IdForCanvas, dataType);
            seriesGenerator(chart_data[IdForCanvas][key1][key2], dataType, refLine, outer_ch, display, IdForCanvas);
        });
    }

    /**上排 按鈕 */
    function buttonEngine(refLine, outer_ch, display, IdForCanvas){

        /**數量 按鈕 */
        $(document).on('click', ".buttonLastTen", function(){
            var tmp_canvas = $(this).attr('value');
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val();
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, -10);
            }
            else{
                seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, -10);
            }
        });
        $(document).on('click', ".buttonEntire", function(){
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val()
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                seriesGenerator(chart_data[IdForCanvas][key2][key1], dataType, refLine, outer_ch, display, IdForCanvas, 'all');
            }
            else{
                seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, 'all');
            }
        });
        $(document).on('click', ".buttonCustomize", function(){
            var tmp_canvas = $(this).attr('value');
            $("#customizeRange"+tmp_canvas).collapse('toggle');
        });
        $(".rangeStartSelect").change(function(){
            var rangeEnd = parseInt($(".rangeEndSelect"+IdForCanvas).find(":selected").val()) + 1;
            var rangeStart = parseInt($(".rangeEndSelect"+IdForCanvas).find(":selected").val());
            var range = rangeEnd - rangeStart;
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val();
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                var tmpData = chart_data[IdForCanvas][key2][key1];
            }
            else{
                var tmpData = chart_data[IdForCanvas];
            }
            stockDateRange(IdForCanvas, dataType, 'refreshEnd', rangeStart);
            if(range > 0){
                seriesGenerator(tmpData, dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
            }
        });
        $(".rangeEndSelect").change(function(){
            var rangeEnd = parseInt($(".rangeEndSelect"+IdForCanvas).find(":selected").val()) + 1;
            var rangeStart = parseInt($(".rangeEndSelect"+IdForCanvas).find(":selected").val());
            var range = rangeEnd - rangeStart;
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val();
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                seriesGenerator(chart_data[IdForCanvas][key2][key1], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
            }
            else{
                seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
            }
        });

        /**年度 季度 按鈕*/
        $(document).on('click', ".buttonQuater", function(){
            dataType = 'PeriodData';
            var tmp_canvas = $(this).attr('value');
            stockDateRange(tmp_canvas, dataType);
            var rangeEnd = parseInt($(".rangeEndSelect"+tmp_canvas).find(":selected").val()) + 1;
            var rangeStart = parseInt($(".rangeEndSelect"+tmp_canvas).find(":selected").val());
            var range = rangeEnd - rangeStart;
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val();
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
            }
            else{
                console.log('IdForCanvas', tmp_canvas);
                seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
            }
        });
        $(document).on('click', ".buttonYear", function(){
            dataType = 'YearData';
            var tmp_canvas = $(this).attr('value');
            stockDateRange(tmp_canvas, dataType);
            var rangeEnd = parseInt($(".rangeEndSelect"+tmp_canvas).find(":selected").val()) + 1;
            var rangeStart = parseInt($(".rangeEndSelect"+tmp_canvas).find(":selected").val());
            var range = rangeEnd - rangeStart;
            if($(".ChartActive").val()){
                var key1 = $(".ChartActive").val();
                var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
                seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
            }
            else{
                console.log('IdForCanvas', tmp_canvas);
                seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
            }
        });
    }

    /**日期機制 按鈕*/
    function stockDateRange(IdForCanvas, refreshEnd, startFrom){
        var count = 0;
        if($(".ChartActive").val()){
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            $.each(chart_data[IdForCanvas][key2][key1], function(key, val){
                $.each(val[dataType], function(key2, val2){
                    if(!refreshEnd){
                        if(count == 0){
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeStartOption" value="'+count+'">'+val2[0]+'</option>');
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                        }
                        else{
                            //var tmp_value = parseInt(startFrom) + parseInt(i) + parseInt(1);
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeStartOption" value="'+count+'">'+val2[0]+'</option>');
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="'+count+'">'+val2[0]+'</option>');
                        }
                    }
                    else{
                        if(count == 0){
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                        }
                        else if(count > startFrom){
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="'+count+'">'+val2[0]+'</option>');
                        }
                    }
                    count++
                });
            });
        }
        else{
            $.each(chart_data[IdForCanvas], function(key, val){
                $.each(val[dataType], function(key2, val2){
                    if(!refreshEnd){
                        if(count == 0){
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeStartOption" value="'+count+'">'+val2[0]+'</option>');
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                        }
                        else{
                            //var tmp_value = parseInt(startFrom) + parseInt(i) + parseInt(1);
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeStartOption" value="'+count+'">'+val2[0]+'</option>');
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="'+count+'">'+val2[0]+'</option>');
                        }
                    }
                    else{
                        if(count == 0){
                            $(".rangeEndSelect"+IdForCanvas).empty();
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>---請選擇日期---</option>');
                        }
                        else if(count >= startFrom){
                            $(".rangeEndSelect"+IdForCanvas).append('<option class="rangeEndOption" value="'+count+'">'+val2[0]+'</option>');
                        }
                    }
                    count++
                });
            });
        }
    }
