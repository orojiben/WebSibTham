<?php
	session_start();
	$count_err = 0;
	$username = '';
	$password = '';
	$name_show = '';
	$xeem_show = '';
	$xeem_score = 0;
	$block = 0;
	$webboard_id = 1;

	if(isset($_GET['w']))
	{
		$webboard_id = $_GET['w'];
	}
	
	
	if(isset($_SESSION['nkauj_hmo_no_pass']))
	{
		$count_err = $count_err + 1;
		$username = $_SESSION['nkauj_hmo_no_id'];
		$password = $_SESSION['nkauj_hmo_no_pass'];
	}

	$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");

	
	if($count_err > 0)
	{

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
				$name_show = $row['name_show'];
				$xeem_show = $row['lastname_hmong'];
				$xeem_score = $row['score'];
			}
			else
			{
				header('Location:http://www.nkaujhmono.com/');
			}
		}
		else
		{
			//header('Location:http://www.nkaujhmono.com/');
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
		<title></title>
		<link rel="shortcut icon" href="images/icon_main.png">
		<meta name="description" content="" />
		<meta name="keywords" content="กระทู้ม้ง,webboard hmong"/>
		<link rel="stylesheet" href="styles/style_for_webboard.css" />

	<script type="text/javascript" src="fancy/lib/jquery-1.10.1.min.js"></script>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancy/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="fancy/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
		
		<!--<script src="script/jquery.js"></script>-->
		<script src="script/webboard.js"></script>
		<script src="script/in_webboard_permission.js"></script>
	</head>
<body>
	<div class ='header'>
				<img class="icon" alt="" src="images/icon_w.png" height="35" width="35" />
				<div class ='header_home'  id ='header_home' onmouseup="header_home()" title='home'>
					home
				</div>
				
		</div>
	<div class ="main" id="error" style="display:none">
		ไม่มีหน้าอยู่แล้ว
	</div>

	<div class ="main" id="main" style="display:none">	
		
		<div id="view_text_post" class ="view_text_post" >
				
		</div>
		<br/>
		<!--<div id="sub_1" class ="sub_main1">
			<div id="sub_view_details_1" class ="txt_sub_detail">
				<img class="profile_img" id="profile_img" alt="" src="img_user/1.jpg" height="50" width="50" />
				<div class='sub_txt_head' >
					<span class="name_id">id</span><span class="name">ชื่อ</span>
					<span class="score_nickname">คะแนน</span><span class="nickname">ฉายา</span><span class="time_post">โพสเมื่อ</span>
				</div> 
				</br>
				</br>
				<div class='txt' >dfffffff ffffff  fffff ff ffffff f fffff wwwww wfff ff wqfqwf ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf</div>
				<span id="score_like_1"  class="score_like"><img class="like_img" id="like_img" alt="" src="img_user/1.jpg" height="25" width="25" />99990</span>
				<img class="reply_img" id="reply_img" alt="" src="images/reply.png" height="25" width="25" onmouseup="eventImageEdit();" />
				<img class="inf_img" id="inf_img" alt="" src="images/inf.png" height="25" width="25" />
				<img class="delete_img" id="delete_img" alt="" src="images/delete.png" height="25" width="25" />
				<img class="delete_img" id="edit_img" alt="" src="images/edit.png" height="25" width="25" />
				
				
			</div>
			<br/>
			<div id="sub_sub_view_details_1_1" class ="txt_sub_sub_detail">
				<img class="profile_img" id="profile_imgb" alt="" src="img_user/1.jpg" height="50" width="50" />
				<div class='sub_sub_txt_head' >
					<span class="name_id">id</span><span class="name">ชื่อ</span>
					<span class="score_nickname">คะแนน</span><span class="nickname">ฉายา</span>
				</div> 
				</br>
				</br>
				<div class='txt' >dfffffff ffffff  fffff ff ffffff f fffff wwwww wfff ff wqfqwf ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf</div>
				<img class="like_img" id="like_imgb" alt="" src="img_user/1.jpg" height="25" width="25" />
			</div>
		</div>
		<br/>
		<div id="sub_2" class ="sub_main1">
			<div id="sub_view_details_2" class ="txt_sub_detail">
				<img class="profile_img" id="profile_img" alt="" src="img_user/1.jpg" height="50" width="50" />
				<div class='sub_txt_head' >
					<span class="name_id">id</span><span class="name">ชื่อ</span>
					<span class="score_nickname">คะแนน</span><span class="nickname">ฉายา</span>
				</div> 
				</br>
				</br>
				<div class='txt' >dfffffff ffffff  fffff ff ffffff f fffff wwwww wfff ff wqfqwf ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf</div>
				<img class="like_img" id="like_img" alt="" src="img_user/1.jpg" height="25" width="25" />
			</div>
			<br/>
			<div id="sub_sub_view_details_2_1" class ="txt_sub_sub_detail">
				<img class="profile_img" id="profile_imgb" alt="" src="img_user/1.jpg" height="50" width="50" />
				<div class='sub_sub_txt_head' >
					<span class="name_id">id</span><span class="name">ชื่อ</span>
					<span class="score_nickname">คะแนน</span><span class="nickname">ฉายา</span>
				</div> 
				</br>
				</br>
				<div class='txt' >dfffffff ffffff  fffff ff ffffff f fffff wwwww wfff ff wqfqwf ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf
				ff ffffff f fffff wwwww wfff ff wqfqwf</div>
				<img class="like_img" id="like_imgb" alt="" src="img_user/1.jpg" height="25" width="25" />
			</div>
		</div>
		<br/>-->

	</div>
	<!--<div style="background-color=#00925F;"><embed width="420" height="315"
	src="https://youtube.com/v/NxujF-Oc-OA"></div>-->
	<?php
			echo '<script> var webboard_id ="'.$webboard_id.'";var username ="'.$username.
			'";var name_show ="'.$name_show.'";var xeem_show ="'.$xeem_show.
			'";var xeem_score ="'.$xeem_score.
			'"; </script>';
		?>
		<script>
			
			var cook_name = 'nkauj_hmo_no_id';
			var cook_pass = 'nkauj_hmo_no_pass';
			var id_user;
			var date_event_reply = '';
			
			//details_webboard = window.atob(details_webboard);//btoa()
			//alert(details_webboard);
			
			//show_post(details_webboard,title_webboard,id_nhn);

			//load_post();
			function setCookie() {
				var d = new Date();
				d.setTime(d.getTime() + (1*24*60*60*100000));
				
				var expires = "expires="+d.toUTCString();
				document.cookie = cookOfName + "=" + valueOfName + "; " + expires;
				document.cookie = cookOfPass + "=" + valueOfPass + "; " + expires;
			}


			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
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
