<?php
	
	include 'db/connect_db.php';
	$go_to = '';
	if (isset($_GET["x"]))
	{
		$user = $_GET["user"];
		$x = $_GET["x"];
	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT * FROM user_r u WHERE  `username` ='$user' 
			and `pass` ='$x'");
			
			$count_all = 0;
			if($row = mysqli_fetch_array($result))
			{
				
				if($row['pass']==$x)
				{
					$result = mysqli_query($con,"SELECT * 
						FROM  `user_nkauj_hmo_no` 
						WHERE  `username` =  '$user'");
					$row = mysqli_fetch_array($result);
					
					session_start();
				
					if($user==$row['username']){
						//setcookie("username-au-si",$username,time()+(365*24*60*60));
						//$_COOKIE['username-au-si'] = $username;

							unset($_SESSION['nkauj_hmo_no_pass']);
							$_SESSION['nkauj_hmo_no_id'] = $row['id_nhn'];
							$_SESSION['nkauj_hmo_no_pass'] = $row['password'];
							$go_to = "yes";
							$result = mysqli_query($con,"DELETE FROM `user_r` WHERE  `username` =  '$user'");
					}
					mysqli_close($con);
						
				}
			}

			mysqli_close($con);

		}
    }
	//echo '-*-';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Nkauj Hmo No Ok</title>
		<link rel="shortcut icon" href="images/icon_main.png">
		<meta name="description" content="" />
		<meta name="keywords" content="กระทู้ม้ง,webboard hmong"/>
		<link rel="stylesheet" href="styles/style_for_webboard.css" />
	</head>
<body>
	<?php include_once("analyticstracking.php") ?>
		<script>
			
			location.replace("http://www.nkaujhmono.com/");
			
		</script>

</body>
</html>
