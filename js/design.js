/**********************************************************************/
/* 플래시 스크립트 알죠?? 플래시 박스 나오는거 없애는 스크립트 ********/
/**********************************************************************/

function playflash(file,width,height,bgcolor,quality,name){
        document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+width+'" height="'+height+'" id="'+name+'">');
        document.write('<param name="movie" value="'+file+'" />');
        document.write('<param name="quality" value="'+quality+'" />');
        document.write('<param name="wmode" value="transparent">');
        document.write('<param name="bgcolor" value="'+bgcolor+'" />');
        document.write('<embed src="'+file+'" quality="'+quality+'"bgcolor="'+bgcolor+'" width="'+width+'" height="'+height+'" name="'+name+'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" />');
        document.write('</object>')
}



/*************이미지 롤오버 스크립트***************/

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


/*************탭 스크립트********************/

//type : 뒤에 숫자를 뺀 테이블 ID
//top : 총 탭테이블 개수
//no : 탭 넘버

function view_tab(type, tot, no)
{
	for(i=1; i<=tot; i++)
	{
		h = document.getElementById(type+i);
		if(h){
			h.style.display="none";
				
		}
	}	
	s = document.getElementById(type+no);
	if(s){
		s.style.display="";
	}
}

/******************************** view_tab 활용 *********
<div id="mainboard_1"> 
	<img src="/images/main/title_notice_ov.gif" onClick="view_tab('mainboard_', 2, 1)" style="cursor:pointer;">
	<img src="/images/main/title_news.gif" onClick="view_tab('mainboard_', 2, 2)" style="cursor:pointer;">
	게시판테이블
</div>
<div id="mainboard_2" style="display:none;"> 
	<img src="/images/main/title_notice.gif" onClick="view_tab('mainboard_', 2, 1)" style="cursor:pointer;">
	<img src="/images/main/title_news_ov.gif" onClick="view_tab('mainboard_', 2, 2)" style="cursor:pointer;">
	게시판테이블
</div>
*********************************************************/



/**********************************************************************/
/* Select Box Design Script  이곳에서 셀렉트박스 조절합니다. **********/
/**********************************************************************/

var nowOpenedSelectBox = "";
var mousePosition = "";

function selectThisValue(thisId,thisIndex,thisValue,thisString) {
	var objId = thisId;
	var nowIndex = thisIndex;
	var valueString = thisString;
	var sourceObj = document.getElementById(objId);
	var nowSelectedValue = document.getElementById(objId+"SelectBoxOptionValue"+nowIndex).value;
	hideOptionLayer(objId);
	if (sourceObj) sourceObj.value = nowSelectedValue;
	settingValue(objId,valueString);
	selectBoxFocus(objId);
	if (sourceObj.onchange) sourceObj.onchange();
}

function settingValue(thisId,thisString) {
	var objId = thisId;
	var valueString = thisString;
	var selectedArea = document.getElementById(objId+"selectBoxSelectedValue");
	if (selectedArea) selectedArea.innerText = valueString;
}

function viewOptionLayer(thisId) {
	var objId = thisId;
	var optionLayer = document.getElementById(objId+"selectBoxOptionLayer");
	if (optionLayer) optionLayer.style.display = "";
	nowOpenedSelectBox = objId;
	setMousePosition("inBox");
}

function hideOptionLayer(thisId) {
	var objId = thisId;
	var optionLayer = document.getElementById(objId+"selectBoxOptionLayer");
	if (optionLayer) optionLayer.style.display = "none";
}

function setMousePosition(thisValue) {
	var positionValue = thisValue;
	mousePosition = positionValue;
}

function clickMouse() {
	if (mousePosition == "out") hideOptionLayer(nowOpenedSelectBox);
}

function selectBoxFocus(thisId) {
	var objId = thisId;
	var obj = document.getElementById(objId + "selectBoxSelectedValue");
	obj.className = "selectBoxSelectedAreaFocus";
	obj.focus();
}

function selectBoxBlur(thisId) {
	var objId = thisId;
	var obj = document.getElementById(objId + "selectBoxSelectedValue");
	obj.className = "selectBoxSelectedArea";
}

