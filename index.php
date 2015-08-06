<?php
			session_start();
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
			
			if(isset($_SESSION['nkauj_hmo_no_id']))
			{
				$username = $_SESSION['nkauj_hmo_no_id'];
			}
			
			if(isset($_COOKIE['nkauj_hmo_no_pass']))
			{
				$username = $_COOKIE['nkauj_hmo_no_id'];
				$password = $_COOKIE['nkauj_hmo_no_pass'];
				$count_err = $count_err + 1;
			}
			
			if(isset($_COOKIE['nkauj_hmo_no_id']))
			{
				$username = $_COOKIE['nkauj_hmo_no_id'];
			}
			
			$script = '';
			$checkconnection = @mysql_connect('localhost', "admin_nkuajhmono", "PW8lkmLlp5@&");
			if($count_err != 0)
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
						$script = 'document.getElementById("logined").style.display = "block"';
					}
					else
					{
						$script = 'document.getElementById("login").style.display = "block"';
					}
				}
				else
				{
					$script = 'document.getElementById("login").style.display = "block"';
				}
			}
			else
			{
				$script = 'document.getElementById("login").style.display = "block"';
				if($checkconnection&&$username!="") 
				{
					$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
					$con->set_charset("utf8");
					$result = mysqli_query($con,"SELECT * 
								FROM  `user_nkauj_hmo_no` 
								WHERE  `id_nhn` =  '$username'");
					$row = mysqli_fetch_array($result);
					mysqli_close($con);
					if($username==$row['id_nhn'])
					{
						$username = $row['username'];
					}
				}
				
				
			}
			
		?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="th" lang="th">
	<meta charset="utf-8">
	<header>
		<title>Nkauj Hmo No มาสนทนากันนะ ฟังเพลงม้ง ฟังผ่านวิทยุออนไลน์ 24 ชม. </title>
		<link rel="shortcut icon" href="http://www.nkaujhmono.com/images/icon_main.png">
		<link rel="image_src" href="http://www.nkaujhmono.com/images/h_full.png">
		<meta name="description" content="Nkauj Hmo No nkaujhmono มาสนทนากันนะ วิทยุเพลงม้งออนไลน์ 24 ชม. ฟังเพลงม้ง chat hmong" />
		<meta name="keywords" content="กระทู้ม้ง,เว็บบอร์ดม้ง,วิทยุเพลงม้ง,nkauj,hmoob,hmong,เพลงม้ง,แชทม้ง,chat hmong,webboard hmong"/>
		<meta property="fb:app_id"          content="374184436039948" /> 
		<meta property="og:type"            content="article" /> 
		<meta property="og:url"             content="http://www.nkaujhmono.com/" /> 
		<meta property="og:title"           content="Nkauj Hmo No มาสนทนากันนะ ฟังเพลงม้ง ฟังผ่านวิทยุออนไลน์ 24 ชม." /> 
		<meta property="og:image"           content="http://www.nkaujhmono.com/images/h_full.png" /> 
		<meta property="og:description"    content="Nkauj Hmo No nkaujhmono มาสนทนากันนะ วิทยุเพลงม้งออนไลน์ 24 ชม. ฟังเพลงม้ง chat hmong" />
		
		<link rel="stylesheet" href="styles/style_for_index.css" />
		<script src="script/jquery.js"></script>
		<script src="script/for_index.js"></script>
		<script src="script/register.js"></script>
		<script src="http://www.nkaujhmono.com:3000/socket.io/socket.io.js"></script>
		
		
	</header>
	<body>
		<?php include_once("analyticstracking.php") ?>
		<div class ='main_background'>
			<div class = 'register'>
				<span class = 'register_header'>สมัครเล่นด้วยคน</span>
				<input class ='txt_user_reg' id ='txt_user_reg' type="text" placeholder="อีเมล" value="">
				<input class ='txt_pass_reg' id ='txt_pass_reg' type="password" placeholder="รหัสผ่าน" value="">
				<input class ='txt_pass_reg_re' id ='txt_pass_reg_re' type="password" placeholder="รหัสผ่านอีกครั้ง" value="">
				<span class = 'mark'>*สำคัญ*</span>
				<select class ='select_xeem' onchange="register_seem(this.value)">
				  <option value="default">เลือกแซ่</option>
				  <option value="vaj">แซ่หว้า Xeem Vaj</option>
				  <option value="tsab">แซ่จาง Xeem Tsab</option>
				  <option value="lis">แซ่ลี Xeem Lis</option>
				  <option value="xyooj">แซ่โซ้ง  Xeem Xyooj</option>
				  <option value="thoj">แซ่ท่อ  Xeem Thoj</option>
				  <option value="lauj">แซ่เล่า Xeem Lauj</option>
				  <option value="muas">แซ่มัว  Xeem Muas</option>
				  <option value="yaj">แซ่ย่าง Xeem Yaj</option>
				  <option value="hawj">แซ่เฮ้อ Xeem Hawj</option>
				  <option value="vwj">แซ่วื้อ Xeem Vwj</option>
				  <option value="kwm">แซ่กือ Xeem Kwm</option>
				  <option value="ham">แซ่หาญ Xeem Ham</option>
				  <option value="tswb">แซ่จื้อ Xeem Tswb</option>
				  <option value="faj">แซ่ฟ่า Xeem Faj</option>
				  <option value="phab">แซ่พ้า Xeem Phab</option>
				  <option value="koo">แซ่กง Xeem Koo</option>
				  <option value="tsheej">แซ่เฉ้ง Xeem Tsheej</option>
				  <option value="khab">แซ่ค้า Xeem Khab</option>
				</select>
				<form action="" class="select_sex">
					<input type="radio" name="sex" value="male" onmouseup='register_sex(this.value)'>ชาย
					<input type="radio" name="sex" value="female" onmouseup='register_sex(this.value)'>หญิง
				</form>
				<span class ='msg_err' id = 'msg_err'></span>
				<button type="button" class="btn_register" onclick="register_user();">สมัครเล่น</button>
			</div>
			<div class ='login' id ='login'>
					<input class ='txt_user' id = 'txt_user' type="text" placeholder="อีเมล" value="<?php echo $username; ?>">
					<input class ='txt_pass' id = 'txt_pass' type="password" placeholder="รหัสผ่าน" value="">
					<span class ='msg_err_login' id = 'msg_err_login'></span>
					<input class ='checkbox_login' type="checkbox" name="vehicle" value="Bike" onchange='checked_login(this.checked)'>
					<span class ='span_checkbox_login'>อยู่ในระบบต่อไป</span>
					<button type="button" class="btn_login" onclick="login();">Login</button>
			</div>
			<div class ='logined' id ='logined'>
				<span  class="btn_in_web" onclick="home();"></span>
				<span class="btn_logout" onclick="logout();"></span>
			</div>
			
			<div class ='free'>
				<span  class="btn_in_web_free" onclick="home();">เข้าโดยไม่ต้อง login</span>
			</div>
			
		</div>
		<?php
			echo '<script> '.$script.'; </script>';
		?>
		<script>
			
			//alert(document.cookie);
		</script>
	</body>
</html>