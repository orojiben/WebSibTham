<?php
	
	include 'connect_db.php';

	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT  unhn.name_show as name_show_s,unhn.lastname_hmong as lastname_hmong_s,unhn.score as score_s
			,w.id_w,w.id_nhn,w.title,w.time_w,w.details_w,w.viewed_w,w.like_w 
FROM user_nkauj_hmo_no unhn
INNER JOIN webboard w
ON unhn.id_nhn=w.id_nhn
						ORDER BY viewed_w DESC;");
			
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

				
				
				$score_like_w = $row['like_w'];
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
    
	//echo '-*-';
?>