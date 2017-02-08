<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

	$SQL = "select * from tblPerMember where tblStrID='{$_POST['userid']}' and tblSnsType='facebook'";
	$row=mysql_fetch_array(mysql_query($SQL,$connect));
	if (!$row['tblStrID']) {
		$_SESSION['ss_id'] = $_POST['userid'];
		$_SESSION['ss_name'] = $_POST['username'];
		$_SESSION['ss_email'] = $_POST['email'];
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'facebook';

		$_SESSION['ss_id_tmp'] = "";
		$_SESSION['ss_name_tmp'] = "";
		$_SESSION['ss_email_tmp'] = "";
		$_SESSION['sns_tmp'] = "";

		$iQue = "INSERT INTO tblPerMember SET ";
		$iQue .= "tblStrID = '{$_POST['userid']}',";
		$iQue .= "tblStrName = '{$_POST['username']}',";
		$iQue .= "tblSection = 'general',";
		$iQue .= "tblSnsType= '{$_SESSION['sns']}',";
		$iQue .= "tblStrMobile = '',";
		$iQue .= "tblBlnEmail = '',";
		$iQue .= "tblBlnSms = '',";
		$iQue .= "tblStrEmail = '{$_POST['email']}',";
		$iQue .= "tblIntLevel = '8',";
		$iQue .= "tblDtmRegDate = now(),";
		$iQue .= "tblDtmLastDate= now(),";
		$iQue .= "tblDtmRegIp = '".$_SERVER['REMOTE_ADDR']."'";
		$stmt=mysql_query($iQue,$connect);

		$response = 'auth_login';
	} else {
		$update_sql = "update tblPerMember set tblDtmLastDate='".date("Y-m-d H:i:s")."' where tblStrID='{$_POST['userid']}' and tblSnsType='facebook'";
		mysql_query($update_sql,$connect);		

		$_SESSION['ss_id'] = $_POST['userid'];
		$_SESSION['ss_name'] = $_POST['username'];
		$_SESSION['ss_email'] = $_POST['email'];
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'facebook';

		$response = 'login';
	}

	toJson($response);
?>