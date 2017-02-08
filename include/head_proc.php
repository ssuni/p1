<?php
	
	/* 팝업 불러오기 .... */
	$sPopQuery	= " SELECT * FROM tblPopup ";
	$sPopQuery	.= " WHERE tblDtmSdate <= '".date("Y-m-d")."' ";
	$sPopQuery	.= " AND tblDtmEdate >= '".date("Y-m-d")."' and tblStrDevice='pc'";
	$sPopQuery	.= " ORDER BY tblDtmRegDate DESC ";
	$rPopQuery	= mysql_query( $sPopQuery );
	$nPopCnt	= 0;
	while ( $aPopQuery = @mysql_fetch_array( $rPopQuery ) ){ 
		$arrPopup[$nPopCnt]['idx']		= $aPopQuery['tblNumber'];
		$arrPopup[$nPopCnt]['subject']	= $aPopQuery['tblStrSubject'];
		$arrPopup[$nPopCnt]['comment']	= $aPopQuery['tblStrComment'];
		$arrPopup[$nPopCnt]['width']	= $aPopQuery['tblIntWidth'];
		$arrPopup[$nPopCnt]['height']	= $aPopQuery['tblIntHeight'];
		$arrPopup[$nPopCnt]['left']		= $aPopQuery['tblIntLeft'];
		$arrPopup[$nPopCnt]['top']		= $aPopQuery['tblIntTop'];
		$nPopCnt++;
	}
?>
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
			gap=<?=ceil($cnt_0)-1?>;
			document.getElementById('ba_0').style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}else{
			document.getElementById('ba_'+(gap+1)).style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}
	}else if(oo=='right'){
		gap=gap+1;
		if(gap > <?=ceil($cnt_0)-1?>){
			gap=0;
			document.getElementById('ba_<?=ceil($cnt_0)-1?>').style.display='none';
			document.getElementById('ba_0').style.display='inline';
		}else{
			document.getElementById('ba_'+(gap-1)).style.display='none';
			document.getElementById('ba_'+gap).style.display='inline';
		}	
	}
}
</script>