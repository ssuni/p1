



	<footer>
		<p class="tel"><a href="tel:02-593-3344"><img src="../images/common/b_tel.jpg" alt="02-593-3344"/'></a></p>

		<div id="footer_menu">
			<ul>
				<li><a href="../community/community03.php">온라인상담</a></li>
				<li><a href="../member/privacy.php">개인정보처리방침</a></li>
				<li><a href="../member/provision.php">이용약관</a></li>
			</ul>	
		</div>

		<div class="footer_cont">			
			<address>
				상호명 : 신논현쁨의원    대표자 : 정헌진<br>
				사업자등록번호 : 784-11-00540    전화 : 02)593-3344<br>
				주소 : 서울특별시 서초구 강남대로 459 백암빌딩 4층<br>				
			</address>
			<p class="copyright">Copyright @ 2016 ppeumclinic All right resesrved.</p>

			<div id="bmenu02">
				<ul>
					<? if ($_SESSION['ss_name']) { ?>
					<li><a href="javascript:;" onclick="javascript:document.formout.submit();">로그아웃</a></li>
					<li><a href="<?=$bagData["mdir"];?>/member/modify.php" target="_self">정보수정</a></li>
					<? } else { ?>
					<li><a href="<?=$bagData["mdir"];?>/member/login.php" target="_self">로그인</a></li>
					<li><a href="<?=$bagData["mdir"];?>/member/join01.php" target="_self">회원가입</a></li>
					<? } ?>
					<li class="type02"><a href="<?=$bagData["host"];?>?pc">PC버전</a></li>
				</ul>
			</div>
		</div>



		<ul id="bmenu">
			<li style='border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0'><a href="http://plus.kakao.com/home/@쁨클리닉신논현점"  target="_blank"><img src="../images/common/bmenu01_180.jpg" alt="카톡상담"></a></li>
			<li style='border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0'><a href="../community/community03.php"><img src="../images/common/bmenu02_180.jpg" alt="온라인상담"></a></li>
			<li style='border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0'><a href="../intro/intro04.php"><img src="../images/common/bmenu03_180.jpg" alt="진료안내"></a></li>
			<li style='border-top:1px solid #e0e0e0'><a href="tel:02-593-3344"><img src="../images/common/bmenu04_180.jpg" alt="전화걸기"></a></li>
		</ul>
	</footer>
</div>

<? include $_SERVER['DOCUMENT_ROOT']."/m/include/common_script.php"; ?>
</body>
</html>	