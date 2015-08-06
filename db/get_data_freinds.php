<?php
	include 'connect_db.php';
	$name = '';
	$xeem = '';
	$my_freided = 1;
	if (isset($_POST["input_freinds"])) 
	{
       $freinds = $_POST["input_freinds"];
	   $id_user = $_POST["input_user"];
	   if($con!='')
		{
			$result = mysqli_query($con,"SELECT * 
				FROM  `user_nkauj_hmo_no` 
				WHERE  `id_nhn` =  '$freinds'");
			$row = mysqli_fetch_array($result);
			if($freinds==$row['id_nhn'])
			{
				$name = $row['name_show'];
				$xeem = $row['lastname_hmong'];
			}
			$result = mysqli_query($con,"SELECT * 
				FROM  `my_freinds` 
				WHERE  `id_user_me` =  '$id_user'
				AND  `id_user_f` =  '$freinds'");

			if($row = mysqli_fetch_array($result))
			{
				$my_freided = 0;
			}
		}
    }
	echo $my_freided.'_'.$xeem .'_'.$name;
?>