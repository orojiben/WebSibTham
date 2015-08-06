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
				$result = mysqli_query($con,"DELETE FROM reply_webboard ".
				"WHERE id_rw='$input_f_id'");
				
				if(!$result){
					echo "not";
				}else{
					echo "ok";
					
				}
			}
			else if($input_f_t=="s")
			{
				$result = mysqli_query($con,"DELETE FROM replys_sub ".
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