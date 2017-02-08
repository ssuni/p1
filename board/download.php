<?	
	$FilePathName = $_SERVER['DOCUMENT_ROOT']."/_data/$tb/$FileName";  // 
	$FileSize = filesize($FilePathName); // 사이즈
	if( $fp = @fopen( $FilePathName,"rb")) {
	$FileOriName = iconv( "UTF-8", "utf-8", $_GET["wn"] );
	if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		 Header("Content-type: application/octet-stream"); 
		 Header("Content-Length: ".$FileSize);    
		 Header("Content-Disposition: attachment; filename=".$FileOriName);   
		 Header("Content-Transfer-Encoding: binary");   
		 Header("Pragma: no-cache");   
		 Header("Expires: 0");   
	} else { 
		 Header("Content-type: file/unknown; char");
		 Header("Content-Length: ".$FileSize); 
		 Header("Content-Disposition: attachment; filename=".$FileOriName); 
		 Header("Content-Description: PHP3 Generated Data"); 
		 Header("Pragma: no-cache"); 
		 Header("Expires: 0"); 
	}
	while ($data=fread($fp,filesize( $FilePathName)))
	{ 
		print($data); 
	}
	fclose($fp);
	}   
?>