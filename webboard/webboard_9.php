<?php
	session_start();
	$count_err = 0;
	$username = "";
	$password = "";
	$name_show = "";
	$xeem_show = "";
	$xeem_score = 0;
	$block = 0;

	
	if(isset($_SESSION["nkauj_hmo_no_pass"]))
	{
		$count_err = $count_err + 1;
		$username = $_SESSION["nkauj_hmo_no_id"];
		$password = $_SESSION["nkauj_hmo_no_pass"];
	}

	$checkconnection = @mysql_connect("localhost", "admin_nkuajhmono", "PW8lkmLlp5@&");

	
	if($count_err > 0)
	{

		//Check if it"s valid
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
			if($username==$row["id_nhn"]&&$password==$row["password"]&&$username!=""&&$password!="")
			{
				$name_show = $row["name_show"];
				$xeem_show = $row["lastname_hmong"];
				$xeem_score = $row["score"];
			}
			else
			{
				header("Location:http://www.nkaujhmono.com/");
			}
		}
		else
		{
			//header("Location:http://www.nkaujhmono.com/");
		}
	}
	else
	{
		$block = 1;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>8dddddfsdf sd   g ge grr </title>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../images/icon_main.png">
		<meta name="description" content="8dddddfsdf sd   g ge grr 8dddddfsdf sd   g ge grr " />
		<meta name="keywords" content="กระทู้ม้ง,webboard hmong"/>
		<link rel="stylesheet" href="../styles/style_for_webboard.css" />

	<script type="text/javascript" src="../fancy/lib/jquery-1.10.1.min.js"></script>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../fancy/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="../fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
		
		<!--<script src="script/jquery.js"></script>-->
		<script src="../script/webboard.js"></script>
		<script src="../script/in_webboard_permission.js"></script>
	</head>
<body>
	
	<div class ="main" id="error" style="display:none">
		ไม่มีหน้าอยู่แล้ว
	</div>

	<div class ="main" id="main" style="display:none">	
		
		<div id="view_text_post" class ="view_text_post" >
				
		</div>
		<br/>
	</div>
	<?php
			echo '<script> var username ="'.$username.
			'";var name_show ="'.$name_show.'";var xeem_show ="'.$xeem_show.
			'";var xeem_score ="'.$xeem_score.
			'"; </script>';
		?>
		<script>

			var cook_name = "nkauj_hmo_no_id";
			var cook_pass = "nkauj_hmo_no_pass";
			var id_user;
			var date_event_reply = "";
			var webboard_id = parseInt(document.URL.split("_")[1]);
			if(webboard_id<1)
			{
				window.location.href = "http://www.nkaujhmono.com/webboard/webboard_1";
			}

			function setCookie() {
				var d = new Date();
				d.setTime(d.getTime() + (1*24*60*60*100000));
				
				var expires = "expires="+d.toUTCString();
				document.cookie = cookOfName + "=" + valueOfName + "; " + expires;
				document.cookie = cookOfPass + "=" + valueOfPass + "; " + expires;
			}


			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(";");
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==" ") c = c.substring(1);
					if (c.indexOf(name) != -1) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}
			
			
			
			check_in_webboard_permission2();
			
			load_webboard_first();
	</script>

</body>
</html>