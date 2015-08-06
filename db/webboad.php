<?php
	
	include 'connect_db.php';
	

	$title = '';
	$id_nhn = '';
	$details = '';
	$time_w  = '';
	$score_like_w = 0;
	$name_user_w = '';
	$user_like = array();
				$score_user_w  ='';
				$xeem_user_w  = '';
	if (isset($_POST["input_webboard_id"])) 
	{
       $input_webboard_id = $_POST["input_webboard_id"];

	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT * 
						FROM  `webboard` 
						WHERE  `id_w` =  '$input_webboard_id'");
			if($row = mysqli_fetch_array($result))
			{
				$title = $row['title'];
				$id_nhn = $row['id_nhn'];
				//$details = base64_encode($row['details_w']);
				$details = $row['details_w'];
				$time_w  =$row['time_w'];
				/*$result = mysqli_query($con,"SELECT COUNT(*) AS c
						FROM  `liked_post_w` 
						WHERE  `id_w` =  '$input_webboard_id'");
				if($row = mysqli_fetch_array($result))
				{
					$score_like_w = $row['c'];
				}*/
				
				
				$result = mysqli_query($con,"SELECT *
						FROM  `liked_post_w` 
						WHERE  `id_w` =  '$input_webboard_id'");
				$score_like_w = 0;
				while($row = mysqli_fetch_array($result))
				{
					$user_like[$score_like_w] = $row["id_nhn"];
					$score_like_w++;
				}
			}
			$result = mysqli_query($con,"SELECT * 
						FROM  `user_nkauj_hmo_no` 
						WHERE  `id_nhn` =  '$id_nhn'");
			if($row = mysqli_fetch_array($result))
			{
				$name_user_w = $row['name_show'];
				$score_user_w  =$row['score'];
				$xeem_user_w  = $row['lastname_hmong'];
			}
			mysqli_close($con);
			header("Content-Type: application/json", true);
			$data_r = array("title"=>$title,"id_nhn"=>$id_nhn,"details"=>$details,"time_w"=>$time_w,"score_like_w"=>$score_like_w,
			"name_user_w"=>$name_user_w,"score_user_w"=>$score_user_w,"xeem_user_w"=>$xeem_user_w,"user_like"=>$user_like);
			echo json_encode($data_r);
			exit;
		}
    }
	//echo '-*-';
?>