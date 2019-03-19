<?php

namespace App\Http\Controllers\Freebie;

use App\Http\Controllers\Controller;

class FreebieController extends Controller
{
    public function stocksummary()
    {
        return view('freebie.stocksummary');
    }
    public function InstitutionalInvestorsNet()
    {
        return view('freebie.InstitutionalInvestorsNet');
    }
    public function HistoricalDividendRecord()
    {
        return view('freebie.HistoricalDividendRecord');
    }
    public function MonthlyRevenue()
    {
        return view('freebie.MonthlyRevenue');
    }
    public function MonthlyRevenueGrowthRate()
    {
        return view('freebie.MonthlyRevenueGrowthRate');
    }
    public function ShortTermRevenueVSLongTermRevenue()
    {
        return view('freebie.ShortTermRevenueVSLongTermRevenue');
    }
    public function BoardHoldingsVSStockPrice()
    {
        return view('freebie.BoardHoldingsVSStockPrice');
    }
    public function QFIIHoldingsVSStockPrice()
    {
        return view('freebie.QFIIHoldingsVSStockPrice');
    }
    public function ShortInterestAsOfMarginPurchase()
    {
        return view('freebie.ShortInterestAsOfMarginPurchase');
    }
    public function MarginBalanceVSMarginUtilization()
    {
        return view('freebie.MarginBalanceVSMarginUtilization');
    }
    public function MarginPurchaseIncrease()
    {
        return view('freebie.MarginPurchaseIncrease');
    }
    public function MonthlyRevenueVSStockPrice()
    {
        return view('freebie.MonthlyRevenueVSStockPrice');
    }
    public function CashDividendPayoutRatio()
    {
        return view('freebie.CashDividendPayoutRatio');
    }
    public function StockPriceVSYield()
    {
        return view('freebie.StockPriceVSYield');
    }
    public function HistoricalPer()
    {
        return view('freebie.HistoricalPer');
    }
    public function HistoricalPbr()
    {
        return view('freebie.HistoricalPbr');
    }
    public function ShortInterestIncrease()
    {
        return view('freebie.ShortInterestIncrease');
    }
    public function ShortInterestVSShortSellUtilization()
    {
        return view('freebie.ShortInterestVSShortSellUtilization');
    }
    public function StatementOfFinancialPosition()
    {
        return view('freebie.StatementOfFinancialPosition');
    }
    public function IncomeStatement()
    {
        return view('freebie.IncomeStatement');
    }
    public function CashFlows()
    {
        return view('freebie.CashFlows');
    }
}
?>