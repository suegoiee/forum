<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

class ToolsController extends Controller
{
    public function bargain()
    {
        return view('tools.bargain');
    }
    public function buffett()
    {
        return view('tools.buffett');
    }
    public function buyCheckForm()
    {
        return view('tools.buyCheckForm');
    }
    public function Compound()
    {
        return view('tools.Compound');
    }
    public function deposit()
    {
        return view('tools.deposit');
    }
    public function estimate()
    {
        return view('tools.estimate');
    }
    public function gordon()
    {
        return view('tools.gordon');
    }
    public function interest()
    {
        return view('tools.interest');
    }
    public function lowestRetire()
    {
        return view('tools.lowestRetire');
    }
    public function money()
    {
        return view('tools.money');
    }
    public function npv()
    {
        return view('tools.npv');
    }
    public function proportion()
    {
        return view('tools.proportion');
    }
    public function retire()
    {
        return view('tools.retire');
    }
    public function PayBack()
    {
        return view('tools.PayBack');
    }
    public function secondDCF()
    {
        return view('tools.secondDCF');
    }
    public function DepositTest()
    {
        return view('tools.DepositTest');
    }
    public function DepositInGroup()
    {
        return view('tools.DepositInGroup');
    }
}
?>