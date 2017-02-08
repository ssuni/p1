<?
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
?>
<?include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
include $_SERVER['DOCUMENT_ROOT']."/include/conn_save.php";
/*
//스마트폰으로 접속시 모바일웹으로 접속
if ($_SERVER['QUERY_STRING'] != 'pc') {
	if ($_SESSION['pc'] != 'pc') {
		$arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC");
		for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) {
			if(strpos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){
				header("Location: /m".$_SERVER['REQUEST_URI']);
				exit;
			} 
		}
	}
} else {
	$_SESSION['pc'] = 'pc';
}
*/

$NOIP = explode( '.', $_SERVER["REMOTE_ADDR"] );
if( $NOIP[0] == '66' && $NOIP[1] == '249' ){
        echo "<script>";
        echo "  history.go(-1);";
        echo "</script>";
        exit;
} ?> 
<!DOCTYPE HTML>
<html lang='ko'>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=720, user-scalable=no, target-densitydpi=device-dpi" >
<meta property="og:image" content="http://www.ppeum1.com/logo.jpg">
<meta property="og:keywords" content="쁨클리닉">
<meta property="og:description" content="서울대출신 의료진,큐오필, 필러,하이코,제모,울쎄라,실리프팅,지방흡입,신논현역">
<title>예.쁨.주.의 쁨클리닉</title>

<link rel='stylesheet' href='../css/style.css' media='all' />
<link rel='stylesheet' href='../css/layout.css' media='all' />
<link rel='stylesheet' href='../css/jquery.bxslider.css' media='all' />
<link rel='stylesheet' href='../css/fixedstyle.css' media='all' />

<?if($mn<=0){?>
<link rel='stylesheet' href='../css/main.css' media='all' />
<?}else{?>
<link rel='stylesheet' href='../css/sub.css' media='all' />
<?}?>

<script src='../js/jquery-1.12.4.min.js'></script>
<script src='../js/jquery.bxslider.min.js'></script>
<script src='../js/gnb.js'></script><!-- 메뉴관련 -->
<?if($mn<=0){?>
<script src='../js/main.js'></script><!-- 메인관련 -->
<?}else{?>
<script src='../js/gallery.js'></script><!-- 메인관련 -->
<?}?>
<? if ($mn || $sn || $cn) { ?>
<script>var mn=<?=$mn?>; var sn=<?=$sn?>; var cn=<?=$cn?>;</script>
<? } ?>


<script src='../js/gnb_fixed.js'></script><!-- 메인관련 -->




</head>
<body>

