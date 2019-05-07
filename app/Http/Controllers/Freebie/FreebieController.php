<?php

namespace App\Http\Controllers\Freebie;

use App\Http\Controllers\Controller;

class FreebieController extends Controller
{
    public function stocksummary()
    {
        $stockCode = request()->route('StockCode');
        $data = array();
        $CompanyInfo = file_get_contents(env('CronAPI').'CompanyInfo/'.$stockCode);
        $News = file_get_contents(env('CronAPI').'News/'.$stockCode);
        $DailyStockPriceAreaChartWithDisplay = file_get_contents(env('CronAPI').'DailyStockPriceAreaChartWithDisplay/'.$stockCode);
        $StockPriceVSEPS = file_get_contents(env('CronAPI').'StockPriceVSEPS/'.$stockCode);
        $CompanyInfo = json_decode($CompanyInfo, true);
        $News = json_decode($News, true);
        $DailyStockPriceAreaChartWithDisplay = json_decode($DailyStockPriceAreaChartWithDisplay, true);
        $url = env('CronAPI').'DailyStockPriceAreaChartWithDisplay/'.$stockCode;
        $url2 = env('CronAPI').'StockPriceVSEPS/'.$stockCode;
        //$DailyStockPriceAreaChartWithDisplay = $this->seriesGenerator($DailyStockPriceAreaChartWithDisplay, -10);
        $StockPriceVSEPS = json_decode($StockPriceVSEPS, true);
        return view('freebie.stocksummary', compact('CompanyInfo', 'News', 'DailyStockPriceAreaChartWithDisplay', 'StockPriceVSEPS', 'url', 'url2'))->with('PageSubtitle', '個股摘要');
    }
    public function Chart()
    {
        $stockCode = request()->route('StockCode');
        $InfoType = request()->route('InfoType');
        $url = env('CronAPI').$InfoType.'/'.$stockCode;
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $stock_name = $data['data']['stock_name'];
        $stock_code = $data['data']['stock_code'];
        return view('freebie.Chart', compact('data', 'stock_name', 'stock_code', 'url'))->with('PageSubtitle', '圖表');
    }
    public function Table()
    {
        $stockCode = request()->route('StockCode');
        $InfoType = request()->route('InfoType');
        $data = file_get_contents(env('CronAPI').$InfoType.'/'.$stockCode);
        $data = json_decode($data, true);
        $stock_name = $data['data']['stock_name'];
        $stock_code = $data['data']['stock_code'];
        $data = $this->seriesGenerator($data, null);
        return view('freebie.Table', compact('data', 'stock_name', 'stock_code', 'url'))->with('PageSubtitle', '表格');
    }
    public function Report()
    {
        $stockCode = request()->route('StockCode');
        $InfoType = request()->route('InfoType');
        $url = env('CronAPI').$InfoType.'/'.$stockCode;
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $stock_name = $data['data']['stock_name'];
        $stock_code = $data['data']['stock_code'];
        return view('freebie.Report', compact('data', 'stock_name', 'stock_code', 'url'))->with('PageSubtitle', '報表');
    }
    function refLineGenerator($data) {
        $tmp_refLine = array();
        foreach($data as $key => $value){
            $tmp_array = array(
                "value" => $value['Data'],
                "color" => 'green',
                "dashStyle" => $value['Style'],
                "width" => 2,
                "label" => array(
                    "text" => $value['ChineseAccount']
                ));
            array_push($tmp_refLine, $tmp_array);
        };
        return $tmp_refLine;
    }

