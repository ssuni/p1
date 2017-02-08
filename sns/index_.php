<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";

if (substr($_SERVER['HTTP_HOST'],0,4) != 'www.') {
//	header('Location: http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

include "api_Key.php";
include 'Naver.php';

$naver = new Naver(array(
        "CLIENT_ID" => $nid_ClientID,        // (*필수)클라이언트 ID  
        "CLIENT_SECRET" => $nid_ClientSecret,    // (*필수)클라이언트 시크릿
        "RETURN_URL" => $nid_RedirectURL,      // (*필수)콜백 URL
        "AUTO_CLOSE" => false,              // 인증 완료후 팝업 자동으로 닫힘 여부 설정 (추가 정보 기재등 추가행동 필요시 false 설정 후 추가)
        "SHOW_LOGOUT" => true              // 인증 후에 네이버 로그아웃 버튼 표시/ 또는 표시안함
	)
);
?>
<!DOCTYPE html>
<html>
<head>
<META content="user-scalable=no, initial-scale = 1.0, maximum-scale=1.0, minimum-scale=1.0" name=viewport>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>  로그인</title>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

<form name="formout" action="/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="500" height="50" style="display:none;"></iframe>
<? if ($_SESSION['userid']) { ?>
	<p><strong><? echo $_SESSION['username'];?>(<? echo $_SESSION['userid'];?>)</strong> 로그인 중!! <button type="button" onclick="javascript:document.formout.submit();"><span>로그아웃</span></button></p>
<? } ?> 

<? if (!$_SESSION['userid']) { ?>
	<div class="login_box"><?=$naver->login()?></div>
<? } ?>