<form name="formout" action="<?=$bagData["mdir"];?>/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="0" height="0" style="display:none;"></iframe>
<div id="wrap">
	<div class="hs_menu">
		<header id="header">
			<a href="#open" class="btn_menu">메뉴토글</a>
			<h1><a href="../"><img src="../images/common/t_logo.jpg" alt=""></a></h1>
			<a href="tel:025933344" class="btn_tel">02-593-3344</a>
	
			<ul class="top_menu">
				<li><a href="../intro/intro01.php"><img src="../images/common/tmenu01.jpg" alt="병원소개"></a></li>
				<li><a href="../filler/filler01.php"><img src="../images/common/tmenu02.jpg" alt="bestseller"></a></li>
				<li><a href="../community/community02.php"><img src="../images/common/tmenu03.jpg" alt="EVENT"></a></li>
				<li><a href="../community/community03.php"><img src="../images/common/tmenu04.jpg" alt="온라인상담"></a></li>
			</ul>                      
		</header>
		<!-- gnb -->
		<div id="gnb">				
			<ul class="gnb_list">
				<li class="active">
					<a href="javascript:void(0);">쁨클리닉 소개</a>
					<ul class="sub">
						<li><a href="../intro/intro01.php">병원소개</a></li>
						<li><a href="../intro/intro02.php">둘러보기</a></li>
						<li><a href="../intro/intro03.php">의료진소개</a></li>
						<li><a href="../intro/intro04.php">진료안내/오시는길</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">BEST SELLER</a>					
					<ul class="sub">
						<li><a href="../filler/filler01.php">큐오필플러스</a></li>
						<li><a href="../filler/filler02.php">하이코</a></li>
						<li><a href="../filler/filler07.php">아나운서얼굴주사</a></li>
						<li><a href="../body/body01.php">종아리 조각주사</a></li>
						<li><a href="../waxing/waxing01.php">프리미엄 제모</a></li>
						<li><a href="../body/body02.php">빼빼주사</a></li>
						<li><a href="../skin/skin02.php">남성전용존</a></li>
						<li><a href="../body/body09.php">지방흡입</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">쁘띠 클리닉</a>					
					<ul class="sub">
						<li><a href="../filler/filler01.php">큐오필플러스</a></li>
						<li><a href="../filler/filler02.php">하이코</a></li>
						<li><a href="../filler/filler03.php">필러</a></li>
						<li><a href="../filler/filler04.php">보톡스</a></li>
						<li><a href="../filler/filler05.php">윤곽주사</a></li>
						<li><a href="../filler/filler06.php">조각주사</a></li>
						<li><a href="../filler/filler07.php">아나운서얼굴주사</a></li>
						<li><a href="../filler/filler08.php">물광주사</a></li>
						<li><a href="../filler/filler09.php">입꼬리필러</a></li>
						<li><a href="../filler/filler10.php">코 조각주사</a></li>
						<li><a href="../filler/filler11.php">목주름필러</a></li>	
						<li><a href="../filler/filler12.php">파워V윤곽술</a></li>	
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">리프팅 클리닉</a>					
					<ul class="sub">
						<li><a href="../lifting/lifting01.php">실리프팅</a></li>
						<li><a href="../lifting/lifting02.php">울쎄라</a></li>
						<li><a href="../lifting/lifting03.php">LDM물방울리프팅</a></li>
						<li><a href="../lifting/lifting04.php">슈링크</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">제모/다한증 클리닉</a>					
					<ul class="sub">
						<li><a href="../waxing/waxing01.php">프리미엄 제모</a></li>
						<li><a href="../waxing/waxing02.php">남성제모</a></li>
						<li><a href="../waxing/waxing03.php">다한증</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">바디 클리닉</a>					
					<ul class="sub">
						<li><a href="../body/body01.php">종아리 조각주사</a></li>
						<li><a href="../body/body02.php">빼빼주사</a></li>
						<li><a href="../body/body03.php">클라투</a></li>
						<li><a href="../body/body04.php">HPL/카복시</a></li>
						<li><a href="../body/body05.php">걸그룹주사</a></li>
						<li><a href="../body/body06.php">미니스커트 주사</a></li>
						<li><a href="../body/body07.php">민소매 조각주사</a></li>
						<li><a href="../body/body08.php">PT주사</a></li>
						<li><a href="../body/body09.php">지방흡입</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">레이저 클리닉</a>					
					<ul class="sub">
						<li><a href="../laser/laser01.php">ALL 흉터케어</a></li>
						<li><a href="../laser/laser02.php">예쁨토닝</a></li>
						<li><a href="../laser/laser03.php">착색토닝</a></li>
						<li><a href="../laser/laser04.php">점/문신제거</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">스킨케어 클리닉</a>					
					<ul class="sub">
						<li><a href="#">필링MALL</a></li>
						<li><a href="../skin/skin02.php">남성전용 19분케어</a></li>
						<li><a href="../skin/skin03.php">스킨 스케일링</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">커뮤니티</a>					
					<ul class="sub">
						<li><a href="../community/community01.php">공지사항</a></li>
						<li><a href="../community/community02.php">이벤트</a></li>
						<li><a href="../community/community03.php">온라인상담</a></li>
						<li><a href="../community/community04.php">카카오톡상담</a></li>
						<li><a href="../community/community05.php">시술후기</a></li>
						<li><a href="../community/community06.php">전후사진</a></li>
						<li><a href="../community/community07.php">쁨 MEDIA</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- //gnb -->



		
