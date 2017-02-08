<? include "../include/head.php"; ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
//$pageNum = 1;
$tabNum = 1;
include $_SERVER['DOCUMENT_ROOT']."/sns/api_Key.php";
include $_SERVER['DOCUMENT_ROOT'].'/sns/Naver.php';
include $_SERVER['DOCUMENT_ROOT'].'/sns/src/facebook.php';

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
<link href="../member/css/style.css" rel="stylesheet" type="text/css">
<script src="//connect.facebook.net/en_US/all.js"></script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="/js/total.js"></script>
<div class="subWrap">
	<div class="contentsArea">
		<div class="conWrap">
			<!---------------------  // Start :: 본문  --------------------->
			<div class="m_contents">
				<div class="m_header">
					<h2>회원로그인</h2>
				</div>
				<div class="m_login_box">
					<div class="form">
						<form method="post" action="/member/memgaip.php" name="loin_agrr" onSubmit="return Loin_Check(this);">
							<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
							<input type="hidden" name="mode" value="login">
							<input type="hidden" name="ref" value="<?=$ref?>">
							<table summary="">
								<tbody>
									<tr>
										<th>아이디</th>
										<td><input type="text" name="userid" id="userid" tabindex="1" class="memberForm" maxlength="15" onFocus="javascript:this.value='';" value="<?=($_COOKIE["ss_id_save"])?$_COOKIE["ss_id_save"]:$_GET['findid']?>"/></td>
										<td rowspan="2"><input type="image" src="../member/images/login.gif" alt="로그인"></td>
									</tr>
									<tr>
										<th>비밀번호</th>
										<td><input type="password" name="pwd" id="pwd" tabindex="2" class="memberForm" maxlength="15" onFocus="javascript:this.value='';"/></td>
									</tr>
									<tr>
										<th></th>
										<td><input name="id_save" type="checkbox" value="y" id="id_save" <?=($_COOKIE["ss_id_save"])?'checked':'';?>>&nbsp;<label for="id_save">아이디 저장</label></td>
										<td></td>
									</tr>
									<!---------------------- Start :: SNS 로그인 ------------------------>
									<tr>
										<th></th>
										<td colspan="2">
											<ul class="sns_list">
												<? if ($nid_ClientID) { ?><li><?=$naver->login()?></li><? } ?>
												<? if ($fb_appId) { ?><li><a href="javascript:facebookLogin()"><img src="images/login_facebook.gif" alt="페이스북로그인" /></a></li><? } ?>
												<? if ($kakao_secret) { ?><li><a href="javascript:loginWithKakao()"><img src="images/login_kakao.gif" alt="카카오톡로그인" /></a></li><? } ?>
											</ul><div class="clr">&nbsp;</div>
										</td>
									</tr>
									<!---------------------- End :: SNS 로그인 ------------------------>
								</tbody>
							</table>
						</form>
						<div class="link">
							<div class="link1">아직 회원이 아니신가요?
								<p class="btn"><a href="../member/join01.php"><img src="../member/images/btn_join.gif" alt="회원가입하기"></a></p>
							</div>
							<!--
							<div class="link2">아이디, 혹은 비밀번호를 분실하셨나요?
								<p class="btn"><a href="../member/idpw.php"><img src="../member/images/btn_idpw.gif" alt="아이디/비밀번호 찾기"></a></p>
							</div>
							-->
						</div>
					</div>
				</div>
			</div>
			<!---------------------  // End :: 본문  --------------------->
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
<? } else { echo "<script>window.parent.location.href='".$bagData["mdir"]."/main/main.php';</script>"; } ?>
<? include "../include/footer.php"; ?>