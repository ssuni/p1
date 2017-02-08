<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

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

	$url					= $_REQUEST["url"];
	if($url=='') $url='/admin/';
	$Data["header"]			= ( $intHeader ) ? $intHeader : "1";
	$Data["title"]			= addslashes( $strTitle );
	$Data["keyword"]		= $strKeyword;
	$Data["clauses"]		= addslashes( $strClauses );
	$Data["consent1"]		= addslashes( $strConsent1 );	// 개인정보의 수집 및 이용목적
	$Data["consent2"]		= addslashes( $strConsent2 );	// 개인정보의 수집항목 및 방법
	$Data["consent3"]		= addslashes( $strConsent3 );	// 개인정보의 보유 및 이용기간
	$Data["consent4"]		= addslashes( $strConsent4 );	// 개인정보처리(취급)방침
	$Data["rejection"]		= $strRejection;
	$Data["smsid"]			= trim( $strSmsid );
	$Data["smspass"]		= $strSmspass;
	$Data["smsurl"]			= $strSmsurl;
	$Data["smscnt"]			= $intSmscnt;
	$Data["nid_ClientID"]  = $_POST['nid_ClientID'];
	$Data["nid_ClientSecret"]  = $_POST['nid_ClientSecret'];
	$Data["fb_appId"]  = $_POST['fb_appId'];
	$Data["fb_secret"]  = $_POST['fb_secret'];
	$Data["m_fb_appId"]  = $_POST['m_fb_appId'];
	$Data["m_fb_secret"]  = $_POST['m_fb_secret'];
	$Data["kakao_secret"]  = $_POST['kakao_secret'];


	$Query = "UPDATE tblBasicConfig SET ";
	$Query .= "tblHeader='".$Data["header"]."',";
	$Query .= "tblTitle='".$Data["title"]."',";
	$Query .= "tblKeyword='".$Data["keyword"]."',";
	$Query .= "tblClauses='".$Data["clauses"]."',";
	$Query .= "tblConsent1='".$Data["consent1"]."',";
	$Query .= "tblConsent2='".$Data["consent2"]."',";
	$Query .= "tblConsent3='".$Data["consent3"]."',";
	$Query .= "tblConsent4='".$Data["consent4"]."',";
	$Query .= "tblRejection='".$Data["rejection"]."',";
	$Query .= "tblSmsid='".$Data["smsid"]."',";
	$Query .= "tblSmspass='".$Data["smspass"]."',";
	$Query .= "tblSmsurl='".$Data["smsurl"]."',";
	$Query .= "tblSmscnt='".$Data["smscnt"]."',";
	$Query .= "nid_ClientID='".$Data["nid_ClientID"]."',";
	$Query .= "nid_ClientSecret='".$Data["nid_ClientSecret"]."',";
	$Query .= "fb_appId='".$Data["fb_appId"]."',";
	$Query .= "fb_secret='".$Data["fb_secret"]."',";
	$Query .= "m_fb_appId='".$Data["m_fb_appId"]."',";
	$Query .= "m_fb_secret='".$Data["m_fb_secret"]."',";
	$Query .= "kakao_secret='".$Data["kakao_secret"]."'";
	$result = $Sql = mysql_query( $Query ) or die( mysql_error() );

	if ($result) {
	echo "<script language='javascript'>";
	echo "	alert('저장되었습니다.');";
	echo "	location.href='$url';";
	echo "</script>";
	} else {
	echo "<script language='javascript'>";
	echo "	alert('설정 실패.');";
	echo "</script>";
	}
	
	?>