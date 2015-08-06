<?php
	if(isset($_FILES["image"]))
			{
				$id = $_GET["id"];
				$images = $_FILES["image"]["tmp_name"];

				$new_images = $id.'.jpg';

				$width=185;

				$size=GetimageSize($images);

				$height=round($width*$size[1]/$size[0]);
				//header ("Content-type: image/jpeg"); 
				if($_FILES["image"]["type"]=='image/jpeg'){
					$images_orig = ImageCreateFromJPEG($images);
				}else if($_FILES["image"]["type"]=='image/png'){
					$images_orig = ImageCreateFromPNG($images);
				}else if($_FILES["image"]["type"]=='image/gif'){
					$images_orig = ImageCreateFromGIF($images);
				}
				$photoX = ImagesX($images_orig);

				$photoY = ImagesY($images_orig);

				$images_fin = ImageCreateTrueColor($width, $height);

				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
				
				ImageJPEG($images_fin,$new_images);
				
				ImageDestroy($images_orig);

				ImageDestroy($images_fin);
				
				$data = fread(fopen($new_images , "r"), filesize($new_images));
				$data = base64_encode($data);
				echo $data;
				
			}

	?>