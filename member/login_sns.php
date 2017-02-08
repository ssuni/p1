<? include "../include/head.php" ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
$tabNum = 1;
include "../sns/api_Key.php";
include '../sns/Naver.php';
include '../sns/src/facebook.php';

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
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/member/css/style.css' media='all' />
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src='/js/total.js'></script>

<body>
<? include "../member/include/m_top.php" ?>

<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원로그인</div>
		<h2>회원로그인</h2>
		<div class="m_contents">
			<!--------------------------- Start :: 로그인 (SNS) ------------------------->
			<div class="m_login_box2">
				<div class="form">
					<form method="post" action="/member/memgaip.php" name="loin_agrr" onSubmit="return Loin_Check(this);">
						<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
						<input type="hidden" name="mode" value="login">
						<input type="hidden" name="ref" value="<?=$ref?>">
						<table summary="">
							<caption></caption>
							<tbody>
								<tr>
									<th>아이디</th>
									<td><input type="text" name="userid" id="userid" tabindex="1" class="memberForm" maxlength="15" onFocus="javascript:this.value='';" value="<?=($_COOKIE["ss_id_save"])?$_COOKIE["ss_id_save"]:$_GET['findid']?>"/></td>
									<td rowspan="2" valign="top"><input type="image" src="/member/images/login.gif" alt="로그인"></td>
									<td rowspan="2" valign="top"><?=$naver->login()?></td>
									<td rowspan="2" valign="top"><a href="javascript:facebookLogin()"><img src="images/login_facebook.gif" alt="페이스북로그인"></a></td>
									<td rowspan="2" valign="top"><a href="javascript:loginWithKakao()"><img src="images/login_kakao.gif" alt="카카오톡로그인"></a></td>
								</tr>
								<tr>
									<th>비밀번호</th>
									<td><input type="password" name="pwd" id="pwd" tabindex="2" class="memberForm" maxlength="15" onFocus="javascript:this.value='';"/></td>
								</tr>
								<tr>
									<th></th>
									<td><input name="id_save" type="checkbox" value="y" id="id_save" <?=($_COOKIE["ss_id_save"])?'checked':'';?>>&nbsp;<label for="id_save">아이디 저장</label></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="footer">
					<div class="link">
						<ul>
							<li><a href="/member/join01.php"><img src="/member/images/btn_join2.gif" alt="회원가입하기"></a></li>
							<li><a href="/member/idpw.php"><img src="/member/images/btn_idpw2.gif" alt="아이디/비밀번호 찾기"></a></li>
						</ul><div class="clr"></div>
					</div>
					<ul class="mtext">
						<li>회원이 되시면 다양한 회원서비스와 진료예약 등의 편리한 기능을 이용하실 수 있습니다.</li>
						<li>사용자 암호는 주기적으로 변경하고 타인에게 노출되지 않도록 주의하시기 바랍니다.</li>
						<li>로그인 후 모든 정보는 암호화하여 전송됩니다.</li>
					</ul><div class="clr"></div>
				</div>
			</div>
			<!--------------------------- End :: 로그인 (SNS) ------------------------->
		</div>
	</div>
</div>
<script>
	$(function() {
		<?php if ($_GET['findid'] || $_COOKIE["ss_id_save"]) { ?>
		$('#pwd').focus();
		<?php } else { ?>
		$('#userid').focus();
		<?php } ?>
	});

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

	function facebookLogin() {  
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				getUserData(response);
			}
			else {
				FB.login(function(response) {  
					if (response.authResponse != null)
					{
						getUserData(response);
					}
				}, {scope: 'publish_stream, email, user_birthday, user_likes'});  
			}
		});
	}

    function loginWithKakao() {
		// 로그인 창을 띄웁니다.
		Kakao.Auth.login({
			success: function(authObj) {
				Kakao.API.request({
					url: '/v1/user/me',
					success: function (res) {
						var sData = JSON.stringify(res);
						sData = JSON.parse(sData);
						var id = sData.id;
						var nickname = sData.properties.nickname;
						var thumbnail_image = sData.properties.thumbnail_image;
						var profile_image = sData.properties.profile_image;
						
						//$.post("/sns/loginKakao.php", { "kakao_id": id, "kakao_nick": nickname, "access_token": access_token, "refresh_token":refresh_token},  
						$.post("/sns/loginKakao.php", { "kakao_id": id, "kakao_nick": nickname, "access_token": access_token},  
							function (response) {  
								location.reload();
						});
					}
				});
			},
			fail: function(err) {
				alert(JSON.stringify(err));
			}
		});
		var access_token = Kakao.Auth.getAccessToken();
	};
</script>
<? } else { echo "<script>window.parent.location.href='/main/main.php';</script>"; } ?>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>