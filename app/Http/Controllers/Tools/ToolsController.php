<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

class ToolsController extends Controller
{
    public function bargain()
    {
        return view('Tools.bargain');
    }
    public function buffett()
    {
        return view('Tools.buffett');
    }
    public function buyCheckForm()
    {
        return view('Tools.buyCheckForm');
    }
    public function Compound()
    {
        return view('Tools.Compound');
    }
    public function deposit()
    {
        return view('Tools.deposit');
    }
    public function estimate()
    {
        return view('Tools.estimate');
    }
    public function gordon()
    {
        return view('Tools.gordon');
    }
    public function interest()
    {
        return view('Tools.interest');
    }
    public function lowestRetire()
    {
        return view('Tools.lowestRetire');
    }
    public function money()
    {
        return view('Tools.money');
    }
    public function npv()
    {
        return view('Tools.npv');
    }
    public function proportion()
    {
        return view('Tools.proportion');
    }
    public function retire()
    {
        return view('Tools.retire');
    }
    public function PayBack()
    {
        return view('Tools.PayBack');
    }
    public function secondDCF()
    {
        return view('Tools.secondDCF');
    }
    public function DepositTest()
    {
        return view('Tools.DepositTest');
    }
    public function DepositInGroup()
    {
        return view('Tools.DepositInGroup');
    }
}
?>