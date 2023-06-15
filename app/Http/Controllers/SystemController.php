<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display some PHP Info.
     */
    public function info()
    {
        return view('system.info');
    }

    /**
     * Display Adminer
     */
    public function adminer()
    {
        return view('system.adminer');
    }
}
