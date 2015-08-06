<?php
/*

    MixStream All-In-One StreamStats 1.1 - Display SHOUTast stats on any website
    Copyright (C) 2013  Bell Online Ltd

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/



#############################################################
########### No need to edit anything in this file ###########
#############################################################


include ('./configure.php');
if ($SHOUTcastVersion == 2) {
	$SHOUTcastSID = "?sid=".$SHOUTcastSID;
} else {
	unset($SHOUTcastSID);
	$SHOUTcastSID = '';
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://".$SHOUTcastServer.":".$SHOUTcastPort."/index.html".$SHOUTcastSID);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
$SHOUTcastData = curl_exec($ch);
curl_close($ch);
if (!$SHOUTcastData) {
	$SHOUTcastStatus['refused'] = utf8_encode(str_replace('"', '\"', $SHOUTcastStatus['refused']));
	
	$SHOUTcastServerIP = gethostbyname($SHOUTcastServer);
	echo 'orojiben,';
	exit;
}
if ($SHOUTcastVersion == 2) {
	preg_match_all('/<font class="default"><b>(.*?)<\/b>/si', $SHOUTcastData, $matches);
} else {
	preg_match_all('/<font class=default><b>(.*?)<\/b>/si', $SHOUTcastData, $matches);
}
$i = 1;
$last = count($matches[1]);
foreach ($matches[1] as $val) {
	$val = str_replace('"', '\"', $val);
	 if ($i == 2) {
		preg_match_all('!\d+!', $val, $streamStatusMatches);		
		echo $streamStatusMatches[0][1].',';
	}else if ($i == 5) {
		echo $val.',';
	} else if ($i == $last) {
		$valBuff = explode('-', $val);
					echo $val.',';
	}
	$i++;
}
if ($showHistory == 1) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://".$SHOUTcastServer.":".$SHOUTcastPort."/played.html".$SHOUTcastSID);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	$SHOUTcastData = curl_exec($ch);
	curl_close($ch);
	if ($SHOUTcastData) {

		$match = preg_match_all('/<\/td><td>(.*?)<\/tr><tr>/si', $SHOUTcastData, $matches);
		$i = 1;
		$j = 1;
		foreach ($matches[1] as $val) {
			if($j == 5)
			{
				break;
			}
			if ($val != "") {
				if ($i == 3) {
					$show = 1;	
				}
				if ($show) {
					if (strpos($val,'</table>') !== false) {
						break;
					}
					$valBuff = explode('-', $val);
					echo $val.',';
					$j++;
				}
				$i++;
			}
		}
		
	}
}
?>