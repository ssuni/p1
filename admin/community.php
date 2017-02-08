<? include "inc/head.php" ?>
<?
$sub_menu = '500100';
auth_check($auth[$sub_menu]);

$pageNum = 5;
$subNum = 1;
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
				<h2><?=$sub_tit2_1?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_1?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	$sql = "SELECT tblBname FROM tblBoardManager where tblBtable='$tb'";
$stmt=mysql_query($sql);
$rs=mysql_fetch_array($stmt);
$bname=$rs["tblBname"];
mysql_free_result($stmt);	?>

			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="12"></td>
				</tr>
				<tr>
					<td>
					<!-- 예약 처리 대상자-->
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="main_title_01" style="font-size:16pt;padding:0 0 0 15px;"><?=$bname?></td>
							<td width="100" align="right"><a href="/admin/admin_05_01.php?act=add">[게시판 목록]</a></td>
						</tr>
					</table>					
					<? include $_SERVER['DOCUMENT_ROOT']."/board/index.php"; ?>
					</td>
				</tr>
			</table>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>