<? include "../include/head.php" ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
$tabNum = 1;
?>
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/member/css/style.css' media='all' />
<script src='/js/jquery-1.11.2.min.js'></script>
<script src='/js/total.js'></script>
<script>
	$(function() {
		<?php if ($_GET['findid'] || $_COOKIE["ss_id_save"]) { ?>
		$('#pwd').focus();
		<?php } else { ?>
		$('#userid').focus();
		<?php } ?>
	});
</script>

<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원로그인</div>
		<h2>회원로그인</h2>
		<div class="m_contents">
			<!--------------------------- Start :: 로그인 (일반로그인버튼) ------------------------->
			<div class="m_login_box">
				<div class="form">
					<form method="post" action="/member/memgaip.php" name="loin_agrr" onSubmit="return Loin_Check(this);">
						<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
						<input type="hidden" name="mode" value="login">
						<input type="hidden" name="ref" value="<?=$ref?>">
						<table summary="">
							<caption></caption>
							<colgroup>
								<col width="" />
							</colgroup>
							<tbody>
								<tr>
									<th>아이디</th>
									<td><input type="text" name="userid" id="userid" tabindex="1" class="memberForm" maxlength="15" value="<?=($_COOKIE["ss_id_save"])?$_COOKIE["ss_id_save"]:$_GET['findid']?>"/></td>
									<td rowspan="2" valign="top";><input type="image" src="/member/images/login.gif" alt="로그인"></td>
								</tr>
								<tr>
									<th>비밀번호</th>
									<td><input type="password" name="pwd" id="pwd" tabindex="2" class="memberForm" maxlength="15" /></td>
								</tr>
								<tr>
									<th></th>
									<td><input name="id_save" type="checkbox" value="y" id="id_save" <?=($_COOKIE["ss_id_save"])?'checked':'';?>>&nbsp;<label for="id_save">아이디 저장</label></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</form>
					<div class="link">
						<div class="link1">아직 회원이 아니신가요? <p class="btn"><a href="/member/join01.php"><img src="/member/images/btn_join.gif" alt="회원가입하기"></a></p></div>
						<div class="link2">아이디, 혹은 비밀번호를 분실하셨나요? <p class="btn"><a href="/member/idpw.php"><img src="/member/images/btn_idpw.gif" alt="아이디/비밀번호 찾기"></a></p></div>
					</div>
				</div>
				<ul class="mtext">
					<li>회원이 되시면 다양한 회원서비스와 <br />
진료예약 등의 편리한 기능을 이용하실 수 있습니다.</li>
					<li>사용자 암호는 주기적으로 변경하고 <br />
타인에게 노출되지 않도록 주의하시기 바랍니다.</li>
					<li>로그인 후 모든 정보는 <br />
암호화하여 전송됩니다.</li>
				</ul>
			</div>
			<!--------------------------- End :: 로그인 (일반로그인버튼) ------------------------->
		</div>
	</div>
</div>
<? } else { echo "<script>window.parent.location.href='/main/main.php';</script>"; } ?>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>