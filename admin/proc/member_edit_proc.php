<?
	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";

	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

	if( !$_SESSION["ss_id"] || $_SESSION["ss_level"] > 2 ) {
		include "../html/login.html";
	}

	if( $step != 'next' ) {
		echo "<script language='javascript'>";
		echo "	alert('경로가 올바르지 않습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
	}

	/*파일업로드*/
	//$Data["filename"] = upload( $_FILES['strSaveFile'], $_SERVER['DOCUMENT_ROOT']."/_data/member");
	

	$Data["level"]			= $intLevel;
	$Data["name"]				= $strName;
	$Data["passwd"]			= $strPass; //urlencode(amho($strPass,$Data["tblIntBirth"]));
	$Data["email"]			= $strEmail;
	$Data["mobile"]			= $strMobile1."-".$strMobile2."-".$strMobile3;
	$Data["blnemail"]		= ( $blnEmail == 'Y' ) ? "Y" : "N";
	$Data["blnsms"]			= ( $blnSms == 'Y' ) ? "Y" : "N";

	$Data["memo"]				= addslashes( $strComment );
	$Data["gp"]					= $intGP;
    $Data["memDel"]			= $memDel;

	if( $_POST["dtmSdate"] && $_POST["dtmEdate"] ) { 
		$dtmStrDateArr = explode( '-', $_POST["dtmSdate"] );
		$dtmEndDateArr = explode( '-', $_POST["dtmEdate"] );
		$Data["dtmStrDate"] = mktime( 0, 0, 0, $dtmStrDateArr[1], $dtmStrDateArr[2], $dtmStrDateArr[0] );
		$Data["dtmEndDate"] = mktime( 23, 59, 59, $dtmEndDateArr[1], $dtmEndDateArr[2], $dtmEndDateArr[0] );
	}

	$Query = "UPDATE tblPerMember SET ";
	if($Data["passwd"]!='') {
	  if ($tblPassType == 'ksq') {				// 마이그레이션 데이터 일경우
			$Data["passwd"] = md5($Data["passwd"]);
			$Query .= "tblStrPass='".$Data["passwd"]."',";
	  } else {
		   $Query .= "tblStrPass=password('".$Data["passwd"]."'),";
	  }	
	}
	$Query .= "tblStrName='".$Data["name"]."',";
	$Query .= "tblStrMobile='".$Data["mobile"]."',";
	$Query .= "tblBlnEmail='".$Data["blnemail"]."',";
	$Query .= "tblBlnSms='".$Data["blnsms"]."',";
	$Query .= "tblStrEmail='".$Data["email"]."',"; 
	$Query .= "tblDtmStrDate='".$Data["dtmStrDate"]."',";
	$Query .= "tblIntLevel='".$Data["level"]."',";
	$Query .= "tblStrMemo='".$Data["memo"]."',";
	$Query .= "tblIntGP='".$Data["gp"]."',";
	$Query .= "memDel='".$Data["memDel"]."',";
	if($Data["memDel"]=='N'){
		$Query .= "memDel_reason='',";
		$Query .= "memDel_hope='',";
		$Query .= "memDel_date='',";
	}else if($Data["memDel"]=='Y' && ($memDel_date=='' || $memDel_date=='0000-00-00 00:00:00')){
		$Query .= "memDel_reason='',";
		$Query .= "memDel_hope='',";
		$Query .= "memDel_date=now(),";
	}
	$Query .= "tblDtmEndDate='".$Data["dtmEndDate"]."' WHERE tblNumber='".$tNum."'";

	$Sql = mysql_query( $Query ) or die( mysql_error() );

	// 관리자 로그분석
	$logData = array(
		"table" => "tblPerMember",
		"pk" => $tNum,
		"content" => '아이디: ' .$userid, 
		"act" => "modify"
	);
	setAnalysis($logData);

	echo "<script language='javascript'>";
	echo "	alert('수정되었습니다.');";
	echo "	location.href='../admin_03_01.php';";
	echo "</script>";
?>