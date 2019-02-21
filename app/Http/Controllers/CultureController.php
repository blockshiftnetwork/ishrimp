<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function daylyParameters()
    {
    	return view('spark::culture');
    }
}
