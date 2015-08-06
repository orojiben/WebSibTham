<?php
	include 'connect_db.php';
	if (isset($_POST["input_name"])) 
	{
       $name = $_POST["input_name"];
	   $id = $_POST["input_id"];
	   if($con!='')
		{
			$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET `name_show`='$name' WHERE id_nhn='$id'");
			if($result){
				echo "$name";
			}
			else{
				//echo "no";
			}
		}
    }
?>