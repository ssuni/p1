<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";		
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

if($_SESSION["ss_id"]=='' || !$_SESSION["ss_id"] || $_SESSION["ss_level"] > 2){
	Header("Location:http://".$bagData["host"]."/admin/");
	exit;	
}	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::<?=$bagData["siteName"]?> 관리자페이지:::</title>
<link href="/admin/css/admin.css" rel="stylesheet" type="text/css" />
<script src="/admin/js/design_js.js"></script>
<script src="/js/total.js"></script>
<!-- 익스6 png 핵 - (div 내에서 배경png 적용시에 사용, 태그내에 a 링크 사용가능) -->
<!--[if IE 6]>
<script type="text/javascript" src="/admin/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
 DD_belatedPNG.fix('img, #bodyWrap');
</script>
<![endif]-->
</head>