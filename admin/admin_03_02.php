<? include "inc/head.php" ?>
<?
$sub_menu = '300200';
auth_check($auth[$sub_menu]);

$pageNum = 3;
$subNum = 2;
?>
<body class="commonBg">
<div id="bodyWrap">
	<? include "inc/top.php" ?>
	<div id="contentsWrap">
		<div class="leftArea">
			<? include "inc/left.php" ?>
		</div>
		<div class="rightArea">
			<div id="locationBar">
				<h2><?=$sub_tit2_2?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_2?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	include ("html/member_write.html"); ?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>