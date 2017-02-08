<?
$mn = 1;
$sn = 4;
$cn = 0;
?>
<? include "../include/head.php" ?>	

	

	<!-- container -->
	<div id="container" class="sub mt0">
	
		<div class="img_wrap">
			<p class="pos_abs">
				<img src="../images/cont/intro/intro04_cont01.jpg" alt="">
			</p>
		</div>
		<p class="tCenter"><img src="../images/cont/intro/intro04_cont02.jpg" alt=""></p>

	
		<!--
			* Daum 지도 - 약도서비스
			* 한 페이지 내에 약도를 2개 이상 넣을 경우에는
			* 약도의 수 만큼 소스를 새로 생성, 삽입해야 합니다.
		-->
		<!-- 1. 약도 노드 -->
		<div id="daumRoughmapContainer1482570677091" class="root_daum_roughmap root_daum_roughmap_landing"></div>

		<!-- 2. 설치 스크립트 -->
		<script charset="UTF-8" class="daum_roughmap_loader_script" src="http://dmaps.daum.net/map_js_init/roughmapLoader.js"></script>

		<!-- 3. 실행 스크립트 -->
		<script charset="UTF-8">
			new daum.roughmap.Lander({
				"timestamp" : "1482570677091",
				"key" : "exr9",
				"mapWidth" : "1100",
				"mapHeight" : "450"
			}).render();
		</script>



		<p class="tCenter"><img src="../images/cont/intro/intro04_cont03.jpg" usemap="#map1" alt=""></p>
		<map name="map1">
			<area shape="rect" coords="262,172,469,206" href="#link" onclick="onlineLink();">
		</map>

	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	