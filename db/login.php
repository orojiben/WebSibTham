<?php
	include 'connect_db.php';
	$username = $_POST["input_username"];
	$password = $_POST["input_password"];
	$checked = $_POST["input_checked"];
	if (!filter_var($username, FILTER_VALIDATE_EMAIL)) 
	{
       echo ' ';
    }
	else
	{
		if(preg_match("/[^A-z0-9_\-!@#$%]/", "$password"))
		{
			echo ' ';
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
			$result = mysqli_query($con,"SELECT * 
				FROM  `user_r` 
				WHERE  `username` =  '$username'");
			
			if($row = mysqli_fetch_array($result))
			{
				echo "email";
				exit;
			}
			
			$password .= '00';
			$result = mysqli_query($con,"SELECT * 
				FROM  `user_nkauj_hmo_no` 
				WHERE  `username` =  '$username'
				AND  `password` =  '$password'");
			$row = mysqli_fetch_array($result);
			mysqli_close($con);
			session_start();

			if($username==$row['username']&&$password==$row['password']&&$username!=""&&$password!=""){
				//setcookie("username-au-si",$username,time()+(365*24*60*60));
				//$_COOKIE['username-au-si'] = $username;
				$id = $row['id_nhn'];
				if($checked==1)
				{
					//setcookie("nkauj_hmo_no_id",FALSE);
					//setcookie("nkauj_hmo_no_pass",FALSE);
					setcookie("nkauj_hmo_no_id",'',time()-(365*24*60*60),"/","nkaujhmono.com");
					setcookie("nkauj_hmo_no_pass",'',time()-(365*24*60*60),"/","nkaujhmono.com");
					setcookie("nkauj_hmo_no_id",$id,time()+(365*24*60*60),"/","nkaujhmono.com");

					$_COOKIE['nkauj_hmo_no_id'] = $id;
					setcookie("nkauj_hmo_no_pass",$password,time()+(365*24*60*60),"/","nkaujhmono.com");
					$_COOKIE['nkauj_hmo_no_pass'] = $password;
				}
				else
				{
					unset($_SESSION['nkauj_hmo_no_pass']);
					$_SESSION['nkauj_hmo_no_id'] = $id;
					$_SESSION['nkauj_hmo_no_pass'] = $password;
				}
				echo "yes";
				
			}else{
				echo " ";
			}

		}
		else
		{
			echo "not-err";
		}
	}
?>