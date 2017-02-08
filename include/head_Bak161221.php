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
<meta name='keywords' content='쁨클리닉' />
<meta name='description' content='쁨클리닉' />
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name='viewport' content='width=1200,user-scalable=yes, target-densitydpi=device-dpi' />
<title>PPEUM</title>
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
<script src='/js/right_quick.js'></script><!-- 오른쪽 퀵관련 -->
<script src='/js/jquery.easing.1.3.js'></script>
<script src="../js/gallery.js"></script>
<script type="text/javascript" src="/js/jquery.SuperSlide.2.1.1.js"></script><!--이미지롤링관련 -->
<script src='/js/gnb.js'></script><!-- 메뉴관련 -->
<script src="/js/menu.js"></script><!-- 메뉴관련 -->
<script src='/js/common.js'></script><!-- 마우스오버효과,각영역 스크롤(마우스휠),윈도우 리사이즈시 컨텐츠영역 사이즈변경 -->
<script src="/js/jquery.mousewheel.min.js"></script><!-- 스크롤(마우스휠) -->
<script src="/js/design.js"></script>

</head>
<body>

<form name="formout" action="/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="0" height="0" style="display:none;"></iframe>