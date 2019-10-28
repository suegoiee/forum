
/**總成 */
var chart_type = [];
var chart_series_name = [];
var display = [];
var dateRange = [];
var yLabels = [];
var stock_name;
var yaxis = [];
var rangeStart = -10;
var rangeEnd = '';
var chart_data = [];

/**表格列表 */
function drawTableB(TableData, TableTitle, ipo) {
    if(ipo){
        $('#example').DataTable({
            data: TableData,
            columns: TableTitle,
            "order": [[0, "desc"]],
            "pagingType": "full_numbers",
            columnDefs: [
                {
                    targets: 0,
                    className: "text-center"
                },
                { 
                    targets: 1,
                    className: "text-center",
                    width: "13%"
                },
                { 
                    targets: 2,
                    width: "16%"
                },
                {
                    targets: "_all",
                    className: 'text-right'
                }
            ],
            "oLanguage": {
                "sInfoThousands": ",",
                "sLengthMenu":
                    '顯示 _MENU_ 筆',
                "sSearch":
                    '搜尋',
                "oPaginate": {
                    "sPrevious": "<",
                    "sFirst": "|<",
                    "sNext": ">",
                    "sLast": ">|"
                },
                "sInfo": "共 _TOTAL_ 筆資料 (_START_ 至 _END_)"
            }
        });
    }
    else{
        $('#example').DataTable({
            data: TableData,
            columns: TableTitle,
            "order": [[0, "desc"]],
            "pagingType": "full_numbers",
            columnDefs: [
                {
                    targets: 0,
                    className: "text-center"
                },
                {
                    targets: "_all",
                    className: 'text-right'
                }
            ],
            "oLanguage": {
                "sInfoThousands": ",",
                "sLengthMenu":
                    '顯示 _MENU_ 筆',
                "sSearch":
                    '搜尋',
                "oPaginate": {
                    "sPrevious": "<",
                    "sFirst": "|<",
                    "sNext": ">",
                    "sLast": ">|"
                },
                "sInfo": "共 _TOTAL_ 筆資料 (_START_ 至 _END_)"
            }
        });
    }
}

/**畫圖表 */
function drawChartB(title, yLabel, series) {
    Highcharts.chart("canvas", {
        title: {
            text: title
        }, yAxis: yLabel,
        xAxis: {
            crosshair: {
                color: 'green'
            },
            type: 'category',
            uniqueNames: true
        },
        series: series,
        tooltip: {
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + point.series.name + ': ' +
                        point.y + 'm';
                }, '<b>' + this.x + '</b>');
            },
            borderWidth: 0,
            shared: true,
            /*formatter: function () {
                var tmp_unit = '';
                if (this.series.yAxis.axisTitle) {
                    tmp_unit = this.series.yAxis.axisTitle.textStr;
                }
                return '<b>' + this.series.name + '</b><br/>' + this.series.data[this.x]['name'] + '<br/>' +
                    dataFormat(this.y) + tmp_unit;
            }*/
        }
    });
}

