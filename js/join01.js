$(function() {
	$('#agree_top').click(function() {
		if ($(this).is(':checked') == true)
		{
			$('#agree1_1').attr('checked', true);
			$('#agree2_1').attr('checked', true);
			$('#agree3_1').attr('checked', true);
			$('#agree4_1').attr('checked', true);
			$('#agree_bottom').attr('checked', true);
		}
	});
	$('#agree_bottom').click(function() {
		if ($(this).is(':checked') == true)
		{
			$('#agree1_1').attr('checked', true);
			$('#agree2_1').attr('checked', true);
			$('#agree3_1').attr('checked', true);
			$('#agree4_1').attr('checked', true);
			$('#agree_top').attr('checked', true);
		}
	});
});
function Agrr_Check() {
	if ($('#agree1_1').is(":checked") == false)
	{
		alert('이용약관에 동의 하셔야 합니다.');
		return false;
	}
	if ($('#agree2_1').is(":checked") == false)
	{
		alert('개인정보의 수집 및 이용목적에 동의 하셔야 합니다.');
		return false;
	}
	if ($('#agree3_1').is(":checked") == false)
	{
		alert('개인정보의 수집항목 및 방법에 동의 하셔야 합니다.');
		return false;
	}
	if ($('#agree4_1').is(":checked") == false)
	{
		alert('개인정보의 보유 및 이용기간에 동의 하셔야 합니다.');
		return false;
	}	
}