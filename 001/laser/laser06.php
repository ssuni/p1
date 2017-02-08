<?
$mn = 7;
$sn = 6;
$cn = 0;
?>
<? include "../include/head.php" ?>	


<script type="text/javascript">
function hide_popup(p_sID){
	var f_oLayer	= document.getElementById(p_sID);
	f_oLayer.style.display	= "none";
}
function set_cookie( name, value, expiredays ){
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
function get_cookie( name ) {
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
	var y = (x+nameOfCookie.length);
	if ( document.cookie.substring( x, y ) == nameOfCookie ) {
	  if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
	   endOfCookie = document.cookie.length;
	  return unescape( document.cookie.substring( y, endOfCookie ) );
	}
	x = document.cookie.indexOf( " ", x ) + 1;
	if ( x == 0 )
	  break;
	}
	return "";
}
</script>
<script>
var Q_drg_drp = {
/*
Browser: MSIE7, Firefox3, Safari3, Opera9
DTD: Quirks, Strict XHTML 1.0, Strict HTML 4.01
Update: 2008-08-15
Usage:
Q_drg_drp.add('id');
Q_drg_drp.add('id_1','id_2');
*/
    ghosts : new Array()
    ,create : function(idntty_1,idntty_2) {
        this.idntty_1 = idntty_1;
        this.idntty_2 = idntty_2;
        this.objct_1 = null;
        this.objct_2 = null;
        this.clntX  = null;
        this.clntY  = null;
        this.lft    = null;
        this.top    = null;
//        this.mousemove = null;
        this.mouseup  = null;
        this.mousedown = null;
        this.start    = null;
    }
    ,attach : function(objct,type,fnctn) {
        if(objct.addEventListener) { objct.addEventListener(type,fnctn,false); return true; } //Mozilla
        else if(objct.attachEvent) { var rtrn = objct.attachEvent('on'+type,fnctn); return rtrn; } //MSIE
        else objct.onclick = fnctn;
    }
    ,detach : function(objct,type,fnctn) {
        if(objct.removeEventListener) { objct.removeEventListener(type,fnctn,false); return true; } //Mozilla
        else if(objct.detachEvent)    { var rtrn = objct.detachEvent('on'+type,fnctn); return rtrn; } //MSIE
        else objct.onclick = null;
    }
    ,add : function(idntty_1,idntty_2) {
        if(!idntty_2) idntty_2 = idntty_1;
        var idntty = idntty_1+"_"+idntty_2;
        var code = '';
        code += "Q_drg_drp.ghosts."+idntty+" = new Q_drg_drp.create('"+idntty_1+"','"+idntty_2+"');";
        code += "Q_drg_drp.ghosts."+idntty+".mousemove = function(e) {";
        code += "    var delta_x = e.clientX-Q_drg_drp.ghosts."+idntty+".clntX;";
        code += "    var delta_y = e.clientY-Q_drg_drp.ghosts."+idntty+".clntY;";
        code += "    Q_drg_drp.ghosts."+idntty+".objct_2.style.left = Q_drg_drp.ghosts."+idntty+".lft+delta_x +'px';";
        code += "    Q_drg_drp.ghosts."+idntty+".objct_2.style.top  = Q_drg_drp.ghosts."+idntty+".top+delta_y +'px';";
        code += "};";
        code += "Q_drg_drp.ghosts."+idntty+".mouseup = function() {";
//        code += "    Q_drg_drp.detach(document,'mousemove',Q_drg_drp.ghosts."+idntty+".mousemove);";
        code += "    Q_drg_drp.detach(document,'mouseup'  ,Q_drg_drp.ghosts."+idntty+".mouseup);";
        code += "};";
        code += "Q_drg_drp.ghosts."+idntty+".mousedown = function(e) {";
        code += "    Q_drg_drp.ghosts."+idntty+".clntX = e.clientX;";
        code += "    Q_drg_drp.ghosts."+idntty+".clntY = e.clientY;";
        code += "    Q_drg_drp.ghosts."+idntty+".lft  = parseInt(Q_drg_drp.ghosts."+idntty+".objct_2.style.left);";
        code += "    Q_drg_drp.ghosts."+idntty+".top  = parseInt(Q_drg_drp.ghosts."+idntty+".objct_2.style.top);";
        code += "    if(e.srcElement) Q_drg_drp.attach(e.srcElement,'dragstart',function() { return false; });"; //MSIE
//        code += "    Q_drg_drp.attach(document,'mousemove',Q_drg_drp.ghosts."+idntty+".mousemove);";
        code += "    Q_drg_drp.attach(document,'mouseup'  ,Q_drg_drp.ghosts."+idntty+".mouseup);";
        code += "};";
        code += "Q_drg_drp.ghosts."+idntty+".start = function() {";
        code += "    Q_drg_drp.ghosts."+idntty+".objct_1 = document.getElementById('"+idntty_1+"');";
        code += "    Q_drg_drp.ghosts."+idntty+".objct_1.style.cursor = 'pointer';";
        code += "    Q_drg_drp.ghosts."+idntty+".objct_1.onmousedown = function() { return false; };"; //Mozilla
        code += "    Q_drg_drp.ghosts."+idntty+".objct_2 = document.getElementById('"+idntty_2+"');";
        code += "    Q_drg_drp.attach(Q_drg_drp.ghosts."+idntty+".objct_1,'mousedown',Q_drg_drp.ghosts."+idntty+".mousedown);";
        code += "};";
        code += "Q_drg_drp.attach(window,'load',Q_drg_drp.ghosts."+idntty+".start);";
        eval(code);
    }
}; 