function makeSelectBox(thisId) {
	var downArrowSrc = "../images/board/bu_arrow.gif";	//오른쪽 화살표이미지
	var downArrowSrcWidth = 15;	//오른쪽 화살표이미지 width
	var optionHeight = 20; // option 하나의 높이
	var optionMaxNum = 10; // 한번에 보여지는 option의 갯수
	var optionInnerLayerHeight = "";
	var objId = thisId;
	var obj = document.getElementById(objId);
	var selectBoxWidth = parseInt(obj.style.width);
	var selectBoxHeight = parseInt(obj.style.height);
	if (obj.options.length > optionMaxNum) optionInnerLayerHeight = "height:"+ (optionHeight * optionMaxNum) + "px";
	newSelect  = "<table id='" + objId + "selectBoxOptionLayer' cellpadding='0' cellspacing='0' border='0' style='position:absolute;z-index:100;display:none;' onMouseOver=\"viewOptionLayer('"+ objId + "')\" onMouseOut=\"setMousePosition('out')\">";
	newSelect += "	<tr>";
	newSelect += "		<td height='" + selectBoxHeight + "' style='cursor:hand;' onClick=\"hideOptionLayer('"+ objId + "')\"></td>";
	newSelect += "	</tr>";
	newSelect += "	<tr>";
	newSelect += "		<td height='1'></td>";
	newSelect += "	</tr>";
	newSelect += "	<tr>";
	newSelect += "		<td bgcolor='#E2E2E2' style='padding:1px'>";
	newSelect += "		<div class='selectBoxOptionInnerLayer' style='width:" + (selectBoxWidth-2) + "px;" + optionInnerLayerHeight + "'>";
	newSelect += "		<table cellpadding='0' cellspacing='0' border='0' width='100%' style='table-layout:fixed;word-break:break-all;'>";
	for (var i=0 ; i < obj.options.length ; i++) {
		var nowValue = obj.options[i].value;
		var nowText = obj.options[i].text;
		newSelect += "			<tr>";
		newSelect += "				<td height='" + optionHeight + "' class='selectBoxOption' onMouseOver=\"this.className='selectBoxOptionOver'\" onMouseOut=\"this.className='selectBoxOption'\" onClick=\"selectThisValue('"+ objId + "'," + i + ",'" + nowValue + "','" + nowText + "')\" style='cursor:hand;'>" + nowText + "</td>";
		newSelect += "				<input type='hidden' id='"+ objId + "SelectBoxOptionValue" + i + "' value='" + nowValue + "'>";
		newSelect += "			</tr>";
	}
	newSelect += "		</table>";
	newSelect += "		</div>";
	newSelect += "		</td>";
	newSelect += "	</tr>";
	newSelect += "</table>";
	newSelect += "<table cellpadding='0' cellspacing='1' border='0' bgcolor='#E2E2E2' onClick=\"viewOptionLayer('"+ objId + "')\" style='cursor:hand;'>";
	newSelect += "	<tr>";
	newSelect += "		<td style='padding-right:1px;padding-left:1px' bgcolor='#FFFFFF'>";
	newSelect += "		<table cellpadding='0' cellspacing='0' border='0'>";
	newSelect += "			<tr>";
	newSelect += "				<td><div id='" + objId + "selectBoxSelectedValue' class='selectBoxSelectedArea' style='width:" + (selectBoxWidth - downArrowSrcWidth - 4) + "px;height:" + (selectBoxHeight - 2) + "px;overflow:hidden;' onBlur=\"selectBoxBlur('" + objId + "')\"></div></td>";
	newSelect += "				<td><img src='" + downArrowSrc + "' width='" + downArrowSrcWidth + "' border='0'></td>";
	newSelect += "			</tr>";
	newSelect += "		</table>";
	newSelect += "		</td>";
	newSelect += "	</tr>";
	newSelect += "</table>";
	document.write(newSelect);
	
	var haveSelectedValue = false;
	for (var i=0 ; i < obj.options.length ; i++) {
		if (obj.options[i].selected == true) {
			haveSelectedValue = true;
			settingValue(objId,obj.options[i].text);
		}
	}
	if (!haveSelectedValue) settingValue(objId,obj.options[0].text);
}

