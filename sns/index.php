<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

if (substr($_SERVER['HTTP_HOST'],0,4) != 'www.') {
	header('Location: http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

include "api_Key.php";
include 'Naver.php';
include './src/facebook.php';

$naver = new Naver(array(
        "CLIENT_ID" => $nid_ClientID,        // (*필수)클라이언트 ID  
        "CLIENT_SECRET" => $nid_ClientSecret,    // (*필수)클라이언트 시크릿
        "RETURN_URL" => $nid_RedirectURL,      // (*필수)콜백 URL
        "AUTO_CLOSE" => false,              // 인증 완료후 팝업 자동으로 닫힘 여부 설정 (추가 정보 기재등 추가행동 필요시 false 설정 후 추가)
        "SHOW_LOGOUT" => true              // 인증 후에 네이버 로그아웃 버튼 표시/ 또는 표시안함
	)
);

$facebook = new Facebook(array(
  'appId'  => $fb_appId,
  'secret' => $fb_secret,
));
?>
<!DOCTYPE html>
<html>
<head>
<META content="user-scalable=no, initial-scale = 1.0, maximum-scale=1.0, minimum-scale=1.0" name=viewport>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>  로그인</title>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>

<form name="formout" action="/member/memgaip.php" method="post" target="toplog_act">
	<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
	<input type="hidden" name="mode" value="out">
</form>
<iframe name="toplog_act" frameborder="0" width="500" height="50" style="display:none;"></iframe>

<? if ($_SESSION['ss_id']) { ?>
	<p><strong><? echo $_SESSION['ss_name'];?>(<? echo $_SESSION['ss_id'];?>)</strong> 로그인 중!! <button type="button" onclick="javascript:document.formout.submit();"><span>로그아웃</span></button></p>
<? } ?> 

<? if (!$_SESSION['ss_id']) { ?>
	<div class="login_box"><?=$naver->login()?></div>

	<p><button type="button" onclick="facebooklogin()"><span>로그인</span></button></p> 

	<a id="kakao-login-btn"></a>

	<form name="kakaoLogin" method="post" action="kakao_saveSession.php">
	<input type="hidden" name="kakao_id">
	<input type="hidden" name="kakao_nick">
	<input type="hidden" name="access_token">
	<input type="hidden" name="refresh_token">
	</form>

<script>
	Kakao.init('<?=$kakao_secret;?>');
	window.fbAsyncInit = function() {
		FB.init({appId: '<?=$fb_appId;?>', status: true, cookie: true,xfbml: true, oauth:true, });
	};
					  
	function getUserData(response) {
		var fbname;  
		var accessToken = response.authResponse.accessToken;  
		FB.api('/me?fields=id,name,email', function(user) {  
							
			fbname = user.name;
			userid = user.id;
			email = user.email;
					
			$.post("/sns/loginFacebook.php", { "userid": user.id, "username": fbname, "email": email, "fbaccesstoken":accessToken},  
				function (response) {  
					location.reload();
			});      
		});
	}

	function facebooklogin() {  
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				getUserData(response);
			}
			else {
				FB.login(function(response) {  
					getUserData(response);
				}, {scope: 'publish_stream, email, user_birthday, user_likes'});  
			}
		});
	}

	// 카카오 로그인 버튼을 생성합니다.
	Kakao.Auth.createLoginButton({
		container: '#kakao-login-btn',
		//lang:'en',
		size: 'small',	// 'small', 'medium', 'large' (default: 'medium') 
        success: function(authObj) {

          // 로그인 성공시 API를 호출합니다.
          Kakao.API.request({
          url: '/v1/user/me',
          success: function(res) {

            var sData = JSON.stringify(res);
            sData = JSON.parse(sData);
			var id = sData.id;
            var nickname = sData.properties.nickname;
            var thumbnail_image = sData.properties.thumbnail_image;
            var profile_image = sData.properties.profile_image;
            
			$.post("/sns/loginKakao.php", { "kakao_id": id, "kakao_nick": nickname, "access_token": access_token, "refresh_token":refresh_token},  
				function (response) {  
					location.reload();
			});      
          }
		});
		var access_token = Kakao.Auth.getAccessToken();
		var refresh_token = Kakao.Auth.getRefreshToken();
        }
	});
</script>
<? } ?>

