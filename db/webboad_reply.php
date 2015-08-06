<?php
	
	include 'connect_db.php';
	
	$details = '';
				$score_user_w  ='';
				$xeem_user_w  = '';
	if (isset($_POST["input_id"])) 
	{
       $input_id = $_POST["input_id"];
	   $input_t = $_POST["input_t"];

	   if($con!='')
		{
			if($input_t=='r')
			{
				$result = mysqli_query($con,"SELECT * 
						FROM  `reply_webboard` 
						WHERE  `id_rw` =  '$input_id'");
				if($row = mysqli_fetch_array($result))
				{

					$details = $row['details_rw'];


				}
			}
			else if($input_t=='s')
			{
				$result = mysqli_query($con,"SELECT * 
						FROM  `replys_sub` 
						WHERE  `id_sr` =  '$input_id'");
				if($row = mysqli_fetch_array($result))
				{

					$details = $row['details_srw'];


				}
			}
			mysqli_close($con);
			header("Content-Type: application/json", true);
			$data_r = array("details"=>$details);
			echo json_encode($data_r);
			exit;
		}
    }
	//echo '-*-';
?>