<? include "../include/head.php" ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
$tabNum = 3;
?>
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/member/css/style.css' media='all' />
<script src='/js/jquery-1.11.2.min.js'></script>
<script src="/js/total.js"></script>
<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;아이디/비밀번호 찾기</div>
		<h2>아이디/비밀번호 찾기</h2>
		<div class="m_contents">
			<div><img src="images/head_idpw.gif" alt=""></div>
			<form method="post" action="/member/memgaip.php" name="id_search" onSubmit="return Form_Check_ID(this);">
			<input type="hidden" name="url" value="/member/idpw.php">
			<input type="hidden" name="mode" value="idpw1">
			<div class="id_box">
				<h3>아이디찾기</h3>
				<div class="search_box">
					<table summary="">
						<caption></caption>
						<tbody>
						<tr>
							<th>이름</th>
							<td><input type="text" name="fname" id="fname" tabindex="1" class="joinForm1" maxlength="6" style="width:270px;"></td>
							<td rowspan="2"><input type="image" src="/member/images/btn_search.gif" alt="찾기" tabindex="3" /></td>
						</tr>
						<tr>
							<th>이메일주소</th>
							<td><input type="text" name="femail" id="femail" tabindex="2" class="joinForm1" maxlength="30" style="width:270px;" onChange="javascript:return emailcheck(this.value);"></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			</form>
			<form method="post" action="/member/memgaip.php" name="pw_search" onSubmit="return Form_Check_PW(this);">
			<input type="hidden" name="url" value="/member/login.php">
			<input type="hidden" name="mode" value="idpw2">
			<div class="pw_box">
				<h3>비밀번호찾기</h3>
				<div class="search_box">
					<table summary="">
						<caption></caption>
						<tbody>
						<tr>
							<th>아이디</th>
							<td><input type="text" name="fuserid" id="fuserid" tabindex="4" class="memberForm" maxlength="15" style="width:270px;" style="ime-mode:disabled;"></td>
							<td rowspan="2"><input type="image" src="/member/images/btn_search.gif" alt="찾기" /></td>
						</tr>
						<tr>
							<th>이름</th>
							<td><input type="text" name="fname2" id="fname2" tabindex="5" class="memberForm" maxlength="6" style="width:270px;"></td>
						</tr>
						<tr>
							<th>이메일주소</th>
							<td><input type="text" name="femail2" id="femail2" tabindex="6" class="memberForm" maxlength="30" style="width:270px;" onChange="javascript:return emailcheck(this.value);"></td>
							<td></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div><div class="clr"></div></form>
		</div>
	</div>
</div>
<? } else { echo "<script>window.parent.location.href='/main/main.php';</script>"; } ?>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>