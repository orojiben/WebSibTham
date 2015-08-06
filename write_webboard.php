<?php
	session_start();
	$username = '';
	$password = '';
	$count_err = 0;
	if(isset($_SESSION['nkauj_hmo_no_pass']))
	{
		$count_err = $count_err + 1;
		$username = $_SESSION['nkauj_hmo_no_id'];
		$password = $_SESSION['nkauj_hmo_no_pass'];
		
	}
 
	$f_t = '';
	$f_id = '';
	$v = '';
	
	if(isset($_GET['v']))
	{
		if($_GET['v'].''=='0' || $_GET['v'].''=='1')
		{
			$v = $_GET['v'];
			if(isset($_GET['t']))
			{
				if($_GET['t']=='ww')
				{
					$f_t = 'ww';
				}
				else if($_GET['t']=='w' || $_GET['t']=='r'|| $_GET['t']=='s')
				{
					$f_t = $_GET['t'];
					if(isset($_GET['id']))
					{
						$f_id = $_GET['id'];
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
	else
	{
		header('Location:http://www.nkaujhmono.com/');
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>เขียนกระทู้ม้ง webboard hmong</title>
		<link rel="shortcut icon" href="images/icon_main.png">
		<meta name="description" content="เขียนกระทู้ม้ง webboard hmong" />
		<meta name="keywords" content="กระทู้ม้ง,webboard hmong"/>
		<link rel="stylesheet" href="styles/style_for_webboard.css" />

		
		<script type="text/javascript" src="fancy/lib/jquery-1.10.1.min.js"></script>
		<script src="script/webboard.js"></script>
		<script src="script/w_webboard.js"></script>
		<script src="script/in_webboard_permission.js"></script>
	</head>
<body>
	<?php include_once("analyticstracking.php") ?>


	<div>
		
		
		<div class ='title_post' >
			<div class ='category_post'>
			  หมวดกระทู้ :
			   <input type="radio" name="colors" value="love" onmouseup='select_category_post(this.value)'>ความรัก
			   <input type="radio" name="colors" value="learn" onmouseup='select_category_post(this.value)'>การเรียน
			   <input type="radio" name="colors" value="trip" onmouseup='select_category_post(this.value)'>เที่ยว-สถานที่
			   <input type="radio" name="colors" value="work" onmouseup='select_category_post(this.value)'>ทำงาน
			   <input type="radio" name="colors" value="sport" onmouseup='select_category_post(this.value)'>กีฬา
			   <input type="radio" name="colors" value="other" onmouseup='select_category_post(this.value)'>อื่นๆ
			</div>
			<div id ='category_post_error' style="color:#ff0000"></div>
		<input id ='title_post' type="text" placeholder="หัวเรื่อง" value="">
		<div id ='title_error' style="color:#ff0000"></div>
		</div>
		
		<div class ='button_post'>
			<button type="button" onmouseup="add_tag_text('b')">หนา</button>
			<button type="button" onmouseup="add_tag_text('i')">เอียง</button>
			<button type="button" onmouseup="add_tag_text('u')">ขีดเส้นใต้</button>
			<button type="button" onmouseup="add_tag_text('sup')">sup</button>
			<button type="button" onmouseup="add_tag_text('sub')">sub</button>
			<button type="button" onmouseup="add_tag_text('center')">center</button>
			<button type="button" onmouseup="add_tag_text('right')">right</button>
			<button type="button" onmouseup="add_tag_text('left')">left</button>
			<button type="button" onmouseup="add_tag_text('youtube')">youtube</button>
			<div class="image_upload" id="image_upload">
							<input class="image_upload_input" type="file"  id="image_upload_input" name="image" accept="image/gif, image/jpeg, image/png" onchange="get_img()"> <!--onchange="getImg()"-->
			</div>
		</div>
		<br/>
		<div class ="text_post" >
		<div id ='text_error' style="color:#ff0000">
		</div>
		<textarea name="text_post" cols="50" rows="5" id="text_post" class ="textarea_post" ></textarea></div>

		

		
		<div class ="main" id="main">
			<button type="button" onmouseup="view_post()">ดูตัวอย่าง</button>
			<button id="button_ok" type="button" onmouseup="save_post()">ตกลง</button>
			<div id="view_text_post" class ="view_text_post"> </div>
		</div>
		<br/>
	</div>
	<!--<div style="background-color=#00925F;"><embed width="420" height="315"
	src="https://youtube.com/v/NxujF-Oc-OA"></div>-->
	<?php
			echo '<script> var f_t ="'.$f_t.'";var f_id ="'.$f_id.
			'";var id_user ="'.$id_user.'";var v ="'.$v.'";var username ="'.$username.'";var password ="'.$password.'"; </script>';
		?>
		<script>
			
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
			
			var url_new = document.URL+"";
			if(url_new.indexOf('http://www.')==-1)
			{
				location.replace(url_new.replace("http://", "http://www."));
			}
			else{
				var cook_name = 'nkauj_hmo_no_id';
				var cook_pass = 'nkauj_hmo_no_pass';
				
				if(f_t!='ww')
				{
					document.getElementById("title_post").style.display = "none";
				}
				//alert();
				check_in_webboard_permission();
				edit_post();
			}
	</script>
</body>
</html>
