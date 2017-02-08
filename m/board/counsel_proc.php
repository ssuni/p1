<? include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

if($_POST["w_name"]==""){
	echo "<script>alert('성명을 입력하여 주세요.'); history.go(-1);</script>";
	exit;
}
if(implode("-", $_POST["w_tel"]) == "--"){
	echo "<script>alert('휴대폰 번호를 입력하여 주세요.'); history.go(-1);</script>";
	exit;
}
if($_POST["w_birth"]==""){
	echo "<script>alert('생년월일을 선택하여 주세요.'); history.go(-1);</script>";
	exit;
}
if($_POST["w_part1"]==""){
	echo "<script>alert('소속을 선택하여 주세요.'); history.go(-1);</script>";
	exit;
}	

	$iQue = "INSERT INTO tb_counsel SET ";
	$iQue .= "tblStrName='".$_POST["w_name"]."',";
	$iQue .= "tblStrMobile='".implode("-", $_POST["w_tel"])."',";
	$iQue .= "tblStrEmail='".$_POST["tblStrEmail"]."',";
	$iQue .= "tblIntField='".$_POST["tblIntField"]."',";
	$iQue .= "tblStrBirth='".$_POST["w_birth"]."',";
	$iQue .= "tblStrPart1='".$_POST["w_part1"]."',";
	$iQue .= "tblStrPart2='".$_POST["w_part2"]."',";
	$iQue .= "tblStrPart3='".$_POST["w_part3"]."',";
	$iQue .= "tblStrPart3_Etc='".$_POST["w_part3_etc"]."',";
	$iQue .= "tblIntStatus='1',";
	$iQue .= "tblDtmRegDate='".date("YmdHis")."',";
	$iQue .= "tblip='".$_SERVER['REMOTE_ADDR']."'";
	$stmt=mysql_query($iQue,$connect);

	if ($stmt) {
	   echo "<script>window.parent.location.href='/welfare/welfare02_02.php';</script>";
	   exit;
	} else {
	   echo "<script>alert('등록시 문제가 발생하였습니다. 고객센터로 문의 바랍니다.');window.parent.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	   exit;
	}

mysql_close($connect);
unset($connect);
?>