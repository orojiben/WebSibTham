<?php
	
	include 'connect_db.php';

	   if($con!='')
		{
			if(isset($_POST['id_w']))
			{
				$id_w = $_POST['id_w'];
				$result = mysqli_query($con,"UPDATE `webboard` SET `viewed_w`=webboard.viewed_w+1 WHERE id_w='$id_w';");
			}
			mysqli_close($con);
		}
?>

