<?php
	include 'connect_db.php';
	
	if(isset($_POST["input_id_w"]))
	{

		if($con!='')
		{

				$id_w =  $_POST["input_id_w"];
				$result = mysqli_query($con,"SELECT webboard.id_nhn
						FROM  `webboard` 
						WHERE  `id_w` =  '$id_w'");
				if($row = mysqli_fetch_array($result))
				{
					$value_id = $row['id_nhn'];
					$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score-2 WHERE id_nhn='$value_id';");
				}
				$result = mysqli_query($con,"DELETE FROM webboard ".
				"WHERE id_w='$id_w'");
				if(!$result){
					echo "not";
				}else{
					echo "ok";
				}
				unlink ("../webboard/w_".$id_w.".php");
				

		}
	}
?>