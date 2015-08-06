<?php
	if(isset($_POST['input_img_user_f']))
	{
		$img_user_f = $_POST['input_img_user_f'];
		$user_sex = $_POST['input_user_sex'];
		$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
		$result = mysqli_query($con,"SELECT * 
					FROM  `user_nkauj_hmo_no` 
					WHERE  `username` =  '$img_user_f'");
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		$img_user_id = '';
		if($img_user_f==$row['username'])
		{
			$img_user_id = $row['id_nhn'];
		}
		$images = '';
		if($user_sex==0)
		{
			$images = 'm_0.png';
		}
		else if($user_sex==1)
		{
			$images = 'f_0.png';
		}
		//$images = 'm_0.png';
		//$pass = img_user_f;
		$new_images = $img_user_id.'.jpg';//$_FILES["image"]["name"];
		$width=185; //*** Fix Width & Heigh (Autu caculate) ***//

		$size=GetimageSize($images);

		$height=round($width*$size[1]/$size[0]);

		$images_orig = ImageCreateFromPNG($images);

		$photoX = ImagesX($images_orig);

		$photoY = ImagesY($images_orig);

		$images_fin = ImageCreateTrueColor($width, $height);

		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

		ImageJPEG($images_fin,$new_images);

		ImageDestroy($images_orig);

		ImageDestroy($images_fin);
	}
?>