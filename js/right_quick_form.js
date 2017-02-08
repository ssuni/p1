function counselSubmit() {
	if ($('#cagreement').is(":checked") == false)
	{
		alert('개인정보 수집·이용 동의하셔야 합니다.');
		return false;
	}
	if (!$('#ctblStrName').val())
	{
		alert('성명은 필수항목입니다.');
		$('#ctblStrName').focus();
		return false;
	}
	if (!$('#ctblStrMobile1').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile1').focus();
		return false;
	}
	if (!$('#ctblStrMobile2').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile2').focus();
		return false;
	}
	if (!$('#ctblStrMobile3').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile3').focus();
		return false;
	}
	if (!$('#ctblIntField').val())
	{
		alert('치료과목은 필수항목입니다.');
		return false;
	}
}

function kakaoSubmit() {
	if ($('#agree').is(":checked") == false)
	{
		alert('개인정보 수집·이용 동의하셔야 합니다.');
		return false;
	}
	if (!$('#tblStrName').val())
	{
		alert('성명은 필수항목입니다.');
		$('#tblStrName').focus();
		return false;
	}
	if (!$('#tblStrMobile1').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#tblStrMobile1').focus();
		return false;
	}
	if (!$('#tblStrMobile2').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#tblStrMobile2').focus();
		return false;
	}
	if (!$('#tblStrMobile3').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#tblStrMobile3').focus();
		return false;
	}
	if (!$('#tblStrKatok').val())
	{
		alert('카톡아이디는 필수항목입니다.');
		$('#tblStrKatok').focus();
		return false;
	}
	if (!$('#tblIntField').val())
	{
		alert('진료과목은 필수항목입니다.');
		$('#tblIntField').focus();
		return false;
	}
	if (!$('#tblStrAge').val())
	{
		alert('나이는 필수항목입니다.');
		$('#tblStrAge').focus();
		return false;
	}
	if (!$('#tblStrSex').val())
	{
		alert('성별은 필수항목입니다.');
		$('#tblStrSex').focus();
		return false;
	}
}

function cKakaoSubmit() {
	if ($('#cagree').is(":checked") == false)
	{
		alert('개인정보 수집·이용 동의하셔야 합니다.');
		return false;
	}
	if (!$('#ctblStrName').val())
	{
		alert('성명은 필수항목입니다.');
		$('#ctblStrName').focus();
		return false;
	}
	if (!$('#ctblStrMobile1').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile1').focus();
		return false;
	}
	if (!$('#ctblStrMobile2').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile2').focus();
		return false;
	}
	if (!$('#ctblStrMobile3').val())
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#ctblStrMobile3').focus();
		return false;
	}
	if (!$('#ctblStrKatok').val())
	{
		alert('카톡아이디는 필수항목입니다.');
		$('#ctblStrKatok').focus();
		return false;
	}	
	if (!$('#ctblIntField').val())
	{
		alert('진료과목은 필수항목입니다.');
		$('#ctblIntField').focus();
		return false;
	}
	if (!$('#ctblStrAge').val())
	{
		alert('나이는 필수항목입니다.');
		$('#ctblStrAge').focus();
		return false;
	}
	if (!$('#ctblStrSex').val())
	{
		alert('성별은 필수항목입니다.');
		$('#ctblStrSex').focus();
		return false;
	}
}