/*상단메뉴 스크롤 고정 셋팅*/
function Loin_Check(form){
    if(!form.userid.value || form.userid.value=="아이디"){
		alert("아이디를 입력해 주세요!");
		form.userid.focus();
		return false;
	}
	if(!form.pwd.value || form.pwd.value=="패스워드"){
		alert("비밀번호를 입력해 주세요!");
		form.pwd.focus();
		return false;
	}
	return true;
}

function isNumber(str) {
	if (str) {
		if (str.search(/[^0-9]/g) == -1) return true;
		else return false;
	}
	else return false;
}

function korOnly(str) {
	var strLength = str.length;
	var i;
	var Unicode;
	for (var i=0; i<strLength; i++){
		Unicode = str.charCodeAt(i);
		if ( !(44032 <= Unicode && Unicode <= 55203) ) return false;
	}
	return true;
}

function WinPop(clo_name,pop_name){
	if(clo_name){
		jQuery(document.body).overlayPlayground('close');
	}
	if(pop_name){
		$("#" + pop_name + "_linker").click();
	}
}

function Agrr2_Check(form){
	var v_true=false;
	var j_true=false;
	var numeric = /[0-9]/gi;
	var passwdvalue = form.pwd.value;
	var pattern = /[~!@\#$%<>^&*\()\-=+_\']/gi;

	if(!form.strName.value){
		alert("성명을 입력해 주세요!");
		form.strName.focus();
		return false;
	}
	if(!form.strUserId.value){
		alert("아이디를 입력해 주세요!");
		form.strUserId.focus();
		return false;
	}
	if(!is_ID(form.strUserId.value)){
		alert("아이디는 숫자 또는 영문만 입력가능하며, 6~20자 이내로 작성해야 합니다.");
		form.strUserId.value = "";
		form.strUserId.focus();
		return false;
	}
	if(!form.idchch.value || form.idchch.value.replace(/_/g,"") != 'checkingsuccess'){
		alert("아이디 중복확인을 해주세요!");
		form.strUserId.focus();
		return false;
	}
	if(!form.pwd.value){
		alert("비밀번호를 입력해 주세요!");
		form.pwd.focus();
		return false;
	}
	if (!passwdvalue.match(pattern))
	{
		alert("비밀번호는 특수문자(!,@,#등) 조합으로 입력하여 주세요.");
		form.pwd.focus();
		return false;
	}
	if(form.pwd.value.length < 6){
		alert("비밀번호는 영문, 숫자, 특수문자 조합으로 6~20자 이내로 작성해야 합니다.");
		form.pwd.focus();
		return false;
	}
	if(!form.repwd.value){
		alert("비밀번호 확인을 입력해 주세요!");
		form.repwd.focus();
		return false;
	}
	if(form.pwd.value!=form.repwd.value){
		alert("비밀번호가 일치하지 않습니다! 다시 입력해 주세요.");
		form.pwd.focus();
		return false;
	}
	if(!form.phone1.value){
		alert("핸드폰번호를 선택해 주세요.");
		form.phone1.focus();
		return false;
	}
	if(!form.phone2.value){
		alert("핸드폰번호를 입력해 주세요.");
		form.phone2.focus();
		return false;
	}
	if(!form.phone2.value.match(numeric)){
		alert("핸드폰번호는 숫자만 입력하여 주세요.");
		form.phone2.focus();
		return false;
	}
	if(!form.phone3.value){
		alert("핸드폰번호를 입력해 주세요.");
		form.phone3.focus();
		return false;
	}
	if(!form.phone3.value.match(numeric)){
		alert("핸드폰번호는 숫자만 입력하여 주세요.");
		form.phone2.focus();
		return false;
	}
	if(form.phone2.value.length < 3 || form.phone2.value.length > 4 || form.phone3.value.length != 4){
		alert("핸드폰번호를 정확히 입력하세요!");
		form.phone2.focus();
		return false;
	}
	if (!$('#strEmail1').val())
	{
		alert('이메일(앞자리)를 입력하여 주세요.');
		$('#strEmail1').focus();
		return false;
	}		
	if (!$('#strEmail2').val())
	{
		alert('이메일(뒷자리)를 입력하여 주세요.');
		$('#strEmail2').focus();
		return false;
	}		
}

function Edit_Check(form){
	var numeric = /[0-9]/gi;
	var pattern = /[~!@\#$%<>^&*\()\-=+_\']/gi;
	if(!form.sns.value){
		var passwdvalue = form.newpwd.value;
		if(!form.pwd.value){
			alert("비밀번호를 입력해 주세요!");
			form.pwd.focus();
			return false;
		}
		if(form.newpwd.value){
			if (!passwdvalue.match(pattern))
			{
				alert("새비밀번호는 특수문자(!,@,#등) 조합으로 입력하여 주세요.");
				form.newpwd.focus();
				return false;
			}
		  if(!form.re_newpwd.value){
			alert("새비밀번호 확인란를 입력해 주세요!");
			form.re_newpwd.focus();
			return false;
		  }
		  if(form.newpwd.value!=form.re_newpwd.value){
			alert("새비밀번호와 확인란번호가 일치하지 않습니다! 다시 입력해 주세요.");
			form.newpwd.focus();
			return false;
		  }
		}
	}
	if(!form.phone1.value){
		alert("핸드폰번호를 선택해 주세요.");
		form.phone1.focus();
		return false;
	}
	if(!form.phone2.value || !form.phone3.value){
		alert("핸드폰번호를 입력해 주세요.");
		form.phone2.focus();
		return false;
	}
	if(form.phone2.value.length < 3 || form.phone2.value.length > 4 || form.phone3.value.length != 4){
		alert("핸드폰번호를 정확히 입력하세요!");
		form.phone2.focus();
		return false;
	}
}

function is_ID(id_pw){
	if(id_pw.length < 6 || id_pw.length > 20){
		return false;
	}
	var j = k = 0;
	for(var i=0; i<id_pw.length; i++){
		var chr = id_pw.substr(i,1);
		if((chr < '0' || chr > '9') && (chr < 'a' || chr > 'z')){
			return false;
		}
		if(chr >= '0' && chr <= '9')
			j++;
		if(chr >= 'a' && chr <= 'z')
			k++;
	}
	return true;
}

function is_IDPW(id_pw){
	if(id_pw.length < 6 || id_pw.length > 20){
		return false;
	}
}

function Loin_Check(form){
	if(!form.userid.value || form.userid.value=="아이디"){
		alert("아이디를 입력해 주세요!");
		form.userid.focus();
		return false;
	}
	if(!form.pwd.value || form.pwd.value=="패스워드"){
		alert("비밀번호를 입력해 주세요!");
		form.pwd.focus();
		return false;
	}
	return true;
}

function Form_Check_ID(form){
	if(!form.fname.value){
		alert("이름을 입력해 주세요!");
		form.fname.focus();
		return false;
	}else{
		if(!korOnly(form.fname.value)){
			alert("이름은 한글만 입력됩니다!");
			form.fname.focus();
			form.fname.select();
			return false;
		}
	}
	if(!form.femail.value){
		alert("이메일을 입력해 주세요!");
		form.femail.focus();
		return false;
	}
	if(!emailcheck(form.femail.value)){
	 form.femail.focus();
	 return false;
	}
	return true;
}

function Form_Check_PW(form){
	if(!form.fuserid.value){
		alert("아이디를 입력해 주세요!");
		form.fuserid.focus();
		return false;
	}
	else{
		if(form.fuserid.value && !is_ID(form.fuserid.value)){
			alert("아이디는 4∼10자 사이의 영문(소문자)과 숫자만을 허용합니다!");
			form.fuserid.focus();
			form.fuserid.select();
			return false;
		}
	}
	if(!form.fname2.value){
		alert("이름을 입력해 주세요!");
		form.fname2.focus();
		return false;
	}else{
		if(!korOnly(form.fname2.value)){
			alert("이름은 한글만 입력됩니다!");
			form.fname2.focus();
			form.fname2.select();
			return false;
		}
	}
	if(!form.femail2.value){
		alert("이메일을 입력해 주세요!");
		form.femail2.focus();
		return false;
	}
	if(!emailcheck(form.femail2.value)){
	 form.femail2.focus();
	 return false;
	}
	return true;
}

function Del_Check(form){
	var passwdvalue = form.pwd.value;
	var pattern = /[~!@\#$%<>^&*\()\-=+_\']/gi;
	if(!form.duserid.value){
		alert("아이디를 입력해 주세요!");
		form.duserid.focus();
		return false;
	}
	if(!form.pwd.value){
		alert("비밀번호를 입력해 주세요!");
		form.pwd.focus();
		return false;
	}
	if(!form.reason.value){
		alert("탈퇴사유를 선택하여 주세요!");
		return false;
	}
	if(!form.content.value){
		alert("바라는점을 입력해 주세요!");
		form.content.focus();
		return false;
	}
	if(confirm("회원을 탈퇴하게 되시면 기존에 입력한 자료에 대한 \n수정 및 삭제에 대한 권한은 없어집니다.\n\n 그래도 탈퇴하시겠습니까?")){
      return true;
	}else{
      alert("탈퇴를 취소하셨습니다.");
	  return false;
	}	
}

function onlyNumber(event) {
	var code = event.which?event.which:event.keyCode;
	if((code<48)||(code>57))
		return false;
}

function open_win(){
  window.open('/com_popup/com_popup_02.html','win_popo','height=450,width=507,top=150,left=200,scrollbars=no');
}

function win_popup(aa,bb,cc){
  window.open(aa,bb,cc);
}

function mem_login(){
	alert('JK위드미 성형외과, 피부과는 의료법을 준수합니다.\n\n본 페이지는 로그인한 회원에게만 제공되는 페이지입니다.');
	$("#example0_linker").click();
}

 function minicounsel2(oo){
  if(!oo.h_strName.value){
   alert('성명을 입력해 주세요.');
   oo.h_strName.focus();
   return false;
  }
  if(!oo.h_intField.value){
   alert('과목을 선택해 주세요.');
   oo.h_intField.focus();
   return false;
  }
  if(!oo.h_strPhone1.value){
   alert('휴대폰번호를 입력해 주세요.');
   oo.h_strPhone1.focus();
   return false;
  }
  if(!oo.h_strPhone2.value){
   alert('휴대폰번호를 입력해 주세요.');
   oo.h_strPhone2.focus();
   return false;
  }
  if(!oo.h_strPhone3.value){
   alert('휴대폰번호를 입력해 주세요.');
   oo.h_strPhone3.focus();
   return false;
  }
  oo.h_strPhone.value=oo.h_strPhone1.value+"-"+oo.h_strPhone2.value+"-"+oo.h_strPhone3.value;
  /*if(!oo.h_strMonth.value){
   alert('연령을 입력해 주세요.');
   oo.h_strMonth.focus();
   return false;
  }*/
  if(!oo.h_strTime.value){
   alert('상담시간을 선택해 주세요.');
   oo.h_strTime.focus();
   return false;
  }
  if(!oo.h_strComment.value){
   alert('내용을 입력해 주세요.');
   oo.h_strComment.focus();
   return false;
  }
  if(!oo.agree.checked){
   alert('개인정보취급방침에 동의를 하셔야 합니다.');
   return false;
  }
  return true;
 }

		function chkReservation() {
			if(document.frmMain.Agree){
				if( !document.frmMain.Agree.checked ) {
					alert('개인정보취급방침에 동의하셔야 합니다.');
					document.frmMain.Agree.focus();
					return false;
				}
			}
			if( !document.frmMain.strDate.value ) {
				alert('좌측의 달력에서 예약버튼을 눌러 주십시오.');
				return false;
			}
			if( !document.frmMain.strTime.value ) {
				alert('예약시간을 선택해 주세요.');
				document.frmMain.strTime.focus();
				return false;
			}
			if( !document.frmMain.intField.value ) {
				alert('진료과목을 선택해 주세요.');
				document.frmMain.intField.focus();
				return false;
			}
			if( !document.frmMain.strName.value ) {
				alert('이름을 입력해 주세요.');
				document.frmMain.strName.focus();
				return false;
			}
			if( !document.frmMain.strEmail.value ) {
				alert('이메일주소를 입력해 주세요.');
				document.frmMain.strEmail.focus();
				return false;
			}
			if( !document.frmMain.strPass1.value ) {
				alert('비밀번호를 입력해 주세요.');
				document.frmMain.strPass1.focus();
				return false;
			}
			if( !document.frmMain.strPass2.value ) {
				alert('비밀번호 확인을 입력해 주세요.');
				document.frmMain.strPass2.focus();
				return false;
			}
			if( !document.frmMain.strPhone1.value) {
				alert('핸드폰번호를 입력해 주세요.');
				document.frmMain.strPhone1.focus();
				return false;
			}
			if( !document.frmMain.strPhone2.value ) {
				alert('핸드폰번호를 입력해 주세요.');
				document.frmMain.strPhone2.focus();
				return false;
			}
			if( !document.frmMain.strPhone3.value ) {
				alert('핸드폰번호를 입력해 주세요.');
				document.frmMain.strPhone3.focus();
				return false;
			}
			return true;
		}