<? include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
include $_SERVER['DOCUMENT_ROOT']."/include/api.class.php";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

if(!$_POST["tblStrName"]) metaBack("성명을 입력하여 주세요.");
if(!$_POST["tblStrMobile"]) metaBack("휴대폰 번호를 입력하여 주세요.");

switch($_POST['tblType']){
	case 'main':
		if(!$_POST["tblIntField1"] && !$_POST["tblIntField2"]) metaBack("상담부위를 선택하여 주세요.");

		$alertMsg = '빠른 비용상담이 정상적으로 접수되었습니다.';
		break;
}


	$iQue = "INSERT INTO tb_counsel SET ";
	$iQue .= "tblType='".trim($_POST["tblType"])."',";
	$iQue .= "tblStrName='".trim($_POST["tblStrName"])."',";
	$iQue .= "tblStrMobile='".trim($_POST["tblStrMobile"])."',";
	$iQue .= "tblStrEmail='".$_POST["tblStrEmail"]."',";
	$iQue .= "tblIntField1='".$_POST["tblIntField1"]."',";
	$iQue .= "tblIntField2='".$_POST["tblIntField2"]."',";
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
				$r = $api->sms_send($p, "010-7621-3343","[논현][빠른비용상담]글이 등록되었습니다.","_REF_KEY_","_RESERVE_DATE_");			//단문 전송

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
		alertTour($alertMsg, $_SERVER['HTTP_REFERER']);
	} else {
		metaBack('등록시 문제가 발생하였습니다. 고객센터로 문의 바랍니다.');
	}

mysql_close($connect);
unset($connect);
?>