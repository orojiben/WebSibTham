<?php
	include 'connect_db.php';
	include 'file.php';
	
	if(isset($_POST["input_user"]))
	{
		$value = '';
		$value_id = '';
		if($con!='')
		{
			if($_POST["input_f_t"]=="ww")
			{
				$id = $_POST["input_user"];
				$text = $_POST["input_text_post"];
				$title = $_POST["input_title_post"];
				$select = $_POST["input_select_cp"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"INSERT INTO  webboard".
				"(`id_w`, `id_nhn`, `time_w`,`title`,`details_w`,`viewed_w`,`category`)".
				"VALUES (' ','$id','$date','$title','$text','0','$select')");
				
				if(!$result){
					$value = "not";
				}else{
					$result = mysqli_query($con,"SELECT w.id_w FROM webboard w WHERE ".
					"w.id_nhn = '$id' and w.title = '$title' and w.time_w = '$date'");
					if($row = mysqli_fetch_array($result))
					{
						$value_id = $row['id_w'];
					}
					
					$value = "ok";
					$text = $_POST["input_text_post_r"];
					$myfile = fopen("../webboard/w_".$value_id.".php", "w");
					

					$txt = c_file($title,$text,$value_id);
					fwrite($myfile, $txt);
					fclose($myfile);
					$result = mysqli_query($con,"UPDATE `user_nkauj_hmo_no` SET
						`score`=user_nkauj_hmo_no.score+2 WHERE id_nhn='$id';");
				}
			}
			else if($_POST["input_f_t"]=="w")
			{
				$f_id = $_POST["input_f_id"];
				$id = $_POST["input_user"];
				$text = $_POST["input_text_post"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"INSERT INTO reply_webboard".
				"(`id_rw`, `id_nhn`,`id_w`, `time_rw`,`details_rw`)".
				"VALUES (' ','$id','$f_id','$date','$text')");
				if(!$result){
					$value = "not";
				}else{
					$value = "ok";
					$result = mysqli_query($con,"SELECT rw.id_rw FROM reply_webboard rw WHERE ".
					"rw.id_nhn = '$id' and rw.id_w = '$f_id' and rw.time_rw = '$date'");
					if($row = mysqli_fetch_array($result))
					{
						$value_id = $row['id_rw'];
					}
				}
			}
			else if($_POST["input_f_t"]=="r")
			{
				$f_id = $_POST["input_f_id"];
				$id = $_POST["input_user"];
				$text = $_POST["input_text_post"];
				$date =  date("Y-m-d H:i:s");
				$result = mysqli_query($con,"INSERT INTO  replys_sub".
				"(`id_sr`, `id_nhn_rs`,`id_rw`, `time_nhnwsr`,`details_srw`)".
				"VALUES (' ','$id','$f_id','$date','$text')");
				if(!$result){
					$value = "not";
				}else{
					$value = "ok";
					$result = mysqli_query($con,"SELECT rw.id_sr FROM replys_sub rw WHERE ".
					"rw.id_nhn_rs = '$id' and rw.id_rw = '$f_id' and rw.time_nhnwsr = '$date'");
					if($row = mysqli_fetch_array($result))
					{
						$value_id = $row['id_sr'];
					}
				}
			}
			mysqli_close($con);
			
			$data_r = array("f_id"=>$_POST["input_f_id"],"f_t"=>$_POST["input_f_t"],"value" => $value ,"value_id" => $value_id ,"id" => $id ,"text" => $text ,
			"date" => $date);
			header("Content-Type: application/json", true);
			
			echo json_encode($data_r);
			exit;
		}
	}
?>