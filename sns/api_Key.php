<?
$nid_ClientID = $bagData["nid_ClientID"];
$nid_ClientSecret = $bagData["nid_ClientSecret"];
$nid_RedirectURL = 'http://'.$_SERVER['HTTP_HOST'].'/sns/naver_callback.php';
$nid_mRedirectURL = 'http://'.$_SERVER['HTTP_HOST'].'/sns/naver_m_callback.php';		// ¸ð¹ÙÀÏ

$fb_appId = $bagData["fb_appId"];
$fb_secret = $bagData["fb_secret"];
$m_fb_appId = $bagData["m_fb_appId"];
$m_fb_secret = $bagData["m_fb_secret"];

$kakao_secret = $bagData["kakao_secret"];
?>