    function seriesGenerator($data, $sliceHead) {
        $result = array();
        $chart_data = array();
        $display = array();
        $SideTable = array();
        /**純圖表 */
        if ($data['data']['type'] == 'chart') {
            $TmpData = $data['data']['data'];
            foreach($TmpData as $key => $value){
                array_push($chart_data, $value);
            }
            if (array_key_exists('YearData', $chart_data[0])) {
                $dataType = 'YearData';
                $PYButton = true;
            }
            else{
                $dataType = 'Data';
            }
            $chart_data = $this->DataStandardization($chart_data);
        }
        else if ($data['data']['type'] == 'sorting_table') {
            $chart_data = $this->TableData($data['data']);
            return $chart_data;
        }
        else if ($data['data']['type'] == 'table_chart') {
            $SideTable = $data;
        }
        $refLine = $data['data']['refline'] ?? '';
        if ($refLine != '') {
            $refLine = $this->refLineGenerator($refLine);
        }
        $display = $data['data']['display'] ?? '';
        $seriestData = array();
        //$xData = array();
        $unit = array();
        $yAxisLocate = array();
        $unitForBottomTable = array();
        foreach ($chart_data as $key => $value) {
            if (array_search($value['UnitRef'], $unit)) {
                array_push($yAxisLocate, array_search($value['UnitRef'], $unit));
            }
            else {
                array_push($unit, $value['UnitRef']);
                array_push($yAxisLocate, intval($key));
            }
            array_push($unitForBottomTable, $value['UnitRef']);
        }
        foreach ($chart_data as $i => $value) {
            $tmpData = $value[$dataType];
            if ($sliceHead == -10) {
                $tmpData = array_slice($value[$dataType], -10);
            }
            /*else if ($sliceEnd) {
                $tmpData = array_slice($value[$dataType], $sliceHea);
            }*/
            $tmp_array = array(
                "type" => $value['Style'],
                "name" => $value['ChineseAccount'],
                "data" => $tmpData,
                "yAxis" => $yAxisLocate[$i],
                "label" => array(
                    "enabled" => false
                ));
            array_push($seriestData, $tmp_array);
        }
        $yLabel = $this->yLabelGenerator($unit, $refLine);
        array_push($result, $seriestData);
        array_push($result, $yLabel);
        array_push($result, $display);
        array_push($result, $SideTable);
        return $result;
        /*drawChart(IdForCanvas, title, yLabel, seriestData);
        drawTableChartBottomTable(IdForCanvas, seriestData, unitForBottomTable);
        drawDisplay(IdForCanvas, display);*/
    }
    /**資料一致化 */
    function DataStandardization($data) {
        $xData = array();
        $xData2 = array();
        foreach ($data as $key => $value) {
            $YearData = $value['YearData'] ?? false;
            $PeriodData = $value['PeriodData'] ?? false;
            if($YearData){
                foreach($YearData as $key => $val) {
                    if (!array_search($key, $xData)) {
                        array_push($xData, $key);
                    }
                };
                foreach($PeriodData as $key => $val) {
                    if (!array_search($key, $xData2)) {
                        array_push($xData2, $key);
                    }
                }
            }
            else{
                foreach($value['Data'] as $key => $val) {
                    if (!array_search($key, $xData)) {
                        array_push($xData, $key);
                    }
                }
            }
        }
        sort($xData);
        sort($xData2);
        foreach ($data as $key => $value) {
            $yData = array();
            $yData2 = array();
            $YearData = $value['YearData'] ?? false;
            $PeriodData = $value['PeriodData'] ?? false;
            if($YearData){
                foreach($YearData as $key2 => $val2){
                    array_push($yData, array("$key2", $val2));
                }
                foreach($xData as $key3 => $val3) {
                    if (!array_key_exists($val3, $YearData)) {
                        array_push($yData, array("$val3", null));
                    }
                }
                foreach($PeriodData as $key4 => $val4){
                    array_push($yData2, array("$key4", $val4));
                }
                foreach($xData2 as $key5 => $val5) {
                    if (!array_key_exists($val5, $PeriodData)) {
                        array_push($yData2, array("$val5", null));
                    }
                }
                sort($yData);
                sort($yData2);
                $data[$key]['YearData'] = $yData;
                $data[$key]['PeriodData'] = $yData2;
            }
            else {
                foreach($value['Data'] as $key2 => $val2){
                    array_push($yData, array("$key2", $val2));
                }
                foreach($xData as $key3 => $val3) {
                    if (!array_key_exists($val3, $value['Data'])) {
                        array_push($yData, array("$val3", null));
                    }
                }
                sort($yData);
                $data[$key]['Data'] = $yData;
            }
        }
        return $data;
    }

    function dataFormat($toFormat) {
        $toFormat = (string)$toFormat;
        return str_replace('/\B(?=(\d{3})+(?!\d))/g', ",", $toFormat);
    }
    
    function yLabelGenerator($formats, $refline) {
        $yLabel = array();
        foreach ($formats as $key => $value) {
            array_push($yLabel, array(
                "title" => array(
                    "text" => $value
                ),
                "opposite" => $key % 2,
                "plotLines" => $refline
            ));
        }
        return $yLabel;
    }
    
    function TableData($data) {
        $TableData = array();
        $TableTitle = array();
        $compare = array();
        foreach ($data['column_title'] as $key => $value) {
            foreach($value as $key2 => $value2) {
                array_push($compare, $key2);
                array_push($TableTitle, (object)array('title'=>$value2, 'sTitle'=>$value2));
            }
        }
        foreach ($data['data'] as $key => $value) {
            $tmp = array();
            foreach ($compare as $key2 => $value2) {
                /*if ($value[$value2] != null || $value[$value2] != 'undefined' || $value[$value2]) {
                    if ($value2 != 'row_title_center') {
                        array_push($tmp, $this->dataFormat($value[$value2]));
                    }
                    else {*/
                        array_push($tmp, $value[$value2]);
                /*    }
                }
                else if(!array_key_exists($value2, $value)) {
                    array_push($tmp, null);
                }*/
            }
            array_push($TableData, $tmp);
        }
        $compare = array($TableTitle, $TableData);
        return $compare;
    }

    function FindChild($data){
        $tmp = array();
        if(array_key_exists('Child', $data)){
            $tmp = $data['Child'];
            foreach($tmp as $key => $value2){
                $tmp[$key] = array();
            }
            $tmp = $this->FindChild($tmp);
        }
        else{
            foreach($data as $key => $value){
                array_push();
                $tmp[$key] = $key;
            }
        }
        return $tmp;
            /*else{
                if(array_key_exists('Combo', $value)){
                    foreach($value2['Combo'] as $key3 => $value3){
                        //$SideTable[$key][$key2] = $value3;
                        array_push($SideTable[$key][$key2], $value3);
                        //$value3 = $this->DataStandardization($value3);
                        //array_push($SideTable[$key], $value3);
                    }
                }
                else{
                    $SideTable[$key][$key2] = $value2;
                }
            }*/
    }

    function ReportData($data){
        return $data;
    }
}
?>