function initVal(thisId) {
	var objId = thisId;
	var obj = document.getElementById(objId);
	var haveSelectedValue = false;
	for (var i=0 ; i < obj.options.length ; i++) {
		if (obj.options[i].selected == true) {
			haveSelectedValue = true;
			settingValue(objId,obj.options[i].text);
		}
	}
	if (!haveSelectedValue) settingValue(objId,obj.options[0].text);
}



document.onmousedown = clickMouse;





/**********************************************************************/
/* 탭게시판 스크립트입니다. *******************************************/
/**********************************************************************/

function BlockMenu() {
	document.all.menu_01.style.display = "none"
	document.all.menu_02.style.display = "none"
}
function toggleMenu(currMenu) {
	BlockMenu();
	thiMenu = eval("document.all." + currMenu + ".style");
	thiMenu.display = "block"
}

/*function BlockMenu2() {
 document.all.menu_04.style.display = "none"
 document.all.menu_05.style.display = "none"
 document.all.menu_06.style.display = "none"
}
function toggleMenu2(currMenu) {
 BlockMenu2();
 thiMenu = eval("document.all." + currMenu + ".style");
 thiMenu.display = "block"
}


function BlockMenu3() {
 document.all.menu_07.style.display = "none"
 document.all.menu_08.style.display = "none"
 document.all.menu_09.style.display = "none"
}
function toggleMenu3(currMenu) {
 BlockMenu3();
 thiMenu = eval("document.all." + currMenu + ".style");
 thiMenu.display = "block"
}


function BlockMenu4() {
 document.all.menu_10.style.display = "none"
 document.all.menu_11.style.display = "none"
}
function toggleMenu4(currMenu) {
 BlockMenu4();
 thiMenu = eval("document.all." + currMenu + ".style");
 thiMenu.display = "block"
}
*/



/**********************************************************************/
/* 로그인 인풋박스 스크립트 입니다.  **********************************/
/**********************************************************************/

function inputFocus(frm,img){
	if(frm.value==''){
		frm.style.backgroundColor=img
		frm.style.backgroundImage='none'
	}
}

function inputBlur(frm,img){
	if(frm.value==''){
		frm.style.backgroundImage='url('+img+')'
	}
}


/**********************************************************************/
/* 탑매뉴 눌르면 부드럽게 최상단으로 올라갑니다. **********************/
/**********************************************************************/


function scroll(x, y){
	document.body.scrollTop=x
	document.body.scrollLeft=y
}


function back_top(){
	y = document.body.scrollLeft;
	x = document.body.scrollTop;

	step = 3;  // 숫자가 클수록...빠름
	//alert(x)
	while ((x != 0) || (y != 0)) {
		scroll (x, y);
		x -= step;
		y -= step;
		if (x < 0) x = 0;
		if (y < 0) y = 0;
	} 
	scroll (0, 0);
}


/**********************************************************************/
/* 퀵매뉴 스크립트 ****************************************************/
/**********************************************************************/
var stmnLEFT = 25; // 스크롤메뉴의 좌측 위치 
var stmnGAP1 = 0; // 페이지 헤더부분의 여백 
var stmnGAP2 = 600; // 스크롤시 브라우저 상단과 약간 띄움. 필요없으면 0으로 세팅 
var stmnBASE = 600; // 스크롤메뉴 초기 시작위치 (아무렇게나 해도 상관은 없지만 stmnGAP1과 약간 차이를 주는게 보기 좋음) 
var stmnActivateSpeed = 100; // 움직임을 감지하는 속도 (숫자가 클수록 늦게 알아차림) 
var stmnScrollSpeed = 10; // 스크롤되는 속도 (클수록 늦게 움직임) 

var stmnTimer; 

function ReadCookie(name) { 
var label = name + "="; 
var labelLen = label.length; 
var cLen = document.cookie.length; 
var i = 0; 

while (i < cLen) { 
        var j = i + labelLen; 

        if (document.cookie.substring(i, j) == label) { 
                var cEnd = document.cookie.indexOf(";", j); 
                if (cEnd == -1) cEnd = document.cookie.length; 
                return unescape(document.cookie.substring(j, cEnd)); 
        } 
                i++; 
    } 
  return ""; 
} 

