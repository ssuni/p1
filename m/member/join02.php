<? include "../include/head.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php" ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
if ($_POST['agree1'] != 'y') {
   echo "<script>alert('이용약관에 동의 하셔야 합니다.'); history.go(-1);</script>";
   exit;
}
if ($_POST['agree2'] != 'y') {
   echo "<script>alert('개인정보의 수집 및 이용목적에 동의 하셔야 합니다.'); history.go(-1);</script>";
   exit;
}
if ($_POST['agree3'] != 'y') {
   echo "<script>alert('개인정보의 수집항목 및 방법에 동의 하셔야 합니다.'); history.go(-1);</script>";
   exit;
}
if ($_POST['agree4'] != 'y') {
   echo "<script>alert('개인정보의 보유 및 이용기간에 동의 하셔야 합니다.'); history.go(-1);</script>";
   exit;
}
$tabNum = 2;
?>
<script src="/js/total.js"></script>
<script src="/js/UI_SelectBoxDirect.js"></script>
<script>
$(function() {
    // 이메일		
    var selectBoxDirect = new SelectBoxDirect($("#strEmail3"), $("#strEmail2"));
    selectBoxDirect.change();    
});
</script>
<link href="../member/css/style.css" rel="stylesheet" type="text/css">
<div class="subWrap">
	<div class="contentsArea">
		<div class="conWrap"> 
			<!---------------------  // Start :: 본문  --------------------->
			<div class="m_contents">
				<div class="m_header">
					<h2>회원가입</h2>
				</div>
				<div class="m_join_wrap">
					<div class="htext">
						<strong>* 가입된 회원정보는 회원정보수정 메뉴에서 수정가능합니다.</strong><br /><span class="st">* 필수 입력 항목</span>
					</div>
					<form method="post" action="<?=$bagData["mdir"];?>/member/memgaip.php" name="form1" target="toplog_act" id="form1">
						<input type="hidden" name="mode" value="idcheck" id="mode">
						<input type="hidden" name="checking_id" value="" id="checking_id">
					</form>
					<form method="post" action="<?=$bagData["mdir"];?>/member/memgaip.php" name="join2_agrr" onSubmit="return Agrr2_Check(this);" target="toplog_act" id="join2_agrr">
						<input type="hidden" name="url" value="<?=$bagData["mdir"];?>/member/join03.php">
						<input type="hidden" name="mode" value="join2">
						<input type="hidden" name="idchch" value="" id="idchch">
					<table summary="" class="join_list">
						<caption></caption>
						<colgroup>
							<col width="25%" />
							<col width="75%" />
						</colgroup>
						<tbody>
							<tr>
								<th>이름 <span class="check">*</span></th>
								<td><input name="strName" type="text" style="width:250px;" class="joinForm1" id="strName">
									<div class="stext">이름이 부정확할 경우 진료예약 및 조회가 불가능합니다.</div>
								</td>
							</tr>
							<tr>
								<th>아이디 <span class="check">*</span></th>
								<td><input name="strUserId" type="text" class="joinForm1" id="strUserId" onKeyUp="ElementVar2('strUserId',this.value)" maxlength="20" style="width:250px; ime-mode:disabled;" oncontextmenu="return false" autocomplete="off" class="middle"> &nbsp; <a href="javascript:iiiidcheck();" onFocus="blur();" class="sbtn1" class="middle">중복확인</a>
									<div class="stext">6~20자여야 하며, 한글/특수문자는 입력이 불가능합니다.</div>
								</td>
							</tr>
							<tr>
								<th>비밀번호 <span class="check">*</span></th>
								<td><input type="password" name="pwd" class="joinForm1" maxlength="20" style="width:250px;ime-mode:disabled;" oncontextmenu="return false" autocomplete="off">
									<div class="stext">영문, 숫자 특수문자 조합으로 6~20자 이여야 합니다.</div>
								</td>
							</tr>
							<tr>
								<th>비밀번호 확인 <span class="check">*</span></th>
								<td><input type="password" name="repwd" class="joinForm1" maxlength="20" style="width:250px;ime-mode:disabled;" oncontextmenu="return false" autocomplete="off">
									<div class="stext">비밀번호 확인을 위해 다시 한 번 입력해주세요.</div>
								</td>
							</tr>
							<tr>
								<th>핸드폰 번호 <span class="check">*</span></th>
								<td>
									<select name="phone1" class="joinForm2">
										<option value="">::선택::</option>
										<option value="010">010</option>
										<option value="011">011</option>
										<option value="016">016</option>
										<option value="017">017</option>
										<option value="018">018</option>
										<option value="019">019</option>
									</select>
									-
									<input type="number" name="phone2" class="joinForm1" style="width:100px;ime-mode:disabled;" maxlength="4" oncontextmenu="return false" autocomplete="off">
									-
									<input type="number" name="phone3" class="joinForm1" style="width:100px;ime-mode:disabled;" maxlength="4" oncontextmenu="return false" autocomplete="off">
								</td>
							</tr>
							<tr>
								<th>이메일 주소 <span class="check">*</span></th>
								<td><input name="strEmail[]" type="text" style="width:80px;" class="joinForm1" id="strEmail1"> @ <input name="strEmail[]" type="text" style="width:80px;" class="joinForm1" id="strEmail2"> &nbsp;
									<select title="이메일 도메인 선택" class="joinForm2" id="strEmail3">
									<option value="self">직접입력</option>
									<?php foreach($emailDomain as $k => $v) { ?>
									<option value="<?php echo $v;?>"><?php echo $v;?></option>
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th>메일링 서비스</th>
								<td><input name="ismail" type="checkbox" value="Y" id="ismail"> <label for="ismail">메일링 서비스에 동의합니다. </label>
								<div class="stext"> 주요 정보 및 이벤트 소식 등 제공하는 정보를 받습니다. 예약 관련정보는 수신동의 여부와 관계없이 발송됩니다. </div></td>
							</tr>
							<tr>
								<th>SMS 수신여부</th>
								<td><input name="issms" type="checkbox" value="Y" id="issms"> <label for="issms">SMS 수신에 동의합니다.</label>
								<div class="stext"> 예약/상담/이벤트 관련 SMS를 받습니다. 예약/상담 중요정보는 수신동의 여부와 관계없이 발송됩니다. </div></td>
							</tr>
						</tbody>
					</table>
					<div class="btn_area">
						<button type="submit" class="ok_btn">등록하기</button> &nbsp;&nbsp;
						<a href="javascript:history.go(-1)" class="cancel_btn">취소</a>
					</div>
					</form>
				</div>
			</div>
			<!---------------------  // End :: 본문  --------------------->
		</div>
	</div>
</div>
<script language="JavaScript"> 
function ElementVar(ele,uid){
	$("input[name=" + ele + "]").val(uid);
}

function ElementZip(ele1,var1,ele2,var2,ele3,var3){
	$("input[name=" + ele1 + "]").val(var1);
	$("input[name=" + ele2 + "]").val(var2);
	$("input[name=" + ele3 + "]").val(var3);
}

function iiiidcheck(){
    var one=$('#strUserId').val();
    $('#checking_id').val(one);
	document.getElementById('form1').submit();
}

function ElementVar2(ele,uid){
	$("input[name=" + ele + "]").val(uid);
	$("input[name=idchch]").val('');
}
</script>
<iframe name="toplog_act" frameborder="0" width="0" height="0" style="display:none;"></iframe>
<? } else { echo "<script>window.parent.location.href='".$bagData["mdir"]."/main/main.php';</script>"; } ?>
<? include "../include/footer.php"; ?>
