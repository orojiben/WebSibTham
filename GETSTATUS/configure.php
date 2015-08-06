<?php
#############################################################
############            CONFIGURATION            ############
#############################################################

####### If you get stuck, then please see README.txt ########

$SHOUTcastServer = "112.121.150.133"; // IP or hostname
$SHOUTcastPort = 8126;
$SHOUTcastVersion = 1; // 1 or 2
$SHOUTcastSID = 1; // Usually 1

$showHistory = 1; // 1 or 0
$tableClass = "table table-striped";

$SHOUTcastStatus['refused'] = "Connection Refused (Server Offline)"; // Server off
$SHOUTcastStatus['down'] = "We are off air, try again later"; // No source
$SHOUTcastStatus['up'] = "We are on air"; // Streaming

// Example of messages with HTML:
// $SHOUTcastStatus['down'] = "We are off air, <a href=\"schedule.html\">see our schedule for details</a>";
// $SHOUTcastStatus['up'] = "We are on air, <a href=\"http://{$SHOUTcastServer}:{$SHOUTcastPort}/listen.pls\">listen here</a>";

?>