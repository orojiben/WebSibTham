<?php
	
	include 'connect_db.php';
	
	$data_r = array();
	if (isset($_POST["input_webboard_id"])) 
	{
		/*
		SELECT *
FROM reply_webboard
LEFT JOIN replys_sub 
ON reply_webboard.id_rw = replys_sub.id_rw
		*/
       $input_webboard_id = $_POST["input_webboard_id"];

	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT rv.name_show,rv.lastname_hmong,rv.score,rv.id_rw,rv.id_nhn,rv.id_w,rv.time_rw,rv.details_rw
			,sv.name_show_s,sv.lastname_hmong_s,sv.score_s,sv.id_sr,sv.id_nhn_rs,sv.time_nhnwsr,sv.details_srw
FROM reply_v rv
LEFT JOIN sub_v  sv
ON rv.id_rw = sv.id_rw WHERE rv.id_w = '$input_webboard_id'");
				
				/*CREATE VIEW r_a_rs AS
SELECT rv.id_rw,rv.id_nhn,rv.id_w,rv.time_rw,rv.details_rw,
rv.liked_rw,sv.id_sr,sv.id_nhn_rs,sv.time_nhnwsr,sv.details_srw,sv.liked_srw
FROM reply_v rv
LEFT JOIN sub_v  sv
ON rv.id_rw = sv.id_rw WHERE rv.id_w = $input_webboard_id;*/
				
				
			$id_rw = '0';
			$data_r = array();
			$count_data_r = -1;
			$count_data_rs = 0;
			
			while($row = mysqli_fetch_array($result))
			{
				if($id_rw!= $row['id_rw'])
				{
					$count_data_r++;
					$id_rw = $row['id_rw'];
					
					$result_r = mysqli_query($con,"SELECT *
						FROM  `liked_post_r` 
						WHERE  `id_rw` =  '$id_rw'");
					$score_like_r = 0;
					$user_like_r = array();
					while($row_r = mysqli_fetch_array($result_r))
					{
						$user_like_r[$score_like_r] = $row_r["id_nhn"];
						$score_like_r++;
					}
					
					$data_r[$count_data_r] = array( "name_show" => $row['name_show'],"xeem_show" => $row['lastname_hmong'],"score" => $row['score'],
						"id_rw" => $row['id_rw'], "id_nhn" => $row['id_nhn'],
						"time_rw" => $row['time_rw'], "details_rw" => $row['details_rw'],
						"liked_rw" => $score_like_r,"user_like"=>$user_like_r,"sr" => array());
					
					$count_data_rs = 0;
					/*$data_r[$count_data_r]["sr"][$count_data_rs] = array( "id_sr" => '0', "id_nhn_rs" => '0',
						"time_nhnwsr" => '0', "details_srw" => '0',
						"liked_srw" => '0');
					$count_data_rs++;*/
				}
				
				$result_s = mysqli_query($con,"SELECT *
						FROM  `liked_post_s` 
						WHERE  `id_sr` =  '".$row['id_sr']."'");
					$score_like_s = 0;
					$user_like_s = array();
					while($row_s = mysqli_fetch_array($result_s))
					{
						$user_like_s[$score_like_s] = $row_s["id_nhn"];
						$score_like_s++;
					}
				
				$data_r[$count_data_r]["sr"][$count_data_rs] = array( "name_show_s" => $row['name_show_s'],"xeem_show" => $row['lastname_hmong_s'],"score_s" => $row['score_s'],
						"id_sr" => $row['id_sr'], "id_nhn_rs" => $row['id_nhn_rs'],
						"time_nhnwsr" => $row['time_nhnwsr'], "details_srw" => $row['details_srw'],
						"liked_srw" => $score_like_s,"user_like"=>$user_like_s);
				$count_data_rs++;
				
				//$json[0]=("")
				/*
				SELECT *
			FROM reply_webboard
			LEFT JOIN replys_sub ON reply_webboard.id_rw = replys_sub.id_rw
				*/
				//echo 'beb';
				
			}
			header("Content-Type: application/json", true);
			echo json_encode($data_r);
			exit;
		}
    }
	//echo '-*-';
?>