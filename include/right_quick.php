	<!-- right_quick -->

	<script src="/js/right_quick_form.js"></script>
	
	<div id="right_quick">
			<ul id="top_util">	
				<? if ($_SESSION['ss_name']) { ?>
				<li class="img_onoff"><a href="javascript:;" onclick="javascript:document.formout.submit();"><img src="../images/common/right_quick_logout.gif" alt="로그아웃"></a></li>
				<li class="img_onoff"><a href="/member/modify.php" target="_self"><img src="../images/common/right_quick_mod.gif" alt="마이페이지"></a></li>
				<? } else { ?>
				<li class="img_onoff"><a href="/member/login.php" target="_self"><img src="../images/common/right_quick_login.gif" alt="로그인"></a></li>
				<li class="img_onoff"><a href="/member/join01.php"><img src="../images/common/right_quick_join.gif" alt="회원가입"></a></li>
				<? } ?>
			</ul>
		<a href="javascript:void(0);" class="btn_openClose"><span>퀵메뉴 열고닫기</span></a>
		<ul>
			<li><a href="javascript:void(0);" class="img_onoff btn_kakao_counsel"><img src="../images/common/right_quick1.jpg" id="quick_btn1" alt="카카오톡 상담" /></a></li>
			<li><a href="javascript:menu_08_01();" class="img_onoff"><img src="../images/common/right_quick2.jpg" id="quick_btn2" alt="온라인상담" /></a></li>
			<li><a href="javascript:menu_08_02();" class="img_onoff"><img src="../images/common/right_quick3.jpg" id="quick_btn3" alt="온라인예약" /></a></li>
			<li><a href="javascript:menu_09_02();" class="img_onoff"><img src="../images/common/right_quick4.jpg" id="quick_btn4" alt="셀카스토리" /></a></li>
			<li><a href="javascript:menu_09_01();" class="img_onoff"><img src="../images/common/right_quick5.jpg" id="quick_btn5" alt="수술후기" /></a></li>
			<li><a href="javascript:menu_09_04();" class="img_onoff"><img src="../images/common/right_quick6.jpg" id="quick_btn5" alt="전후사진" /></a></li>
			<li><a href="http://blog.naver.com/varabonen" target="_blank" class="img_onoff"><img src="../images/common/right_quick7.jpg" id="quick_btn6" alt="블로그" /></a></li>
		</ul>
		
		<!-- kakao_counsel -->
		<div id="kakao_counsel">
			<img src="../images/common/kakao_counsel_top_img.jpg" alt="카카오톡 상담"/>
			<!-- form_wrap -->
			<div class="form_wrap">
				<form name="kakao" method="post" action="/board/kakao_proc.php" onSubmit="return kakaoSubmit()">
					<fieldset>
						<legend>빠른상담신청</legend>				
						<table>
							<colgroup>
								<col style="width:77px;">
								<col style="width:*">
							</colgroup> 
							<tr>
								<th>이름</th>
								<td><input class="input01 size01" maxlength="10" name="tblStrName" id="tblStrName" value="" required/></td>
							</tr>
							<tr>
								<th>휴대폰</th>
								<td>
									<p class="row">
										<select  class="select01 size02" name="tblStrMobile[]" id="tblStrMobile1" required>
										  <option value="" selected="selected">선택</option>
										  <option value="010" >010</option>
										  <option value="011" >011</option>
										  <option value="016" >016</option>
										  <option value="017" >017</option>
										  <option value="018" >018</option>
										  <option value="019" >019</option>
										</select>
										<span class="bar">-</span>
										<input class="input01 size02" maxlength="4" name="tblStrMobile[]" id="tblStrMobile2" value="" required/>
										<span class="bar">-</span>
										<input class="input01 size02" maxlength="4" name="tblStrMobile[]" id="tblStrMobile3" value="" required/>
									</p>
								</td>
							</tr>
							<tr>
								<th>카톡아이디</th>
								<td><input class="input01 size01" maxlength="20" name="tblStrKatok" id="tblStrKatok" value="" required/></td>
							</tr>
							<tr>
								<th>진료과목</th>
								<td>
									<select name="tblIntField" id="tblIntField" class="select01 size01" required>
									<option value="">선택하세요</option>
									<? foreach($counselField as $k => $v) { ?>
									<option value="<?=$k;?>"><?=$v;?></option>
									<? } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th>나이</th>
								<td>
									<select name="tblStrAge" id="tblStrAge" class="select01 size01" required>
									  <option value="" selected="selected">선택해 주세요.</option>									 
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
									<select name="tblStrSex" id="tblStrSex" class="select01 size01" required>
									  <option value="" selected="selected">선택해 주세요.</option>									 
									  <option value="1">남</option>									 
									  <option value="2">여</option>									 
									</select>
								</td>
							</tr>
						</table>

						<div class="agree_box">
							<p class="agree_top">
								<strong>개인정보 수집·이용 동의 안내</strong><br/>
								동의를 거부할 수 있습니다. <br/>
								동의 거부시에는 상담서비스 이용이 제한됩니다.
							</p>
							<div class="agree_cont"><?=$bagData["consent2"];?></div>
						</div>

						<p class="agree_chk"><input type="checkbox" type="radio" id="agree" required> <label for="agree_chk">개인정보취급방침에 동의합니다. </label></p>

						<input type="image" src="../images/common/btn_kakao_submit.jpg" border="0" alt="상담신청하기">
					</fieldset>
				</form>
			</div>
			
		</div>
		<!-- kakao_counsel -->
	</div>
	<!-- //right_quick -->