function dataFactoryC(data, stock_url, ClearCanvas) {
    stockPool();
    var IdForCanvas = stock_url.substring(stock_url.lastIndexOf("/", stock_url.lastIndexOf("/") - 1) + 1, stock_url.lastIndexOf("/"));
    chart_data[IdForCanvas] = [];
    dataType = 'Data';
    var refLine = [];
    var DisPlayLabel = false;
    var PYButton = false;
    if (data.data.display) {
        display = data.data.display;
        DisPlayLabel = true;
    }
    if (data.data.refline) {
        refLine = refLineGenerator(data.data.refline);
    }

    /**純圖表 */
    if (data.data.type == 'chart') {
        var TmpData = data.data.data;
        var outer_ch = '';
        $.each(TmpData, function (key1, val1) {
            chart_data[IdForCanvas].push(val1);
        });
        if (chart_data[IdForCanvas][0].YearData) {
            dataType = 'YearData';
            PYButton = true;
        }
        chart_data[IdForCanvas] = DataStandardization(chart_data[IdForCanvas]);
        ContainerGenerator(PYButton, true, DisPlayLabel, IdForCanvas, ClearCanvas, false);
        seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, -10);
    }

    /**報表 */
    else if (data.data.type == 'table_chart') {
        var tmp0 = data.data.data;
        var sideTable = '<div class="btn-group-vertical" style="width:100%">';
        var first = true;
        $.each(tmp0, function (key1, val1) {
            var tmp_outer_ch = val1.ChineseAccount;
            chart_data[IdForCanvas][key1] = [];
            var childLayers = findchild(val1);
            /**報表左側控制 第一層按鈕 */
            sideTable = sideTable + '<button type="button" class="btn btn-primary OuterSideTable" data-toggle="collapse" data-target="#' + key1 + '" value="' + key1 + '">' + tmp_outer_ch + '</button>';
            sideTable = sideTable + '<div id="' + key1 + '" class="collapse">';
            for (var i = 0; i < childLayers; i++) {
                val1 = val1.Child;
                sideTable += '<div class="btn-group-vertical ChartTableButtonParent" value="' + key1 + '">';
                $.each(val1, function (key2, val2) {
                    chart_data[IdForCanvas][key1][key2] = [];
                    if (val2.Combo) {
                        $.each(val2.Combo, function (key3, val3) {
                            if (val3.YearData) {
                                dataType = 'YearData';
                            }
                            chart_data[IdForCanvas][key1][key2].push(val3);
                        });
                    }
                    else {
                        if (val2.YearData) {
                            dataType = 'YearData';
                        }
                        chart_data[IdForCanvas][key1][key2].push(val2);
                    }
                    chart_data[IdForCanvas][key1][key2] = DataStandardization(chart_data[IdForCanvas][key1][key2]);
                    var active = '';
                    if (i == 0 && first == true) {
                        first = false;
                        active = 'ChartActive';
                    }
                    /**報表左側控制 第二層按鈕 */
                    sideTable = sideTable + '<button type="button" class="drawTableChart ' + active + '" value="' + key2 + '">' + val2.ChineseAccount + '</button>';
                });
                sideTable += '</div>';
            }
            sideTable = sideTable + '</div>';
        });
        sideTable = sideTable + '</div>';
        if (dataType != 'Data') {
            var PYButton = true;
        }
        ContainerGenerator(PYButton, true, DisPlayLabel, IdForCanvas, ClearCanvas, true);

        /**edit it with css */
        $("#" + IdForCanvas + "table").append(sideTable);

        for (var i in chart_data[IdForCanvas]) {
            for (var j in chart_data[IdForCanvas][i]) {
                dataType = 'Data';
                if (chart_data[IdForCanvas][i][j][0]['YearData']) {
                    dataType = 'YearData';
                }
                seriesGenerator(chart_data[IdForCanvas][i][j], dataType, refLine, outer_ch, display, IdForCanvas, -10);
                break;
            }
            break;
        }
    }
    drawTableChart(refLine, outer_ch, display, IdForCanvas, chart_data[IdForCanvas]);
    stockDateRangeB(IdForCanvas, dataType, chart_data[IdForCanvas]);
    buttonEngineB(refLine, outer_ch, display, IdForCanvas, chart_data);
}

