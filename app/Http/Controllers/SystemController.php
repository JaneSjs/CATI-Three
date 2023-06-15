<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller class to handle system monitoring
 *  for the System Admin. This is especially things
 * like server environment, logs and things like that
 */
class SystemController extends Controller
{
    /**
     * Display some PHP Info.
     */
    public function info()
    {
        return view('system.info');
    }

}
