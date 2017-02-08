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

	<!-- * Daum 지도 - 지도퍼가기 -->
<!-- 1. 지도 노드 -->
<div id="daumRoughmapContainer1485156997958" class="root_daum_roughmap root_daum_roughmap_landing"></div>

<!--
	2. 설치 스크립트
	* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
-->
<script charset="UTF-8" class="daum_roughmap_loader_script" src="http://dmaps.daum.net/map_js_init/roughmapLoader.js"></script>

<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1485156997958",
		"key" : "fjjy",
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

