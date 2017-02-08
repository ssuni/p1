<?
header("Content-Type: text/html; charset=UTF-8");
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";

if (!$_SESSION['ss_id_tmp'] || !$_SESSION['ss_name_tmp']) {
?>
<script>
	alert('정상적으로 접근하여 주세요.');
	opener.location.reload();
	window.close();
</script>
<?
exit;
}

	$htel_imp = implode("-", $_POST['htel']);
	$email_imp = implode("@", $_POST['email']);

	$SQL = "select * from tblPerMember where tblStrID='{$_SESSION['userid_tmp']}' and tblSnsType='{$_SESSION['sns_tmp']}'";
	$row=mysql_fetch_array(mysql_query($SQL,$connect));
	if (!$row['tblStrID']) {
	
		$_POST['infomail']=($_POST['infomail'])?$_POST['infomail']:'N';
		$_POST['infoopen']=($_POST['infoopen'])?$_POST['infoopen']:'N';

		$iQue = "INSERT INTO tblPerMember SET ";
		$iQue .= "tblStrID = '{$_SESSION['ss_id_tmp']}',";
		$iQue .= "tblStrName = '{$_POST['name']}',";
		$iQue .= "tblSection = 'general',";
		$iQue .= "tblSnsType= '{$_SESSION['sns_tmp']}',";
		$iQue .= "tblStrMobile = '{$htel_imp}',";
		$iQue .= "tblBlnEmail = '{$_POST['infomail']}',";
		$iQue .= "tblBlnSms = '{$_POST['infoopen']}',";
		$iQue .= "tblStrEmail = '{$email_imp}',";
		$iQue .= "tblIntLevel = '8',";
		$iQue .= "tblDtmRegDate = now(),";
		$iQue .= "tblDtmLastDate= now(),";
		$iQue .= "tblDtmRegIp = '".$_SERVER['REMOTE_ADDR']."'";
		$stmt=mysql_query($iQue,$connect);
	}
	$_SESSION['ss_id'] = $_SESSION['userid_tmp'];
	$_SESSION['ss_name'] = $_SESSION['username_tmp'];
	$_SESSION['ss_level'] = 8;
	$_SESSION['sns'] = $_SESSION['sns_tmp'];

	$_SESSION['ss_id_tmp'] = "";
	$_SESSION['ss_name_tmp'] = "";
	$_SESSION['ss_email_tmp'] = "";
	$_SESSION['sns_tmp'] = "";
?>
<script>
	opener.location='/';
	window.close();
</script>