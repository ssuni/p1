<?
$mn = 9;
$sn = 3;
$cn = 0;
?>
<? include "../include/head.php" ?>	


	<!-- container -->
	<div id="container" class="sub">
		<h2 class="title01">ONLINE COUNSEL</h2>
		<p class="top_txt">빠르고 정확하게 상담해드리겠습니다.</p>

		<?
			$tb = "online_counsel";  // $tb = 게시판생성 테이블명
			include $_SERVER['DOCUMENT_ROOT']."/board/index.php";
		?>
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	