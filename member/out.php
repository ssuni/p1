<? include "../include/head.php" ?>
<? if(!$_SESSION["ss_id"]) { echo "<script>location.href='/member/login.php?ref=".urlencode($_SERVER['REQUEST_URI'])."';</script>"; } ?>
<? 
$tabNum = 5;
?>
<script src="/js/total.js"></script>
<link rel='stylesheet' href='../css/style.css' media='all' />
<link rel='stylesheet' href='../member/css/style.css' media='all' />
<body>
<? include "../member/include/m_top.php" ?>
<div class="m_body_wrap">
	<div class="m_body">
		<div class="m_location"><img src="/member/images/ico_home.gif" class="middle gimg">&nbsp;<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;멤버쉽<img src="/member/images/ico_gubun.gif" class="middle gimg">&nbsp;회원탈퇴</div>
		<h2>회원탈퇴</h2>
		<div class="m_contents">
			<div><img src="images/head_out.gif" alt=""></div>
			<form method="post" action="/member/memgaip.php" name="del_agrr" onSubmit="return Del_Check(this);" target="toplog_act" id="del_agrr">
			<input type="hidden" name="url" value="/main/main.php">
			<input type="hidden" name="mode" value="del">
			<input type="hidden" name="strUserId" value="<?=$_SESSION["ss_id"]?>">
			<table summary="" class="join_list mgt50">
				<caption></caption>
				<colgroup>
					<col width="15%" />
					<col width="85%" />
				</colgroup>
				<tbody>
					<tr>
						<th>아이디</th>
						<td><input name="duserid" type="text" class="joinForm1" id="duserid" maxlength="15" style="ime-mode:disabled; width:250px;" oncontextmenu="return false" autocomplete="off" value="<?=$_SESSION['ss_id'];?>" readonly></td>
					</tr>
					<tr>
						<th>비밀번호</th>
						<td><input name="pwd" type="password" class="joinForm1" maxlength="15" style="width:250px;"></td>
					</tr>
					<tr>
						<th>탈퇴사유</th>
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
						<th>바라는점</th>
						<td><textarea rows="5" name="content" class="joinForm3" style="width:90%;"></textarea></td>
					</tr>
				</tbody>
			</table>
			<div class="btn_area">
				<button type="submit" class="ok_btn">회원탈퇴</button> &nbsp;&nbsp;
				<a href="javascript:history.go(-1)" class="cancel_btn">취소</a>
			</div>
			</form>
		</div>
	</div>
</div>
<? include "../member/include/m_bottom.php" ?>
</body>
</html>