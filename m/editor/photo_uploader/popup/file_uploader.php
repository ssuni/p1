<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$uploadDir = '/home/cmruby/www/_data/edit_img/'.date("Y")."/".date("m")."/";
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
	
		// 파일명 생성
		$pathInfo = pathinfo($_FILES['Filedata']['name']);
		list($ms, $se) = explode(' ', microtime());
		$ms = substr($ms, 2);
		$se = substr($se, -1);
		$microtime = date("Ymd").$se.$ms;
		$newFileName = $microtime.'.'.$pathInfo['extension'];

		$newPath = $uploadDir.$newFileName;
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=/_data/edit_img/".urlencode(urlencode($name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>