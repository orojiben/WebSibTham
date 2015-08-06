<?php
	
	include 'connect_db.php';

	   if($con!='')
		{
			if(isset($_POST['id_nhn']))
			{
				$id_nhn = $_POST['id_nhn'];
				$s = $_POST['s'];
				$password = $_POST['password'];
				$password .= '00';
				$result = mysqli_query($con,"SELECT * 
					FROM  `user_nkauj_hmo_no` 
					WHERE  `id_nhn` =  '$id_nhn'
					AND  `password` =  '$password'");
				$row = mysqli_fetch_array($result);
				if($id_nhn==$row['id_nhn']&&$password==$row['password']&&$username!=""&&$password!="")
				{
					
					if($s=='0')
					{
						$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+5 WHERE id_nhn='$id_nhn';");
					}
					else if($s=='1')
					{
						$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+1 WHERE id_nhn='$id_nhn';");
					}
				}
			}
			mysqli_close($con);
		}
?>

