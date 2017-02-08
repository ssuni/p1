<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function fnConfirm(p_oForm) {
		<? if(!$_SESSION["ss_id"]){   ?>
		if(!p_oForm.agree.checked ){
			alert("개인정보취급방침에 동의하셔야 합니다");
			p_oForm.agree.focus();
			return false;
		}
		<? } ?>
		if(!p_oForm.strSubject.value){
			alert("제목을 입력하셔야 합니다");
			p_oForm.strSubject.focus();
			return false;
		}
		if(!p_oForm.strName.value){
			alert("작성자를 입력하셔야 합니다");
			p_oForm.strName.focus();
			return false;
		}
		<? if(!$_SESSION["ss_id"]){   ?>
		if(!p_oForm.strPass.value ){
			alert("비밀번호를 입력하셔야 합니다");
			p_oForm.strPass.focus();
			return false;
		}
		<? } ?>
		if (!p_oForm.strMobile2.value || !p_oForm.strMobile3.value){
			alert("연락처를 입력하셔야 합니다");
			return false;
		}
		if(!p_oForm.strEmail.value){
			alert("이메일을 입력하셔야 합니다");
			p_oForm.strEmail.focus();
			return false;
		}
		if(p_oForm.wr_key){
		  if(!p_oForm.wr_key.value){
			alert("자동등록방지글을 입력하셔야 합니다.");
			p_oForm.wr_key.focus();
			return false;
		  }
		}
		
		document.frmMain.submit();
		return true;
	}
</script>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="utf-8"></script>
<form name="frmMain" method="post" enctype="multipart/form-data" action="<?=$PHP_SELF?>?act=<?=$act?>_ok" id="frmMain">
	<input type="hidden" name="step" value="next">
	<input type="hidden" name="tb" value="<?=$tb?>">
	<input type="hidden" name="tNum" value="<?=$Data["number"]?>">
	<input type="hidden" name="act" value="<?=$act?>_ok">
	<input type="hidden" name="Name" value="<?=$tblStrName?>">
	<input type="hidden" name="Pass" value="<?=$tblStrPass?>">
	<input type="hidden" name="sSearch" value="<?=$_GET['sSearch']?>">
	<input type="hidden" name="sKeyword" value="<?=$_GET['sKeyword']?>">
	<input type="hidden" name="p" value="<?=$_GET['p']?>">
