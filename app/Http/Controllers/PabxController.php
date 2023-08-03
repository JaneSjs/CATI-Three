<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePabxRequest;
use App\Http\Requests\UpdatePabxRequest;
use App\Models\Pabx;
use Illuminate\Http\Request;

class PabxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePabxRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pabx $pabx)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pabx $pabx)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePabxRequest $request, Pabx $pabx)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pabx $pabx)
    {
        //
    }

    /**
     * Initiate Call
     */
    function call(Request $request)
    {
        //dd($request);
        # ip address that asterisk is on.
        $strHost = env('PABX_HOST');

        # asterisk manager username and password
        $strUser = env('PABX_USER');
        $strSecret = env('PABX_PASSWORD'); 

        # specify the channel (extension) you want to receive the call requests with
        # e.g. SIP/XXX, IAX2/XXXX, ZAP/XXXX, etc
        $strChannel = $request->input('exten');
        $strContext = "from-internal";

        $number = strtolower($request->input('respondent_number'));
        $strCallerId = $number;

        #specify the amount of time you want to try calling the specified channel before hangin up
        $strWaitTime = "30";

        #specify the priority you wish to place on making this call
        $strPriority = "1";

        # validation
        $valNumber = '/^\d+$/';
        $valExt = '/^(SIP|IAX2|ZAP)\/\d+$/';

        if (!preg_match($valNumber, $number)) {
            print "The number is incorrect, should match '$valNumber' pattern\n";
            exit();
        }
        if (!preg_match($valExt, $strChannel)) {
            print "The extension is incorrect, should match '$valExt' pattern\n";
            exit;
        }

        $errno=0 ;
        $errstr=0 ;
        $oSocket = fsockopen ($strHost, 5038, $errno, $errstr, 20);

        if (!$oSocket) {
            echo "$errstr ($errno)<br>\n";
            exit();
        }

        fputs($oSocket, "Action: login\r\n");
        fputs($oSocket, "Events: off\r\n");
        fputs($oSocket, "Username: $strUser\r\n");
        fputs($oSocket, "Secret: $strSecret\r\n\r\n");
        fputs($oSocket, "Action: originate\r\n");
        fputs($oSocket, "Channel: $strChannel\r\n");
        fputs($oSocket, "WaitTime: $strWaitTime\r\n");
        fputs($oSocket, "CallerId: $strCallerId\r\n");
        fputs($oSocket, "Exten: $number\r\n");
        fputs($oSocket, "Context: $strContext\r\n");
        fputs($oSocket, "Priority: $strPriority\r\n\r\n");
        fputs($oSocket, "Action: Logoff\r\n\r\n");
        sleep(2);
        fclose($oSocket);

        echo "Extension $strChannel should be calling $number." ;   
    }
}
