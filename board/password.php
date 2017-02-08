<div class="password_wrap">
	<link rel='stylesheet' href='/board/images/password.css' media='all' />
	<div class="password_bg">
		<div class="leftarea"><img src="/board/images/img_password.jpg" alt="" /></div>
		<div class="rightarea">
			<div class="t1">비밀번호를 입력해 주세요.</div>
			<div class="t2">비밀번호 입력이 필요한 서비스입니다. <br />비밀번호를 정확히 입력해 주세요.</div>
	<form name="passFrm" method="post" action="/board/password_proc.php" target="toplog_act">
		<input type="hidden" name="act" value="<?=$mji?>" id='mji'>
		<input type="hidden" name="gogos" value="<?=$nmh?>" id='nmh' size="150">
		<input type="hidden" name="tb" value="<?=$tb?>">
		<input type="hidden" name="tNum" value="<?=$kdj;?>" id='kdj'>
				<div class="form">비밀번호&nbsp;<input name="strPass" type="password" itemname="비밀번호" class="inputs" required><input name="strPass1" type="password" class="inputs" style="display:none;" itemname="비밀번호1">&nbsp;<input type="image" src="/board/images/btn_ok.jpg">&nbsp;<a title="close" href="javascript:history.go(-1)"><img src="/board/images/btn_cansel.jpg"></a>
				</div>
			</form>
		</div><div class="clr"></div>
	</div>
</div>