<? include "inc/head.php" ?>
<?
$pageNum = 2;
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
<?	if( !$act || $act == 'list' ) {		

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "20";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblCall" );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$Query = "SELECT * FROM tblCall ORDER BY tblDtmRegDate DESC LIMIT ".$startnum.", ".$linenum;
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$tmp]["number"]		= $Array["tblNumber"];
			$Data[$tmp]["field"]		= $medicalField[$Array["tblIntField"]];
			$Data[$tmp]["name"]			= $Array["tblStrName"];
			$Data[$tmp]["phone"]		= $Array["tblStrMobile"];
			if($Array["tblStrYear"]=='1'){
				$Data[$tmp]["year"]="남자";
			}else if($Array["tblStrYear"]=='2'){
				$Data[$tmp]["year"]="여자";
			}
			$Data[$tmp]["month"]		= $Array["tblStrMonth"]!=''?$Array["tblStrMonth"]."세":"";
			switch( $Array["tblStrDay"] ) {
				case "1" : $Data[$tmp]["day"]		= "피부(색소)"; break;
				case "2" : $Data[$tmp]["day"]		= "피부(여드름)"; break;
				case "3" : $Data[$tmp]["day"]		= "피부(기타)"; break;
				case "4" : $Data[$tmp]["day"]		= "주름/탄력"; break;
				case "5" : $Data[$tmp]["day"]		= "보톡스"; break;
				case "6" : $Data[$tmp]["day"]		= "필러"; break;
				case "7" : $Data[$tmp]["day"]		= "비만"; break;
				case "8" : $Data[$tmp]["day"]		= "기타"; break;
				default : $Data[$tmp]["day"]		= "-"; break;
			}
			$Data[$tmp]["time"]			= $teltimeArr[$Array["tblStrTime"]];
			$Data[$tmp]["email"]		= $Array["tblStrEmail"];
			switch( $Array["tblIntStatus"] ) {
				case "1" : $Data[$tmp]["status"]		= "<font color='blue'>접수</font>"; break;
				case "2" : $Data[$tmp]["status"]		= "<font color='FF6600'>완료</font>"; break;
				case "3" : $Data[$tmp]["status"]		= "<font color='gray'>취소</font>"; break;
				default : $Data[$tmp]["status"]			= "<font color='blue'>접수</font>"; break;
			}
			$Data[$tmp]["regdate"]	= $Array["tblDtmRegDate"];
			$tmp++;
		}

		include ( "./html/call.html" );
	}

	if( $act == 'modify' ) {
		$Query = "SELECT * FROM tblCall WHERE tblNumber='".$tNum."'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$Data["number"]		=	$Array["tblNumber"];
		$Data["field"]		=	$Array["tblIntField"];
		$Data["name"]		=	$Array["tblStrName"];
		//$Data["phone"]	=	explode( '-', $Array["tblStrMobile"] );
		$Data["phone"]		=	$Array["tblStrMobile"];
		$Data["month"]		=	$Array["tblStrMonth"];
		$Data["day"]		=	$Array["tblStrDay"];
		$Data["time"]		=	$Array["tblStrTime"];
		$Data["comment"]	=	stripslashes( $Array["tblStrComment"] );
		$Data["status"]		=	$Array["tblIntStatus"];
		$Data["regdate"]	=	$Array["tblDtmRegDate"];
		$Data["year"]		=	$Array["tblStrYear"];
		$Data["memo"]		=	$Array["tblStrMemo"];
		$Data["etc"]		=	$Array["tblStrEtc"];
		$Data["email"]		=	$Array["tblStrEmail"];

		include ( "./html/call_edit.html" );
	}

	if( $act == 'edit_ok' ) {
		$Data["number"]		= $_POST["tNum"];
		$Data["name"]		= $_POST["strName"];
		//$Data["phone"]	= $_POST["strPhone1"]."-".$_POST["strPhone2"]."-".$_POST["strPhone3"];
		$Data["phone"]		= $_POST["strPhone"];
		$Data["field"]		= $_POST["intField"];
		$Data["month"]		= $_POST["strMonth"];
		$Data["day"]		= $_POST["strDay"];
		$Data["time"]		= $_POST["strTime"];
		$Data["comment"]	= addslashes( $_POST["strComment"] );
		$Data["status"]		= $_POST["intStatus"];
		$Data["year"]		= $_POST["strYear"];
		$Data["memo"]		= $_POST["strMemo"];
		$Data["etc"]		= $_POST["strEtc"];	
		$Data["email"]		= $_POST["strEmail"];

		$Query = "UPDATE tblCall SET ";
		$Query .= "tblIntField='".$Data["field"]."',";
		$Query .= "tblStrName='".$Data["name"]."',";
		$Query .= "tblStrMobile='".$Data["phone"]."',";
		$Query .= "tblStrEmail='".$Data["email"]."',";
		$Query .= "tblStrYear='".$Data["year"]."',";
		$Query .= "tblStrMonth='".$Data["month"]."',";
		$Query .= "tblStrDay='".$Data["day"]."',";
		$Query .= "tblStrTime='".$Data["time"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblStrEtc='".$Data["etc"]."',";
		$Query .= "tblIntStatus='".$Data["status"]."' WHERE tblNumber='".$Data["number"]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'del_ok' ) {
		$Data["number"] = $_POST["chk"];
		if( count( $Data["number"] ) <= 0 ) echo "<script language='javascript'>alert('경로가 올바르지 않습니다.'); history.go(-1);</script>";
		for( $i = 0; $i < count( $Data["number"] ); $i++ ) {
			$Query = "DELETE FROM tblCall WHERE tblNumber='".$Data["number"][$i]."'";
			$Sql = mysql_query( $Query ) or die( mysql_error() );
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