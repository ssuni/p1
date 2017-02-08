<? include "../include/head.php" ?>
<? if(!$_SESSION["ss_id"]) { echo "<script>location.href='/member/login.php?ref=".urlencode($_SERVER['REQUEST_URI'])."';</script>"; } ?>
<? 
$tabNum = 4;
include "../include/selectConfig.php";
?>
<link rel='stylesheet' href='../css/style.css' media='all' />
<link rel='stylesheet' href='../member/css/style.css' media='all' />
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="/js/UI_SelectBoxDirect.js"></script>
<script src="/js/total.js"></script>
<script>
$(function() {
    // 이메일		
    var selectBoxDirect = new SelectBoxDirect($("#strEmail3"), $("#strEmail2"));
    selectBoxDirect.change();    
});
</script>
<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원정보수정</div>
		<h2>회원정보수정</h2>
		<div class="m_contents">
			<div><img src="images/head_modify.gif" alt=""></div>
			<div class="htext2 mgt30">
				<strong>* 회원정보를 수정하기 위하여 필수항목을 다시 입력해 주세요. </strong><span class="st">* 필수 입력 항목</span>
			</div>

		<?
			$sql="select * from tblPerMember where tblStrID='".$_SESSION["ss_id"]."'";
			$stmt=mysql_query($sql,$connect);
			$rs=mysql_fetch_array($stmt); 
			$phone = explode("-",$rs["tblStrMobile"]);
			$email = explode("@",$rs["tblStrEmail"]);
		?>
		<form method="post" action="/member/memgaip.php" name="edit_agrr" onSubmit="return Edit_Check(this);" target="toplog_act" id="edit_agrr">
			<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
			<input type="hidden" name="mode" value="edit">
			<input type="hidden" name="strUserId" value="<?=$_SESSION["ss_id"]?>">
			<input type="hidden" name="strName" value="<?=$rs["tblStrName"]?>">
			<input type="hidden" name="chkemail" value="<?=$rs["tblStrEmail"]?>">
			<input type="hidden" name="sns" value="<?=$_SESSION['sns']?>">
			<table summary="" class="join_list">
				<caption></caption>
				<colgroup>
					<col width="15%" />
					<col width="85%" />
				</colgroup>
				<tbody>
					<tr>
						<th>이름 <span class="check">*</span></th>
						<td><?=$rs["tblStrName"]?></td>
					</tr>
					<? if (!$_SESSION['sns']) { ?>
					<tr>
						<th>아이디 <span class="check">*</span></th>
						<td><?=$_SESSION["ss_id"]?></td>
					</tr>
					<tr>
						<th>비밀번호 <span class="check">*</span></th>
						<td><input type="password" name="pwd" class="joinForm1" maxlength="15" style="ime-mode:disabled;" oncontextmenu="return false" autocomplete="off"> 
						<span class="tt">기존 비밀번호를 입력해 주세요.</span></td>
					</tr>
					<tr>
						<th>새 비밀번호</th>
						<td><input type="password" name="newpwd" class="joinForm1" maxlength="15" style="ime-mode:disabled;" oncontextmenu="return false" autocomplete="off">
						<span class="tt">변경하고자 하는 비밀번호를 영문, 숫자 2가지 이상 조합으로 10~20자 이여야 합니다.</span></td>
					</tr>
					<tr>
						<th>새 비밀번호확인</th>
						<td><input type="password" name="re_newpwd" class="joinForm1" maxlength="15" style="ime-mode:disabled;" oncontextmenu="return false" autocomplete="off">
						<span class="tt">비밀번호를 다시 입력해 주세요</span></td>
					</tr>
					<? } ?>
					<tr>
						<th>핸드폰 번호 <span class="check">*</span></th>
						<td>
							<select name="phone1" class="joinForm2">
								<option value=""<?if($phone[0]=="") echo " selected";?>>::선택::</option>
								<option value="010"<?if($phone[0]=="010") echo " selected";?>>010</option>
								<option value="011"<?if($phone[0]=="011") echo " selected";?>>011</option>
								<option value="016"<?if($phone[0]=="016") echo " selected";?>>016</option>
								<option value="017"<?if($phone[0]=="017") echo " selected";?>>017</option>
								<option value="018"<?if($phone[0]=="018") echo " selected";?>>018</option>
								<option value="019"<?if($phone[0]=="019") echo " selected";?>>019</option>
							</select>
							-
							<input type="text" name="phone2" class="joinForm1" style="width:100px;ime-mode:disabled;" maxlength="4" onKeyPress="onlyNumber();" oncontextmenu="return false" autocomplete="off" value="<?=$phone[1]?>">
							-
							<input type="text" name="phone3" class="joinForm1" style="width:100px;ime-mode:disabled;" maxlength="4" onKeyPress="onlyNumber();" oncontextmenu="return false" autocomplete="off" value="<?=$phone[2]?>">
						</td>
					</tr>
					<tr>
						<th>이메일 주소 <span class="check">*</span></th>
						<td><input name="strEmail[]" type="text" style="width:150px;" class="joinForm1" id="strEmail1" value="<?=$email[0];?>"> @ <input name="strEmail[]" type="text" style="width:250px;" class="joinForm1" id="strEmail2" value="<?=$email[1];?>"> &nbsp;
							<select title="이메일 도메인 선택" class="joinForm2"  id="strEmail3">
								<option value="">선택하세요</option>				
								<?php
									foreach($emailDomain as $k => $v) {
										if ($email[1]==$v) {
											$selected = 'selected="selected"';
											$direct++;
										} else {
											$selected = '';
										}
								?>
								<option <?php echo $selected?> value="<?php echo $v;?>"><?php echo $v;?></option>
								<?php } ?>
								<option <?php echo (!$direct)?'selected="selected"':''?> value="self">직접입력</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>메일링 서비스</th>
						<td><input name="ismail" type="checkbox" value="Y" <?if($rs["tblBlnEmail"]=="Y") echo " checked";?> id="ismail"> <label for="ismail">메일링 서비스에 동의합니다. </label>
						<div class="stext"> 주요 정보 및 이벤트 소식 등 제공하는 정보를 받습니다. 예약 관련정보는 수신동의 여부와 관계없이 발송됩니다. </div></td>
					</tr>
					<tr>
						<th>SMS 수신여부</th>
						<td><input name="issms" type="checkbox" value="Y" <?if($rs["tblBlnSms"]=="Y") echo " checked";?> id="issms"> <label for="issms">SMS 수신에 동의합니다.</label>
						<div class="stext"> 예약/상담/이벤트 관련 SMS를 받습니다. 예약/상담 중요정보는 수신동의 여부와 관계없이 발송됩니다. </div></td>
					</tr>
				</tbody>
			</table>
			<div class="btn_area">
				<button type="submit" class="ok_btn">수정하기</button> &nbsp;&nbsp;
				<a href="/" class="cancel_btn">취소</a>
			</div>
			</form>
		</div>
	</div>
</div>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>