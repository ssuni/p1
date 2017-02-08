<? include "inc/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";?>
<?
$sub_menu = '200900';
auth_check($auth[$sub_menu]);

$pageNum = 2;
$subNum = 9;
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
				<h2><?=$sub_tit2_9?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_9?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	if( !$act || $act == 'list' ) {

		include ( "./html/online_counsel_list.html" );
	}

	if( $act == 'modify' ) {

		include ( "./html/online_counsel_edit.html" );
	}

	if( $act == 'edit_ok' ) {

		// 관리자 로그분석
		$logData = array(
			"table" => "tb_kakaotalk_reservation",
			"pk" => $Data["cno"],
			"content" => '성명 : ' .$Data["name"],
			"act" => "modify"
		);
		setAnalysis($logData);

		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'del_ok' ) {


			// 관리자 로그분석
			$logData = array(
				"table" => "tb_kakaotalk_reservation",
				"pk" => $row["cno"],
				"content" => '성명 : ' .$row["tblStrName"],
				"act" => "delete"
			);
			setAnalysis($logData);


		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
		exit;
	}	?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>