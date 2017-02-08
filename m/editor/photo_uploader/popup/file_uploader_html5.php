<?php
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

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
		$uploadDir = $bagData["absoluteDir"].'/_data/edit_img/'.date('Y').'/'.date('m').'/';
		if(!is_dir($bagData["absoluteDir"].'/_data/edit_img/'.date('Y').'/')) mkdir($bagData["absoluteDir"].'/_data/edit_img/'.date('Y').'/', 0777);
		if(!is_dir($bagData["absoluteDir"].'/_data/edit_img/'.date('Y').'/'.date('m').'/')) mkdir($bagData["absoluteDir"].'/_data/edit_img/'.date('Y').'/'.date('m').'/', 0777);
		
		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);
		
		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=".$bagData["host"]."/_data/edit_img/".date('Y')."/".date('m')."/".$file->name;
		}
		
		echo $sFileInfo;
	}
?>