<div id="boardSkin">
<?   if(!$_SESSION["ss_id"]){   ?>
	<!----개인정보를 받는 모든 게시판에 개인정보취급방침 동의---->
	<div class="agreeBox">
		<div class="agreeText">
			<table width="100%" summary="">
				<caption></caption>
				<colgroup>	
					<col width="33%" />
					<col width="33%" />
					<col width="33%" />
				</colgroup>
				<thead>
					<tr>
						<th>필수항목</th>
						<th>수집목적</th>
						<th>보유기간</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>제목, 실명, 연락처, 이메일</td>
						<td>상담게시판에 상담내용 등록</td>
						<td>1년(상담 목적 달성 확인시)</td>
					</tr>
				</tbody>
			</table>
		</div>
		<p><input name="agree" id="agree" type="checkbox" value="">&nbsp;<label for="agree">개인정보취급방침에 동의합니다</label></p>
	</div>
	<!----//개인정보를 받는 모든 게시판에 개인정보취급방침 동의---->
<?	}	?>
	<table width="100%" id="writeForm">
		<colgroup>
		<col width="20%" />
		<col width="80%" />
		</colgroup>
		<tbody>
		<?	if( count( $List["categoryarr"] ) > 0 ){	?>
			<tr>
				<th>진료과목</th>
				<td><?=getSelectCategory(array("name"=>"intField", "value"=>$Data["field"], "list"=>$List["categoryarr"], "itemname"=>"분류"));?></td>
			</tr>
		<?	}	?>
			<tr>
				<th>제목 <span class="red">*</span></th>
				<td><input name="strSubject" type="text" id="strSubject" style="width:60%;" class="textForm" value="<?=$Data["subject"]?>" itemname="제목" required><span class="tt">
					<? if( $_SESS["ss_level"] <= 2 && $boardSet["notice"] == 'Y' ){	?>
						&nbsp;<input type="checkbox" name="intNotice" id="intNotice" value="1" <?=( $Data["notice"] == '1' ) ? "checked" : "" ?>>	
						베스트
					<? }
					   if( $boardSet["secret"] == 'Y' ){
						  if($tb=='counsel1' || $tb=='online_counsel'){ ?>
						&nbsp;
						<input type="hidden" name="strSecret" id="strSecret" value="Y">
						<?}else{?>
						&nbsp;<input type="checkbox" name="strSecret" id="strSecret" value="Y" <?=( $Data["secret"] == 'Y' ) ? "checked" : "" ?>>	<?if($tb=='banner' || $tb=='banner2') echo "비노출"; else echo "비밀글";?>
					<?    }
					   } ?></span>
				</td>
			</tr>
			<tr>
				<th>작성자 <span class="red">*</span></th>
				<td><input name="strName" type="text" id="strName" class="textForm" style="width:20%;" value="<?=$strName;?>" itemname="작성자" required> <span class="tt">* 실명을 정확히 입력해주셔야 보다 정확한 상담이 가능합니다. </span></td>
			</tr>
			<? if(!$_SESSION["ss_id"]){   ?>
			<tr>
				<th>비밀번호 <span class="red">*</span></th>
				<td><input name="strPass" type="password" id="strPass" class="textForm" style="width:20%;" itemname="비밀번호" required></td>
			</tr>
			<? } ?>
			<tr>
				<th>연락처 <span class="red">*</span></th>
				<td><select name="strMobile1" <?=( $_SESS["ss_level"] > 2 ) ? "itemname='연락처' required" : "" ?>>
				 <?for($i=1;$i<count($phone_num2);$i++){?>
					<option value="<?=$phone_num2[$i]?>" <?=( $Data["mobile"][0] == $phone_num2[$i] ) ? "selected" : ""?>><?=$phone_num2[$i]?></option>
				 <?}?>
				</select>
			 - 
			 <input name="strMobile2" type="text" id="strMobile2" style="width:80px;" maxlength="4" class="textForm" value="<?=$Data["mobile"][1]?>" <?=( $_SESSION["ss_level"] > 2 ) ? "itemname='휴대폰' required numeric" : "" ?>>
			 - 
			 <input name="strMobile3" type="text" id="strMobile3" style="width:80px;" maxlength="4" class="textForm" value="<?=$Data["mobile"][2]?>" <?=( $_SESSION["ss_level"] > 2 ) ? "itemname='휴대폰' required numeric" : "" ?>></td>
			</tr>
			<tr>
				<th>이메일 <span class="red">*</span></th>
				<td><input name="strEmail" type="text" id="strEmail" class="textForm" value="<?=($_SESSION["ss_email"])?$_SESSION["ss_email"]:$Data["email"];?>" itemname="이메일" style="width:95%;" /></td>
			</tr>
	<?if($boardSet["homepage"] == 'Y'){?>
			<tr>
				<th>홈페이지</th>
				<td><input name="strHomepage" type="text" id="strHomepage" maxlength="250" class="textForm" style="width:95%;" value="<?=$Data["homepage"]?>"></td>
			</tr>
	<?}?>
	<?	for( $i = 0; $i < $boardSet["addfilenumber"]; $i++ ){	?>
			<tr>
				<th><?if($tb=='banner' || $tb=='banner2') echo "배너이미지"; else echo "첨부파일";?>첨부파일<?=$i+1?></th>
				<td>
				<?	if( $Data["savefile"][$i] ) {
						$Data["filename"] = ( $Data["liefile"][$i] ) ? $Data["liefile"][$i] : $Data["savefile"][$i];
						echo $Data["filename"]."&nbsp;<img src='/board/skin/".$boardSet["skin"]."/images/icon_x.gif' onclick=\"fnDel('".$tb."','".$Data["number"]."','".$i."')\" style='cursor:hand' align='absmiddle'><br>";
					}	?>
				<input type="file" name="strSaveFile[]" id="strSaveFile" style="width:70%;height:21px;" class="textForm"><?if(($tb=='banner' || $tb=='banner2') && $i==0) echo "(적정사이즈 : 285 X 144)"; else if(($tb=='banner' || $tb=='banner2') && $i==1) echo "(적정사이즈 : 252 X 155)";?></td>
			</tr>
	<?	}	?>
	<?	if( $_SESSION["ss_level"] <= 2 ){	?>
			<!---start : 관리자만
			<tr>
				<th>등록일</th>
				<td><select name="iYear">
					<option value="">::년도::</option>
				<?	for( $i = 2010; $i <= date(Y); $i++ ){	?>
					<option value="<?=$i?>"><?=$i?></option>
				<?	}	?>
				</select> 년 
				<select name="iMonth">
					<option value="">::월::</option>
				<?	for( $i = 1; $i <= 12; $i++ ){	?>
					<option value="<? echo zero_full($i,2); ?>"><? echo zero_full($i,2); ?></option>
				<?	}	?>
				</select> 월 
			 	<select name="iDay">
					<option value="">::일::</option>
				<?	for( $i = 1; $i <= 31; $i++ ){	?>
					<option value="<? echo zero_full($i,2); ?>"><? echo zero_full($i,2); ?></option>
				<?	}	?>
				</select> 일 <span class="tt">*설정시 등록일이 변경됩니다.</span>				
				</td>
			</tr>
			-->
			<tr>
				<th>조회수</th>
				<td><input name="intRef" type="text" id="intRef" class="textForm" style="width:40%;" value="<?=$Data["ref"]?>" numeric><span class="tt">*설정시 조회수가 변경됩니다.</span></td>
			</tr>
		<?	if($boardSet["streaming"] == 'Y'){	?>
		<!---동영상 첨부기능 있을경우--->
			<tr>
				<th>스트리밍</th>
				<td><input name="strStreaming" id="strStreaming" type="text" class="textForm" style="width:40%;" value="<?=$Data["streaming"]?>"><span class="tt">*스트리밍 서버의 파일이름만 기재</span></td>
			</tr>
		<!---//동영상 첨부기능 있을경우--->
		<?	}	?>
			<!---end : 관리자만--->
		<?	}	?>
		
			<tr>
				<th>자동등록 <span class="red">*</span></th>
				<td><input name="wr_key" type="text" id="wr_key" class="textForm" style="width:20%;" itemname="자동등록방지" required>&nbsp;<?=$norobot_str?> <font color="#FF6600">붉은색 글씨</font>를 차례로 입력해주세요.</td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea name="ir1" id="ir1" rows="10" cols="100" style="width:100%; height:412px; display:none;"><?=$Data["comment"]?></textarea>
					<p style="display:none"><textarea name="strComment" id="strComment" cols="45" rows="5" style="width:880px;" itemname="내용"><?=$Data["comment"]?></textarea></p>
				</td>
			</tr>
		<?if($_SESSION["ss_level"] <= 2 && $act=="modify"){
			if($Data["rename"]=="") $Data["rename"]=$_SESSION["ss_name"];?>
		</tbody></table>
		<table width="100%" id="writeForm">
			<colgroup>
			<col width="20%">
			<col width="80%">
			</colgroup>
			<tbody>
			<tr>
				<th>답변자</th>
				<td><input name="strReName" type="text" id="strReName" class="textForm" style="width:40%;" value="<?=$Data["rename"]?>" itemname="답변자"></td>
			</tr>
			<tr>
				<th>답변시 메일발송</th>
				<td><input name="newemail" type="checkbox" value="Y"></td>
			</tr>
			<tr>
				<th>답변</th>
				<td>
					<textarea name="ir2" id="ir2" rows="10" cols="100" style="width:100%; height:250px; display:none;"><?=$Data["reply"]?></textarea>
					<p style="display:none"><textarea name="strReply" id="strReply" cols="45" rows="5" style="width:880px;" itemname="내용"><?=$Data["reply"]?></textarea></p>
				</td>
			</tr>
		<?}?>
		</tbody>
	</table>
	<div class="btnArea3"><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_ok.gif" style="cursor:pointer" onclick="submitContents(document.frmMain);" class="middle">&nbsp;<img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_cancel.gif" onClick="javascript:location.href='<?=$PHP_SELF?>?tb=<?=$tb?>&sField=<?=$sField?>&sSearch=<?=$sSearch?>&sField2=<?=$sField2?>&sKeyword=<?=$sKeyword?>&sGP=<?=$sGP?>&sSecret=<?=$sSecret?>&act=list';" style="cursor:pointer;" class="middle"></div>
</div>
</form>

<script type="text/javascript">
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir2",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function popupImgAdd() { window.open("/editor/photo_uploader/popup/image.html", "a", "width=400, height=300, left=100, top=50"); }

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["ir1"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
	document.getElementById("strComment").value = document.getElementById("ir1").value;

	<?if($_SESSION["ss_level"] <= 2 && $act=="modify"){ ?>
	oEditors.getById["ir2"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
	document.getElementById("strReply").value = document.getElementById("ir2").value;
	<? } ?>
	try {
		var breaker = fnConfirm(elClickedObj)
		if (breaker == false)
		{
			return false;
		}
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>

