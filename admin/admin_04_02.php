<? include "inc/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";?>
<?
$sub_menu = '400200';
auth_check($auth[$sub_menu]);

$pageNum = 4;
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
				<h2><?=$sub_title[$sub_menu]?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_title[$sub_menu]?></strong></p>
			</div>
			<div class="contentsArea">
				<!--- start : 본문 --->
<?	
		include ( "./html/holiday_config.html" );
?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>