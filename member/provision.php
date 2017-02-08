<? include "../include/head.php" ?>
<? 
$tabNum = 6;
?>
<link rel='stylesheet' href='/css/style.css' media='all' />
<link rel='stylesheet' href='/member/css/style.css' media='all' />
<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원약관</div>
		<h2>회원약관</h2>
		<div class="m_contents"> 
			<div class="m_box">
				<?=$bagData["clauses"];?>
			</div>
		</div>
	</div>
</div>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>