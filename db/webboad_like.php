<?php
	include 'connect_db.php';
	
	if(isset($_POST["input_id_user"]))
	{
		if($con!='')
		{
			if($_POST["input_f_t"]=="w")
			{
				$id = $_POST["input_id_user"];
				$f_id = $_POST["input_f_id"];

				$result = mysqli_query($con,"INSERT INTO `liked_post_w`(`id_w`, `id_nhn`) VALUES ('$f_id','$id')");
				
				$id_nhn = $_POST['input_id_nhn'];
					$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+1 WHERE id_nhn='$id_nhn';");

					$result = mysqli_query($con,"UPDATE `webboard` SET
						`like_w`=webboard.like_w+1 WHERE id_w='$f_id';");
				
				if(!$result){
					echo "n";
				}else{
					echo "ok";
					
				}
			}
			else if($_POST["input_f_t"]=="r")
			{
				$id = $_POST["input_id_user"];
				$f_id = $_POST["input_f_id"];

				$result = mysqli_query($con,"INSERT INTO liked_post_r".
				"(`id_rw`, `id_nhn`)".
				"VALUES ('$f_id','$id')");
				
				if(!$result){
					echo "n";
				}else{
					echo "ok";
				}
				$id_nhn = $_POST['input_id_nhn'];
					$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+1 WHERE id_nhn='$id_nhn';");
				$result = mysqli_query($con,"UPDATE `reply_webboard` SET
						`like_rw`=reply_webboard.like_rw+1 WHERE id_rw='$f_id';");
			}
			else if($_POST["input_f_t"]=="s")
			{
				$id = $_POST["input_id_user"];
				$f_id = $_POST["input_f_id"];

				$result = mysqli_query($con,"INSERT INTO liked_post_s".
				"(`id_sr`, `id_nhn`)".
				"VALUES ('$f_id','$id')");
				
				if(!$result){
					echo "n";
				}else{
					echo "ok";
					
				}
				$id_nhn = $_POST['input_id_nhn'];
					$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+1 WHERE id_nhn='$id_nhn';");
				$result = mysqli_query($con,"UPDATE `replys_sub` SET
						`like_sr`=replys_sub.like_sr+1 WHERE id_sr='$f_id';");
			}
			mysqli_close($con);
		}
	}
?>