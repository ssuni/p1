<? include "inc/head.php" ?>
<?
$sub_menu = '200100';
auth_check($auth[$sub_menu]);

$pageNum = 2;
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
<?if($_SERVER['REMOTE_ADDR'] == '125.131.120.61'){

$db_host="db.ppeum2.com";
$db_user="bettey";
$db_pass="gmlwjd23!!!";
$db_name="dbbettey";

	$connect1 = mysql_connect($db_host, $db_user, $db_pass);	
	mysql_select_db($db_name, $connect1);
	if (!$connect1) {
		$errno=mysql_errno($connect1);
		$errmsg=mysql_error($connect1);
		echo "데이터 베이스에 연결할 수 없습니다.<br>";
		echo "에러코드: $errno, $errmsg ";
		exit;
	}
	mysql_query('set names utf8');

$sSelQuery	= "SELECT * FROM tbl_online_counsel order by tblNumber desc";
		$rSelQuery	= mysql_query($sSelQuery);

		while ( $aSelQuery = mysql_fetch_array($rSelQuery) ){
	
		
		}
		

			}?>
				<!--- start : 본문 --->
<?	
	if( !$act || $act == 'list' ) {
		$g_rStatus	= Array("대기", "게시", "만료");
		$sSelQuery	= "SELECT * FROM tblPopup ORDER BY tblDtmRegDate DESC";
		$rSelQuery	= mysql_query($sSelQuery);
		$nTmp	= 0;
		while ( $aSelQuery = mysql_fetch_array($rSelQuery) ){
			$arrList[$nTmp]['number']		= $aSelQuery['tblNumber'];
			$arrList[$nTmp]['subject']	= $aSelQuery['tblStrSubject'];
			$arrList[$nTmp]['comment']	= $aSelQuery['tblStrComment'];
			$arrList[$nTmp]['top']			= $aSelQuery['tblIntTop'];
			$arrList[$nTmp]['left']			= $aSelQuery['tblIntLeft'];
			$arrList[$nTmp]['width']		= $aSelQuery['tblIntWidth'];
			$arrList[$nTmp]['height']		= $aSelQuery['tblIntHeight'];
			$arrList[$nTmp]['device']		= $aSelQuery['tblStrDevice'];
			$arrList[$nTmp]['sdate']		= $aSelQuery['tblDtmSdate'];
			$arrList[$nTmp]['edate']		= $aSelQuery['tblDtmEdate'];
			$arrList[$nTmp]['regdate']	= $aSelQuery['tblDtmRegDate'];

			if ( date("Y-m-d") < $aSelQuery['tblDtmSdate'] ){
				$arrList[$nTmp]['icon']	= "<img src=\"./img/picon_08.gif\" width=\"30\" height=\"16\">";
			}
			if ( date("Y-m-d") > $aSelQuery['tblDtmEdate'] ){
				$arrList[$nTmp]['icon']	= "<img src=\"./img/picon_03.gif\" width=\"30\" height=\"16\">";
			}
			if ( $aSelQuery['tblDtmSdate'] <= date("Y-m-d") && date("Y-m-d") <= $aSelQuery['tblDtmEdate'] ){
				$arrList[$nTmp]['icon']	= "<img src=\"./img/picon_02.gif\" width=\"30\" height=\"16\">";
			}
			$nTmp++;
		}

		include ("html/popup_list.html");
	}

	if( $act == 'write' ) {
		$Data["act"] = "write_ok";

		include ("html/popup_write.html");
	}

	if( $act == 'write_ok' ) {
		$Data["width"]	= $_POST["intWidth"];
		$Data["height"]	= $_POST["intHeight"];
		$Data["top"]	= $_POST["intTop"];
		$Data["left"]	= $_POST["intLeft"];
		$Data["sdate"]	= $_POST["dtmSdate"];
		$Data["edate"]	= $_POST["dtmEdate"];
		$Data["subject"]	= $_POST["strSubject"];
		$Data["device"]	= $_POST["strDevice"];
		$Data["comment"]	= $_POST["strComment"];
		$Data["status"]	= 0;
		$Data["regdate"]	= "now()";

		$Query = "INSERT INTO tblPopup SET ";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblIntLeft='".$Data["left"]."',";
		$Query .= "tblIntTop='".$Data["top"]."',";
		$Query .= "tblIntWidth='".$Data["width"]."',";
		$Query .= "tblIntHeight='".$Data["height"]."',";
		$Query .= "tblIntStatus='".$Data["status"]."',";
		$Query .= "tblStrDevice='".$Data["device"]."',";
		$Query .= "tblDtmSdate='".$Data["sdate"]."',";
		$Query .= "tblDtmEdate='".$Data["edate"]."',";
		$Query .= "tblDtmRegDate='".$Data["regdate"]."'";

		$Sql = mysql_query( $Query ) or die ( mysql_error() );
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'modify' ) {
		if( !$tNum ) {
			echo "<script language='javascript'>";
			echo "	alert('경로가 올바르지 않습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		$Query = "SELECT * FROM tblPopup WHERE tblNumber='".$tNum."'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$Data["number"]		= $Array["tblNumber"];
		$Data["site"]			= $Array["tblIntSite"];
		$Data["subject"]	= $Array["tblStrSubject"];
		$Data["device"]	= $Array["tblStrDevice"];
		$Data["comment"]	= $Array["tblStrComment"];
		$Data["left"]			= $Array["tblIntLeft"];
		$Data["top"]			= $Array["tblIntTop"];
		$Data["width"]		= $Array["tblIntWidth"];
		$Data["height"]		= $Array["tblIntHeight"];
		$Data["status"]		= $Array["tblIntStatus"];
		$Data["sdate"]		= $Array["tblDtmSdate"];
		$Data["edate"]		= $Array["tblDtmEdate"];
		$Data["regdate"]	= $Array["tblDtmRegDate"];
		$Data["act"]			= "edit_ok";

		include ("html/popup_edit.html");
	}

	if( $act == 'edit_ok' ) {
		$Data["width"]		= $_POST["intWidth"];
		$Data["height"]		= $_POST["intHeight"];
		$Data["top"]			= $_POST["intTop"];
		$Data["left"]			= $_POST["intLeft"];
		$Data["sdate"]		= $_POST["dtmSdate"];
		$Data["edate"]		= $_POST["dtmEdate"];
		$Data["subject"]	= $_POST["strSubject"];
		$Data["device"]	= $_POST["strDevice"];
		$Data["comment"]	= $_POST["strComment"];

		$Query = "UPDATE tblPopup SET ";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblIntLeft='".$Data["left"]."',";
		$Query .= "tblIntTop='".$Data["top"]."',";
		$Query .= "tblIntWidth='".$Data["width"]."',";
		$Query .= "tblIntHeight='".$Data["height"]."',";
		$Query .= "tblIntStatus='".$Data["status"]."',";
		$Query .= "tblStrDevice='".$Data["device"]."',";
		$Query .= "tblDtmSdate='".$Data["sdate"]."',";
		$Query .= "tblDtmEdate='".$Data["edate"]."',";
		$Query .= "tblDtmRegDate='".$Data["regdate"]."' WHERE tblNumber='".$tNum."'";

		$Sql = mysql_query( $Query ) or die ( mysql_error() );
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'delete' ) {
		$Data["number"]	= $_POST["tNum"];

		$result = mysql_query("select * FROM tblPopup WHERE tblNumber='".$Data["number"]."'");
		$row = mysql_fetch_array( $result );

		// 내용에 있는 이미지 삭제(pc용 절대 경로)
		$src = imgTag($row["tblStrComment"]);
		if (is_array($src)) {
			foreach($src as $k => $v) {
				@unlink( $_SERVER['DOCUMENT_ROOT'].$v );
			}
		}

		$Query = "DELETE FROM tblPopup WHERE tblNumber='".$Data["number"]."'";
		$Sql = mysql_query( $Query ) or die ( mysql_error() );
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