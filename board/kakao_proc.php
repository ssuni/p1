<? include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
include $_SERVER['DOCUMENT_ROOT']."/include/api.class.php";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

  if(!trim($_POST["tblStrName"])){
   echo "<script>alert('성명을 입력하여 주세요.'); history.go(-1);</script>";
   exit;
  }
  if(!trim($_POST["tblStrMobile"])){
   echo "<script>alert('휴대폰 번호를 입력하여 주세요.'); history.go(-1);</script>";
   exit;
  }

	$iQue = "INSERT INTO tb_kakaotalk_reservation SET ";
	$iQue .= "tblStrId='".$_SESSION["ss_id"]."',";
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
	 //sms
	  $api = new gabiaSmsApi('ppeum000','4ef81ca5eaa4654331ae3936400fb3dd');
	  $oBuffer = array("010-8762-6986","010-7621-3343","010-3322-1202");
	  foreach($oBuffer as $p)
			{
				// 발송시에 _REF_KEY_는 나중에 개별적인 발송 결과를 확인하고자 할 때 사용되는 값입니다.
				// 고객 내부의 규칙에 따른 40byte 이내의 unique한 값을 넣어주시면 됩니다.
				$r = $api->sms_send($p, "010-7621-3343","[논현][카카오톡상담]글이 등록되었습니다.","_REF_KEY_","_RESERVE_DATE_");			//단문 전송

				//$r = $api->lms_send($p, "_CALL_BACK_", "_MESSAGE_", "_TITLE_", "_REF_KEY_", "_RESERVE_DATE_");			//장문 전송
				//$r = $api->mms_send($p, "_CALL_BACK_", $file_path, "_MESSAGE_", "_TITLE_", "_REF_KEY_", "_RESERVE_DATE_");		//이미지 전송
				if ($r == gabiaSmsApi::$RESULT_OK)
				{
					//echo($p . " : " . $api->getResultMessage() . "<br>");
					//echo("이전 : " . $api->getBefore() . "<br>");
					//echo("이후 : " . $api->getAfter() . "<br>");
				}
				//metaBack ("error : " . $p . " - " . $api->getResultCode() . " - " . $api->getResultMessage() . "<br>");
			}
		//metaBack('ip.');
//sms

		// 전환,공통 스크립트
		include $_SERVER['DOCUMENT_ROOT']."/include/switch_script.php";  
		include $_SERVER['DOCUMENT_ROOT']."/include/common_script.php"; 

		echo "<script>alert('카카오톡상담이 정상적으로 접수되었습니다.');window.parent.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	}

mysql_close($connect);
unset($connect);?>