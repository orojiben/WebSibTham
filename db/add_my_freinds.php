<?php
	include 'connect_db.php';
	if (isset($_POST["input_user"]))
	{
		if($con!='')
		{
			$id = $_POST["input_user"];
			$id_f = $_POST["input_freinds"];
			$result = mysqli_query($con,"INSERT INTO  my_freinds".
			"(`id_mf`, `id_user_me`, `id_user_f`)".
			"VALUES (' ','$id','$id_f')");
			
			if(!$result){
				//echo "not-user";
			}else{
				
			}
			mysqli_close($con);
		}
	}
?>