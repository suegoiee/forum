<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

class Tools extends Controller
{
    public function stocksummary()
    {
        return view('freebie.stocksummary');
    }
}
?>