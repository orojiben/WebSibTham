<?php
	include 'connect_db.php';
	
	if(isset($_POST["input_f_t"]))
	{

		if($con!='')
		{
			$input_f_t = $_POST["input_f_t"];
			$input_f_id = $_POST["input_f_id"];
			
			if($input_f_t=="r")
			{

				$text = $_POST["input_text_post"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"UPDATE reply_webboard SET ".
				"`time_rw` = '$date',`details_rw`='$text' ".
				"WHERE id_rw='$input_f_id'");
				
				if(!$result){
					echo "not";
				}else{
					echo "ok";
					
				}
			}
			else if($input_f_t=="s")
			{

				$text = $_POST["input_text_post"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"UPDATE replys_sub SET ".
				"`time_nhnwsr` = '$date',`details_srw`='$text' ".
				"WHERE id_sr='$input_f_id'");
				
				if(!$result){
					echo "not";
				}else{
					echo "ok";
					
				}
			}
		}
	}
?>