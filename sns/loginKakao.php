<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

// 회원 가입
//if ($_POST['access_token'] && $_POST['refresh_token']) {
if ($_POST['access_token']) {

	$SQL = "select * from tblPerMember where tblStrID='{$_POST['kakao_id']}' and tblSnsType='kakao'";
	$row=mysql_fetch_array(mysql_query($SQL,$connect));
	if (!$row['tblStrID']) {

		$_SESSION['ss_id'] = $_POST['kakao_id'];
		$_SESSION['ss_name'] = $_POST['kakao_nick'];
		$_SESSION['ss_email'] = '';
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'kakao';

		$iQue = "INSERT INTO tblPerMember SET ";
		$iQue .= "tblStrID = '{$_POST['kakao_id']}',";
		$iQue .= "tblStrName = '{$_POST['kakao_nick']}',";
		$iQue .= "tblSection = 'general',";
		$iQue .= "tblSnsType= '{$_SESSION['sns']}',";
		$iQue .= "tblStrMobile = '',";
		$iQue .= "tblBlnEmail = '',";
		$iQue .= "tblBlnSms = '',";
		$iQue .= "tblStrEmail = '',";
		$iQue .= "tblIntLevel = '8',";
		$iQue .= "tblDtmRegDate = now(),";
		$iQue .= "tblDtmLastDate= now(),";
		$iQue .= "tblDtmRegIp = '".$_SERVER['REMOTE_ADDR']."'";
		$stmt=mysql_query($iQue,$connect);

	} else {
		$update_sql = "update tblPerMember set tblDtmLastDate='".date("Y-m-d H:i:s")."' where tblStrID='{$_POST['kakao_id']}' and tblSnsType='kakao'";
		mysql_query($update_sql,$connect);		

		$_SESSION['ss_id'] = $_POST['kakao_id'];
		$_SESSION['ss_name'] = $_POST['kakao_nick'];
		$_SESSION['ss_email'] = '';
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'kakao';
		$_SESSION['access_token'] = $_POST['access_token'];
		$_SESSION['refresh_token'] = $_POST['refresh_token'];

		$response = 'login';
	}
	toJson($response);
}
?>