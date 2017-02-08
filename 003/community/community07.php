<?
$mn = 9;
$sn = 7;
$cn = 0;
?>
<? include "../include/head.php" ?>	


	<!-- container -->
	<div id="container" class="sub">
		<h2 class="title01">PPEUM MEDIA</h2>
		<p class="top_txt">쁨클리닉의  방송/언론보도 게시판입니다.</p>

		<?
			$tb = "news";  // $tb = 게시판생성 테이블명
			include $_SERVER['DOCUMENT_ROOT']."/board/index.php";
		?>
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	