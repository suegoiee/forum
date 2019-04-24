<?php

namespace App\Http\Controllers\Freebie;

use App\Http\Controllers\Controller;

class FreebieController extends Controller
{
    public function stocksummary()
    {
        $data = file_get_contents('https://cronjob.uanalyze.com.tw/fetch/CompanyInfo/1101');
        $data = json_decode($data, true);
        return view('freebie.stocksummary', compact('data'))->with('PageSubtitle', '個股摘要');
    }
    public function InstitutionalInvestorsNet()
    {
        return view('freebie.InstitutionalInvestorsNet')->with('PageSubtitle', '三大法人買賣超日報表');
    }
    public function HistoricalDividendRecord()
    {
        return view('freebie.HistoricalDividendRecord')->with('PageSubtitle', '歷年股息表');
    }
    public function MonthlyRevenue()
    {
        return view('freebie.MonthlyRevenue')->with('PageSubtitle', '月營收變化表');
    }
    public function MonthlyRevenueGrowthRate()
    {
        return view('freebie.MonthlyRevenueGrowthRate')->with('PageSubtitle', '月營收成長率');
    }
    public function ShortTermRevenueVSLongTermRevenue()
    {
        return view('freebie.ShortTermRevenueVSLongTermRevenue')->with('PageSubtitle', '長短期營收趨勢圖');
    }
    public function BoardHoldingsVSStockPrice()
    {
        return view('freebie.BoardHoldingsVSStockPrice')->with('PageSubtitle', '董監持股比率');
    }
    public function QFIIHoldingsVSStockPrice()
    {
        return view('freebie.QFIIHoldingsVSStockPrice')->with('PageSubtitle', '外資持股比例');
    }
    public function ShortInterestAsOfMarginPurchase()
    {
        return view('freebie.ShortInterestAsOfMarginPurchase')->with('PageSubtitle', '券資比');
    }
    public function MarginBalanceVSMarginUtilization()
    {
        return view('freebie.MarginBalanceVSMarginUtilization')->with('PageSubtitle', '融資餘額與融資使用率');
    }
    public function MarginPurchaseIncrease()
    {
        return view('freebie.MarginPurchaseIncrease')->with('PageSubtitle', '融資增減變化');
    }
    public function MonthlyRevenueVSStockPrice()
    {
        return view('freebie.MonthlyRevenueVSStockPrice')->with('PageSubtitle', '月營收與股價對照表');
    }
    public function CashDividendPayoutRatio()
    {
        return view('freebie.CashDividendPayoutRatio')->with('PageSubtitle', '股息配發率');
    }
    public function StockPriceVSYield()
    {
        return view('freebie.StockPriceVSYield')->with('PageSubtitle', '股價 VS 殖利率');
    }
    public function HistoricalPer()
    {
        return view('freebie.HistoricalPer')->with('PageSubtitle', '本益比走勢圖');
    }
    public function HistoricalPbr()
    {
        return view('freebie.HistoricalPbr')->with('PageSubtitle', '股價淨值比走勢圖');
    }
    public function ShortInterestIncrease()
    {
        return view('freebie.ShortInterestIncrease')->with('PageSubtitle', '融券增減變化');
    }
    public function ShortInterestVSShortSellUtilization()
    {
        return view('freebie.ShortInterestVSShortSellUtilization')->with('PageSubtitle', '融券餘額與融券使用率');
    }
    public function StatementOfFinancialPosition()
    {
        return view('freebie.StatementOfFinancialPosition')->with('PageSubtitle', '資產負債表');
    }
    public function IncomeStatement()
    {
        return view('freebie.IncomeStatement')->with('PageSubtitle', '損益表');
    }
    public function CashFlows()
    {
        return view('freebie.CashFlows')->with('PageSubtitle', '現金流量表');
    }
    public function StockNews()
    {
        return view('freebie.StockNews')->with('PageSubtitle', '個股新聞');
    }
    public function DailyStockPriceAreaChartWithDisplay()
    {
        return view('freebie.DailyStockPriceAreaChartWithDisplay')->with('PageSubtitle', '股價走勢');
    }
    public function StockPriceVSEPS()
    {
        return view('freebie.StockPriceVSEPS')->with('PageSubtitle', '每股盈餘VS股價');
    }
}
?>