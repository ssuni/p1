<? include "../include/head.php" ?>
<?if($_SESSION["ss_id"]==false || $_SESSION["ss_id"]==""){  //세션 유무에 따른 레이어 표출?>

<script type="text/javascript">
		$(document).ready(function(){
			/*EX(mn=1뎁스체크넘버, sn=2뎁스체크넘버, cn=3뎁스체크넘버, evt1=탑메뉴 버튼이벤트설정, evt2=레프트메뉴 버튼이벤트설정)*/
			var mn=0;
			var sn=1;
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
						<h3>회원로그인</h3>
						<em>편안한 여성과 가족의 공간, 엠제이 산부인과에 오신 것을 환영합니다</em>
						<span>HOME > 멤버쉽 > 로그인</span>
					</div>
					<div class='content'>
						<!------------ start :: 본문 시작 ------------->

					<!--------------------------------- S:로그인 --------------------------------->
					<form method="post" action="/member/memgaip.php" name="loin_agrr" onSubmit="return Loin_Check(this);">
						<input type="hidden" name="url" value="<?=$_SERVER["REQUEST_URI"]?>">
						<input type="hidden" name="mode" value="login">
						<input type="hidden" name="ref" value="<?=$ref?>">
						<div id="memberLoginBox">
							<div class="imgArea">
								<p class="text"><img src="/member/images/s_text_login.gif" alt="" /></p>
								<p class="img"><img src="/member/images/img_login.gif" /></p>
							</div>
							<div class="loginArea">
								<table border="0" align="center" cellpadding="0" cellspacing="0" class="formBox">
									<tr>
										<td valign="top"><img src="/member/images/login_tt01.gif" alt="아이디" /></td>
										<td valign="top" class="pd">
											<input type="text" name="userid" id="userid" tabindex="1" class="memberForm" value="<?=$findid?>" maxlength="15" onFocus="javascript:this.value='';"/>
										</td>
										<td rowspan="2">
											<input type="image" src="/member/images/login_btn.gif" alt="로그인">
										</td>
									</tr>
									<tr>
										<td><img src="/member/images/login_tt02.gif" alt="비밀번호" /></td>
										<td>
											<input type="password" name="pwd" id="pwd" tabindex="2" class="memberForm" maxlength="15" onFocus="javascript:this.value='';"/>
										</td>
									</tr>
								</table>
							</div>
							<ul>
								<li><a href="javascript:m_join1();"><img src="/member/images/login_bott_btn01.gif" alt="무료회원가입" /></a></li>
								<li><a href="javascript:m_idpw();"><img src="/member/images/login_bott_btn02.gif" alt="아이디/비밀번호찾기" /></a></li>
							</ul>
							<div class="clear"></div>
						</div>
					</form>
					<!--------------------------------- S:로그인 --------------------------------->



						<!------------ start :: 본문 끝 ------------->
					</div>
				</div><div class='clr'></div>
		</div><div class='br_line'></div>
</div>
<? } else { echo "<script>window.parent.location.href='/main/main.php';</script>"; } ?>
<? include "../include/footer.php"; ?>
