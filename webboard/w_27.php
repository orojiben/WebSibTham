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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="th" lang="th">

	<head>
		<title>นิทาน เต่ากับปลา หญ้าและอัศวิน ณ หนองน้ำแห่งชีวิต</title>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="http://www.nkaujhmono.com/images/icon_main.png">
		<link rel="image_src" href="http://www.nkaujhmono.com/images/h_full.png">
		<meta name="description" content="<b>กาลครั้งหนึ่งนานมาแล้ว</b>.. มีเต่าตัวหนึ่งอาศัยร่วมกับปลาตัวหนึ่งในหนองน้ำแห่งหนึ่งอย่างมีความสุ" />
		<meta name="keywords" content="กระทู้ม้ง,webboard hmong"/>
		
		<meta property="fb:app_id"          content="374184436039948" /> 
		<meta property="og:type"            content="article" /> 
		<meta property="og:url"             content="http://www.nkaujhmono.com/webboard/webboard_27" /> 
		<meta property="og:title"           content="นิทาน เต่ากับปลา หญ้าและอัศวิน ณ หนองน้ำแห่งชีวิต" /> 
		<meta property="og:image"           content="http://www.nkaujhmono.com/images/h_full.png" /> 
		<meta property="og:description"    content="<b>กาลครั้งหนึ่งนานมาแล้ว</b>.. มีเต่าตัวหนึ่งอาศัยร่วมกับปลาตัวหนึ่งในหนองน้ำแห่งหนึ่งอย่างมีความสุ" />
		
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
	<div class ='header'>
				<a class ="icon" href="http://www.nkaujhmono.com/"  >
					<img class="icon" alt="" src="../images/icon_w_long.png" height="35" width="140" />
				</a>
				
				<a class ="header_home" href="http://www.nkaujhmono.com/home"  title="home">home
				</a>
				
				<a class ="c_web" href="http://www.nkaujhmono.com/write_webboard.php?v=0&t=ww" >
					<img class="icon" alt="" src="../images/create_w.png" height="30" width="120" />
				</a>
				
	</div>
	<img class="up" alt="" src="../images/up.png" height="35" width="35" title="ขึ้นบนสุด" onmouseup="up_header()"/>
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
			$.ajax({
				type: "POST",
					url: "http://www.nkaujhmono.com/db/count_view.php",
					dataType: "text", 
					data: {id_w: webboard_id},
					success: function (data) {

					},
					error: function()
					{
						alert("An error occoured!");
					}
			});
			function up_header()
			{
				document.documentElement.scrollTop = 0;
				document.body.scrollTop = 0;
				
			}
	</script>

</body>
</html>