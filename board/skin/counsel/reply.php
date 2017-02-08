<link href="/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function fnConfirm(p_oForm) {
		document.frmMain.submit();
		return true;
	}
</script>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="utf-8"></script>
<form name="frmMain" method="post" enctype="multipart/form-data" action="<?=$PHP_SELF?>" id="frmMain" onsubmit="return submitContents(this);" >
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
				<th>제목</th>
				<td><?=$Data["subject"]?></td>
			</tr>
			<tr>
				<th>작성자</th>
				<td><?=$strName;?></td>
			</tr>
			<tr>
				<th>연락처</th>
				<td><?=$Data["mobile"];?></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td><?=$Data["email"];?></td>
			</tr>
	<?if($Data["homepage"]){?>
			<tr>
				<th>홈페이지</th>
				<td><?=$Data["homepage"]?></td>
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
		<?	if($Data["streaming"]){	?>
		<!---동영상 첨부기능 있을경우--->
			<tr>
				<th>스트리밍</th>
				<td><?=$Data["streaming"]?></td>
			</tr>
		<!---//동영상 첨부기능 있을경우--->
		<?	}	?>
	
			<tr>
				<td colspan="2"><?=nl2br($Data["comment"])?></td>
			</tr>
		<?if($_SESSION["ss_level"] <= 2 && $act=="reply"	){
			if($Data["rename"]=="") $Data["rename"]=$_SESSION["ss_name"];?>
		</tbody>
		</table>

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
			<? if ($bagData["smsid"]) { ?>
			<tr>
				<th>답변시 문자발송</th>
				<td><input name="newsms" type="checkbox" value="Y"></td>
			</tr>
			<? } ?>
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

	<div class="btnArea3"><input type="image" src="/board/skin/<?=$boardSet["skin"];?>/images/btn_ok.gif" style="cursor:pointer" class="middle">&nbsp;<img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_cancel.gif" onClick="javascript:location.href='<?=$PHP_SELF?>?tb=<?=$tb?>&sField=<?=$sField?>&sSearch=<?=$sSearch?>&sField2=<?=$sField2?>&sKeyword=<?=$sKeyword?>&sGP=<?=$sGP?>&sSecret=<?=$sSecret?>&act=list';" style="cursor:pointer;" class="middle"></div>
</div>
</form>

<script type="text/javascript">
var oEditors = [];

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

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["ir1"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["ir2"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
	document.getElementById("strReply").value = document.getElementById("ir2").value;
	try {
		fnConfirm(elClickedObj)
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>

