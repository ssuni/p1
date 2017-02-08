<? include "../include/head.php"; ?>
<? if(!$_SESSION["ss_name"]){  //세션 유무에 따른 레이어 표출 ?>
<? 
//$pageNum = 1;
$tabNum = 1;
?>
<script type='text/javascript' src='/js/join01.js'></script>
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
					<form method="post" action="join02.php" name="join_agrr" onSubmit="return Agrr_Check();">
						<div class="htext"> <strong>본원은 회원 가입에 필요한 최소한의 개인정보만을 취득하며, 수집된 정보는 홈페이지 회원 관리를 위한 용도로 사용합니다.</strong><br />
							본원의 홈페이지 회원으로 가입을 원하실 경우, ‘서비스 약관 및 개인정보 수집ㆍ이용’ 에 대한 안내를 반드시 읽고 동의해주시기 바랍니다. </div>
						<div class="agree_box2 mgb20">
							<input type="radio" id="agree_top"> &nbsp;<label for="agree_top">전체 약관및 개인정보취급방침에 동의합니다. </label>
						</div>
						<h3>이용약관<span class="st">(동의 필수)</span></h3>
						<div class="agree_box">
							<iframe name="" src="/member/text_provision.php" frameborder="0" scrolling="yes" height="110"></iframe>
						</div>
						<div class="agree_form">
							<input name="agree1" type="radio" value="y" id="agree1_1">
							&nbsp;
							<label for="agree1_1">동의합니다.</label>
							&nbsp;&nbsp;&nbsp;
							<input name="agree1" type="radio" value="n" id="agree1_2">
							&nbsp;
							<label for="agree1_2">동의하지 않습니다.</label>
						</div>
						<h3>개인정보의 수집 및 이용목적<span class="st">(동의 필수)</span></h3>
						<div class="agree_box">
							<iframe name="" src="/member/text_privacy1.php" frameborder="0" scrolling="yes"></iframe>
						</div>
						<div class="agree_form">
							<input name="agree2" type="radio" value="y" id="agree2_1">
							&nbsp;
							<label for="agree2_1">동의합니다.</label>
							&nbsp;&nbsp;&nbsp;
							<input name="agree2" type="radio" value="n" id="agree2_2">
							&nbsp;
							<label for="agree2_2">동의하지 않습니다.</label>
						</div>
						<h3>개인정보의 수집항목 및 방법<span class="st">(동의 필수)</span></h3>
						<div class="agree_box">
							<iframe name="" src="/member/text_privacy2.php" frameborder="0" scrolling="yes"></iframe>
						</div>
						<div class="agree_form">
							<input name="agree3" type="radio" value="y" id="agree3_1">
							&nbsp;
							<label for="agree3_1">동의합니다.</label>
							&nbsp;&nbsp;&nbsp;
							<input name="agree3" type="radio" value="n" id="agree3_2">
							&nbsp;
							<label for="agree3_2">동의하지 않습니다.</label>
						</div>
						<h3>개인정보의 보유 및 이용기간<span class="st">(동의 필수)</span></h3>
						<div class="agree_box">
							<iframe name="" src="/member/text_privacy3.php" frameborder="0" scrolling="yes"></iframe>
						</div>
						<div class="agree_form">
							<input name="agree4" type="radio" value="y" id="agree4_1">
							&nbsp;
							<label for="agree4_1">동의합니다.</label>
							&nbsp;&nbsp;&nbsp;
							<input name="agree4" type="radio" value="n" id="agree4_2">
							&nbsp;
							<label for="agree4_2">동의하지 않습니다.</label>
						</div>
						<div class="point_box">
							<ul>
								<li class="li1">동의 거부 시 불이익에 관한 사항</li>
								<li class="li2">귀하는 위 항목에 대하여 동의를 거부할 수 있으며, 동의 후에도 언제든지 철회 가능합니다. 다만, 수집하는 개인정보는 원활한 서비스 제공을 위해 필요한 최소한의 기본정보로서, 동의를 거부하실 경우에는 회원에게 제공되는 서비스 이용에 제한될 수 있음을 알려드립니다.</li>
							</ul>
						</div>
						<div class="agree_box2 mgt20">
							<input type="radio" id="agree_bottom">
							&nbsp;
							<label for="agree_bottom">전체 약관및 개인정보취급방침에 동의합니다. </label>
						</div>
						<div class="btn_area">
							<button type="submit" class="ok_btn">회원가입</button>
							&nbsp;&nbsp; <a href="javascript:history.go(-1)" class="cancel_btn">취소</a> </div>
					</form>
				</div>
			</div>
			<!---------------------  // End :: 본문  ---------------------> 
		</div>
	</div>
</div>
<? } else { echo "<script>window.parent.location.href='".$bagData["mdir"]."/main/main.php';</script>"; } ?>
<? include "../include/footer.php"; ?>