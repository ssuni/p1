function loading_field() {
	$.post("/loading_counselField.php", { tblIntField1:$('#tblIntField1').val()},function(data,state) {
		var optionHtml = '';
		for(var i=0; i<data.field.length; i++) {
			optionHtml += '<option value="'+ data.field[i] +'">'+ data.field_name[i] +'</option>';
		}
		title = '<option value="">선택하여 주세요</option>';
		$("#tblIntField2 option").remove();
		$('#tblIntField2').append(title+optionHtml);
	});
}

function counselSubmit() {
	if (!$.trim($('#tblStrName').val()))
	{
		alert('성명은 필수항목입니다.');
		$('#tblStrName').focus();
		return false;
	}
	if (!$.trim($('#tblStrMobile').val()))
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#tblStrMobile').focus();
		return false;
	}
	if (!$('#tblIntField1').val())
	{
		alert('상담부위는 필수항목입니다.');
		$('#tblIntField1').focus();
		return false;
	}
	if (!$('#tblIntField2').val())
	{
		alert('상담부위는 필수항목입니다.');
		$('#tblIntField2').focus();
		return false;
	}
}

function kakaoSubmit() {
	if ($('#agree').is(":checked") == false)
	{
		alert('개인정보 수집·이용 동의하셔야 합니다.');
		return false;
	}
	if (!$.trim($('#tblStrName').val()))
	{
		alert('성명은 필수항목입니다.');
		$('#tblStrName').focus();
		return false;
	}
	if (!$.trim($('#tblStrMobile').val()))
	{
		alert('핸드폰 번호는 필수항목입니다.');
		$('#tblStrMobile').focus();
		return false;
	}
}