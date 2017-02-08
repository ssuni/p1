<? include "../include/head.php" ?>
<? 
$tabNum = 2;
?>
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/member/css/style.css' media='all' />
<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원가입</div>
		<h2>회원가입완료</h2>
		<div class="m_contents">
			<div class="himg"><img src="images/step03.jpg" alt=""></div>
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
						<a href="/member/login.php" class="login_btn">로그인하기</a> &nbsp;
						<a href="javascript:home_main();" class="home_btn">HOME으로 이동</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>