<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThxController extends Controller
{
    public function form()
    {
        return view('thx/form');
    }
}
