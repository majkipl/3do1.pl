<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function privacy()
    {
        return view('policy/privacy');
    }

    public function cookie()
    {
        return view('policy/cookie');
    }

    public function user()
    {
        return view('policy/user');
    }
}
