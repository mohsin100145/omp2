<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SixToEightResultController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('six_to_eight_result.index');
    }
}
