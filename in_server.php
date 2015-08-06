<?php 
	//
	session_start();
function begin()
{
	$count_err = 0;
	$username = '';
	$password = '';
	$name_show = '';
	if(isset($_SESSION['nkauj_hmo_no_pass']))
	{
		$count_err = $count_err + 1;
		$username = $_SESSION['nkauj_hmo_no_id'];
		$password = $_SESSION['nkauj_hmo_no_pass'];
	}
	if(isset($_COOKIE['nkauj_hmo_no_pass']))
	{
		$username = $_COOKIE['nkauj_hmo_no_id'];
		$password = $_COOKIE['nkauj_hmo_no_pass']; 
	}
	
	if($count_err == 0)
	{
		header('Location:index');
	}
	$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");

		//Check if it's valid
		if($checkconnection) 
		{
			$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
			$result = mysqli_query($con,"SELECT * 
						FROM  `user_sib_tham` 
						WHERE  `id_ust` =  '$username'
						AND  `password` =  '$password'");
			$row = mysqli_fetch_array($result);
			mysqli_close($con);
			if($username==$row['id_ust']&&$password==$row['password']&&$username!=""&&$password!="")
			{
				$name_show = $row['name_show'];
			}
			else
			{
				header('Location:http://www.nkaujhmono.com/');
			}
		}
		else
		{
			header('Location:http://www.nkaujhmono.com/');
		}
}
begin();
?>