<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminGunController extends Controller
{
    public function Show()
    {
        return view('dash.gun-register');
    }
}
