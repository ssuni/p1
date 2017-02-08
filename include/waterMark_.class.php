<?php
class waterMark_
{
	function addLogoPng($file, $fileTo, $waterImage, $sort)
	{
		$itemImgLogo["quality"] = "100";

		$src_im = ImageCreateFromJPEG($file);

		$water = imagecreatefrompng($waterImage); 
		list($width,$height) = getimagesize($waterImage);
		list($org_width, $org_height) = getimagesize($file);
		
		/*
			dst_image : Destination image link resource.
			src_image : Source image link resource.

			dst_x : x-coordinate of destination point.
			dst_y : y-coordinate of destination point.
			src_x : x-coordinate of source point.
			src_y : y-coordinate of source point.

			dst_w : Destination width.
			dst_h : Destination height.
			src_w : Source width.
			src_h : Source height.
		*/
		// waterImage CenterPoint
		switch($sort) {
			case 'center':
				$leftPoint = ($org_width/2) - ($width/2);
				$topPoint = ($org_height/2) - ($height/2);
				break;
			case 'leftTop':
				$leftPoint = 0;
				$topPoint = 0;
				break;
			case 'rightBottom':
				$leftPoint = $org_width - $width;
				$topPoint = $org_height - $height;
				break;
			case 'rightMiddleBottom':
				//$leftPoint = $org_width/1.1 - $width;
				//$topPoint = $org_height/1.1 - $height;
				$leftPoint = $org_width-50 - $width;
				$topPoint = $org_height-50 - $height;
				break;
		}

//		imagecopyresampled($src_im, $water, 0, 0, 0, 0, $width, $height, $width, $height);
		imagecopyresampled($src_im, $water, $leftPoint, $topPoint, 0, 0, $width, $height, $width, $height);
		
		return ImageJPEG($src_im, $fileTo, $itemImgLogo["quality"]);
	}
}
?>