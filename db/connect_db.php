<?php
	$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");
    $con = '';
	if($checkconnection) 
	{
		$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
		$con->set_charset("utf8");
	}
	date_default_timezone_set('Asia/Bangkok');
?>