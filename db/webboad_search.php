<?php
	
	include 'connect_db.php';

	if(isset($_POST["input_search"]))
	{
	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT *
				FROM `webboard`
				WHERE `title` LIKE '%".$_POST["input_search"]."%'
				OR `details_w` LIKE '%".$_POST["input_search"]."%'
				ORDER BY like_w DESC;");
			
			$data_r = array();
			$count_all = 0;
			while($row = mysqli_fetch_array($result))
			{
				$title = $row['title'];
				$viewed = $row['viewed_w'];
				$id_nhn = $row['id_nhn'];
				$id_nhn = $row['id_nhn'];
				$id_w  = $row['id_w'];
				//$details = base64_encode($row['details_w']);
				$details = $row['details_w'];
				$time_w  =$row['time_w'];
				$name_user_w = $row['name_show_s'];
				$xeem_user_w = $row['lastname_hmong_s'];

				
				
			//	$result_l = mysqli_query($con,"SELECT count(*) as c
				//		FROM  `liked_post_w` 
			//			WHERE  `id_w` =  '$id_w'");
				$score_like_w = $row['like_w'];;
				//if($row_l = mysqli_fetch_array($result_l))
				//{
				//	$score_like_w = $row_l["c"];
				//}
				$result_r = mysqli_query($con,"SELECT count(*) as c
						FROM  `reply_webboard` 
						WHERE  `id_w` =  '$id_w'");
				$count_reply = 0;
				if($row_r = mysqli_fetch_array($result_r))
				{
					$count_reply = $row_r["c"];
				}
				
				
				$data_r[$count_all] = array("title"=>$title,"id_nhn"=>$id_nhn,"details"=>$details,"time_w"=>$time_w,
				"score_like_w"=>$score_like_w,"count_reply"=>$count_reply,
				"name_user_w"=>$name_user_w,"score_user_w"=>$score_user_w,
				"xeem_user_w"=>$xeem_user_w,"user_like"=>$user_like,"id_w"=>$id_w,"viewed_w"=>$viewed);
				$count_all++;
			}

			mysqli_close($con);
			header("Content-Type: application/json", true);
			
			echo json_encode($data_r);
			exit;
		}
	}
    
	//echo '-*-';
?>