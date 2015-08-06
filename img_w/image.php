<?php
	if(isset($_FILES["image"]))
	{
		$images = $_FILES["image"]["tmp_name"];
		if(filesize($images)>700000)
		{
			echo 'file';
		}
		else
		{
			date_default_timezone_set('Asia/Bangkok');
			$date = new DateTime();
			$name = $_GET["t"]."_".$_GET["id"].".jpg";
				
				
			
			$con=mysqli_connect("localhost","admin_nkuajhmono","PW8lkmLlp5@&","admin_nkuajhmono");
			$result = mysqli_query($con,"INSERT INTO  img_iw".
					"(`file`)".
					"VALUES ('$name')");
			mysqli_close($con);
			
			$size=GetimageSize($images);
			$width=$size[0]; //*** Fix Width & Heigh (Autu caculate) ***//
			$height=$size[1];
			if($width>900)
			{
				$persent = (900*100.0)/$width;
				$width = 900;
				$height = $height*$persent*0.01;
			}
			if($_FILES["image"]["type"]=='image/jpeg'){
						$images_orig = ImageCreateFromJPEG($images);
					}else if($_FILES["image"]["type"]=='image/png'){
						$images_orig = ImageCreateFromPNG($images);
					}else if($_FILES["image"]["type"]=='image/gif'){
						$images_orig = ImageCreateFromGIF($images);
					}

			$photoX = ImagesX($images_orig);

			$photoY = ImagesY($images_orig);
			
			//echo filesize($images);
			
			$images_fin = ImageCreateTrueColor($width, $height);

			ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

			ImageJPEG($images_fin,$name);

			ImageDestroy($images_orig);

			ImageDestroy($images_fin);
			
			echo ''.$name;
		}
	}
	echo '';
?>