<?php
	session_start();
	$count_err = 0;
	$username = '';
	$password = '';
	$name_show = '';
	$xeem_show = '';
	$score = 0;
	$block = 0;
	
	if(isset($_SESSION['nkauj_hmo_no_pass']))
	{
		$count_err = $count_err + 1;
		$username = $_SESSION['nkauj_hmo_no_id'];
		$password = $_SESSION['nkauj_hmo_no_pass'];
	
	}

	if($nkauj_hmo_no_pass!='')
	{
		$username = $nkauj_hmo_no_id;
		$password = $nkauj_hmo_no_pass; 
		//$count_err = $count_err + 1;
	}
	
	if($count_err > 0)
	{
		
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
				$name_show = $row['name_show'];
				$xeem_show = $row['lastname_hmong'];
				$score = $row['score'];

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
		$block = 1;
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="th" lang="th">
	<meta charset="utf-8">
	<header>
		<title>Home มาสนทนากันนะ ฟังเพลงม้ง ฟังผ่านวิทยุออนไลน์ 24 ชม. </title>
		<link rel="shortcut icon" href="http://www.nkaujhmono.com/images/icon_main.png">
		<link rel="image_src" href="http://www.nkaujhmono.com/images/h_full.png">
		<meta name="description" content="Nkauj Hmo No nkaujhmono มาสนทนากันนะ วิทยุเพลงม้งออนไลน์ 24 ชม. ฟังเพลงม้ง chat hmong" />
		<meta name="keywords" content="กระทู้ม้ง,เว็บบอร์ดม้ง,วิทยุเพลงม้ง,nkauj,hmoob,hmong,เพลงม้ง,แชทม้ง,chat hmong,webboard hmong"/>
		
		<meta property="fb:app_id"          content="374184436039948" /> 
		<meta property="og:type"            content="article" /> 
		<meta property="og:url"             content="http://www.nkaujhmono.com/home" /> 
		<meta property="og:title"           content="Home มาสนทนากันนะ ฟังเพลงม้ง ฟังผ่านวิทยุออนไลน์ 24 ชม. " /> 
		<meta property="og:image"           content="http://www.nkaujhmono.com/images/h_full.png" /> 
		<meta property="og:description"    content="Nkauj Hmo No nkaujhmono มาสนทนากันนะ วิทยุเพลงม้งออนไลน์ 24 ชม. ฟังเพลงม้ง chat hmong" />
		
		<link rel="stylesheet" href="styles/style_for_home.css" />
		<link rel="stylesheet" href="styles/style_for_home_chat.css" />
		<link rel="stylesheet" href="styles/style_for_home_subject.css" />
		<link rel="stylesheet" href="styles/style_for_home_profile.css" />
		<link rel="stylesheet" href="styles/style_for_entertainment.css" />
		<link rel="stylesheet" href="styles/style_for_home_report.css" />

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

		
		<script src="script/for_home.js"></script>
		<script src="script/for_home_profile.js"></script>
		<script src="script/for_home_chat.js"></script>
		<script src="script/for_home_subject.js"></script>
		<script src="script/for_home_entertainment.js"></script>
		<script src="script/for_home_report.js"></script>
		<script src="script/emo.js"></script>
		<script src="script/in_home_permission.js"></script>
		<script src="http://www.nkaujhmono.com:3000/socket.io/socket.io.js"></script>
		<script>
			try
			{
				var socket = io.connect('http://www.nkaujhmono.com:3000');
			}
			catch(ee)
			{
				window.location.assign("http://www.nkaujhmono.com/");
			}
		</script>
	</header>
	<body>
		<?php include_once("analyticstracking.php") ?>
		<div class ='header'>
				<div class ='se_chat'  id ='se_chat' onmouseup="c_chat()" title='สนทนา'>
					สนทนา
				</div>
				<div class ='se_subject' id ='se_subject' onmouseup="c_subject()" title='กระทู้'>
					กระทู้
				</div>
				<div class ='se_entertainment' id ='se_entertainment' onmouseup="c_entertainment()" title='เพลง'>
					เพลง
				</div>
				<div class ='se_event' id ='se_event'>
					กิจกรรม
				</div>
				<div class ='se_report' id ='se_report' title='แจ้งปัญหา'>
					ปัญหา
				</div>
				<div class ='se_logout' onmouseup="logout()" title='ออกจากระบบ'>
					ออก
				</div>
		</div>

		<div class ='main_background'>
			
			<div class ='sub_select_chat' id ='sub_select_chat'>
				<div class ='messages_chat'>
					<div class ='box_messages_chat' id="box_messages_chat">
						<div class="messages_chat_write" id="messages_chat_write">
							
						</div>
					</div>
					<div class ='send_messages_chat' id ='send_messages_chat'>
						<textarea name="" class = "messages_box" id="messages_box" cols="67" rows="2" maxlength="200" placeholder="เขียนข้อความ"></textarea>
						<span  class="btn_send_messages_chat" onmouseup="sendMessages()">ส่งข้อความ</span>
					</div>
					<div class ='emoimg_messages_chat' id ='emoimg_messages_chat'>
						<div class ='emo_messages_chat'>
							<div class="emo_messages_chat_select" id="emo_messages_chat_select">
							
							</div>
						</div>
						<div class ='color_messages_chat'>
							<span  id = 'btn_color_messages_chat' class="btn_color_messages_chat" onmouseup="show_box_color_messages()">สีตัวอักษร</span>
							<span  id="btn_color_bg_messages_chat" class="btn_color_bg_messages_chat" onmouseup="show_box_color_bg_messages()">สีพื้นหลัง</span>
						</div>
					</div>
				</div>
				<div class ='profile_chat' id ='profile_chat'>
					<div class ='image_profile_chat'>
						<img class="image_profile_chat_img" id="image_profile_chat_img" alt="" src="img_user/1.jpg" height="150" width="150" />
						<div class="image_profile_chat_upload" id="image_profile_chat_upload">
							<input class="image_profile_chat_upload_input" type="file" id="image_profile_chat_upload_input" name="image" accept="image/gif, image/jpeg, image/png" onchange="get_img_edit()"> <!--onchange="getImg()"-->
						</div>
					</div>
					<span class ='profile_chat_name' id ='profile_chat_name'>ชื่อ</span>
					<input class ='profile_chat_name' id ='profile_chat_name_for_edit' type="text" value="">
					<span class ='profile_chat_xeem' id ='profile_chat_xeem'>แซ่</span>
					<span class ='btn_profile_chat' id ='btn_profile_chat' onmouseup='edit_and_ok_profile()'>แก้ไข</span>
					<span class ='btn_profile_add' id ='btn_profile_add' onmouseup='add_freind_profile()'>เพิ่มเพื่อน</span>
					<span class ='btn_back_profile' id ='btn_back_profile' onmouseup ='back_profile()'>หน้าของฉัน</span>
				</div>
				<!--<div class ='profile_chat_friend'>
					<div class ='image_profile_chat_friend'>
			
					</div>
					<span class ='profile_chat_friend_name' id ='profile_chat_friend_name'>ชื่อ</span>
					<span class ='profile_chat_friend_xeem' id ='profile_chat_friend_xeem'>แซ่</span>
					<span class ='btn_add_friend' id ='btn_add_friend'>เพิ่มเพื่อน</span>
				</div>-->
				<div class ='friends_chat' id ='friends_chat'>
					<!--<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="img_user/1.jpg" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>
					<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>
					<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>
					<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>
					<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>
					<div class ='friends_chat_name'><img class="friends_chat_name_img" alt="" src="" height="20" width="20" /><span class="friends_chat_name_in">ชื่อ</span></div>-->
				</div>
				<div id="color_messages">
					<table>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5BCA9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5D0A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F3E2A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F2F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E1F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BCF5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5BC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5E1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5F2"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9E2F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9D0F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9BCF5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9A9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BCA9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0A9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E2A9F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9F2"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9E1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9BC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E6E6E6"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F78181"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F79F81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7BE81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5DA81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F3F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D8F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BEF781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9FF781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F79F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7BE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7D8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81DAF5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81BEF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#819FF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8181F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9F81F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BE81F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DA81F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781D8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781BE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7819F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D8D8D8"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA5858"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA8258"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FAAC58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7D358"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F4FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#ACFA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#82FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FA82"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAAC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAD0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAF4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58D3F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58ACFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5882FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5858FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8258FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#AC58FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D358F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58F4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58AC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA5882"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BDBDBD"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE642E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE9A2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FACC2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#C8FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9AFE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#64FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE64"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE9A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFEC8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFEF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2ECCFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E9AFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E64FE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E2EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#642EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9A2EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#CC2EFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2EF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2EC8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E9A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E64"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A4A4A4"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF4000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF8000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FFBF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FFFF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BFFF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#80FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#40FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF40"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF80"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FFBF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FFFF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00BFFF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0080FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0040FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BF00FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF00FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF00BF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0080"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0040"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#848484"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF0101"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF3A01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF7401"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DBA901"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D7DF01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A5DF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#74DF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3ADF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF3A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF74"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DFA5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DFD7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01A9DB"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0174DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#013ADF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0101DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3A01DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#7401DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A901DB"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF01D7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF01A5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF0174"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF013A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#6E6E6E"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B43104"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B45F04"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B18904"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#AEB404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#86B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5FB404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#31B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B431"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B45F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B486"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B4AE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0489B1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#045FB4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0431B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0404B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3104B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5F04B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8904B1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B404AE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40486"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B4045F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40431"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#585858"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0808"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A2908"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A4B08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#886A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#868A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#688A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B8A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#298A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A29"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A4B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A68"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A85"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#086A87"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#084B8A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#08298A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#08088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#29088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#6A0888"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0886"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0868"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A084B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0829"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#424242"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B0B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#61210B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#61380B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5F4C0B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5E610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#38610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#21610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B6121"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B6138"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B614B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B615E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B4C5F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B3861"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B2161"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B0B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#210B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#380B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4C0B5F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B5E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B4B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B38"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B21"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E2E2E"></td></tr>
					</table>
					</div>
				<div id="color_messages_bg">
					<table>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5BCA9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5D0A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F3E2A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F2F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E1F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BCF5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5A9"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5BC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5E1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9F5F2"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9E2F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9D0F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9BCF5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A9A9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BCA9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0A9F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E2A9F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9F2"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9E1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5A9BC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#E6E6E6"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F78181"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F79F81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7BE81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F5DA81"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F3F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D8F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BEF781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9FF781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F781"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F79F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7BE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7D8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81F7F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81DAF5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#81BEF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#819FF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8181F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9F81F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BE81F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DA81F5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781F3"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781D8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F781BE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7819F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D8D8D8"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA5858"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA8258"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FAAC58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7D358"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F4FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D0FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#ACFA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#82FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FA58"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FA82"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAAC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAD0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58FAF4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58D3F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#58ACFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5882FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5858FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8258FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#AC58FA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D358F7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58F4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58D0"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA58AC"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FA5882"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BDBDBD"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE642E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE9A2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FACC2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#F7FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#C8FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9AFE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#64FE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE2E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE64"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFE9A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFEC8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2EFEF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2ECCFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E9AFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E64FE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E2EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#642EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#9A2EFE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#CC2EFA"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2EF7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2EC8"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E9A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FE2E64"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A4A4A4"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF4000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF8000"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FFBF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FFFF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BFFF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#80FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#40FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF40"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FF80"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FFBF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00FFFF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#00BFFF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0080FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0040FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8000FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#BF00FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF00FF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF00BF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0080"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#FF0040"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#848484"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF0101"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF3A01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF7401"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DBA901"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#D7DF01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A5DF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#74DF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3ADF00"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF01"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF3A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DF74"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DFA5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01DFD7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#01A9DB"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0174DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#013ADF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0101DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3A01DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#7401DF"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#A901DB"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF01D7"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF01A5"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF0174"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#DF013A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#6E6E6E"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B43104"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B45F04"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B18904"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#AEB404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#86B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5FB404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#31B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B404"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B431"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B45F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B486"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#04B4AE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0489B1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#045FB4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0431B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0404B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#3104B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5F04B4"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8904B1"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B404AE"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40486"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B4045F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#B40431"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#585858"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0808"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A2908"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A4B08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#886A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#868A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#688A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B8A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#298A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A08"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A29"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A4B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A68"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#088A85"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#086A87"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#084B8A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#08298A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#08088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#29088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B088A"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#6A0888"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0886"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0868"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A084B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#8A0829"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#424242"></td></tr>
					 <tr><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B0B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#61210B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#61380B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5F4C0B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#5E610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4B610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#38610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#21610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B610B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B6121"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B6138"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B614B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B615E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B4C5F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B3861"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B2161"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#0B0B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#210B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#380B61"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#4C0B5F"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B5E"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B4B"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B38"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#610B21"></td><td onmouseup='get_bg_color(this.bgColor)' bgColor="#2E2E2E"></td></tr>
					</table>
				</div>
				
			</div>
			
			<div class ='sub_select_subject' id ='sub_select_subject'>
				
			</div>
			
			<div class ='sub_select_event_fm' id ='sub_select_event_fm'>
	
								<!-- Generate By DJ.IN.TH For User nkaujhmono Skin faredirfare -->
								
								<br/>
								<span class="top5">รายการ_5_เพลงที่เปิดล่าสุด</span>
								<br/>
								<div id="cc_recenttracks_nkaujhmono" class="cc_recenttracks_list">Loading...</div>
								<br/>
								<div class="fb-page" data-href="https://www.facebook.com/PanPagesSibTham" data-width="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/PanPagesSibTham"><a href="https://www.facebook.com/PanPagesSibTham">Nkauj Hmo No</a></blockquote></div></div>

			</div>
			
			<div class ='sub_se_report' id ='sub_se_report'>
				<span class="address_report">แจ้งมาที่ E-mail: nkaujhmono@gmail.com หรือ</span>
				<textarea name="" class = "report_box" id="messages_box" cols="67" rows="2" maxlength="200" placeholder="เขียนข้อความ"></textarea>
				<span  class="btn_send_messages_report" onmouseup="send_report()">ส่งข้อความ</span>
			</div>
		</div>
		
		
		<?php
			echo '<script> var name_user_db ="'.$name_show.'";var id_user_db ="'.$username.
			'";var xeem_user_db ="'.$xeem_show.'";var block ="'.$block.'";var score ="'.$score.'"; </script>';
		?>
		<script>
			var se_chat= "#ffffff";
			var se_subject= "#78c0b6";
			var se_entertainment= "#ffffff";
			var se_event= "#ffffff";
			var se_report= "#ffffff";
			$(document).ready(function(){
				$("#se_chat").hover(function(){
					$("#se_chat").css("color", "#78c0b6");
					},function(){
					$("#se_chat").css("color", se_chat);
				});
				$("#se_subject").hover(function(){
					$("#se_subject").css("color", "#78c0b6");
					},function(){
					$("#se_subject").css("color", se_subject);
				});
				$("#se_entertainment").hover(function(){
					$("#se_entertainment").css("color", "#78c0b6");
					},function(){
					$("#se_entertainment").css("color", se_entertainment);
				});
				$("#se_event").hover(function(){
					$("#se_event").css("color", "#78c0b6");
					},function(){
					$("#se_event").css("color", se_event);
				});
				$("#se_report").hover(function(){
					$("#se_report").css("color", "#78c0b6");
					},function(){
					$("#se_report").css("color", se_report);
				});
			});
			var cook_name = 'nkauj_hmo_no_id';
			var cook_pass = 'nkauj_hmo_no_pass';
			var name_user;
			var xeem_user;
			//alert(name_user);
			var id_user;
			var messages_send = '';
			var messages_color = '#003300';
			var messages_color_bg = '#BCF5A9';
			var img_user;
			var messages_time = '';
			var color_messages = 0;
			var color_messages_bg = 0;
			var myid = 0;
			var list_my_freinds;
			var nickname = "";
			
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
			

			function click_add_emo(emo)
			{
				var mem = document.getElementById("messages_box").value;
				var mem2 = mem+emo.id;
				if(mem2.length>200)
				{
					document.getElementById("messages_box").value =mem;
				}else{
					document.getElementById("messages_box").value =mem+emo.id;
				}
			}
			
			function messagesWrite(name,messages,ofURL,color,colorBg,time)
			{
				
				messages = messages.replace(/\\/gi,"");
				
				messages = convertEMO(messages);
				var id_split_img = ofURL.split('.')[0].split('/');
				converData = '<div class="user_messages_chat_main">';
				converData += '<img class="img_user_messages_chat" id="'+id_split_img[1]+'" alt="" src="'+ofURL+'" height="32" width="32" onmouseup="friend_profile(this.id)"/>';
				converData += '<div class="bg_user_messages_chat">';//===background: #037DFF;
				converData += '<div class="user_messages_chat" style="background:'+colorBg+'">';
				converData += '<span class="messages" style="color:'+color+'" >'+messages+'</span>';
				converData += '</div><div class="user_messages_chat_after" style="border-color: transparent '+colorBg+'"></div>';
				converData += '</div>';//==
				converData += '<span class="name_user_messages_chat" id="nameSend">'+name ;
				converData += '<span class="user_messages_chat_time">'+' ['+time+']'+'</span>';
				converData += '</span>';
				converData += '</div>';
				
				document.getElementById("messages_chat_write").innerHTML += converData;
				document.getElementById('box_messages_chat').scrollTop = document.getElementById('messages_chat_write').scrollHeight;
			}
			
			function messagesWrite2(valueOf,ofURL,datas,type,color,colorBg,time)
			{
				datas=datas.replace(/\\/gi,"");
							datas = convertEMO(datas);
							//alert("<img id=\"chat\" alt=\"\" src=\"emos/angry.png\"/>" +"<br\>" +data);					  
							//if("<img id=\"chat\" alt=\"\" src=\"emos/angry.png\"/>"==data){
							
							if(type=="0"){
								countForGB++;
								converData = '<div class="PangbubbleUser">';
								converData +='<img class="userImg" alt="" src="'+ofURL+'" height="32" width="32" />';
								converData += '<div class="bubbleUser2">';//===background: #037DFF;
								converData += '<div class="bubbleUser" id="bg'+countForGB+'" style="background:#'+colorBg+'">';
								converData+='<span id=\"spans\" class='+'NO'+' style="color:#'+color+'" >'+datas+'</span>';
								converData += '</div><div class="bubbleUser_after" style="border-color: transparent #'+colorBg+'"></div>';
								converData += '</div>';//==
									converData += '<span class="nameSend" id="nameSend">'+valueOf ;
									converData +='<span class="timeSendDJ">'+' ['+time+']'+'</span>';
								converData += '</span>';
								converData += '</div>';
									document.getElementById("messages_chat_write").innerHTML += converData;
								}else{
									converData = '<div class="PangbubbleUser">';
								converData +='<img class="userImgDJ" alt="" src="'+ofURL+'" height="32" width="32" />';
								converData += '<div class="bubbleDJ">';
								converData+='<span id=\"spans\" class='+'NO'+'>'+datas+'</span>';
								converData += '</div>';
									converData += '<div class="nameSendDJ" id="nameSendDJ">'+valueOf;
								converData +='<span class="timeSendDJ">'+' ['+time+']'+'</span>';
								converData += '</div></br>';
								converData += '</div>';
									document.getElementById("messages_chat_write").innerHTML += converData;
								}
			
			}
			
			/*messagesWrite('orojiben','2222:OffendedBroken:222222222222222222222222:OffendedBroken:2222222222 2222222222222222222222222222222222222222222222222','images/DJ_Orojiben.jpg','00ff00','00ffff','00:00:00');
			for(i=0;i<20;i++){
				
				messagesWrite('orojiben','ben:OffendedBroken:','images/DJ_Orojiben.jpg','00ff00','00ffff','00:00:00');
				messagesWrite('orojiben','ben','images/DJ_Orojiben.jpg','00ff00','00ffff','00:00:00');
			}*/
			function add_emo()
			{
				for(i=0;i<emoImg.length;i++){
					//alert();
					document.getElementById("emo_messages_chat_select").innerHTML += "<span onmouseup=\"click_add_emo(this)\" id=\""+emoValue[i]+"\" class=\"insert_emo\">"+emoImg[i]+"<\span>";	
				}
			}
			
			$(document).ready(function(){
				//document.getElementById("color_messages").style.display = "none";
				//document.getElementById("color_messages_bg").style.display = "none";
				$("#messages_box").keydown(function(event){
					if(event.keyCode == 13 && jQuery.trim($("#messages_box").val()) != ""){
						sendMessages();
						event.preventDefault();
					}
				});
				add_emo();
				 /*$("td").click(function () {
					//$("td", $(this).parent()).each(function () {
						alert("");
					//})
				});*/
				
			});
			
			
			
			
		
			
			socket.on('receive_messages_all', function(data){
				//alert("");
				messagesWrite(data.name,data.messages,data.img,data.color,data.color_bg,data.time);
			});
			
			socket.on('receive_messages_first', function(data){
				document.getElementById("friends_chat").innerHTML = '';
				rows = data.value;
				var rows_length = rows.length;
				if(rows_length==0)
				{
					return;
				}
				for(i_rows=rows_length-1;i_rows>=0;i_rows--)
				{
					
					c_rows = rows[i_rows];
					var d = new Date(parseInt(c_rows.time));
					h = d.getHours()+"";
					if(h.length==1)
					{
						h = "0"+h;
					}
					m = d.getMinutes()+"";
					if(m.length==1)
					{
						m = "0"+m;
					}
					s = d.getSeconds()+"";
					if(s.length==1)
					{
						s = "0"+s;
					}
					var time = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+h+":"+m+":"+s;
					f_img = "img_user/"+c_rows.id_nhn+".jpg";
					//alert(c_rows.id_nhn);
					messagesWrite(c_rows.name_show,c_rows.messages,f_img,c_rows.color,c_rows.color_bg,time);
				}
				//messagesWrite(data.name,data.messages,data.img,data.color,data.color_bg,data.time);
			});
			
			//socket.emit('hello','ben');
				
			/*socket.on('hello', function (data) {
				document.getElementById("ben").innerHTML = '555';
			});*/
			
			function sendMessages()
			{
				if(id_user!="")
				{
					if( document.getElementById("messages_box").value != ""){
						
						messages_send = document.getElementById("messages_box").value;
						var d = new Date();
						h = d.getHours()+"";
						if(h.length==1)
						{
							h = "0"+h;
						}
						m = d.getMinutes()+"";
						if(m.length==1)
						{
							m = "0"+m;
						}
						s = d.getSeconds()+"";
						if(s.length==1)
						{
							s = "0"+s;
						}
						messages_time = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+h+":"+m+":"+s;
						messages_send = escapeHtml(messages_send);
						messages_send = urlToTag(messages_send);
						//alert(messages_send);
						socket.emit('send_messages',{name:name_user,messages:messages_send,img:img_user,
						color:messages_color,color_bg:messages_color_bg,time:messages_time,idu:id_user,time_db:d.getTime()});
						
						//document.getElementById("messages_box").value = '';
						
						$("#messages_box").val('');
					}
				}
				else
				{
					create_subject_none();
				}
			}
			
			function get_bg_color(bgColor)
			{
				if(color_messages==1)
				{
					messages_color = bgColor;
				}
				else if(color_messages_bg==1)
				{
					messages_color_bg = bgColor;
				}
				color_messages = 0;
				color_messages_bg = 0;
				document.getElementById("color_messages_bg").style.display = "none";
				document.getElementById("color_messages").style.display = "none";
				//alert(bgColor);
				//var $selectedRow = $(this).parent("td").parent("tr");
			}

			
			
			function show_box_color_messages()
			{
				if(color_messages==0){
					if(document.getElementById("color_messages_bg").style.display == "block")
					{
						document.getElementById("color_messages_bg").style.display = "none";
						color_messages_bg = 0;
						
					}
					document.getElementById("color_messages").style.display = "block";
					color_messages = 1;
			
				}else{
					document.getElementById("color_messages").style.display = "none";
					color_messages = 0;
					
					
					
				}
			}
			//show_box_color_messages();
			function show_box_color_bg_messages()
			{
				if(color_messages_bg==0){
					if(document.getElementById("color_messages").style.display = "block")
					{
						document.getElementById("color_messages").style.display = "none";
						color_messages = 0;
				
					}
					document.getElementById("color_messages_bg").style.display = "block";
					color_messages_bg = 1;
					
				}else{
					document.getElementById("color_messages_bg").style.display = "none";
					color_messages_bg = 0;
					
				}
				
			}
			
			function getStatusRadio()
			{
			//alert("");
				 $.ajax({
								url: "GETSTATUS/shoutcast.php",
							dataType : 'text', 
							type : 'post',
							data : { msg : ""},
								success: function(data){
									var data2 = data.split(",");
									//alert(data2);
									if(data2[0]!="orojiben"){
											document.getElementById("cc_strinfo_listeners_nkaujhmono").innerHTML = data2[0];
											document.getElementById("cc_strinfo_title_nkaujhmono").innerHTML  = data2[1];
											
											document.getElementById("cc_strinfo_tracktitle_nkaujhmono").innerHTML = data2[2].split('[')[0];
											document.getElementById("cc_strinfo_tracktitle_nkaujhmono").title = document.getElementById("cc_strinfo_tracktitle_nkaujhmono").innerHTML;
											document.getElementById("cc_recenttracks_nkaujhmono").innerHTML = '<ol><li>'+data2[2] +'</li><br/><li>'+ data2[3] 
											+'</li><br/><li>'+ data2[4] + '</li><br/><li>'+
											data2[5] +'</li><br/><li>'+data2[6] +'</li></ol>';
										}
								}
							});
								

			
			}
			setInterval(
				function(){
				getStatusRadio();
			},3000);
			getStatusRadio();
			//alert(block +" "+ block=='0');
			
			check_in_home_permission();
			
		</script>
		<div class="foot">
			<div class="radio_main">
				<div class="radio">
					<iframe src="//www.dj.in.th/player-1-1-8126-50-true-substream-nkaujhmono.html" height="200" width="220" frameborder="0" scrolling="no"" height="52" width="269" frameborder="0" scrolling="no"></iframe>
				</div>				
									<div class="djN">
										<span class="headForRadio">DJ :</span> <span id="cc_strinfo_title_nkaujhmono" class="cc_streaminfo"></span><br />
									</div>
									<div class="countListen">
										<span class="headForRadio">ผู้ฟังปัจจุบัน: </span><span id="cc_strinfo_listeners_nkaujhmono" class="cc_streaminfo"></span> คน
									</div>
									<div class="songC">
										<span class="headForRadio">กำลังเล่น: </span> <span id="cc_strinfo_tracktitle_nkaujhmono" class="cc_streaminfo"></span>
									</div>
									<div class="number_on_alls">
										<span class="headForRadio">ผู้เล่นออนไลน์: </span> <span id="number_on_alls" class="cc_streaminfo">คุณไม่ได้เข้าสู่ระบบ</span>
									</div>
			</div>
		</div>
	
	</body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.3&appId=1445199945756450";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</html>