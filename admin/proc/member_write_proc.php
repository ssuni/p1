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
	// 주민등록번호 암호화
	//$Data["strIDnum"]		= $strIDnum1.$strIDnum2;
	//$Data["strIDnum1"]	= substr( $Data["strIDnum"], 0, 6 );
	//$Data["strIDnum2"]	= md5( substr( $Data["strIDnum"], 6, 7 ) );
	//$Data["encIDnum"]		= md5( $Data["strIDnum"] ); 
	// 주민등록번호로 나이 뽑기
	//$Data["age"]				= createAge( $Data["strIDnum"] );
	// 주민등록번호로 성별 뽑기
	//$Data["sex"]				= createSex( $Data["strIDnum"] );

	//생년월일 조합
	//$Data["tblIntBirth"] = $intBirth1.zero_full( $intBirth2, 2 ).zero_full( $intBirth3, 2 );

	//양력읍력
	//$strCl = $_POST["strCl"];

	// 성별
	//$Data["sex"] = $_POST["strSex"];

	//나이뽑기	
	$Data["age"] = date('Y') - intval($intBirth1) + 1; 

	if( $_POST["dtmSdate"] && $_POST["dtmEdate"] ) {
		$dtmStrDateArr = explode( '-', $_POST["dtmSdate"] );
		$dtmEndDateArr = explode( '-', $_POST["dtmEdate"] );
		$Data["dtmStrDate"] = mktime( 0, 0, 0, $dtmStrDateArr[1], $dtmStrDateArr[2], $dtmStrDateArr[0] );
		$Data["dtmEndDate"] = mktime( 23, 59, 59, $dtmEndDateArr[1], $dtmEndDateArr[2], $dtmEndDateArr[0] );
	}

	$Data["id"]					= $strID;
	$Data["passwd"]			= $strPass; //urlencode(amho($strPass,$Data["tblIntBirth"]));
	$Data["email"]			= $strEmail;
	$Data["mobile"]			= $strMobile1."-".$strMobile2."-".$strMobile3;
	$Data["blnemail"]		= ( $blnEmail == 'Y' ) ? "Y" : "N";
	$Data["blnsms"]			= ( $blnSms == 'Y' ) ? "Y" : "N";
	$Data["level"]			= $intLevel;
	$Data["regdate"]		= date('Y-m-d H:i:s', time());
	$Data["gp"]					= $intGP;

	$Query = "INSERT INTO tblPerMember SET ";
	$Query .= "tblStrID='".$Data["id"]."',";
	$Query .= "tblStrPass=password('".$Data["passwd"]."'),";
	$Query .= "tblStrName='".$Data["name"]."',";
	$Query .= "tblStrEmail='".$Data["email"]."',";
	$Query .= "tblBlnEmail='".$Data["blnemail"]."',";
	$Query .= "tblStrMobile='".$Data["mobile"]."',";
	$Query .= "tblBlnSms='".$Data["blnsms"]."',";
	$Query .= "tblIntLevel='".$Data["level"]."',";
	$Query .= "tblStrMemo='".$Data["strComment"]."',";
	$Query .= "tblDtmRegDate='".$Data["regdate"]."',";
	$Query .= "tblDtmLastDate='".$Data["regdate"]."',";
	$Query .= "tblDtmRegIp='".$_SERVER["REMOTE_ADDR"]."',";
	$Query .= "tblIntGP='".$Data["gp"]."',";
	$Query .= "tblDtmEndDate='".$Data["dtmEndDate"]."'";

	$Sql = mysql_query( $Query ) or die( mysql_error() );
	$pk = mysql_insert_id();

	/*가입메일발송*/
	if( $Data["blnemail"] == 'Y' ) {
		$homeUrl = "http://".$bagData["host"];
		$fromname = $bagData["siteName"];
		$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';

		$fromaddress = $admData["email"];
		$server_mail = $admData["email"];
		$headers = "From: ".$fromname." < ".$fromaddress." > \n"; 
		$headers .= "X-Sender: < ".$server_mail." >\n"; 
		$headers .= "X-Mailer: PHP\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "Return-Path: < ".$fromaddress." >\n";  
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		/*$fp = fopen($_SERVER['DOCUMENT_ROOT']."/mail/mail_join.html","r");
		$m_content = fread($fp,"100000");
		fclose($fp);*/
		$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter.html");
		$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
		$m_contents = str_replace("@NAME@",$Data["name"],$m_contents);
		$m_contents = str_replace("@ID@",$Data["id"],$m_contents);
		$m_contents = str_replace("@PASS@",$Data["passwd"],$m_contents);

		$m_contents = str_replace("@ETC1@","회원님은 <font color='#000000'>".date('Y')."년 ".date('m')."월 ".date('d')."일</font> 루비성형외과 웹회원이 되셨습니다.",$m_contents);
		$m_contents = str_replace("@ETC2@"," 회원님</div><div style='font-family:돋움;color:#686868;font-size:12px;'>루비성형외과 홈페이지에 가입해 주신 것에 대해 깊이 감사 드리며,기대와 관심에 부응할 수 있도록 끊임없이 노력하겠습니다.",$m_contents);

		$m_contents_arr = explode("\r\n\r\n",$m_contents);			
		$m_contents = $m_contents_arr[2];
		$title = "[".$bagData["siteName"]."] 회원가입 확인 메일입니다.";
		$title='=?UTF-8?B?'.base64_encode($title).'?=';
		$res = mail($Data["email"],$title,$m_contents,$headers);
	}

	/*가입sms발송*/
	//if( $Data["blnsms"] == 'Y' ) {
		/******************** 인증정보 ********************/
		/*$sms_id		= $bagData["smsid"]; //SMS 아이디.
		$sms_pw		= $bagData["smspass"];//SMS 패스워드
		$sms_from = $admData["phone"];
		$sms_to		= $Data["mobile"];
		if( $aSmsData[1]["use"] == 'Y' && $aSmsData[1]["comment"] ) {
			$content = str_replace( "@NAME@", $Data["name"], $aSmsData[1]["comment"] );
			$sms_msg	= $content;
		} else {
			$sms_msg	= "[".$Data["name"]."]님 ".$bagData["siteName"]." 회원가입을 감사드립니다.";
		}
		$sms_ip		= $HTTP_SERVER_VARS["REMOTE_ADDR"];
			
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
			$smvQuery .= "tblDtmRegDate=now()";
			$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

			echo "<script>location.href='../member01.html';</script>";
		} else {

			$smvQuery = "INSERT INTO tblSmsLogs SET ";
			$smvQuery .= "tblStrSender='".$sms_from."',";
			$smvQuery .= "tblStrAddressee='".$sms_to."',";
			$smvQuery .= "tblStrComment='".$sms_msg."',";
			$smvQuery .= "tblStrIp='".$sms_ip."',";
			$smvQuery .= "tblStrStatus='N',";
			$smvQuery .= "tblDtmRegDate=now()";
			$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

			echo $sms->errMsg;
		}
	}*/

	// 관리자 로그분석
	$logData = array(
		"table" => "tblPerMember",
		"pk" => $pk,
		"content" => '아이디: ' .$strID, 
		"act" => "insert"
	);
	setAnalysis($logData);

	echo "<script>location.href='../admin_03_01.php';</script>";
?>