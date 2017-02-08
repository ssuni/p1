<? include "inc/head.php" ?>
<?
$pageNum = 8;
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
<?		if( !$act || $act == 'calendar' ) {
		$year=$_REQUEST["year"];
		$month=$_REQUEST["month"];
		if($year) $curr_year=$year; else $curr_year = date(Y);
		if($year) $curr_month=$month; else $curr_month = date(n);		
		$curr_day = date(j);
		if(!$year||!$month) { $year=$curr_year; $month=$curr_month; }
		
		$month1=$month-1; $month2=$month+1;
		if($month1==0) { $month1=12; $year1=$year-1; } else { $year1=$year; }
		if($month2==13) { $month2=1; $year2=$year+1; } else { $year2=$year; }

		$dd=1; 
		while(checkdate($month,$dd,$year)) { $dd++; }
		$total_days=$dd-1;
		$first_day = date('w', mktime(0,0,0,$month,1,$year));

		$Query = "SELECT *, UNIX_TIMESTAMP( tblDtmRsvDate ) AS utime FROM tblProgram WHERE UNIX_TIMESTAMP( tblDtmRsvDate ) BETWEEN '".mktime(0,0,0,$month,1,$year)."' AND '".mktime(0,0,0,$month,$dd-1,$year)."' ORDER BY tblDtmRsvDate ASC";
		$Sql = mysql_query( $Query );
		$tmp = 0;
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$utime = $Array["utime"];
			$Data[$utime][$tmp]["number"]		= $Array["tblNumber"];
			$Data[$utime][$tmp]["subject"]	= mb_strimwidth( $Array["tblStrSubject"], 0, 12, "...", "utf-8");
			$Data[$utime][$tmp]["link"]			= $PHP_SELF."?act=modify&tNum=".$Data[$utime][$tmp]["number"];
			$tmp++;
		}

		include "./html/program_main.html";
	}

	if( $act == 'write' ) {
		// 관리자가 아닐때는 권한 제한
		if( $_SESSION["ss_level"] > 1 ) {
			echo "<script language='javascript'>";
			echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]는 이용이 제한되었습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
		}
		include "./html/program_write.html";
	}

	if( $act == 'write_ok' ) {
		// 관리자가 아닐때는 권한 제한
		if( $_SESSION["ss_level"] > 1 ) {
			echo "<script language='javascript'>";
			echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]는 이용이 제한되었습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
		}
		$Data["rsvdate"]	= $dtmRsvDate;
		$Data["subject"]	= $strSubject;
		$Data["comment"]	= addslashes( $strComment );

		$Query = "INSERT INTO tblProgram SET ";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblDtmRegDate=now(),";
		$Query .= "tblDtmRsvDate='".$Data["rsvdate"]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		echo "<script language='javascript'>";
		echo "	alert('일정이 등록되었습니다.');";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'modify' ) {
		// 관리자가 아닐때는 권한 제한
		if( $_SESSION["ss_level"] > 1 ) {
			echo "<script language='javascript'>";
			echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]는 이용이 제한되었습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
		}
		$Query = "SELECT * FROM tblProgram WHERE tblNumber=".$tNum;
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$rsvdate	= explode( ' ', $Array["tblDtmRsvDate"] );
		$Data["number"]		= $Array["tblNumber"];
		$Data["rsvdate"]	= $rsvdate[0];
		$Data["subject"]	= $Array["tblStrSubject"];
		$Data["comment"]	= stripslashes( $Array["tblStrComment"] );

		include "./html/program_edit.html";
	}

	if( $act == 'edit_ok' ) {
		// 관리자가 아닐때는 권한 제한
		if( $_SESSION["ss_level"] > 1 ) {
			echo "<script language='javascript'>";
			echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]는 이용이 제한되었습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
		}
		$Data["rsvdate"]	= $dtmRsvDate;
		$Data["subject"]	= $strSubject;
		$Data["comment"]	= addslashes( $strComment );

		$Query = "UPDATE tblProgram SET ";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblDtmRsvDate='".$Data["rsvdate"]."' WHERE tblNumber='".$tNum."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		echo "<script language='javascript'>";
		echo "	alert('일정이 수정되었습니다.');";
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