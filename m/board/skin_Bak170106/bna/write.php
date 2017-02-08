<link href="/board/skin/<?=$boardSet["skin"];?>/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function fnConfirm(p_oForm) {
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
<?   if(!$_SESSION["ss_id"]){   ?>
		if(!p_oForm.agree.checked ){
			alert("개인정보취급방침에 동의하셔야 합니다");
			p_oForm.agree.focus();
			return false;
		}
		if(!p_oForm.strPass.value ){
			alert("비밀번호를 입력하셔야 합니다");
			p_oForm.strPass.focus();
			return false;
		}
	<? } ?>
		document.frmMain.submit();
		return true;
	}
</script>
<form name="frmMain" method="post" enctype="multipart/form-data" action="<?=$PHP_SELF?>" onsubmit="return fnConfirm(this);" id="frmMain">
	<input type="hidden" name="step" value="next">
	<input type="hidden" name="tb" value="<?=$tb?>">
	<input type="hidden" name="tNum" value="<?=$Data["number"]?>">
	<input type="hidden" name="act" value="<?=$act?>_ok">
	<input type="hidden" name="Name" value="<?=$tblStrName?>">
	<input type="hidden" name="Pass" value="<?=$tblStrPass?>">
<div id="boardSkin" style="width:1140px;">
<?	if($_SESSION["ss_level"] > 2){	?>
	<!----개인정보를 받는 모든 게시판에 개인정보취급방침 동의---->
	<div class="agreeBox">
		<div class="agreeText"><?=$bagData["consent"]?></div>
		<p><input name="agree" type="checkbox" value="">&nbsp;개인정보취급방침에 동의합니다</p>
	</div>
	<!----//개인정보를 받는 모든 게시판에 개인정보취급방침 동의---->
<?	}	?>
	<table width="100%" id="writeForm">
		<colgroup>
		<col width="20%" />
		<col width="80%" />
		</colgroup>
		<tbody>
			<tr>
				<th>제목</th>
				<td><input name="strSubject" type="text" id="strSubject" style="width:60%;" class="textForm" value="<?=$Data["subject"]?>" itemname="제목" required><span class="tt">
					<? if( $boardSet["secret"] == 'Y' ){
						  if($tb=='counsel1'){ ?>
						&nbsp;<input type="hidden" name="strSecret" id="strSecret" value="Y">
						<?}else{?>
						&nbsp;<input type="checkbox" name="strSecret" id="strSecret" value="Y" <?=( $Data["secret"] == 'Y' ) ? "checked" : "" ?>>	비밀글
					<?    }
					   } ?></span>
				</td>
			</tr>
			<tr>
				<th>출력설정</th>
				<td>
					<select name="strShow">
					<option <?=($Data["show"]=='Y')?'selected':'';?> value="Y">공개</option>
					<option <?=($Data["show"]=='N')?'selected':'';?> value="N">비공개</option> 
					</select>
					<input type="checkbox" name="intNotice" id="intNotice" value="1" <?=( $Data["notice"] == '1' ) ? "checked" : "" ?>> 베스트
				</td>
			</tr>
		<?	if( count( $List["categoryarr"] ) > 0 ){	?>
			<tr>
				<th>분류</th>
				<td><?=getChkCategory(array("name"=>"intField[]", "value"=>$Data["field"], "list"=>$List["categoryarr"]));?></td>
			</tr>
		<?	}	?>
			<tr>
				<th>작성자</th>
				<td><input name="strName" type="text" id="strName" class="textForm" style="width:40%;" value="<?= $Data["name"]?>" itemname="작성자" required></td>
			</tr>
		<?	if( $_SESS["ss_level"] > 2 ){	?>
			<tr>
				<th>비밀번호</th>
				<td><input name="strPass" type="password" id="strPass" class="textForm" style="width:20%;" itemname="비밀번호" required></td>
			</tr>
		<?	}	?>
	<?	for( $i = 0; $i < $boardSet["addfilenumber"]; $i++ ){	?>
			<tr>
				<th>
					<? 
						switch($i) {
							case '0': echo '정면'; break;
							case '1': echo '45도'; break;
							case '2': echo '측면'; break;
					   }
					   ?>
				</th>
				<td>
				<?	if( $Data["savefile"][$i] ) {
						$Data["filename"] = ( $Data["liefile"][$i] ) ? $Data["liefile"][$i] : $Data["savefile"][$i];
						echo $Data["filename"]."&nbsp;<img src='/board/skin/".$boardSet["skin"]."/images/icon_x.gif' onclick=\"fnDel('".$tb."','".$Data["number"]."','".$i."')\" style='cursor:hand' align='absmiddle'><br>";
					}	?>
					<input type="file" name="strSaveFile[]" id="strSaveFile" style="width:60%;height:21px;" class="textForm">
				</td>
			</tr>
	<?	}	?>
	<?	if( $_SESSION["ss_level"] <= 2 ){	?>
			<!---start : 관리자만--->
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
			<!---end : 관리자만--->
		<?	}	?>
			<tr>
				<th>전후사진 설명글</th>
				<td><input name="strComment" type="text" class="textForm" style="width:95%;" value="<?=$Data["comment"]?>"/></td>
			</tr>
		</tbody>
	</table>
	<div class="btnArea3"><input type="image" src="/board/skin/<?=$boardSet["skin"];?>/images/btn_ok.gif" class="middle">&nbsp;<img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_cancel.gif" onClick="javascript:location.href='<?=$PHP_SELF?>?tb=<?=$tb?>&sField=<?=$sField?>&sSearch=<?=$sSearch?>&sField2=<?=$sField2?>&sKeyword=<?=$sKeyword?>&sGP=<?=$sGP?>&sSecret=<?=$sSecret?>&act=list';" style="cursor:pointer;" class="middle"></div>
</div>
</form>
