<? include "inc/head.php" ?>
<?
$sub_menu = '700100';
auth_check($auth[$sub_menu]);

$pageNum = 7;
$subNum = 1;
if($act=='modify'){
	$subNum = 2;
}else if($act=='log'){
	$subNum = 3;
}else if($act=='exam'){
	$subNum = 4;
}
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
<?	// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		$whereIs = "WHERE tblIntGP='".$_SESSION["ss_gp"]."'";
	}
	
	if( !$act || $act == 'list' ) {
		$whereIs = ( $whereIs ) ? $whereIs : "";
		/*검색에 사용할 변수 설정 시작*/
		$sh["level"]		= $level;
		$sh["place"]		= $place;
		$sh["sex"]			= $sex;
		$sh["blnemail"] = $blnemail;
		$sh["blnsms"]		= $blnsms;
		$sh["age"]			= $age;
		$sh["search"]		= $search;
		$sh["keyword"]	= $keyword;
		/*검색에 사용할 변수 설정 끝*/

		if( trim( $sh["level"] ) != '' ) {
			$whereIs .= ( $whereIs ) ? " AND tblIntLevel='".$sh["level"]."'" : "WHERE tblIntLevel='".$sh["level"]."'";
		}

		if( $sh["place"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblIntFirAddr='".$sh["place"]."'" : "WHERE tblIntFirAddr='".$sh["place"]."'";
		}
		
		if( $sh["sex"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblStrSex='".$sh["sex"]."'" : "WHERE tblStrSex='".$sh["sex"]."'";
		}
		
		if( $sh["blnemail"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblBlnEmail='".$sh["blnemail"]."'" : "WHERE tblBlnEmail='".$sh["blnemail"]."'";
		}

		if( $sh["blnsms"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblBlnSms='".$sh["blnsms"]."'" : "WHERE tblBlnSms='".$sh["blnsms"]."'";
		}
		
		if( $sh["age"] ) {
			$sh["age2"]	=	( $sh["age"] < 80 ) ? $sh["age"] + 9 : 200;
			$whereIs .= ( $whereIs ) ? " AND tblIntAge>='".$sh["age"]."' AND tblIntAge<='".$sh["age2"]."'" : "WHERE tblIntAge<='".$sh["age"]."' AND tblIntAge<='".$sh["age2"]."'";
		}
		
		if( $sh["search"] && $sh["keyword"] ) {
			$whereIs .= ( $whereIs ) ? " AND ".$sh["search"]." LIKE '%".$sh["keyword"]."%'" : "WHERE ".$sh["search"]." LIKE '%".$sh["keyword"]."%'";
		}

		/* 페이지 설정 시작 */
		$p = ( !$p ) ? "1" : $p;
		$boardSet["linenumber"] = ( $boardSet["linenumber"] ) ? $boardSet["linenumber"] : "20";
		$startnum = ( $p - 1 ) * $boardSet["linenumber"];
		$countQuery = mysql_query( "SELECT tblNumber FROM tblPerMember ".$whereIs );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $boardSet["linenumber"] )+1;
		/* 페이지 설정 끝   */

		$tmp = 0;
		$Query = "SELECT * FROM tblPerMember ".$whereIs." ORDER BY tblDtmRegDate ASC limit ".$startnum.",".$boardSet["linenumber"];
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$tmp]["number"] = $Array["tblNumber"];
			$Data[$tmp]["level"]	= $memberNameArr[$Array["tblIntLevel"]];
			$Data[$tmp]["id"]			= $Array["tblStrID"];
			$Data[$tmp]["name"]		= $Array["tblStrName"];
			$Data[$tmp]["fir"]		= $placeArr[$Array["tblIntFirAddr"]];
			$Data[$tmp]["mobile"]	= $Array["tblStrMobile"];
			$Data[$tmp]["email"]	= $Array["tblStrEmail"];
			$Data[$tmp]["sex"]		= ( $Array["tblStrSex"] == 'M' ) ? "남자" : "여자";
			$Data[$tmp]["age"]		= $Array["tblIntAge"];
			$tmp++;
		}

		/*상용구*/
		$xfQuery = "SELECT * FROM tblSmsField ORDER BY tblIntOrder ASC";
		$xfSql = mysql_query( $xfQuery );
		$xfData[0]["number"]		= "";
		$xfData[0]["name"]	= "전체";
		$xfmp = 1;
		While( $xfArray = mysql_fetch_array( $xfSql ) ) {
			$xfData[$xfmp]["number"]	= $xfArray["tblNumber"];
			$xfData[$xfmp]["name"]		= $xfArray["tblStrName"];
			$xfData[$xfmp]["order"]		= $xfArray["tblIntOrder"];
			$xfmp++;
		}

		/*상용구용 페이징*/
		$subQuery = ( $field ) ? "WHERE tblIntField='".$field."'" : "";

		/*$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "8";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblSmsExam ".$subQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;*/
		/*/상용구용 페이징*/

		
		$xQuery = "SELECT * FROM tblSmsExam ".$subQuery;//." LIMIT ".$startnum.", ".$linenum;
		$xSql = mysql_query( $xQuery );
		$xmp = 0;
		while( $xArray = mysql_fetch_array( $xSql ) ) {
			$xData[$xmp]["number"]	= $xArray["tblNumber"];
			$xData[$xmp]["field"]		= $xArray["tblIntField"];
			$xData[$xmp]["subject"]	= $xArray["tblStrSubject"];
			$xData[$xmp]["comment"]	= $xArray["tblStrComment"];
			$xmp++;
		}
		include ( "./html/sms_list.html" );
	}

	if( $act == 'modify' ) {

		$Query = "SELECT * FROM tblSmsSave";
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$Array["tblIntType"]]["type"]			=	$Array["tblIntType"];
			$Data[$Array["tblIntType"]]["use"]			=	$Array["tblStrUse"];
			$Data[$Array["tblIntType"]]["comment"]	=	$Array["tblStrComment"];
		}

		include "./html/sms_edit.html";
	}

	if( $act == 'edit_ok' ) {
		for( $i = 1; $i < count( $smsSaveTypeArr ); $i++ ) {
			$Data["type"]	= $i;
			$Data["use"]	= ( ${"strUse_$i"} == 'Y' ) ? "Y" : "N";
			$Data["comment"]	= addslashes( ${"strComment_$i"} );

			$Query = "UPDATE tblSmsSave SET ";
			$Query .= "tblIntType='".$Data["type"]."',";
			$Query .= "tblStrUse='".$Data["use"]."',";
			$Query .= "tblStrComment='".$Data["comment"]."' WHERE tblIntType='".$i."'";
			$Sql = mysql_query( $Query ) or die( mysql_error() );

			echo "<script language='javascript'>";
			echo "	location.href='$PHP_SELF?act=modify';";
			echo "</script>";
		}
	}

	if( $act == 'exam' ) {
		$fieldQuery	= "SELECT * FROM tblSmsField ORDER BY tblIntOrder ASC";
		$fieldSql	= mysql_query( $fieldQuery );
		$fieldData[0]["number"]	= "";
		$fieldData[0]["name"]		= "전체";
		$nFldCnt	= 1;
		while ( $fieldArray = mysql_fetch_array( $fieldSql ) ){
			$fieldData[$fieldArray["tblNumber"]]["number"]	= $fieldArray["tblNumber"];
			$fieldData[$fieldArray["tblNumber"]]["name"]		= $fieldArray["tblStrName"];
			$nFldCnt++;
		}

		$subWhere = "";
		$whereData["field"] = ( $field ) ? $field : "";
		if( $whereData["field"] ) {
			$searchQuery = ( $subWhere ) ? " AND tblIntField='".$whereData["field"]."'" : "WHERE tblIntField='".$whereData["field"]."'";
		}
		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "8";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblSmsExam ".$searchQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$Query = "SELECT * FROM tblSmsExam ".$searchQuery." ORDER BY tblIntField DESC LIMIT ".$startnum.", ".$linenum;
		$Sql = mysql_query( $Query );
		$tmp = 0;
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data["chk"]	=	( $tmp == 0 ) ? $Array["tblIntField"] : $Data["chk"];
			if( $Data["chk"] != $Array["tblIntField"] ) {
				$tmp = 0;
			}
			$Data[$Data["chk"]]["number"][$tmp]	=	$Array["tblNumber"];
			$Data[$Data["chk"]]["field"][$tmp]	=	$Array["tblIntField"];
			$Data[$Data["chk"]]["subject"][$tmp]	=	$Array["tblStrSubject"];
			$Data[$Data["chk"]]["comment"][$tmp]	=	$Array["tblStrComment"];
			$tmp++;
		}

		include "./html/sms_exam.html";
	}

	if( $act == 'log' ) {

		$subQuery = ( $sGp ) ? "WHERE tblIntGP='".$sGp."'" : "";

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "30";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblSmsLogs ".$subQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$Query = "SELECT * FROM tblSmsLogs ".$subQuery." ORDER BY tblDtmRegDate DESC LIMIT ".$startnum.", ".$linenum;
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$tmp]["viewnumber"]	= $viewCount;
			$Data[$tmp]["number"]			= $Array["tblNumber"];
			$Data[$tmp]["sender"]			= $Array["tblStrSender"];
			$Data[$tmp]["addressee"]	= $Array["tblStrAddressee"];
			$Data[$tmp]["comment"]		= $Array["tblStrComment"];
			$Data[$tmp]["ip"]					= $Array["tblStrIp"];
			//$Data[$tmp]["status"]			= ( $Array["tblStrStatus"] == 'Y' ) ? "<font color='blue'>성공</font>" : "<font color='ff6600'>실패</font>";
			$Data[$tmp]["status"]			= ( $Array["tblStrStatus"] == 'Y' ) ? "<img src='/admin/img/icon_o.gif' align='absmiddle'>" : "<img src='/admin/img/icon_x.gif' align='absmiddle'>";
			$Data[$tmp]["gp"]					= $GPArray[$Array["tblIntGP"]];
			$Data[$tmp]["regdate"]		= $Array["tblDtmRegDate"];
			$viewCount--;
			$tmp++;
		}
		include "./html/sms_logs.html";
	}	?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>