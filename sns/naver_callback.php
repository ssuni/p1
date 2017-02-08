<?php
header("Content-Type: text/html; charset=UTF-8");
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

include "api_Key.php";
require 'Naver.php';

$naver = new Naver(array(
        "CLIENT_ID" => $nid_ClientID,        // (*필수)클라이언트 ID  
        "CLIENT_SECRET" => $nid_ClientSecret,    // (*필수)클라이언트 시크릿
        "RETURN_URL" => $nid_RedirectURL,      // (*필수)콜백 URL
        "AUTO_CLOSE" => false,		           // 인증 완료후 팝업 자동으로 닫힘 여부 설정 (추가 정보 기재등 추가행동 필요시 false 설정 후 추가)
        "SHOW_LOGOUT" => true              // 인증 후에 네이버 로그아웃 버튼 표시/ 또는 표시안함
	)
);

$user = $naver->getUserProfile();

//echo 'resultcode 인증코드  = '.$user['result']['resultcode'].'<br/>';
//echo 'message  = '.$user['result']['message'].'<br/><br/>';
//var_dump($user);


// 인증되었으면 회원 DB처리(중복가입)
if ($user['result']['resultcode'] == '00') {
	$SQL = "select * from tblPerMember where tblStrID='{$user['response']['id']}' and tblSnsType='naver'";
	$row=mysql_fetch_array(mysql_query($SQL,$connect));
	if (!$row['tblStrID']) {
		$_SESSION['ss_id'] = $user['response']['id'];
		$_SESSION['ss_name'] = $user['response']['nickname'];
		$_SESSION['ss_email'] = $user['response']['email'];
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'naver';

		$_SESSION['ss_id_tmp'] = "";
		$_SESSION['ss_name_tmp'] = "";
		$_SESSION['ss_email_tmp'] = "";
		$_SESSION['sns_tmp'] = "";

		$iQue = "INSERT INTO tblPerMember SET ";
		$iQue .= "tblStrID = '{$user['response']['id']}',";
		$iQue .= "tblStrName = '{$user['response']['nickname']}',";
		$iQue .= "tblSection = 'general',";
		$iQue .= "tblSnsType= '{$_SESSION['sns']}',";
		$iQue .= "tblStrMobile = '',";
		$iQue .= "tblBlnEmail = '',";
		$iQue .= "tblBlnSms = '',";
		$iQue .= "tblStrEmail = '{$user['response']['email']}',";
		$iQue .= "tblIntLevel = '8',";
		$iQue .= "tblDtmRegDate = now(),";
		$iQue .= "tblDtmLastDate= now(),";
		$iQue .= "tblDtmRegIp = '".$_SERVER['REMOTE_ADDR']."'";
		$stmt=mysql_query($iQue,$connect);
		?>
		<script>
			opener.location='/';
			window.close();
		</script>
		<?
	} else {
		$update_sql = "update tblPerMember set tblDtmLastDate='".date("Y-m-d H:i:s")."' where tblStrID='{$user['response']['id']}' and tblSnsType='naver'";
		mysql_query($update_sql,$connect);		

		$_SESSION['ss_id'] = $user['response']['id'];
		$_SESSION['ss_name'] = $user['response']['nickname'];
		$_SESSION['ss_level'] = 8;
		$_SESSION['sns'] = 'naver';
		?>
		<script>
			opener.location.href='/';
			window.close();
		</script>
		<?
	}
}
?>