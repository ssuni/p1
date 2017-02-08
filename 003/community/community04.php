<?
$mn = 9;
$sn = 4;
$cn = 0;
?>
<? include "../include/head.php" ?>	
<? include $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php" ?>
<script src="/js/customer_form.js"></script>
<link rel='stylesheet' href='/css/board.css' media='all' />
	<!-- container -->
	<div id="container" class="sub">
		<h2 class="title01">TALK COUNSEL</h2>
		<p class="top_txt">빠르고 정확하게 상담해드리겠습니다.</p>

			<div class="form_area2">
				<form name="kakao" method="post" action="/board/kakao_proc.php" onSubmit="return kakaoSubmit()">
				<h3>개인정보 수집·이용 동의 안내<span class="st">※ 동의를 거부할 수 있습니다. 동의 거부시에는 상담서비스 이용이 제한됩니다.</span></h3>
				<div class="agree_box">
					<table summary="">
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
								<td>이름, 관심부위, 연락처, 카카오톡 아이디, 나이, 성별</td>
								<td>카카오톡 상담서비스 이행을 위한 연락</td>
								<td>1년(상담 목적 달성 확인시)</td>
							</tr>
						</tbody>
					</table>
					<div class="agree_form">
						<input type="radio" id="agree" required> &nbsp; <label for="agree">위 개인정보 수집·이용에 동의합니다.</label>
					</div>
				</div>
				<table summary="" class="form_list">
					<caption></caption>
					<colgroup>
						<col width="15%" />
						<col width="85%" />
					</colgroup>
					<tbody>
						<tr>
							<th>성명</th>
							<td><input name="tblStrName" type="text" style="width:250px;" class="form1" id="tblStrName" itemname="성명" required></td>
						</tr>
						<tr>
							<th>관심부위</th>
							<td>
								<select id="tblIntField" name="tblIntField" class="form2" itemname="관심부위" required>
									<option value="">선택하세요</option>
									<? foreach($counselField as $k => $v) { ?>
									<option value="<?=$k;?>"><?=$v;?></option>
									<? } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th>연락처</th>
							<td><input name="tblStrMobile" type="text" style="width:350px;" class="form1" id="tblStrMobile" itemname="연락처" required> <span class="stext">(예)01012349870)</span></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td><input name="tblStrId" type="text" style="width:250px;" class="form1" id="tblStrId" value="<?=$_SESSION["ss_id"];?>" <?=($_SESSION["ss_id"])?'readonly':'';?>> <span class="stext">(예) ppeum01</span></td>
						</tr>
						<tr>
							<th>나이</th>
							<td>
								<select id="tblStrAge" name="tblStrAge" class="form2" required>
										<option value="">선택하세요</option>
										<option value="1">10대</option>
										<option value="2">20대</option>
										<option value="3">30대</option>
										<option value="4">40대</option>
										<option value="5">50대</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>성별</th>
							<td>
								<select id="tblStrSex" name="tblStrSex" class="form2" required>
										<option value="">선택하세요</option>
										<option value="1">남성</option>
										<option value="2">여성</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="btn_area">
					<button type="submit" class="ok_btn">확인</button> &nbsp;&nbsp;
					<a href="javascript:history.go(-1)" class="cancel_btn">취소</a>
				</div>
				</form>
			</div>

		<!--  카톡상담 -->
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	