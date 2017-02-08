<div class="b_counsel">
				<ul class="b_btn">
					<li><a href="javascript:menu_09_01();"><img src="../images/common/botton_btn1.jpg" alt="바라본수술후기" /></a></li>
					<li><a href="javascript:menu_08_01();"><img src="../images/common/botton_btn2.jpg" alt="온라인상담" /></a></li>
					<li><a href="javascript:menu_09_04();"><img src="../images/common/botton_btn3.jpg" alt="전후사진" /></a></li>
				</ul><div class="clr">&nbsp;</div>
				<div class="b_counsel_area">
					<div class="b_form">
						<h2><img src="../images/common/bottom_counsel_tt.gif" alt="바라본성형외과 빠른상담" /></h2>
						<form name="counsel" method="post" action="/board/counsel_proc.php" onSubmit="return counselSubmit()">
						<table width="660" class="b_table">
							<colgroup>
								<col width="77" />
								<col width="365" />
								<col width="218" />
							</colgroup>
							<tbody>
								<tr>
									<th>이름</th>
									<td><input type="text" name="tblStrName" id="ctblStrName" class="counselForm" style="width:345px;" required/></td>
									<td rowspan="2">
									<div class="agree">
										<strong><a href="#">[개인정보취급방침 보기]</a></strong>
    									<div class="custom_checkbox2"><input type="checkbox" id="cagreement" name="agreement" required/> <label for="agree">개인정보취급방침 동의</label></div>
									</div>
									</td>
								</tr>
								<tr>
									<th>핸드폰</th>
									<td><select name="tblStrMobile[]" id="ctblStrMobile1" class="counselSelect" style="width:112px;">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
						</select>&nbsp;<input type="text" name="tblStrMobile[]" id="ctblStrMobile2" required class="counselForm" style="width:112px;" maxlength="4"/>&nbsp;<input type="text" name="tblStrMobile[]" id="ctblStrMobile3" required class="counselForm" style="width:113px;" maxlength="4"/></td>
								</tr>
								<tr>
									<th>치료과목</th>
									<td><select name="tblIntField" id="ctblIntField" required class="counselSelect" style="width:345px;">
										<option value="">치료과목을 선택하세요</option>
											<? foreach($counselField as $k => $v) { ?>
											<option value="<?=$k;?>"><?=$v;?></option>
											<? } ?>
									</select></td>
									<td rowspan="2"><input type="image" src="../images/common/bottom_counsel_btn.gif" alt="상담요청" /></td>
								</tr>
								<tr>
									<th>상담내용</th>
									<td><textarea name="tblStrComment" id="ctblStrComment" rows="4" class="counselTextarea" style="width:345px; height:83px;"></textarea></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="kakao"><a href="javascript:menu_08_03();"><img src="../images/common/botton_kakao.jpg" alt="카카오톡상담 ID : varabonps" /></a></div>
				</div>
			</div>