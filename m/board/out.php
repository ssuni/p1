<? include "../include/head.php" ?>

<script type="text/javascript">
		$(document).ready(function(){
			/*EX(mn=1뎁스체크넘버, sn=2뎁스체크넘버, cn=3뎁스체크넘버, evt1=탑메뉴 버튼이벤트설정, evt2=레프트메뉴 버튼이벤트설정)*/
			var mn=0;
			var sn=3;
			var cn=0;
			var evt1=0;
			var evt2=0;
			var notop=1;
			menu_set(mn,sn,cn,evt1,evt2,notop);
		});
</script>

<? include "../include/simg1.php"; ?>

<div class='sub_wrap'>
		<div class='sub_area'>	
			   <? include "../include/left_member.php"; ?>
			   <? include "../include/quick.php"; ?>
			   <div class='sub_content'>
					<div class='exp_wrap'>
						<h3>회원탈퇴</h3>
						<em>편안한 여성과 가족의 공간, 엠제이 산부인과에 오신 것을 환영합니다</em>
						<span>HOME > 멤버쉽 > 회원탈퇴</span>
					</div>
					<div class='content'>
						<!------------ start :: 본문 시작 ------------->
					<!--------------------------------- S:회원탈퇴 --------------------------------->
					<form method="post" action="/member/memgaip.php" name="del_agrr" onsubmit="return Del_Check(this);" target="toplog_act" id="del_agrr">
						<input type="hidden" name="url" value="/main/main.php">
						<input type="hidden" name="mode" value="del">
						<input type="hidden" name="strUserId" value="<?=$_SESSION["ss_id"]?>">
						<div id="memberOutBox">
							<div class="formArea">
								<p class="stt"><img src="/member/images/mypage2_s_title1.gif" alt="회원탈퇴:아래의 본인 확인 절차를 거치신 후 회원탈퇴 요청을 하시거나, 개인정보관리책임자에게 서면, 전화 또는 Fax 등으로 연락하셔서 개인정보 삭제를 요청하실 경우 지체 없이 귀하의 개인정보를 파기하는 등 필요한 조치를 해드립니다." /></p>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formBox">
									<colgroup>
									<col width="130" />
									<col width="*" />
									</colgroup>
									<tbody>
										<tr>
											<th><img src="/member/images/join2_tt3.gif" alt="아이디" /></th>
											<td>
												<input name="duserid" type="text" class="joinform" id="duserid" maxlength="15" style="ime-mode:disabled;" oncontextmenu="return false" autocomplete="off">
											</td>
										</tr>
										<tr>
											<th><img src="/member/images/join2_tt4.gif" alt="비밀번호" /></th>
											<td>
												<input name="pwd" type="password" class="joinform" maxlength="15">
											</td>
										</tr>
										<tr>
											<th><img src="/member/images/join2_tt15.gif" alt="탈퇴사유" /></th>
											<td>
												<ul>
													<li>
														<input name="reason" type="radio" value="1">
														&nbsp;시스템 에러/속도 등 불만</li>
													<li>
														<input name="reason" type="radio" value="2">
														&nbsp;개인정보 유출 우려</li>
													<li>
														<input name="reason" type="radio" value="3">
														&nbsp;회원특혜 부족</li>
													<li>
														<input name="reason" type="radio" value="4">
														&nbsp;홈페이지를 자주 사용하지 않음</li>
													<li>
														<input name="reason" type="radio" value="5">
														&nbsp;이벤트 및 컨텐츠 부족</li>
													<li>
														<input name="reason" type="radio" value="6" checked>
														&nbsp;기타 사유</li>
												</ul>
											</td>
										</tr>
										<tr>
											<th><img src="/member/images/join2_tt16.gif" alt="바라는점" /></th>
											<td>
												<textarea rows="5" name="content" class="joinTextarea" style="width:500px;"></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="btnArea">
								<input type="image" src="/member/images/btn_out.gif" border="0">
							</div>
						</div>
					</form>
					<!--------------------------------- E:회원탈퇴 --------------------------------->

						<!------------ start :: 본문 끝 ------------->
					</div>
				</div><div class='clr'></div>
		</div><div class='br_line'></div>
</div>

<? include "../include/footer.php"; ?>