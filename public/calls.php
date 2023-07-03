<?php
# ip address that asterisk is on.
$strHost = "197.232.51.194:28520"; 

# asterisk manager username and password
$strUser = "catiuser";
$strSecret = "fe624df33ce15d6b17c551de7f56cb97"; 

# specify the channel (extension) you want to receive the call requests with
# e.g. SIP/XXX, IAX2/XXXX, ZAP/XXXX, etc
$strChannel = $_REQUEST['exten'];
$strContext = "from-internal";



$number = strtolower($_REQUEST['number']);
$strCallerId = $number;

#specify the amount of time you want to try calling the specified channel before hangin up
$strWaitTime = "30";

#specify the priority you wish to place on making this call
$strPriority = "1";

# validation
$valNumber = '/^\d+$/';
$valExt = '/^(SIP|IAX2|ZAP)\/\d+$/';

echo $number;
echo $strChannel;


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

#echo "Extension $strChannel should be calling $number." ;

?>