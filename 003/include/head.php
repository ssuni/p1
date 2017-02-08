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
<!DOCTYPE html>
<html lang='ko'>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name='viewport' content='width=1200,user-scalable=yes, target-densitydpi=device-dpi'>
<meta name='keywords' content='쁨클리닉' />
<meta name='description' content='서울대출신 의료진,큐오필,필러,하이코,제모,울쎄라,실리프팅,탄력,모공, 화이트닝' />
<title>예.쁨.주.의 쁨클리닉</title>

<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link rel='stylesheet' href='../css/style.css' media='all' />
<link rel='stylesheet' href='../css/layout.css' media='all' />
<?if($mn<=0){?>
<link rel='stylesheet' href='../css/main.css' media='all' />
<?}else{?>
<link rel='stylesheet' href='../css/sub.css' media='all' />
<?}?>
<link rel='stylesheet' href='../css/jquery.bxslider.css' media='all' />

<script src='../js/jquery-1.12.4.min.js'></script>
<script src='../js/jquery.bxslider.min.js'></script>
<script src='../js/common.js'></script><!-- 공통 -->
<script src='../js/gnb.js'></script><!-- 메뉴관련 -->
<?if($mn<=0){?>
<script src='../js/main.js'></script><!-- 메인관련 -->
<?}else{?>
<script src='../js/sub.js'></script><!-- 서브관련 -->
<?}?>
<script>var mn=<?=$mn?>; var sn=<?=$sn?>; var cn=<?=$cn?>;</script>
</head>

<body>

<form name="formout" action="/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="0" height="0" style="display:none;"></iframe>
<div id="main_pop">
	<div class="pop">
		<a href="#link" onclick="popClose()"><img src="../images/popup/btn_close.jpg" class="btn_close"/></a>
		<img src="../images/popup/popup.jpg"/>
	</div>
</div>


<!-- wrap -->
<div id="wrap">

	<!-- header -->
	<div id="header">

		<!-- header_top -->
		<div id="header_top">
			<div class="header_top_inner">
				<!-- util_menu -->
				<ul id="util_menu">
					<? if ($_SESSION['ss_id']) { ?>
					<li><a href="javascript:;" onclick="javascript:document.formout.submit();">Logout</a></li>
					<li><a href="/member/modify.php" target="_self">Modify</a></li>
					<? } else { ?>
					<li><a href="/member/login.php" target="_self" >Login</a></li>
					<li><a href="/member/join01.php" target="_self" >Join</a></li>
					<li><a href="http://www.ppeum1.com/" target="_self" >신논현점</a></li>
					<li><a href="http://www.ppeum3.com/" target="_self" >청담점</a></li>
					<? } ?>					
				</ul>				
				<!-- //util_menu -->
			</div>
		</div>
		<!-- //header_top -->


		<!-- gnb -->
		<div id="gnb">
			
			<h1 class="logo"><a href="/"><img src="../images/common/t_logo.jpg" alt="PPEUM"></a></h1>	
			
			<div class="gnb_list">
				<ul class="after">
					<li>
						<a href="../intro/intro01.php">쁨클리닉 소개</a>
						<ul class="sub">
							<li><a href="../intro/intro01.php">병원소개</a></li>
							<li><a href="../intro/intro02.php">둘러보기</a></li>
							<li><a href="../intro/intro03.php">의료진소개</a></li>
							<li><a href="../intro/intro04.php">진료안내/오시는길</a></li>
						</ul>
					</li>
					<li>
						<a href="../filler/filler01.php">BEST SELLER</a>					
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
						<a href="../filler/filler01.php">쁘띠 클리닉</a>					
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
						<a href="../lifting/lifting01.php">리프팅 클리닉</a>					
						<ul class="sub">
							<li><a href="../lifting/lifting01.php">실리프팅</a></li>
							<li><a href="../lifting/lifting02.php">울쎄라</a></li>
							<li><a href="../lifting/lifting03.php">LDM물방울리프팅</a></li>
							<li><a href="../lifting/lifting04.php">슈링크</a></li>
						</ul>
					</li>
					<li>
						<a href="../waxing/waxing01.php">제모/다한증 클리닉</a>					
						<ul class="sub">
							<li><a href="../waxing/waxing01.php">프리미엄 제모</a></li>
							<li><a href="../waxing/waxing02.php">남성제모</a></li>
							<li><a href="../waxing/waxing03.php">다한증</a></li>
						</ul>
					</li>
					<li>
						<a href="../body/body01.php">바디 클리닉</a>					
						<ul class="sub">
							<li><a href="../body/body01.php">종아리 조각주사</a></li>
							<li><a href="../body/body02.php">빼빼주사</a></li>
							<li><a href="../body/body03.php">클라투</a></li>
							<li><a href="../body/body04.php">HPL/카복시</a></li>
							<li><a href="../body/body05.php">걸그룹주사</a></li>
							<li><a href="../body/body06.php">미니스커트 주사</a></li>
							<li><a href="../body/body07.php">민소매 조각주사</a></li>
							<li><a href="../body/body08.php">PT주사 </a></li>
							<li><a href="../body/body09.php">지방흡입</a></li>							
						</ul>
					</li>
					<li>
						<a href="../laser/laser01.php">레이저 클리닉</a>					
						<ul class="sub">
							<li><a href="../laser/laser01.php">ALL 흉터케어</a></li>
							<li><a href="../laser/laser02.php">예쁨토닝</a></li>
							<li><a href="../laser/laser03.php">착색토닝</a></li>
							<li><a href="../laser/laser04.php">점/문신제거</a></li>
						</ul>
					</li>
					<li>
						<a href="../skin/skin01.php">스킨케어 클리닉</a>					
						<ul class="sub">
							<li><a href="../skin/skin01.php">필링MALL</a></li>
							<li><a href="../skin/skin02.php">남성전용 19분케어</a></li>
							<li><a href="../skin/skin03.php">스킨 스케일링</a></li>
						</ul>
					</li>
					<li>
						<a href="../community/community01.php">커뮤니티</a>					
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

	</div>
	<!-- //header -->	