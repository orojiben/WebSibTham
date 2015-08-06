<?php
	include 'connect_db.php';
	include 'file.php';
	if(isset($_POST["input_id_w"]))
	{

		if($con!='')
		{

				$id_w =  $_POST["input_id_w"];
				$text = $_POST["input_text_post"];
				$title = $_POST["input_title_post"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"UPDATE webboard SET ".
				"`time_w` = '$date',`title` = '$title',`details_w`='$text' ".
				"WHERE id_w='$id_w'");
				
				if(!$result){
					echo "not";
				}else{
					echo "ok";
					$text = $_POST["input_text_post_r"];
					$myfile = fopen("../webboard/w_".$id_w.".php", "w");
					

					$txt = c_file($title,$text,$id_w);
					fwrite($myfile, $txt);
					fclose($myfile);
				}

		}
	}
?>