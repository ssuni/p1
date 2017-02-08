<?
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
include $_SERVER['DOCUMENT_ROOT']."/include/conn_save.php";
?>
<!DOCTYPE html>
<html lang='ko'>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name='viewport' content='width=1200,user-scalable=yes, target-densitydpi=device-dpi'>
<meta property="og:image" content="http://www.ppeum1.com/logo.jpg">
<meta name='keywords' content='쁨클리닉' />
<meta name='description' content='서울대출신 의료진,큐오필, 필러,하이코,제모,울쎄라,실리프팅,지방흡입,신논현역' />
<title>예.쁨.주.의 쁨클리닉</title>
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/css/layout.css' media='all' />
<link href="/css/main_roll.css" rel="stylesheet" type="text/css"><!--이미지롤링관련 -->
<link rel='stylesheet' href='../css/gallery.css' media='all' />

<script>
// 서브인지 아닌지 체크
var isSub = false; 
// 메뉴,퀵메뉴 숨김되는 가로사이즈
var hideW = 1480;
// 메인 오른쪽 배너 열림상태
var isRBannerOpen = false;
</script>

<script src='/js/jquery-1.11.2.min.js'></script>
<script src='/js/jquery.easing.1.3.js'></script>
</head>
<body>

<form name="formout" action="/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="0" height="0" style="display:none;"></iframe>