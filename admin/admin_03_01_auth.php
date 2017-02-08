<? include "inc/head.php" ?>
<?
$sub_menu = '300100';
auth_check($auth[$sub_menu]);

$pageNum = 3;
$subNum = 1;

// 부관리자 체크
$Query = "SELECT * FROM tblPerMember WHERE tblNumber='".$tNum."'";
$Sql = mysql_query( $Query );
$Array = mysql_fetch_array( $Sql );
if ($Array['tblIntLevel'] != 2) {
	echo "<script language='javascript'>";
	echo "	alert('부관리자 회원의 정보만 접근가능합니다.');";
	echo "	history.go(-1);";
	echo "</script>";
	exit;
}

$menu = mysql_fetch_array(mysql_query("SELECT * FROM auth_menu WHERE mb_id='".$Array['tblStrID']."'"));
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
				<h2><?=$sub_tit2_1?>	</h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong>관리권한설정</strong></p>
			</div>
			<div class="contentsArea">
				<!--- start : 본문 --->
<?	
		include ("html/member_auth.html");
?>

				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>