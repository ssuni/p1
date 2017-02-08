<!--link href="/board/css/style.css" rel="stylesheet" type="text/css"-->
<!--------띄워지는 좌표는 알아서 조절해 주세요-------->
<div style="display:none;">
<div id="passwordBox" style="width:650px;height:185px;">
	<div style="width:630px;height:185px;background:url(/board/images/password_bg.jpg) no-repeat top left;border:10px solid #000;">
	<form name="passFrm" method="post" action="/board/password_proc.php" target="toplog_act">
		<input type="hidden" name="act" value="" id='mji'>
		<input type="hidden" name="gogos" value="" id='nmh'>
		<input type="hidden" name="tb" value="<?=$tb?>">
		<input type="hidden" name="tNum" value="" id='kdj'>
		<input type="hidden" name="Name" value="<?=$tblStrName?>">
		<input type="hidden" name="Pass" value="<?=$tblStrPass?>">
		<div style="color:#333; font-weight:bold; width:400px; height:40px;position:absolute;left:220px;top:120px">비밀번호&nbsp;<input name="strPass" type="password" style="background:#ffffff; border:1px solid #e0e0e0; padding:3px; height:25px;" itemname="비밀번호" required><input name="strPass1" type="password" style="background:#ffffff; border:1px solid #e0e0e0; padding:3px;height:15px;display:none;" itemname="비밀번호1">&nbsp;<input type="image" src="/board/skin/default/images/btn_ok.gif">
		<a title="close" href="javascript:jQuery(document.body).overlayPlayground('close');void(0)"><img src="/board/skin/default/images/btn_cancel.gif"></a>		
		</div>
	</form>
	</div>
</div>
</div>