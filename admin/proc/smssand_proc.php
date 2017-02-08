<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
if( $act == 'smssend' ){
	/******************** 인증정보 ********************/
	$sms_id		= $bagData["smsid"]; //SMS 아이디.
	$sms_pw		= $bagData["smspass"];//SMS 패스워드
	$sms_msg	= $_POST['content'];
	$sms_from = $admData["phone"];
	$sms_ip		= $HTTP_SERVER_VARS["REMOTE_ADDR"];

	for( $i = 0; $i < count( $chk ); $i++ ) {
		$mQuery = "SELECT * FROM tblPerMember WHERE tblNumber='".$chk[$i]."'";
		$mSql = mysql_query( $mQuery );
		$mArray = mysql_fetch_array( $mSql );

		$sms_to		= $mArray["tblStrMobile"];
		
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
			echo "<script>location.href = '/admin/admin_07_01.php';</script>";
			//print_r($ret);
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
	}
}
?>