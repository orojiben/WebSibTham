<?php
	if(isset($_POST["input_cook_name"]))
	{
		$username = $_POST["input_cook_name"];
		$password = $_POST["input_cook_pass"]; 
		//$count_err = $count_err + 1;
		
		$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");

		//Check if it's valid
		if($checkconnection) 
		{
			$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
			$con->set_charset("utf8");
			$result = mysqli_query($con,"SELECT * 
						FROM  `user_nkauj_hmo_no` 
						WHERE  `id_nhn` =  '$username'
						AND  `password` =  '$password'");
			$row = mysqli_fetch_array($result);
			mysqli_close($con);
			if($username==$row['id_nhn']&&$password==$row['password']&&$username!=""&&$password!="")
			{
				
				$xeem_show = $row['lastname_hmong'];
				$name_show = $row['name_show'];
				echo $xeem_show .','.$name_show.','.$row['score'];
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}
	else if(isset($_POST["input_id_user"]))
	{
		$input_id_user = $_POST["input_id_user"];
		$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");

		//Check if it's valid
		if($checkconnection) 
		{
			$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
			$con->set_charset("utf8");
			$result = mysqli_query($con,"SELECT * 
						FROM  `user_nkauj_hmo_no` 
						WHERE  `id_nhn` =  '$input_id_user'");
			$row = mysqli_fetch_array($result);
			mysqli_close($con);
			if($input_id_user==$row['id_nhn'])
			{
				
				$xeem_show = $row['lastname_hmong'];
				$name_show = $row['name_show'];
				echo $xeem_show .','.$name_show .','.$row['score'];
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}
	else
	{
		echo "0";
	}
?>