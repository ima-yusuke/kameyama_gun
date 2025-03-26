<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GunsController extends Controller
{
    public function show()
    {
        return view('guns.show');
    }
}