function SaveCookie(name, value, expire) { 
	var eDate = new Date(); 
	eDate.setDate(eDate.getDate() + expire); 
	document.cookie = name + "=" + value + "; expires=" +  eDate.toGMTString()+ "; path=/"; 
} 

function RefreshStaticMenu(){ 
	var stmnStartPoint, stmnEndPoint, stmnRefreshTimer; 

	stmnStartPoint = parseInt(confirm_frm.style.top, 10); 

//	alert(confirm_frm.style.top);

							 
	stmnEndPoint = document.body.scrollTop + stmnGAP2; 

	stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(confirm_frm.offsetHeight); 
	if (stmnEndPoint > stmnLimit) stmnEndPoint = stmnLimit; 
							 
	if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1; 

	stmnRefreshTimer = stmnActivateSpeed; 

	if ( stmnStartPoint != stmnEndPoint ) { 
		stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 ); 
		confirm_frm.style.top = parseInt(confirm_frm.style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount ); 
		stmnRefreshTimer = stmnScrollSpeed; 
	} 

	stmnTimer = setTimeout ("RefreshStaticMenu();", stmnRefreshTimer); 
} 

function ToggleAnimate() { 
var Animate
        if (!ANIMATE.checked) { 
                RefreshStaticMenu(); 
                SaveCookie("ANIMATE", "true", 300); 
                } else { 
                clearTimeout(stmnTimer); 
                confirm_frm.style.top = stmnGAP1; 
                SaveCookie("ANIMATE", "false", 300); 
        } 
} 


function InitializeStaticMenu() { 
var Animate
confirm_frm.style.left = stmnLEFT; 
        if (ReadCookie("ANIMATE") == "false") { 
               // ANIMATE.checked = true; 
                confirm_frm.style.top = document.body.scrollTop + stmnGAP1; 
                } else { 
               // ANIMATE.checked = false; 
                confirm_frm.style.top = document.body.scrollTop + stmnBASE; 
                RefreshStaticMenu(); 
        } 
} 


//////////////////////////////////////////////////////////////////////////////////////
var stmnLEFT1 = 300; // 스크롤메뉴의 좌측 위치 
var stmnGAP11 = 0; // 페이지 헤더부분의 여백 
var stmnGAP21 = 200; // 스크롤시 브라우저 상단과 약간 띄움. 필요없으면 0으로 세팅 
var stmnBASE1 = 80; // 스크롤메뉴 초기 시작위치 (아무렇게나 해도 상관은 없지만 stmnGAP11과 약간 차이를 주는게 보기 좋음) 
var stmnActivateSpeed1 = 100; // 움직임을 감지하는 속도 (숫자가 클수록 늦게 알아차림) 
var stmnScrollSpeed1 = 10; // 스크롤되는 속도 (클수록 늦게 움직임) 

var stmnTimer; 

function ReadCookie1(name) { 
var label = name + "="; 
var labelLen = label.length; 
var cLen = document.cookie.length; 
var i = 0; 

while (i < cLen) { 
        var j = i + labelLen; 

        if (document.cookie.substring(i, j) == label) { 
                var cEnd = document.cookie.indexOf(";", j); 
                if (cEnd == -1) cEnd = document.cookie.length; 
                return unescape(document.cookie.substring(j, cEnd)); 
        } 
                i++; 
    } 
  return ""; 
} 

function SaveCookie1(name, value, expire) { 
	var eDate = new Date(); 
	eDate.setDate(eDate.getDate() + expire); 
	document.cookie = name + "=" + value + "; expires=" +  eDate.toGMTString()+ "; path=/"; 
} 

function RefreshStaticMenu1(){ 
	var stmnStartPoint, stmnEndPoint, stmnRefreshTimer; 

	stmnStartPoint = parseInt(confirm_frm1.style.top, 10); 

//	alert(confirm_frm1.style.top);

							 
	stmnEndPoint = document.body.scrollTop + stmnGAP21; 

	stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(confirm_frm1.offsetHeight); 
	if (stmnEndPoint > stmnLimit) stmnEndPoint = stmnLimit; 
							 
	if (stmnEndPoint < stmnGAP11) stmnEndPoint = stmnGAP11; 

	stmnRefreshTimer = stmnActivateSpeed1; 

	if ( stmnStartPoint != stmnEndPoint ) { 
		stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 ); 
		confirm_frm1.style.top = parseInt(confirm_frm1.style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount ); 
		stmnRefreshTimer = stmnScrollSpeed1; 
	} 

	stmnTimer = setTimeout ("RefreshStaticMenu1();", stmnRefreshTimer); 
} 

