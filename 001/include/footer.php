	<!-- footer -->
	<div id="footer">
		
		<div class="footer_inner cont_size01">

			<img src="../images/common/b_logo.jpg" class="b_logo" alt=""/>
			
			<div class="footer_cont">			
				

				<ul id="footer_menu">
					<li><a href="/new/intro/intro01.php">쁨클리닉 소개</a></li>
					<li><a href="/new/community/community03.php">온라인상담</a></li>
					<li><a href="/member/privacy.php">개인정보처리방침</a></li>
					<li><a href="/member/provision.php">이용약관</a></li>
				</ul>
		
				<p class="adress">
				상호명 : 신논현쁨의원<span class="space"></span>대표자 : 정헌진<span class="space"></span>사업자등록번호 : 784-11-00540<span class="space"></span>전화 : 02)593-3344<br>
				주소 : 서울특별시 서초구 강남대로 459 백암빌딩 4층
				</p>

				<p class="copyright">
				Copyright @ 2016 ppeumclinic All right resesrved.
				</p>
			</div>
		</div>
		<!-- WIDERPLANET  SCRIPT START 2017.1.9 -->
<div id="wp_tg_cts" style="display:none;"></div>
<script type="text/javascript">
var wptg_tagscript_vars = wptg_tagscript_vars || [];
wptg_tagscript_vars.push(
(function() {
         return {
                 wp_hcuid:"",   /*Cross device targeting을 원하는 광고주는 로그인한 사용자의 Unique ID (ex. 로그인 ID, 고객넘버 등)를 암호화하여 대입.
                                   *주의: 로그인 하지 않은 사용자는 어떠한 값도 대입하지 않습니다.*/
                 ti:"33312",      /*광고주 코드*/
                 ty:"Home",       /*트래킹태그 타입*/
                 device:"web"     /*디바이스 종류 (web 또는 mobile)*/
                 
         };
}));
</script>
<script type="text/javascript" async src="//cdn-aitg.widerplanet.com/js/wp_astg_4.0.js"></script>
<!-- // WIDERPLANET  SCRIPT END 2017.1.9 -->
	</div>
	<!-- //footer -->

</div>
<!-- //wrap -->
	<?php
	$indicesServer = array(
		'PHP_SELF',                              // 현재 접속 주소(도메인제외)
		'SERVER_ADDR',                       // 서버 IP
		'SERVER_NAME',                      // 서버 네임
		'REQUEST_METHOD',                // 요청 방식
		'QUERY_STRING',                      // URL 에 있는 파라미터 반환
		'DOCUMENT_ROOT',                 // 서버의 아파치 루트 디렉토리
		'HTTP_ACCEPT',                      // 문서 구성 및 타입 해더 내용
		'HTTP_ACCEPT_CHARSET',      // 캐릭터셋 해더 내용
		'HTTP_ACCEPT_ENCODING',    // 인코딩 방식 해더 내용
		'HTTP_ACCEPT_LANGUAGE',   // 언어 해더 내용
		'HTTP_HOST',                         // 현재 도메인
		'HTTP_REFERER',                   // 현재 오기전 페이지 URL
		'HTTP_USER_AGENT',             // 현재 페이지 접속한 사용자 환경
		'REMOTE_ADDR',                   // 현재 페이지 접속한 사용자 IP
		'REMOTE_HOST',                   // 현재 페이지 접속한 사용자 호스트
		'REMOTE_PORT',                   // 현재 페이지 접속한 사용자 포트
		'SCRIPT_FILENAME',              // 접속 중인 사이트의 파일명과 경로
		'SERVER_PORT',                    // 접속 중인 사이트의 포트
		'REQUEST_URI'                      // 현재 페이지의 URL
	) ;

	echo '<table cellpadding="10">' ;
	foreach ($indicesServer as $arg){
		if (isset($_SERVER[$arg])){
			echo '<tr><td>'.$arg.'</td><td>'.
				$_SERVER[$arg].'</td></tr>';
		}
		else{
			echo '<tr><td>'.$arg.'</td><td>-</td></tr>';
		}
	} // foreach 문 끝
	echo '</table>' ;
	?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/common_script.php"; ?>
</body>
</html>