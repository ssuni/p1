<? include "inc/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";?>
<?
$sub_menu = '200600';
auth_check($auth[$sub_menu]);

$pageNum = 2;
$subNum = 6;
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
				<h2><?=$sub_tit2_6?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_6?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	if( !$act || $act == 'list' ) {		

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "20";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT cno FROM tb_counsel" );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$Query = "SELECT * FROM tb_counsel ORDER BY cno DESC LIMIT ".$startnum.", ".$linenum;
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$tmp]["number"]		= $Array["cno"];
			
			/*
			$field = explode(",", $Array["tblIntField"]);
			unset($counselValue);
			foreach($field as $k => $v) {
				$counselValue[] = $counselField[$v];
			}
			$Data[$tmp]["field"]		= implode(",", $counselValue);
			*/
			$Data[$tmp]["name"]			= $Array["tblStrName"];
			$Data[$tmp]["phone"]		= $Array["tblStrMobile"];
			$Data[$tmp]["email"]		= $Array["tblStrEmail"];
			$Data[$tmp]["cgubun"]		= $Array["cgubun"];
			
			switch( $Array["tblIntStatus"] ) {
				case "1" : $Data[$tmp]["status"]		= "<font color='blue'>접수</font>"; break;
				case "2" : $Data[$tmp]["status"]		= "<font color='FF6600'>완료</font>"; break;
				case "3" : $Data[$tmp]["status"]		= "<font color='gray'>진행중</font>"; break;
				default : $Data[$tmp]["status"]			= "<font color='blue'>접수</font>"; break;
			}
			$Data[$tmp]["regdate"]	= $Array["tblDtmRegDate"];
			$tmp++;
		}

		include ( "./html/counsel_list.html" );
	}

	if( $act == 'modify' ) {
		$Query = "SELECT * FROM tb_counsel WHERE cno='".$tNum."'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		
		$field = explode(",", $Array["tblIntField"]);
		foreach($field as $k => $v) {
			$counselChk[$v] = 'checked';
		}

		$Data["number"]		=	$Array["cno"];
		$Data["field"]		=	$Array["tblIntField"];
		$Data["name"]		=	$Array["tblStrName"];
		$Data["phone"]		=	$Array["tblStrMobile"];
		$Data["comment"]	=	stripslashes( $Array["tblStrComment"] );
		$Data["status"]		=	$Array["tblIntStatus"];
		$Data["cgubun"]		=	$Array["cgubun"];
		$Data["regdate"]	=	$Array["tblDtmRegDate"];
		$Data["email"]		=	$Array["tblStrEmail"];

		include ( "./html/counsel_edit.html" );
	}

	if( $act == 'edit_ok' ) {
		$Data["cno"]		= $_POST["tNum"];
		$Data["name"]		= $_POST["tblStrName"];
		$Data["phone"]		= $_POST["tblStrMobile"];
		$Data["field"]		= (is_array($_POST["tblIntField"]))?implode(",", $_POST["tblIntField"]):'';
		$Data["email"]		= $_POST["tblStrEmail"];
		$Data["comment"]		= $_POST["tblStrComment"];
		$Data["cgubun"]		= $_POST["cgubun"];
		$Data["status"]		= $_POST["tblIntStatus"];

		$Query = "UPDATE tb_counsel SET ";
		$Query .= "tblIntField='".$Data["field"]."',";
		$Query .= "tblStrName='".$Data["name"]."',";
		$Query .= "tblStrMobile='".$Data["phone"]."',";
		$Query .= "tblStrEmail='".$Data["email"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "cgubun='".$Data["cgubun"]."',";
		$Query .= "tblIntStatus='".$Data["status"]."' WHERE cno='".$Data["cno"]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		// 관리자 로그분석
		$logData = array(
			"table" => "tb_counsel",
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
		$Data["number"] = $_POST["chk"];
		if( count( $Data["number"] ) <= 0 ) echo "<script language='javascript'>alert('경로가 올바르지 않습니다.'); history.go(-1);</script>";
		for( $i = 0; $i < count( $Data["number"] ); $i++ ) {
			$Result = mysql_query("SELECT * FROM tb_counsel WHERE cno='".$Data["number"][$i]."'");
			$row = mysql_fetch_array( $Result );

			$Query = "DELETE FROM tb_counsel WHERE cno='".$Data["number"][$i]."'";
			$Sql = mysql_query( $Query ) or die( mysql_error() );
			
			// 관리자 로그분석
			$logData = array(
				"table" => "tb_counsel",
				"pk" => $Data["number"][$i],
				"content" => '성명 : ' .$row["tblStrName"], 
				"act" => "delete"
			);
			setAnalysis($logData);
		}
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}	?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>