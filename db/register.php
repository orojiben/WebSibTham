<?php
	include 'connect_db.php';
	session_start();
	setcookie("nkauj_hmo_no_id",FALSE);
	setcookie("nkauj_hmo_no_pass",FALSE);
	session_destroy();
	session_start();
	$username = $_POST["input_username"];
	$password = $_POST["input_password"];
	$seem = $_POST["input_seem"];
	$sex = $_POST["input_sex"];
	if (!filter_var($username, FILTER_VALIDATE_EMAIL)) 
	{
       echo 'not-mail';
    }
	else
	{
		if(preg_match("/[^A-z0-9_\-!@#$%]/", "$password"))
		{
			echo 'not-pass';
			return;
		}
		/*$string_password = "";
		foreach (str_split($password) as $chr) {
			$buff = "";
			if(ord($chr)%2==0){
				$buff = ord($chr)*2+1;
			}else{
				$buff = ord($chr)*3-1;
			}
		//$hex_ary[] = strlen($buff) . "$buff";
			$string_password  .= strlen($buff) . "$buff";
		}*/
		if($con!='')
		{
			$name_show = "เด็กม้ง";
			$password .= '00';
			$result = mysqli_query($con,"INSERT INTO  user_nkauj_hmo_no".
			"(`id_nhn`, `username`, `password`, `sex`, `name_show`, `lastname_hmong`)".
			"VALUES (' ','$username','$password','$sex','$name_show','$seem')");
			
			if(!$result){
				echo "not-user";
			}else{
				echo "yes";
				$result = mysqli_query($con,"SELECT * 
				FROM  `user_nkauj_hmo_no` 
				WHERE  `username` =  '$username'
				AND  `password` =  '$password'");
				$row = mysqli_fetch_array($result);
				
				$_SESSION['nkauj_hmo_no_id'] = $row['id_nhn'];
				$_SESSION['nkauj_hmo_no_pass'] = $password;
			}
			mysqli_close($con);
		}
		else
		{
			echo "not-err";
		}
	}
?>