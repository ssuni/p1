<?
$mn = 9;
$sn = 2;
$cn = 0;
?>
<? include "../include/head.php" ?>	


	<!-- container -->
	<div id="container" class="sub">
		<h2 class="title01">EVENT</h2>
		<p class="top_txt">쁨클리닉의 이벤트 게시판입니다.</p>

		<?
			$tb = "event";  // $tb = 게시판생성 테이블명
			include $_SERVER['DOCUMENT_ROOT']."/board/index.php";
		?>

	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	