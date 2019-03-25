<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

abstract class APIController extends Controller
{
    protected function jsonResponse($data){
    	return respons()->json($data);
    }
}
