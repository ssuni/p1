<? include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

  if($_POST["tblStrName"]==""){
   echo "<script>alert('성명을 입력하여 주세요.'); history.go(-1);</script>";
   exit;
  }
if($_POST["tblStrMobile"] == "--"){
	echo "<script>alert('휴대폰 번호를 입력하여 주세요.'); history.go(-1);</script>";
	exit;
}

	$iQue = "INSERT INTO tb_kakaotalk_reservation SET ";
	$iQue .= "tblStrId='".$_POST["tblStrId"]."',";
	$iQue .= "tblStrName='".$_POST["tblStrName"]."',";
	$iQue .= "tblIntField='".$_POST["tblIntField"]."',";
	$iQue .= "tblStrMobile='".$_POST["tblStrMobile"]."',";
	$iQue .= "tblStrKatok='".$_POST["tblStrKatok"]."',";
	$iQue .= "tblStrAge='".$_POST["tblStrAge"]."',";
	$iQue .= "tblStrSex='".$_POST["tblStrSex"]."',";
	$iQue .= "tblStrProcess='".$_POST["tblStrProcess"]."',";
	$iQue .= "tblIntStatus='1',";
	$iQue .= "tblStrComment='".$_POST["tblStrComment"]."',";
	$iQue .= "tblDtmRegDate='".date("YmdHis")."',";
	$iQue .= "tblip='".$_SERVER['REMOTE_ADDR']."'";
	$stmt=mysql_query($iQue,$connect);
	
	if ($stmt) {

		// 전환,공통 스크립트
		include $_SERVER['DOCUMENT_ROOT']."/m/include/switch_script.php";  
		include $_SERVER['DOCUMENT_ROOT']."/m/include/common_script.php"; 

	   echo "<script>alert('카카오톡상담이 정상적으로 접수되었습니다.');window.parent.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	}

mysql_close($connect);
unset($connect);?>