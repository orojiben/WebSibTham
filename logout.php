<?php
	session_start();
	setcookie("nkauj_hmo_no_pass",$id,time()-(365*24*60*60),"/","nkaujhmono.com");
	//setcookie("nkauj_hmo_no_pass",FALSE);
	//setcookie("nkauj_hmo_no_id",FALSE);
	//setcookie("nkauj_hmo_no_pass",FALSE);
	//session_destroy();
	unset($_SESSION['nkauj_hmo_no_pass']); 
	header('Location:http://www.nkaujhmono.com/');
?>