var gap=0;
function baba(oo){
	if(oo=='left'){
		gap=gap-1;
		if(gap < 0){
			gap=-1;
			document.getElementById('ba_0').style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}else{
			document.getElementById('ba_'+(gap+1)).style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}
	}else if(oo=='right'){
		gap=gap+1;
		if(gap > -1){
			gap=0;
			document.getElementById('ba_-1').style.display='none';
			document.getElementById('ba_0').style.display='inline';
		}else{
			document.getElementById('ba_'+(gap-1)).style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}	
	}
}
</script>



<div id="popup112" class="laserPop" style="position:fixed; z-index:1000; left:50%; top: 200px; margin-left:250px; display:block;">
	<img src="../images/cont/laser/laser06_pop.jpg" class="block">
	<div class="pop_footer">
		<p class="fLeft">
			<input type="checkbox" name="pop_cookie" onclick="set_cookie('popup112','doned',1);hide_popup('popup112');">
			<span>오늘 하루 창을 열지 않습니다.</span>
		</p>
		<p class="fRight">
			<a href="#pop" onclick="hide_popup('popup112');">[닫기]</a>
		</p>
	</div>	
</div>
<script>
	if ( get_cookie( 'popup112' )  == 'doned' ){
		hide_popup('popup112');
	}
	</script>

	<script>
	    Q_drg_drp.add('popup112');
	</script>

	<!-- container -->
	<div id="container" class="sub">
		
		<!-- prod_info -->
		<div id="prod_info">
			<img src="../images/cont/laser/laser06_timg.jpg" class="pimg" alt="">

			<!-- info -->
			<div class="info">
				<h2>레블라이트 토닝</h2>
				<p>원하는 타겟 색소만 파괴하는 차원이 다른 결과!<br>
				프리미엄 토닝 레블라이트
				</p>

				<dl>
					<dt>시술비용</dt>
					<dd>1회 12만원</dd>

					<dt>시술시간</dt>
					<dd>약 20분</dd>

					<dt>부위선택</dt>
					<dd>
						<select class="w200">
							<option value="1">얼굴전체</option>
						</select>
					</dd>
								
				</dl>

				<div class="btn_set">
					<p>
						<a href="#link" onclick="onlineLink();" class="btn_t01">온라인상담</a>
						<a href="#link" onclick="reviewLink();" class="btn_t02">REVIEW</a>
						<a href="#link" onclick="kakaoLink();" class="btn_t02">KAKAO TALK</a>
					</p>
				</div>

			</div>
			<!-- //info -->
		</div>
		<!-- //prod_info -->



		<!-- prod_detail -->
		<div id="prod_detail">
			<div class="prod_wrap">
				<p class="pos_abs">
					<img src="../images/cont/laser/laser06_cont01.jpg" alt="">
					<img src="../images/cont/laser/laser06_cont02.jpg" alt="">
					<img src="../images/cont/laser/laser06_cont03.jpg" alt="">
				</p>
			</div>
		</div>
		<!-- //prod_detail -->

	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	