<?php
	include 'connect_db.php';
	if (isset($_POST["input_user"]))
	{
		if($con!='')
		{
			$id = $_POST["input_user"];
			$id_f = $_POST["input_freinds"];

			$result = mysqli_query($con,"DELETE FROM `my_freinds` WHERE  `id_user_me` =  '$id' AND  `id_user_f` =  '$id_f'") or die(mysqli_error($con));
			
			if(!$result){
				//echo $id_f."not-user$id";
			}else{
				
			}
			mysqli_close($con);
		}
	}
?>