/**日期機制 按鈕*/
function stockDateRangeB(IdForCanvas, dataType, data, refreshEnd, startFrom) {
    var count = 0;

    if ($(".ChartActive").val()) {
        var key1 = $(".ChartActive").val();
        var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
        $.each(data[key2][key1], function (key, val) {
            $.each(val[dataType], function (key2, val2) {
                if (!refreshEnd) {
                    if (count == 0) {
                        $(".rangeStartSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else {
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                else {
                    if (count == 0) {
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else if (count > startFrom) {
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                count++
            });
            return false;
        });
    }
    else {
        $.each(data, function (key, val) {
            $.each(val[dataType], function (key2, val2) {
                if (!refreshEnd) {
                    if (count == 0) {
                        $(".rangeStartSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else {
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                else {
                    if (count == 0) {
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else if (count >= startFrom) {
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                count++
            });
            return false;
        });
    }
}

/**上排 按鈕 */
function buttonEngineB(refLine, outer_ch, display, IdForCanvas, chart_data) {
    var tmpchartdata = chart_data;
    /**數量 按鈕 */
    $(document).on('click', ".buttonLastTen", function () {
        rangeEnd = '';
        rangeStart = '-10';
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        var tmp_canvas = $(this).attr('value');
        dataType = ClickedCanvasDataType(tmp_canvas);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(tmpchartdata[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, -10);
        }
        else {
            seriesGenerator(tmpchartdata[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, -10);
        }
    });
    $(document).on('click', ".buttonEntire", function () {
        rangeEnd = '';
        rangeStart = 'all';
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        var tmp_canvas = $(this).attr('value');
        dataType = ClickedCanvasDataType(tmp_canvas);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val()
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(tmpchartdata[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
        }
        else {
            seriesGenerator(tmpchartdata[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, 'all');
        }
    });
    $(document).on('click', ".buttonCustomize", function () {
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        var tmp_canvas = $(this).attr('value');
        $("#customizeRange" + tmp_canvas).collapse('toggle');
    });
    $(".rangeStartSelect" + IdForCanvas).change(function () {
        rangeEnd = parseInt($(".rangeEndSelect" + IdForCanvas).find(":selected").val()) + 1;
        rangeStart = parseInt($(".rangeStartSelect" + IdForCanvas).find(":selected").val());
        var tmp_canvas = $(this).attr('value');
        dataType = ClickedCanvasDataType(tmp_canvas);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            var tmpData = tmpchartdata[tmp_canvas][key2][key1];
        }
        else {
            var tmpData = tmpchartdata[tmp_canvas];
        }
        stockDateRangeB(tmp_canvas, dataType, chart_data[IdForCanvas], 'refreshEnd', rangeStart);
        if (rangeEnd - rangeStart > 0) {
            seriesGenerator(tmpData, dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
    });
    $(".rangeEndSelect" + IdForCanvas).change(function () {
        rangeEnd = parseInt($(".rangeEndSelect" + IdForCanvas).find(":selected").val()) + 1;
        rangeStart = parseInt($(".rangeStartSelect" + IdForCanvas).find(":selected").val());
        var tmp_canvas = $(this).attr('value');
        dataType = ClickedCanvasDataType(tmp_canvas);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[IdForCanvas][key2][key1], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
        }
    });

    /**年度 季度 按鈕*/
    $(document).on('click', ".buttonQuater", function () {
        $(".LeftButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        dataType = 'PeriodData';
        var tmp_canvas = $(this).attr('value');
        stockDateRangeB(tmp_canvas, dataType, chart_data[IdForCanvas]);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
    });
    $(document).on('click', ".buttonYear", function () {
        $(".LeftButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        dataType = 'YearData';
        var tmp_canvas = $(this).attr('value');
        stockDateRangeB(tmp_canvas, dataType, chart_data[IdForCanvas]);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
    });
}

/**股票搜尋器 */
function stockPool() {
    $.getJSON('https://cronjob.uanalyze.com.tw/fetch/StockPool', function (data) {
        var availableTags = [];
        for (var i = 0; i < data['data'].length; i++) {
            availableTags.push({
                'id': data['data'][i]['stock_code'],
                'value': data['data'][i]['stock_code'] + '-' + data['data'][i]['stock_name']
            });
        }
        $("#searchBar").autocomplete({
            autoFocus: true,
            delay: 0,
            source: function (request, response) {
                var results = $.ui.autocomplete.filter(availableTags, request.term);
                response(results.slice(0, 3));
                if (results.slice(0, 1)[0]) {
                    var stockCode = results.slice(0, 1)[0];
                    $("#searchBar").attr('name', stockCode['id']);
                }
            },
            select: function (e, ui) {
                var stockCode = ui['item']['id'];
                var current_url = window.location.href;
                var tmp_stock_url = current_url.slice(0, -4);
                var redirectTo = tmp_stock_url + stockCode;
                SetCookie("stockCode", stockCode);
                window.location.href = redirectTo;
            }
        });
    });
}

/**表格列表 */
function drawTable(data, IdForCanvas) {
    $("#" + IdForCanvas).append('<table id="example" class="table table-striped"></table>');
    var TableData = [];
    var TableTitle = [];
    var compare = [];
    for (var i in data['column_title']) {
        $.each(data['column_title'][i], function (key, val) {
            compare.push(key);
            TableTitle.push({ title: val });
        })
    }
    for (var i in data['data']) {
        var tmp = [];
        for (var j in compare) {
            if (data['data'][i][compare[j]] != null || data['data'][i][compare[j]] != 'undefined') {
                if (compare[j] != 'row_title_center') {
                    tmp.push(dataFormat(data['data'][i][compare[j]]));
                }
                else {
                    tmp.push(data['data'][i][compare[j]]);
                }
            }
            else {
                tmp.push(null);
            }
        }
        TableData.push(tmp);
    }
    $('#example').DataTable({
        data: TableData,
        columns: TableTitle,
        "order": [[0, "desc"]],
        "pagingType": "full_numbers",
        "oLanguage": {
            "sInfoThousands": ",",
            "sLengthMenu":
                '顯示 _MENU_ 筆',
            "sSearch":
                '搜尋',
            "oPaginate": {
                "sPrevious": "<",
                "sFirst": "|<",
                "sNext": ">",
                "sLast": ">|"
            },
            "sInfo": "共 _TOTAL_ 筆資料 (_START_ 至 _END_)"
        }
    });

}

function dataFormat(toFormat) {
    return toFormat.toString().replace(
        /\B(?=(\d{3})+(?!\d))/g, ","
    );
}

/**新聞列表 */
function drawNews(data) {
    //$("#" + IdForCanvas).width("50%");
    //$("#" + IdForCanvas).append('<ul id="lists" class="list-group"></ul><ul id="pagination-demo" class="pagination-sm" style="float:right"></ul>');
    var news = [];
    for (var i in data) {
        data[i]['date'] = data[i]['date'].substring(0, data[i]['date'].lastIndexOf(" "));
        news.push('<li class="list-group-item"><small class="margin-left-10 text-colour-white">' + data[i]['date'] + '</small>&nbsp&nbsp&nbsp<a class="news-title" href="' + data[i]['link'] + '" data-category="' + data[i]['category'] + '" target="_blank">' + data[i]['title'] + '</a></li>');
    }
    $('#pagination-demo').twbsPagination({
        totalPages: Math.ceil(i / 10),
        visiblePages: 4,
        first: '|<',
        next: '>',
        prev: '<',
        last: '>|',
        onPageClick: function (event, page) {
            //fetch content and render here
            $('#lists').empty();
            for (var j = page * 10 - 10; j < page * 10; j++) {
                $('#lists').append(news[j]);
            }
        }
    });
}

/**報表底部表格 */
function drawTableChartBottomTable(IdForCanvas, seriestData, unitForBottomTable) {
    var screenWidth = $(window).width();
    if (screenWidth <= 480) {
        var bottomtable = '';
        for (var i in seriestData) {
            bottomtable += '<div><a style="cursor:pointer;" data-toggle="collapse" data-target="#bottom' + i + '">' + seriestData[i]['name'] + unitForBottomTable[i] + '<span class="triangle-down"></span>' + '</a>';
            bottomtable += '<div id="bottom' + i + '" class="collapse bottomName"><table class="table table-bordered"><tbody>';
            for (var j in seriestData[i]['data']) {
                if (seriestData[i]['data'][j][1] != null && seriestData[i]['data'][j][1] != undefined) {
                    var param = seriestData[i]['data'][j][1];
                    param = dataFormat(param);
                    bottomtable += '<tr><th>' + seriestData[i]['data'][j][0] + '</th><td>' + param + '</td></tr>';
                }
                else {
                    bottomtable += '<tr><th>' + seriestData[i]['data'][j][0] + '</th><td>&nbsp</td></tr>';
                }
            }
            bottomtable += '</tbody></table></div>';
            bottomtable += '</div>';
        }
        $("#" + IdForCanvas + "bottomtable").empty();
        $("#" + IdForCanvas + "bottomtable").append(bottomtable);
    }
    else {
        var bottomtable = '<div><div class="bottomTableHeader" style="width:auto; white-space: nowrap; position:relative; float:left;"><table class="table table-bordered"><tbody><tr><th><i class="fas fa-calendar-week"></i></th></tr>';
        for (var i in unitForBottomTable) {
            bottomtable += '<tr><td>' + seriestData[i]['name'] + unitForBottomTable[i] + '</td></tr>';
        }
        bottomtable += '</tbody></table></div>';
        bottomtable += '<div class="bottomTableContent" style="overflow-x:auto; position:relative; float:left;"><table class="table table-bordered"><tbody>';
        for (var i in seriestData) {
            bottomtable += '<tr>';
            if (i == 0) {
                for (var j in seriestData[i]['data']) {
                    bottomtable += '<th>' + seriestData[i]['data'][j][0] + '</th>';
                }
                bottomtable += '</tr><tr>';
            }
            for (var j in seriestData[i]['data']) {
                if (seriestData[i]['data'][j][1] != null && seriestData[i]['data'][j][1] != undefined) {
                    var param = seriestData[i]['data'][j][1];
                    param = dataFormat(param);
                    bottomtable += '<td>' + param + '</td>';
                }
                else {
                    bottomtable += '<td>&nbsp</td>';

                }
            }
            bottomtable += '</tr>';
        }
        bottomtable += '</tbody></table></div></div>';
        $("#" + IdForCanvas + "bottomtable").empty();
        $("#" + IdForCanvas + "bottomtable").append(bottomtable);
        $(".bottomTableContent").css('max-width', $("#" + IdForCanvas + "bottomtable").width() - $(".bottomTableHeader").width() + 'px');
        $(".bottomTableContent").scrollLeft(9999);
    }
}

/**公司基本資料 */
function infoTable(data, IdForCanvas) {
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
    var BasicInfo = '<table class="table table-bordered" style="width:100%; table-layout: fixed; word-wrap: break-word;"><tbody id="infoTable" style="font-size:13px">' + row1 + row2 + row3 + row4 + row5 + row6 + row7 + row8 + row9 + row10 + row11 + row12 + row13 + row14 + row15 + '</tbody></table>';
    $("#" + IdForCanvas).width("50%");
    $("#" + IdForCanvas).append(BasicInfo);
}

/**底層子類別 */
function findchild(data) {
    var layers = 0;
    if (data.Child) {
        layers++;
        findchild(data.Child);
        return layers;
    }
    else {
        return layers;
    }
}

/**框架產生器 */
function ContainerGenerator(PYButton, AmountButton, DisPlayLabel, IdForCanvas, MultiCharts, BottomTable) {
    var display_table = '';
    var RecentTenButton = '';
    var WholeDateButton = '';
    var CostumizeDateButton = '';
    var CostumizeDateStart = '';
    var CostumizeDateEnd = '';
    var PeriodButton = '';
    var YearButton = '';
    var BottomTableCanvas = '';
    /**上方 */
    if (DisPlayLabel) {
        display_table = '<div class="container"><table class="table tableTop"><tr id="' + IdForCanvas + 'Label"></tr></table></div>';
    }

    /**上排資料數量按鈕 */
    if (AmountButton) {
        RecentTenButton = '<button type="button" class="btn btn-default buttonLastTen ActiveChartControlButton" value="' + IdForCanvas + '">近十筆</button>';
        WholeDateButton = '<button type="button" class="btn btn-default buttonEntire" value="' + IdForCanvas + '">全部</button>';
        CostumizeDateButton = '<button type="button" class="btn btn-default buttonCustomize" value="' + IdForCanvas + '">自訂</button>';
        CostumizeDateStart = '<div class="select"><span class="triangle-down"></span><select class=" rangeStartSelect rangeStartSelect' + IdForCanvas + '" value="' + IdForCanvas + '"></select></div>';
        CostumizeDateEnd = '<div class="select"><span class="triangle-down"></span><select class=" rangeEndSelect rangeEndSelect' + IdForCanvas + '" value="' + IdForCanvas + '"></select></div>';
    }

    /**季/年按鈕 */
    if (PYButton) {
        PeriodButton = '<button type="button" class="btn btn-default buttonQuater" value="' + IdForCanvas + '">季度</button>';
        YearButton = '<button type="button" class="btn btn-default buttonYear ActiveChartControlButton" value="' + IdForCanvas + '">年度</button>';
    }

    /** */
    if (BottomTable) {
        BottomTableCanvas = '<div id="' + IdForCanvas + 'bottomtable"></div>'
    }

    /**框架 */
    var ChartContainer = '<div id="' + IdForCanvas + '"></div>';
    var SideTableContainer = '<div class="sidebar" id="' + IdForCanvas + 'table"></div>';

    /**總成 */
    var container = display_table + SideTableContainer + '<div class="container" id="' + IdForCanvas + 'container"><div><div class="btn-group LeftButtonGroup" style="display:inline-block;" role="group" aria-label="...">' + YearButton + PeriodButton + '</div><div class="btn-group RightButtonGroup" style="display:inline-block; position:relative; float:right;" role="group" aria-label="...">' + RecentTenButton + WholeDateButton + CostumizeDateButton + '</div><div id="customizeRange' + IdForCanvas + '" class="collapse"><div class="timeS"><label>從 ： </label>' + CostumizeDateStart + '</div><div class="timeE"><label>至 ： </label>' + CostumizeDateEnd + '</div></div></div>' + ChartContainer + BottomTableCanvas + '</div>';

    if (MultiCharts) {
        $("#" + IdForCanvas + "Outer").append(container);
    }
    else {
        $("#Outer").append(container);
    }
}

/**圖表資料生產器 */
function seriesGenerator(data, dataType, refLine, title, display, IdForCanvas, sliceHead, sliceEnd) {
    var seriestData = [];
    var xData = [];
    var unit = [];
    var yAxisLocate = [];
    var unitForBottomTable = [];
    for (var i in data) {
        if (unit.indexOf(data[i]['UnitRef']) == -1) {
            unit.push(data[i]['UnitRef']);
            yAxisLocate.push(parseInt(i));
        }
        else {
            yAxisLocate.push(getKeyByValue(unit, data[i]['UnitRef']));
        }
        unitForBottomTable.push(data[i]['UnitRef']);
    }
    xData.sort();
    for (var i in data) {
        var tmpData = data[i][dataType];
        if (sliceHead == -10) {
            tmpData = data[i][dataType].slice(-10);
        }
        else if (sliceEnd) {
            tmpData = data[i][dataType].slice(sliceHead, sliceEnd);
        }
        /*$.each(tmpData, function (key2, val2) {
            val2[1] = parseInt(val2[1]);
        });*/
        /*if(data[i]['Style'] == 'area'){
            var sort = 0;
        }
        else if(data[i]['Style'] == 'column'){
            var sort = 1;
        }
        else if(data[i]['Style'] == 'line'){
            var sort = 2;
        }
        seriestData[sort] = {
            type: data[i]['Style'],
            name: data[i]['ChineseAccount'],
            data: tmpData,
            yAxis: yAxisLocate[i],
            label: { enabled: false }
        }*/
        seriestData.push({
            type: data[i]['Style'],
            name: data[i]['ChineseAccount'],
            data: tmpData,
            yAxis: yAxisLocate[i],
            label: { enabled: false },
            tooltip: {
                valueSuffix: data[i]['UnitRef']
            }
        });
    }
    var yLabel = yLabelGenerator(unit, refLine);
    drawChart(IdForCanvas, title, yLabel, seriestData);
    drawTableChartBottomTable(IdForCanvas, seriestData, unitForBottomTable);
    drawDisplay(IdForCanvas, display);
}

/**資料一致化 */
function DataStandardization(data) {
    var xData = [];
    var xData2 = [];
    for (var i in data) {
        if (data[i]['YearData']) {
            dataType = 'YearData';
            $.each(data[i]['YearData'], function (key, val) {
                if (xData.indexOf(key) == -1) {
                    xData.push(key);
                }
            });
            $.each(data[i]['PeriodData'], function (key, val) {
                if (xData2.indexOf(key) == -1) {
                    xData2.push(key);
                }
            });
        }
        else {
            $.each(data[i]['Data'], function (key, val) {
                if (xData.indexOf(key) == -1) {
                    xData.push(key);
                }
            });
        }
    }
    xData.sort();
    xData2.sort();
    for (var i in data) {
        var yData = [];
        var yData2 = [];
        if (data[i]['YearData']) {
            $.each(data[i]['YearData'], function (key, val) {
                yData.push([key, val]);
            });
            $.each(xData, function (key, val) {
                if (data[i]['YearData'][val] === undefined) {
                    yData.push([val, null]);
                }
            });
            $.each(data[i]['PeriodData'], function (key, val) {
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
        else {
            $.each(data[i]['Data'], function (key, val) {
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
function yLabelGenerator(formats, refline) {
    var yLabel = [];
    if (!refline) {
        var refline = [];
    }
    for (var i in formats) {
        var unit = formats[i];
        yLabel.push({
            labels: {
                //format: '{value}' + formats[i]
                formatter: function () {
                    return dataFormat(this.value);
                }
            },
            title: {
                text: formats[i],
                rotation: 0,
                style: {
                    fontWeight: 'normal'
                }
            },
            opposite: i % 2,
            plotLines: refline
        });
    }
    return yLabel;
}

/**X軸生產器 */
function xLabelGenerator(data) {
    var tmpXLabel = [];
    tmpXLabel.push({
        categories: data
    });
    return tmpXLabel;
}

/**基準線生產器 */
function refLineGenerator(data) {
    var tmp_refLine = [];
    $.each(data, function (key, val) {
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
function drawDisplay(canvas, display) {
    $("#" + canvas + "Label").empty();
    $.each(display, function (index, val) {
        $("#" + canvas + "Label").append('<td>' + val.ChineseAccount + '<br/><b><h4>' + val.Data + '</h4></b></td>');
    });
}

/**畫圖表 */
function drawChart(canvas, title, yLabel, series) {
    Highcharts.chart(canvas, {
        title: {
            text: title
        }, yAxis: yLabel,
        xAxis: {
            type: 'category',
            uniqueNames: true
        },
        series: series,
        tooltip: {
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + '<span style="color:' + point.color + '">\u25CF</span>' + '<b>' + point.series.name + ': ' +
                        point.y + point.series.yAxis.axisTitle.textStr + '</b>';
                }, '<b>' + this.points[0].key + '</b>');
            },
            borderWidth: 0,
            shared: true
        }
    });
}

/**用值找KEY */
function getKeyByValue(object, value) {
    var result = parseInt(Object.keys(object).find(key => object[key] === value));
    return result;
}

/**報表左側控制 按鈕 */
function drawTableChart(refLine, outer_ch, display, IdForCanvas, chart_data) {
    $(document).on('click', ".drawTableChart", function () {
        var key1 = $(this).parent('.ChartTableButtonParent').attr('value');
        var key2 = $(this).val();
        $(".ChartActive").removeClass("ChartActive");
        $(this).addClass('ChartActive');
        stockDateRangeB(IdForCanvas, dataType, chart_data);
        seriesGenerator(chart_data[key1][key2], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
    });
    $(document).on('click', ".OuterSideTable", function () {
        $(".OuterChartActive").removeClass("OuterChartActive");
        $(this).addClass('OuterChartActive');
        $(".in").collapse('toggle');
    });
}

/**上排 按鈕 */
function buttonEngine(refLine, outer_ch, display, IdForCanvas) {

    /**數量 按鈕 */
    $(document).on('click', ".buttonLastTen", function () {
        rangeEnd = '';
        rangeStart = '-10';
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        var tmp_canvas = $(this).attr('value');
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, -10);
        }
        else {
            seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, -10);
        }
    });
    $(document).on('click', ".buttonEntire", function () {
        rangeEnd = '';
        rangeStart = 'all';
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val()
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[IdForCanvas][key2][key1], dataType, refLine, outer_ch, display, IdForCanvas, 'all');
        }
        else {
            seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, 'all');
        }
    });
    $(document).on('click', ".buttonCustomize", function () {
        $(".RightButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        var tmp_canvas = $(this).attr('value');
        $("#customizeRange" + tmp_canvas).collapse('toggle');
    });
    $(".rangeStartSelect" + IdForCanvas).change(function () {
        rangeEnd = parseInt($(".rangeEndSelect" + IdForCanvas).find(":selected").val()) + 1;
        rangeStart = parseInt($(".rangeStartSelect" + IdForCanvas).find(":selected").val());
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            var tmpData = chart_data[IdForCanvas][key2][key1];
        }
        else {
            var tmpData = chart_data[IdForCanvas];
        }
        stockDateRange(IdForCanvas, dataType, 'refreshEnd', rangeStart);
        if (rangeEnd - rangeStart > 0) {
            seriesGenerator(tmpData, dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
        }
    });
    $(".rangeEndSelect" + IdForCanvas).change(function () {
        rangeEnd = parseInt($(".rangeEndSelect" + IdForCanvas).find(":selected").val()) + 1;
        rangeStart = parseInt($(".rangeStartSelect" + IdForCanvas).find(":selected").val());
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[IdForCanvas][key2][key1], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[IdForCanvas], dataType, refLine, outer_ch, display, IdForCanvas, rangeStart, rangeEnd);
        }
    });

    /**年度 季度 按鈕*/
    $(document).on('click', ".buttonQuater", function () {
        $(".LeftButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        dataType = 'PeriodData';
        var tmp_canvas = $(this).attr('value');
        stockDateRange(tmp_canvas, dataType);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
    });
    $(document).on('click', ".buttonYear", function () {
        $(".LeftButtonGroup").children(".ActiveChartControlButton").removeClass("ActiveChartControlButton");
        $(this).addClass('ActiveChartControlButton');
        dataType = 'YearData';
        var tmp_canvas = $(this).attr('value');
        stockDateRange(tmp_canvas, dataType);
        if ($(".ChartActive").val()) {
            var key1 = $(".ChartActive").val();
            var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
            seriesGenerator(chart_data[tmp_canvas][key2][key1], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
        else {
            seriesGenerator(chart_data[tmp_canvas], dataType, refLine, outer_ch, display, tmp_canvas, rangeStart, rangeEnd);
        }
    });
}

/**日期機制 按鈕*/
function stockDateRange(IdForCanvas, dataType, refreshEnd, startFrom) {
    var count = 0;
    if ($(".ChartActive").val()) {
        var key1 = $(".ChartActive").val();
        var key2 = $(".ChartActive").parent('.ChartTableButtonParent').attr('value');
        $.each(chart_data[IdForCanvas][key2][key1], function (key, val) {
            $.each(val[dataType], function (key2, val2) {
                if (!refreshEnd) {
                    if (count == 0) {
                        $(".rangeStartSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else {
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                else {
                    if (count == 0) {
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else if (count > startFrom) {
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                count++
            });
            return false;
        });
    }
    else {
        $.each(chart_data[IdForCanvas], function (key, val) {
            $.each(val[dataType], function (key2, val2) {
                if (!refreshEnd) {
                    if (count == 0) {
                        $(".rangeStartSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else {
                        $(".rangeStartSelect" + IdForCanvas).append('<option class="rangeStartOption" value="' + count + '">' + val2[0] + '</option>');
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                else {
                    if (count == 0) {
                        $(".rangeEndSelect" + IdForCanvas).empty();
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="-1" selected="selected" disabled>-</option>');
                    }
                    else if (count >= startFrom) {
                        $(".rangeEndSelect" + IdForCanvas).append('<option class="rangeEndOption" value="' + count + '">' + val2[0] + '</option>');
                    }
                }
                count++
            });
            return false;
        });
    }
}

function ClickedCanvasDataType(tmp_canvas) {
    if ($("#" + tmp_canvas + "container").children("div").children(".LeftButtonGroup").children(".ActiveChartControlButton").length > 0) {
        if ($("#" + tmp_canvas + "container").children("div").children(".LeftButtonGroup").children(".ActiveChartControlButton").hasClass("buttonYear")) {
            var dataType = 'YearData';
        }
        else {
            var dataType = 'PeriodData';
        }
    }
    else {
        var dataType = 'Data';
    }
    return dataType;
}

function SetCookie(name, value) {
    var Days = 2;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/";
    //document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";domain=" + '{{ env("APP_URL") }}' + ";path=/";
}

function getCookie(name) {
    var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if (arr != null) return unescape(arr[2]); return null;
}

function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

Highcharts.setOptions({
    colors: [
        '#ffa500',//1. orange
        '#4abf70',//2. green
        '#ef3474',//3. magenta
        '#73a2ff',//4. blue
        '#b5b5b5',//5. gray
        '#ded780',//6. lime
        '#a2cec1',//7. green
        '#e48274',//8. pink
        '#7e79bb',//9. purple
        '#e9e9e9',//10. light-gray
        '#e17441',//11. orange
        '#468086',//12. teal
        '#ef5350',//13. red
        '#1455c2',//14. blue
    ],
    chart: {
        style: {
            fontFamily: 'Microsoft JhengHei'
        }
    },
    plotOptions: {
        series: {
            fillOpacity: 0.06
        }
    },
    lang: {
        rangeSelectorZoom: ''
    },
    global: {
        useUTC: false//use local timezone instead
    },
    tooltip: {
        borderColor: '#545454'
    },
    exporting: {
        chartOptions: {
            width: 200,
            chart: {
                style: {
                    fontFamily: 'Arial',
                }
            }
        },
    },
    credits: {
        text: '資料來源: 優分析',
        href: 'https://www.uanalyze.com.tw',
        style: {
            'fontSize': '11px',
            'color': '#393939'
        }
    }
});

// <!-- html2canvas start -->
function convertById(id) {
    html2canvas(document.querySelector("#" + id), {
        canvas: document.querySelector("#myCanvas"),
        scale: 2,
    }).then(canvas => {
    });
}
var canvas = document.getElementById("myCanvas");
download_img = function (el) {
    var image = canvas.toDataURL("image/jpg");
    el.href = image;
}
$(document).on("click", ".downloadImg", function () {
    var clickedId = $(this).next().next().attr('id');
    convertById(clickedId);
});

$(document).on("click", ".print", function () {
    convertById('CanvasBaseMap');
});
// <!-- html2canvas end -->


// <!-- button to position -->

$('.rightbtnA').click(function () {
    if (window.screen.availHeight > 900) {
        var height = -200;
        $('html,body').animate({ scrollTop: $('#getInfo').offset().top + height }, 800);
    }
    else {
        var height = -150;
        $('html,body').animate({ scrollTop: $('#getInfo').offset().top + height }, 800);
    }
});
$('.rightbtnB').click(function () {
    if (window.screen.availHeight > 900) {
        var height = -200;
        $('html,body').animate({ scrollTop: $('#getNews').offset().top + height }, 800);
    }
    else {
        var height = -150;
        $('html,body').animate({ scrollTop: $('#getNews').offset().top + height }, 800);
    }
});
$('.rightbtnC').click(function () {
    if (window.screen.availHeight > 900) {
        var height = -200;
        $('html,body').animate({ scrollTop: $('#dailyChart').offset().top + height }, 800);
    }
    else {
        var height = -150;
        $('html,body').animate({ scrollTop: $('#dailyChart').offset().top + height }, 800);
    }
});
$('.rightbtnD').click(function () {
    if (window.screen.availHeight > 900) {
        var height = -200;
        $('html,body').animate({ scrollTop: $('#stockChart').offset().top + height }, 800);
    }
    else {
        var height = -150;
        $('html,body').animate({ scrollTop: $('#stockChart').offset().top + height }, 800);
    }
});

// <!-- button end -->