function ToggleAnimate11() { 
var Animate
        if (!ANIMATE.checked) { 
                RefreshStaticMenu1(); 
                SaveCookie1("ANIMATE", "true", 300); 
                } else { 
                clearTimeout(stmnTimer); 
                confirm_frm1.style.top = stmnGAP11; 
                SaveCookie1("ANIMATE", "false", 300); 
        } 
} 


function InitializeStaticMenu1() { 
var Animate
confirm_frm1.style.left = stmnLEFT1; 
        if (ReadCookie1("ANIMATE") == "false") { 
               // ANIMATE.checked = true; 
                confirm_frm1.style.top = document.body.scrollTop + stmnGAP11; 
                } else { 
               // ANIMATE.checked = false; 
                confirm_frm1.style.top = document.body.scrollTop + stmnBASE1; 
                RefreshStaticMenu1(); 
        } 
} 


/*팝업창 리사이즈 스크립트*/
function resizeWin(maxX,maxY,speed,delay,win){
	this.obj = "resizeWin" + (resizeWin.count++);
	eval(this.obj + "=this");
	if (!win)     this.win = self;    else this.win = eval(win);
	if (!maxX)    this.maxX = 400;    else this.maxX = maxX;
	if (!maxY)    this.maxY = 300;    else this.maxY = maxY;
	if (!speed)   this.speed = 1/5;   else this.speed = 1/speed;
	if (!delay)   this.delay = 0;    else this.delay = delay;
	this.doResize = (document.all || document.getElementById);
	this.stayCentered = false;
	
	this.initWin = 	function(){
		if (this.doResize){
			this.resizeMe();
			}
		else {
			this.win.resizeTo(this.maxX + 10, this.maxY - 20);
			}
		}

	this.resizeMe = function(){
		this.win.focus();
		this.updateMe();
		}
	
	this.resizeTo = function(x,y){
		this.maxX = x;
		this.maxY = y;
		this.resizeMe();
		}
		
	this.stayCentered = function(){
		this.stayCentered = true;
		}

	this.updateMe = function(){
		this.resizing = true;
		var x = Math.ceil((this.maxX - this.getX()) * this.speed);
		var y = Math.ceil((this.maxY - this.getY()) * this.speed);
		if (x == 0 && this.getX() != this.maxX) {
			if (this.getX() > this.maxX) x = -1;
			else  x = 1;
			}
		if (y == 0 && this.getY() != this.maxY){
			if (this.getY() > this.maxY) y = -1;
			else y = 1;
			}
		if (x == 0 && y == 0) {
			this.resizing = false;
    		}
		else {
			this.win.top.resizeBy(parseInt(x),parseInt(y));
			if (this.stayCentered == true) this.win.moveTo((screen.width - this.getX()) / 2,(screen.height - this.getY()) / 2);
			setTimeout(this.obj + '.updateMe()',this.delay)
			}
		}
		
	this.write =  function(text){
		if (document.all && this.win.document.all["coords"]) this.win.document.all["coords"].innerHTML = text;
		else if (document.getElementById && this.win.document.getElementById("coords")) this.win.document.getElementById("coords").innerHTML = text;
		}
		
	this.getX =  function(){
		if (document.all) return (this.win.top.document.body.clientWidth + 10)
		else if (document.getElementById)
			return this.win.top.outerWidth;
		else return this.win.top.outerWidth - 12;
	}
	
	this.getY = function(){
		if (document.all) return (this.win.top.document.body.clientHeight + 29)
		else if (document.getElementById)
			return this.win.top.outerHeight;
		else return this.win.top.outerHeight - 31; 
	}
	
	this.onResize =  function(){
		if (this.doResize){
			if (!this.resizing) this.resizeMe();
			}
		}

	return this;
}
resizeWin.count = 0;


/* 스크립트 끝 추가 되는거 있음 추가하시고요..^^ */