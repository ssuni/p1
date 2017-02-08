<? include "inc/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";?>
<?
$sub_menu = '400100';
auth_check($auth[$sub_menu]);

$pageNum = 4;
$subNum = 2;
if($act=='calendar') $subNum = 1;
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
			<div class="contentsArea"<?if($act=='calendar'){?> style="padding:10px 0px 0px 10px;"<?}?>><!---width:740px--->
				<!--- start : 본문 --->
<?		// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		$subQuery = "WHERE tblIntGP='".$_SESSION["ss_gp"]."'";
	}

	if( !$act || $act == 'list' ) {
		$subQuery = ( $subQuery ) ? $subQuery : "";
		if( $_POST["intField"] ) {
			$subQuery .= ( trim( $subQuery ) ) ? " AND tblIntField='".$_POST["intField"]."'" : "WHERE tblIntField='".$_POST["intField"]."'";
		}

		if( $_POST["sGP"] ) {
			$subQuery .= ( trim( $subQuery ) ) ? " AND tblIntGP='".$_POST["sGP"]."'" : "WHERE tblIntGP='".$_POST["sGP"]."'";
		}

		if( $search && trim( $sKeyword ) ) {
			$subQuery .= ( trim( $subQuery ) ) ? " AND ".$search." LIKE '%".$sKeyword."%'" : "WHERE ".$search." LIKE '%".$sKeyword."%'";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "50";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblReserve ".$subQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$Query = "SELECT * FROM tblReserve ".$subQuery." ORDER BY tblDtmRegDate DESC LIMIT $startnum, $linenum";
		$Sql = mysql_query( $Query );
		$tmp = 0;
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$tmp]["jijem"]		= $Array["jijem"];
			$Data[$tmp]["number"]		= $Array["tblNumber"];
			$Data[$tmp]["field"]		= $Array["tblIntField"];
			$Data[$tmp]["name"]			= $Array["tblStrName"];
			$Data[$tmp]["phone"]		= str_replace( '--', '', $Array["tblStrPhone"] );
			$Data[$tmp]["email"]		= $Array["tblStrEmail"];
			$Data[$tmp]["subject"]	= $Array["tblStrSubject"];
			$Data[$tmp]["comment"]	= $Array["tblStrComment"];
			$Data[$tmp]["regdate"]	= explode( ' ', $Array["tblDtmRegDate"] );
			$Data[$tmp]["rsvdate"]	= explode( ' ', $Array["tblDtmRsvDate"] );
			$Data[$tmp]["gp"]				= $Array["tblIntGP"];
			if ($Array["tblIntStatus"]) {
				$tblIntStatus=($Array["tblIntStatus"]==2)?'7':$Array["tblIntStatus"];
				$Data[$tmp]["img"] ="<img src='/admin/img/icon_0".$tblIntStatus.".gif' align='absmiddle'>";
			} else {
				$Data[$tmp]["img"] = "<img src='/admin/img/icon_01.gif' align='absmiddle'>";
			}
			$tmp++;
		}

		include ( "./html/reserve_list.html" );
	}

	if( $act == 'calendar' ) {
		$date = ( !$date ) ? date('Y-m-d', time() ) : $date;
		$week	= trim($_REQUEST['week']);

		// 오늘이 속한 주 구함
		function getWeek($today="") {
			if(!$today) $today = time();
			if(strlen($today)==8) {
					$ty = substr($today,0,4);
					$tm = substr($today,4,2);
					$td = substr($today,6,2);
					$now_time = mktime(0,0,0,$tm,$td,$ty);
			} elseif(strlen($today)==10) $now_time = $today;
			else return 0; //error
			$t_week = date("w", $now_time);

			$set[0] = $now_time-($t_week*86400);
			$set[1] = $now_time+((1-$t_week)*86400);
			$set[2] = $now_time+((2-$t_week)*86400);
			$set[3] = $now_time+((3-$t_week)*86400);
			$set[4] = $now_time+((4-$t_week)*86400);
			$set[5] = $now_time+((5-$t_week)*86400);
			$set[6] = $now_time+((6-$t_week)*86400);

			return $set;
		}

		$thisweek = getWeek($week);
		$prev_week	= $thisweek[0] - (7 * 24 * 60 * 60);
		$prev_week	= date("Ymd", $prev_week);
		$next_week	= $thisweek[0] + (7 * 24 * 60 * 60);
		$next_week	= date("Ymd", $next_week);

		$s_ji = ($s_ji) ? $s_ji : "0";


		$subQuery = ( $subQuery) ? $subQuery." AND tblIntStatus > 0" : " WHERE tblIntStatus > 0";
		
		$Query	= " SELECT *, UNIX_TIMESTAMP( tblDtmRsvDate ) as utime FROM tblReserve ";

		$Query	.= $subQuery." and jijem = '".$s_ji."' ORDER BY tblDtmRsvDate ASC";
		//$Query	.= " AND tblDtmRsvDate BETWEEN '".date("Y-m-d 00:00:00", $thisweek[0])."' AND '".date("Y-m-d  23:59:59", $thisweek[6])."' ";
		//$Query	.= " ORDER BY tblDtmRsvDate ASC ";
		$Sql	= mysql_query( $Query );
		while ( $Array = mysql_fetch_array( $Sql ) ){
			$utime										= $Array["utime"];
			if( $svTime == $utime ) {
				$tmp++;
			} else {
				$svTime = $utime; 
				$tmp = 0;
			}
			$Data[$utime]["jijem"][$tmp]		= $Array["jijem"];
			$Data[$utime]["number"][$tmp]		= $Array["tblNumber"];
			$Data[$utime]["name"][$tmp]			= $Array["tblStrName"];
			$Data[$utime]["gubun"][$tmp]		= $Array["tblIntGubun"];
			$Data[$utime]["status"][$tmp]		= $Array["tblIntStatus"];
			$rsvDate									= explode( ' ', $Array["tblDtmRsvDate"] );
			$Data[$utime]["rsvdate"][$tmp]	= $rsvDate[0];
			$Data[$utime]["rsvTime"][$tmp]	= $rsvDate[1];
//			$Data[$utime]["guimg"][$tmp]		= ( $Data[$utime]["gubun"][$tmp] ) ? "<img src='/admin/img/mstatus".$Data[$utime]["gubun"][$tmp].".gif' align='absmiddle'>" : "<img src='/admin/img/mstatus1.gif' align='absmiddle'>";
			$Data[$utime]["guimg"][$tmp]		= ( $Data[$utime]["gubun"][$tmp] ) ? "" : "";
			$Data[$utime]["img"][$tmp]			= ( $Data[$utime]["status"][$tmp] ) ? "<img src='/admin/img/icon_0".$Data[$utime]["status"][$tmp].".gif' align='absmiddle'>" : "<img src='/admin/img/icon_01.gif' align='absmiddle'>";
		}
		include ( "./html/reserve_main.html" );
	}

	if( $act == 'write' ) {
		include ( "./html/reserve_write.html" );
	}

	if( $act == 'write_ok' ) {
		if( !$step || $step != 'next' ) echo "<script language='javascript'>alert('경로가 올바르지 않습니다.'); history.go(-1);</script>";

		$Data["gp"]			= $intGP;
		$Data["jijem"]		= $jijem;
		$Data["field"]		= $intField;
		$Data["crack"]		= $intCrack;
		$Data["gubun"]		= $intGubun;
		$Data["rsvdate"]	= $dtmRsvDate." ".$dtmRsvTime.":00";
		$Data["name"]		= $strName;
		$Data["phone"]		= $strPhone1."-".$strPhone2."-".$strPhone3;
		$Data["email"]		= $strEmail;
		$Data["subject"]	= $strSubject;
		$Data["comment"]	= addslashes( $strComment );
		$Data["reply"]		= addslashes( $strReply );
		$Data["blnsms"]		= $blnSms;
		$Data["blnemail"]	= $blnEmail;

		$Query = "INSERT INTO tblReserve SET ";
		$Query .= "jijem='".$Data["jijem"]."',";
		$Query .= "tblIntGP='".$Data["gp"]."',";
		$Query .= "tblIntField='".$Data["field"]."',";
		$Query .= "tblIntCrack='".$Data["crack"]."',";
		$Query .= "tblIntGubun='".$Data["gubun"]."',";
		$Query .= "tblStrName='".$Data["name"]."',";
		$Query .= "tblStrPhone='".$Data["phone"]."',";
		$Query .= "tblStrEmail='".$Data["email"]."',";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblStrReply='".$Data["reply"]."',";
		$Query .= "tblDtmRegDate=now(),";
		$Query .= "tblDtmRsvDate='".$Data["rsvdate"]."',";
		$Query .= "tblIntStatus='1'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		// 관리자 로그분석
		$logData = array(
			"table" => "tblReserve",
			"pk" => mysql_insert_id(),
			"content" => '성명 : ' .$Data["name"], 
			"act" => "insert"
		);
		setAnalysis($logData);
		
		$Data["jijem"] == 0 ? $jijem_msg = "강남점" : $jijem_msg = "부산점";

		

		/*메일전송*/
		$mailData["rsvDate"]	= explode( '-', $dtmRsvDate );
		$mailData["rsvDate"]	= $mailData["rsvDate"][0]."년 ".$mailData["rsvDate"][1]."월 ".$mailData["rsvDate"][2]."일";
		$mailData["rsvTime"]	= explode( ':', $dtmRsvTime );
		$mailData["rsvTime"]	= $mailData["rsvTime"][0]."시 ".$mailData["rsvTime"][1]."분";
		if( $Data["blnemail"] == 'Y' && trim( $strReply ) ) {
			$homeUrl = "http://".$bagData["host"];
			$fromname = $bagData["siteName"];
			$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';
			$fromaddress = $admData["email"];
			$server_mail = $admData["email"];
			$headers = "From: ".$fromname." < ".$fromaddress." > \n"; 
			//$headers .= "X-Sender: < ".$server_mail." >\n"; 
			//$headers .= "X-Mailer: PHP\n"; 
			//$headers .= "Return-Path: < ".$fromaddress." >\n";  
			$headers .= "Content-Type: text/html;\n";
			$headers .= "charset=utf-8"; 
			$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter_reserve.html");
			$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
			$m_contents = str_replace("@FIELD@",$medicalField[$Data["field"]],$m_contents);
			$m_contents = str_replace("@NAME@",$Data["name"],$m_contents);
			$m_contents = str_replace("@DATE@",$mailData["rsvDate"],$m_contents);
			$m_contents = str_replace("@TIME@",$mailData["rsvTime"],$m_contents);
			$m_contents = str_replace("@SUBJECT@",$Data["subject"],$m_contents);
			$m_contents = str_replace("@COMMENT@",stripslashes( $Data["comment"] ),$m_contents);
			$m_contents = str_replace("@REPLY@",$Data["reply"],$m_contents);

			$m_contents = str_replace("@ETC1@"," 회원님의 예약내용 입니다.",$m_contents);
			$m_contents = str_replace("@ETC2@","",$m_contents);

			$m_contents_arr = explode("\r\n\r\n",$m_contents);
			$m_contents = $m_contents_arr[1];

			$title = stripslashes( "[".$bagData["siteName"]."] ".$jijem_msg." 예약이 완료되었습니다." );
			$title='=?UTF-8?B?'.base64_encode($title).'?=';
			$res = mail($Data["email"],$title,$m_contents,$headers);
		}

		/*SMS전송*/
		if( $Data["blnsms"] == 'Y' ) {
			/******************** 인증정보 ********************/
			$sms_id		= $bagData["smsid"]; //SMS 아이디.
			$sms_pw		= $bagData["smspass"];//SMS 패스워드
			$sms_from = $admData["phone"];
			$sms_to		= $Data["phone"];

			if( $aSmsData[3]["use"] == 'Y' && $aSmsData[3]["comment"] ) {
				$content = str_replace( "@NAME@", $Data["name"], $aSmsData[3]["comment"] );
				$content = str_replace( "@RESERVE@", substr( $Data["rsvdate"], 0, 16 ), $content );
				$sms_msg	= $content;
			} else {
				$sms_msg	= substr( $Data["rsvdate"], 0, 16 )."에 예약이 접수되었습니다. [".$jijem_msg.$bagData["siteName"]."]";
			}

			$sms = new EmmaSMS();
			$sms->login($sms_id, $sms_pw);	// $sms->login( [고객 ID], [고객 패스워드]);
			$ret = $sms->send($sms_to, $sms_from, $sms_msg, $sms_date);

			if($ret) {


				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='Y',";
				$smvQuery .= "tblIntGP='".$_SESSION["ss_gp"]."',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo "<script>location.href='$PHP_SELF';</script>";
			} else {

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='N',";
				$smvQuery .= "tblIntGP='".$_SESSION["ss_gp"]."',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo $sms->errMsg;
			}
		} else {
			echo "<script>location.href='$PHP_SELF';</script>";
		}

		//echo "<script language='javascript'>";
		//echo "	alert('예약이 완료되었습니다.');";
		//echo "	location.href='$PHP_SELF';";
		//echo "</script>";
	}

	if( $act == 'modify' ) {
		$Query = "SELECT * FROM tblReserve WHERE tblNumber='$tNum'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$Data["number"]		= $Array["tblNumber"];
		$Data["jijem"]		= $Array["jijem"];
		$Data["gp"]				= $Array["tblIntGP"];
		$Data["field"]		= $Array["tblIntField"];
		$Data["crack"]		= $Array["tblIntCrack"];
		$Data["name"]			= $Array["tblStrName"];
		$Data["gubun"]		= $Array["tblIntGubun"];
		$Data["phone"]		= explode( '-', $Array["tblStrPhone"] );
		$Data["email"]		= $Array["tblStrEmail"];
		$Data["subject"]	= $Array["tblStrSubject"];
		$Data["idnumber"]	= explode( '-', $Array["tblStrIDnum"] );
		$Data["comment"]	= stripslashes( $Array["tblStrComment"] );
		$Data["reply"]		= stripslashes( $Array["tblStrReply"] );
		$Data["regdate"]	= $Array["tblDtmRegDate"];
		$rsvdate					= explode( ' ', $Array["tblDtmRsvDate"] );
		$Data["rsvdate"]	= $rsvdate[0];
		$Data["rsvtime"]	= substr( $rsvdate[1], 0, 5 );
		$Data["status"]		= $Array["tblIntStatus"];

		include ( "./html/reserve_edit.html" );
	}

	if( $act == 'edit_ok' ) { 
		if( !$step || $step != 'next' ) echo "<script language='javascript'>alert('경로가 올바르지 않습니다.'); history.go(-1);</script>";

		$Data["gp"]				= $intGP;
		$Data["jijem"]		= $jijem;
		$Data["field"]		= $intField;
		$Data["crack"]		= $intCrack;
		$Data["gubun"]		= $intGubun;
		$Data["rsvdate"]	= $dtmRsvDate." ".$dtmRsvTime.":00";
		$Data["name"]			= $strName;
		$Data["idnumber"]	= $strIDnum1."-".$strIDnum2;
		$Data["phone"]		= $strPhone1."-".$strPhone2."-".$strPhone3;
		$Data["email"]		= $strEmail;
		$Data["subject"]	= $strSubject;
		$Data["comment"]	= addslashes( $strComment );
		$Data["reply"]		= addslashes( $strReply );
		$Data["status"]		= $intStatus;
		$Data["blnsms"]		= $blnSms;
		$Data["blnemail"]	= $blnEmail;

		$Query = "UPDATE tblReserve SET ";
		$Query .= "tblIntGP='".$Data["gp"]."',";
		$Query .= "jijem='".$Data["jijem"]."',";
		$Query .= "tblIntField='".$Data["field"]."',";
		$Query .= "tblIntCrack='".$Data["crack"]."',";
		$Query .= "tblIntGubun='".$Data["gubun"]."',";
		$Query .= "tblStrName='".$Data["name"]."',";
		$Query .= "tblStrIDnum='".$Data["idnumber"]."',";
		$Query .= "tblStrPhone='".$Data["phone"]."',";
		$Query .= "tblStrEmail='".$Data["email"]."',";
		$Query .= "tblStrSubject='".$Data["subject"]."',";
		$Query .= "tblStrComment='".$Data["comment"]."',";
		$Query .= "tblStrReply='".$Data["reply"]."',";
		$Query .= "tblDtmRsvDate='".$Data["rsvdate"]."',";
		$Query .= "tblIntStatus='".$Data["status"]."' WHERE tblNumber='$tNum'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );
		
		// 관리자 로그분석
		$logData = array(
			"table" => "tblReserve",
			"pk" => $tNum,
			"content" => '성명 : ' .$Data["name"], 
			"act" => "modify"
		);
		setAnalysis($logData);

		$Data["jijem"] == 0 ? $jijem_msg = "강남점" : $jijem_msg = "부산점";

		/*메일전송*/
		$mailData["rsvDate"]	= explode( '-', $dtmRsvDate );
		$mailData["rsvDate"]	= $mailData["rsvDate"][0]."년 ".$mailData["rsvDate"][1]."월 ".$mailData["rsvDate"][2]."일";
		$mailData["rsvTime"]	= explode( ':', $dtmRsvTime );
		$mailData["rsvTime"]	= $mailData["rsvTime"][0]."시 ".$mailData["rsvTime"][1]."분";
		if( $Data["blnemail"] == 'Y' && trim( $strReply ) ) {
			$homeUrl = "http://".$bagData["host"];
			$fromname = $bagData["siteName"];
			$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';
			$fromaddress = $admData["email"];
			$server_mail = $admData["email"];
			$headers = "From: ".$fromname." < ".$fromaddress." > \n"; 
			//$headers .= "X-Sender: < ".$server_mail." >\n"; 
			//$headers .= "X-Mailer: PHP\n"; 
			//$headers .= "Return-Path: < ".$fromaddress." >\n";  
			$headers .= "Content-Type: text/html;\n";
			$headers .= "charset=utf-8"; 
			$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter_reserve.html");
			$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
			$m_contents = str_replace("@FIELD@",$medicalField[$Data["field"]],$m_contents);
			$m_contents = str_replace("@NAME@",$Data["name"],$m_contents);
			$m_contents = str_replace("@DATE@",$mailData["rsvDate"],$m_contents);
			$m_contents = str_replace("@TIME@",$mailData["rsvTime"],$m_contents);
			$m_contents = str_replace("@SUBJECT@",$Data["subject"],$m_contents);
			$m_contents = str_replace("@COMMENT@",stripslashes( $Data["comment"] ),$m_contents);
			$m_contents = str_replace("@REPLY@",$Data["reply"],$m_contents);

			$m_contents = str_replace("@ETC1@"," 회원님의 예약내용 입니다.",$m_contents);
			$m_contents = str_replace("@ETC2@","",$m_contents);

			$m_contents_arr = explode("\r\n\r\n",$m_contents);
			$m_contents = $m_contents_arr[1];

			$title = stripslashes( "[".$bagData["siteName"]."] ".$jijem_msg." 예약이 완료되었습니다." );
			$title='=?UTF-8?B?'.base64_encode($title).'?=';
			$res = mail($Data["email"],$title,$m_contents,$headers);
		}

		/*SMS전송*/
		if( $Data["blnsms"] == 'Y' ) {
			/******************** 인증정보 ********************/
			$sms_id		= $bagData["smsid"]; //SMS 아이디.
			$sms_pw		= $bagData["smspass"];//SMS 패스워드
			$sms_from = $admData["phone"];
			$sms_to		= $Data["phone"];
			if( $aSmsData[3]["use"] == 'Y' && $aSmsData[3]["comment"] ) {
				$content = str_replace( "@NAME@", $Data["name"], $aSmsData[3]["comment"] );
				$content = str_replace( "@RESERVE@", substr( $Data["rsvdate"], 0, 16 ), $content );
				$sms_msg	= $content;
			} else {
				$sms_msg	= substr( $Data["rsvdate"], 0, 16 )."에 예약이 접수되었습니다. [".$jijem_msg.$bagData["siteName"]."]";
			}
				
			$sms = new EmmaSMS();
			$sms->login($sms_id, $sms_pw);	// $sms->login( [고객 ID], [고객 패스워드]);
			$ret = $sms->send($sms_to, $sms_from, $sms_msg, $sms_date);
				
			if($ret) {
				//print_r($ret);

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='Y',";
				$smvQuery .= "tblIntGP='".$_SESSION["ss_gp"]."',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo "<script>location.href='$PHP_SELF';</script>";
			} else {

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='N',";
				$smvQuery .= "tblIntGP='".$_SESSION["ss_gp"]."',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo $sms->errMsg;
			}
		} else {
			echo "<script>location.href='$PHP_SELF';</script>";
		}
		//echo "<script language='javascript'>";
		//echo "	alert('수정이 완료되었습니다.');";
		//echo "	location.href='$PHP_SELF';";
		//echo "</script>";
	}

	if( $act == 'delete' ) {
		if( count( $chk ) <= 0 ) echo "<script language='javascript'>alert('경로가 올바르지 않습니다.'); history.go(-1);</script>";

		for( $i = 0; $i < count( $chk ); $i++ ) {
			//$Data["number"]	= $chk[$i];

			$Result = mysql_query("SELECT * FROM tblReserve WHERE tblNumber='".$chk[$i]."'");
			$Data = mysql_fetch_array( $Result );

			$Query = "DELETE FROM tblReserve WHERE tblNumber='".$chk[$i]."'";
			$Sql = mysql_query( $Query ) or die( mysql_error() );

			// 관리자 로그분석
			$logData = array(
				"table" => "tblReserve",
				"pk" => $Data["tblNumber"],
				"content" => '성명 : ' .$Data["tblStrName"], 
				"act" => "delete"
			);
			setAnalysis($logData);
		}

		echo "<script language='javascript'>";
		echo "	alert('삭제가 완료되었습니다.');";
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