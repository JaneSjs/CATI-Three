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
        //dd('Here');
        // Replace with your port if not using the default.
        // If unsure check /etc/asterisk/manager.conf under [general];
        $port = 5038;
        
        $username = "catiuser";
        $password = "fe624df33ce15d6b17c551de7f56cb97";
        // These are created under AMI Users in asterisk.


        // Pass this parameter as first exten for extension of the user to ring when a call is initiated
        $internalPhoneline = "203";

        // Context for outbound calls. See /etc/asterisk/extensions.conf if unsure.
        $context = "context";

        //$socket = stream_socket_client("tcp://127.0.0.1:$port");
        $socket = stream_socket_client("tcp://192.168.5.58:$port");
        //Use tcp:192.168.5.58:5038
        if($socket)
        {
            echo "Connected to socket, sending authentication request.\n";

            // Prepare authentication request
            $authenticationRequest = "Action: Login\r\n";
            $authenticationRequest .= "Username: $username\r\n";
            $authenticationRequest .= "Secret: $password\r\n";
            $authenticationRequest .= "Events: off\r\n\r\n";

            // Send authentication request
            $authenticate = stream_socket_sendto($socket, $authenticationRequest);
            if($authenticate > 0)
            {
                // Wait for server response
                usleep(200000);

                // Read server response
                $authenticateResponse = fread($socket, 4096);

                // Check if authentication was successful
                if(strpos($authenticateResponse, 'Success') !== false)
                {
                    echo "Authenticated to Asterisk Manager Inteface. Initiating call.\n";

                    // Prepare originate request
                    $originateRequest = "Action: Originate\r\n";
                    $originateRequest .= "Channel: SIP/$internalPhoneline\r\n";
                    $originateRequest .= "Callerid: Click 2 Call\r\n";
                    //$originateRequest .= "Exten: $target\r\n";
                    $originateRequest .= "Exten: 400\r\n";
                    $originateRequest .= "Context: $context\r\n";
                    $originateRequest .= "Priority: 1\r\n";
                    $originateRequest .= "Async: yes\r\n\r\n";

                    // Send originate request
                    $originate = stream_socket_sendto($socket, $originateRequest);
                    if($originate > 0)
                    {
                        // Wait for server response
                        usleep(200000);

                        // Read server response
                        $originateResponse = fread($socket, 4096);

                        // Check if originate was successful
                        if(strpos($originateResponse, 'Success') !== false)
                        {
                            echo "Call initiated, dialing.";
                        } else {
                            echo "Could not initiate call.\n";
                        }
                    } else {
                        echo "Could not write call initiation request to socket.\n";
                    }
                } else {
                    echo "Could not authenticate to Asterisk Manager Interface.\n";
                }
            } else {
                echo "Could not write authentication request to socket.\n";
            }
        } else {
                echo "Unable to connect to socket.";
        }
    }
}
