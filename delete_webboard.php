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

		
		<script src="script/jquery.js"></script>
		<script src="script/webboard.js"></script>
		<script src="script/in_webboard_permission.js"></script>
	</head>
<body>
	


	<div>
		<div class ='button_post'>
			<button type="button" onmouseup="ok_()">ตกลง</button>
			<button type="button" onmouseup="cancel_()">ยกเลิก</button>
		</div>
	</div>
	<!--<div style="background-color=#00925F;"><embed width="420" height="315"
	src="https://youtube.com/v/NxujF-Oc-OA"></div>-->
	<?php
			echo '<script> var f_t ="'.$f_t.'";var f_id ="'.$f_id.'";var username ="'.$username.'";var v ="'.$v.'"; </script>';
		?>
		<script>
			parent.delete_ok = false;
			var id_user;
			var cook_name = 'nkauj_hmo_no_id';
			var cook_pass = 'nkauj_hmo_no_pass';
			function ok_()
			{
				if(f_t=="w")
				{
					$.ajax({
						url: "db/webboad_delete.php",
						dataType : 'text', 
						type : 'post',
						data : 	
						{ 	
							input_id_w: f_id
						},
						success: function(data){
							//alert(data);
							parent.delete_ok = true;
							parent.jQuery.fancybox.close();
						}
					});
				}
				else if(f_t=="s" || f_t=="r")
				{
					$.ajax({
						url: "db/webboad_delete2.php",
						dataType : 'text', 
						type : 'post',
						data : 	
						{ 	
							input_f_id: f_id,
							input_f_t: f_t
						},
						success: function(data){
							//alert(data);
							parent.delete_ok = true;
							parent.jQuery.fancybox.close();
						}
					});
				}
			}
			
			function cancel_()
			{
				parent.jQuery.fancybox.close();
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
			
			
			check_in_webboard_permission();

	</script>
</body>
</html>
