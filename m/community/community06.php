<?
$mn = 9;
$sn = 6;
$cn = 0;
?>
<? include "../include/head.php" ?>	
<? if(!$_SESSION["ss_id"]) { echo "<script>location.href='".$bagData["mdir"]."/member/login.php?ref=".urlencode($_SERVER['REQUEST_URI'])."';</script>"; } ?> 

	<!-- container -->
	<div id="container" class="board">
		<h2 class="title01">B&amp;A</h2>
		<p class="top_txt">쁨클리닉의 전후사진 게시판입니다.</p>

		<?
			$tb = "bna";  // $tb = 게시판생성 테이블명
			include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/index.php";
		?>
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	