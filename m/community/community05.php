<?
$mn = 9;
$sn = 5;
$cn = 0;
?>
<? include "../include/head.php" ?>	


	<!-- container -->
	<div id="container" class="board">
		<h2 class="title01">시술후기</h2>
		<p class="top_txt">쁨클리닉의 시술후기 게시판입니다.</p>

		<?
			$tb = "replyboard";  // $tb = 게시판생성 테이블명
			include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/index.php";
		?>
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	