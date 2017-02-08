<? include "../include/head.php"; ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
//$pageNum = 1;
$tabNum = 1;
?>

<link href="../member/css/style.css" rel="stylesheet" type="text/css">
<div class="subWrap">
	<div class="contentsArea">
		<div class="conWrap"> 
			<!---------------------  // Start :: 본문  --------------------->
			<div class="m_contents">
				<div class="m_header">
					<h2>회원가입</h2>
				</div>
				<div class="m_join_wrap">
					<div class="htext">
						<strong>회원가입을 환영합니다.</strong><br />
						로그인하시면 회원 서비스를 바로 이용하실 수 있습니다. 감사합니다. 
					</div>
					<div class="m_join_box">
						<div class="contents">
							<div class="t1">회원가입이 정상적으로 완료되었습니다. </div>
							<div class="t2">지금 바로 홈페이지에 로그인하시면 회원 맞춤 서비스들을 이용하실 수 있습니다.</div>
							<div class="t3">회원님의 비밀번호는 암호화 코드로 저장되므로 안심하셔도 좋습니다. <br />
							아이디, 비밀번호 분실시에는 회원가입시 입력하신 아이디, 이름, 이메일주소를 이용하여 찾을 수 있습니다.  <br />
							회원탈퇴는 언제든지 가능하며 탈퇴 후에는 고객님의 모든 정보는 삭제 처리됩니다.
							</div>
							<div class="b_area">
								<a href="<?=$bagData["mdir"];?>/member/login.php" class="login_btn">로그인하기</a> &nbsp;
								<a href="<?=$bagData["mdir"];?>" class="home_btn">HOME으로 이동</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!---------------------  // End :: 본문  --------------------->
		</div>
	</div>
</div>

<? } else { echo "<script>window.parent.location.href='".$bagData["mdir"]."/main/main.php';</script>"; } ?>
<? include "../include/footer.php"; ?>
