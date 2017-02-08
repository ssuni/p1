<?php
ini_set('memory_limit', '256M');
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);

 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
		// 파일명 생성
		$pathInfo = pathinfo($headers['file_name']);
		list($ms, $se) = explode(' ', microtime());
		$ms = substr($ms, 2);
		$se = substr($se, -1);
		$microtime = date("ymd").$se.$ms;
		$newFileName = $microtime.'.'.$pathInfo['extension'];

	$file = new stdClass;
	$file->name = rawurldecode($newFileName);
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$uploadDir = ROOT.'/_data/edit_img/'.date('Y').'/'.date('m').'/';
		if(!is_dir(ROOT.'/_data/edit_img/'.date('Y').'/')) mkdir(ROOT.'/_data/edit_img/'.date('Y').'/', 0777);
		if(!is_dir(ROOT.'/_data/edit_img/'.date('Y').'/'.date('m').'/')) mkdir(ROOT.'/_data/edit_img/'.date('Y').'/'.date('m').'/', 0777);
		
		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);
		
		if(file_put_contents($newPath, $file->content)) {
			
			// 썸네일
			$size = getimagesize($newPath);
			if ($size[0] > 900) {
				$max_width = 900;
				$max_height = (900 * $size[1]) / $size[0];

				$microtime = date("ymd").rand(00000000,99999999);
				$file->name  = rawurldecode($microtime.'.'.$pathInfo['extension']);

				/* 원본파일, 썸네일명, 썸네일저장위치, 썸네일가로길이, 썸네일세로길이 */
				thumnail($uploadDir.$newFileName, $file->name, $uploadDir, $max_width, $max_height);
				@unlink($uploadDir.$newFileName);
			}

			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=/_data/edit_img/".date('Y')."/".date('m')."/".$file->name;
		}
		
		echo $sFileInfo;
	}
?>