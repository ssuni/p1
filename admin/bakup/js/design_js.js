/****************PNG 패치*****************/
function setPng24(obj) { 
  obj.width=obj.height=1; 
  obj.className=obj.className.replace(/\bpng24\b/i,''); 
  obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');" 
  obj.src='';  
  return ''; 
}
/****************쿠키*****************/
function setCoo( name, value, expiredays ) 
{ 
var todayDate = new Date(); 
todayDate.setDate( todayDate.getDate() + expiredays ); 
document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 
/****************레이어*****************/
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
function LayerMove(obj,num,type) { //v9.0
  var obj,args=LayerMove.arguments;
  with (document) if (getElementById && ((args=getElementById(obj))!=null)) {
		if (args.style) {
			args.style.top=37+(28*(num-1));
			for (i=1; i<=type; i++) {
				if(i==num){document.all[obj+'_'+i].style.display='';}
				else{document.all[obj+'_'+i].style.display='none';}
			}
		}
  }
}
/****************플래시패치*****************/

	function MakeFlash(Url,Width,Height){                 
	  document.writeln("<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"" + Width + "\" height=\"" + Height + "\">"); 
	  document.writeln("<param name=\"movie\" value=\"" + Url + "\">"); 
	  document.writeln("<param name=\"quality\" value=\"high\" />");     
	  document.writeln("<param name=\"wmode\" value=\"transparent\">"); 
	  document.writeln("<embed src=\"" + Url + " \"wmode=\"transparent\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"" + Width + "\"  height=\"" + Height + "\">"); 
	  document.writeln("</object>");     
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
	/*이미지 체인지*/
	function img_change(path,img_name,img_file){
	window.document[img_name].src=path+ img_file;
	}
	
	/*이미지 탭*/
	function IMG_VIEW(num,mxnum,img_name,img_file,cate){
		for(i=1;i<=mxnum;i++){
			if(num==i){document.all[cate+i].style.display='';img_change('images/',img_name+i,img_file+i+'_on.gif');}
			else{document.all[cate+i].style.display='none';img_change('images/',img_name+i,img_file+i+'.gif');}
		}
	}
	function TAB_VIEW(num,mxnum,img_name,img_file,cate){
		for(i=1;i<=mxnum;i++){
			if(num==i){document.all[cate+i].style.display='';img_change('/product/images/',img_name+i,img_file+i+'_on.gif');}
			else{document.all[cate+i].style.display='none';img_change('/product/images/',img_name+i,img_file+i+'.gif');}
		}
	}
	function BT_VIEW(num,mxnum,img_name,cate){
		for(i=1;i<=mxnum;i++){
			if(num==i){document.all[cate+i].style.display='';}
			else{document.all[cate+i].style.display='none';}
		}
	}
/*************팝업 스크립트***************/

	function shwForm(Src, Name, Left, Top, Width, Height){
		if (typeof(arguments[0]) == 'undefined') return false;
		if (typeof(arguments[1]) == 'undefined') Left = '';
		if (typeof(arguments[2]) == 'undefined') Top = '';
		if (typeof(arguments[3]) == 'undefined') Width = '';
		if (typeof(arguments[4]) == 'undefined') Height = '';
		
		window.open(Src, Name, 'Left=' + Left + ',Top=' + Top + ',Width=' + Width + ',Height=' + Height + ',menubar=no,directories=no,resizable=no,status=no,scrollbars=no');
		
		return false;
	}

	function MM_openBrWindow(theURL,winName,features) { //v2.0
		 window.open(theURL,winName,features);
	}

	function Open_Center_Window(URL, WinTitle,winW,winH,winScroll) {
		var win_Left = (screen.width - winW) / 2;
		var win_Top = (screen.height - winH) / 2;
		options = "width="+winW+",height="+winH+",top="+win_Top+",left="+win_Left+",top="+win_Top+",scrollbars="+winScroll+",resizable=no";

		win = window.open(URL,WinTitle,options);
	}

	/*************팝업***************/
	function getCookie(name) {
		var Found = false
		var start, end
		var i = 0

		// cookie 문자열 전체를 검색
		while(i <= document.cookie.length) {
			 start = i
			 end = start + name.length
			 // name과 동일한 문자가 있다면
			 if(document.cookie.substring(start, end) == name) {
				 Found = true
				 break
			 }
			 i++
		}

		// name 문자열을 cookie에서 찾았다면
		if(Found == true) {
			start = end + 1
			end = document.cookie.indexOf(";", start) 			// 마지막 부분이라는 것을 의미(마지막에는 ";"가 없다)
			if(end < start)
				end = document.cookie.length 			// name에 해당하는 value값을 추출하여 리턴한다.
			return document.cookie.substring(start, end)
		}
		// 찾지 못했다면
		return ""
	}

	function setCookie( name, value, expiredays ) {
		var todayDate = new Date();
		todayDate.setDate( todayDate.getDate() + expiredays );
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}

/* ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
	┃ 개발자 정의 함수																																									 ┃
	┃ 업데이트:2012.01.10																																								 ┃
	┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛*/

	//폼 필수 입력사항 체크
	function formChk(obj){
		 var res=true;
		$(obj).find(".req:visible").each(function(){
			if($(this).val().replace(/\s+/g,"").length==0){
				alert("필수입력사항("+$(this).attr("title")+")을 모두 기입해 주세요.");
				$(this).focus();
				res=false;
				return false;
			}
		});
		return res;
	}

	//개별 폼 체크
	function inputChk(obj, msg){
		if (obj.value.replace(/\s+/g,'').length == 0){
			alert(msg);
			obj.focus();
			return false;
		}
		return true;
	}

	//숫자만 입력
	function onlyNumber(el){
		if((event.keyCode<48 && event.keyCode!==13)||(event.keyCode>57)){
			event.returnValue=false;
			alert('숫자만 입력 가능합니다.');
		}
	}

	//이메일 선택
	/*
	$(function(){
		$(".selMail").change(function(){
			if($(this).val()==""){
				$(this).prev().val("");
				$(this).prev().attr("readonly",false);
				$(this).prev().focus();
			}else{
				$(this).prev().val($(this).val());
				$(this).prev().attr("readonly",true);
			}
		});
	});
*/
	//체크박스 전체 선택
	function check_all(obj, val){
		if($(obj).is(":checked")==true){
			$("input:checkbox[name='"+val+"']").each(function(){
				this.checked=true;
			});
		}else{
			$("input:checkbox[name='"+val+"']").each(function(){
				this.checked=false;
			});
		}
	}

	//체크박스 일괄 삭제
	function check_del(form,el){
		if($("input:checkbox[name='"+el+"']:checked").length<1){
			alert("최소 하나 이상의 글을 선택해 주세요."); return;}
		else{
			if(confirm("선택하신 글을 모두 삭제하시겠습니까?")){
				form.mode.value="check_del";
				form.submit();
			}
		}
	}

	// 정보 삭제시 삭제 여부 확인
	function really(){
		if (confirm("정말로 삭제하시겠습니까?")) return true;
		return false;
	}

	// 메세지 출력 후 실행
	function really_msg(msg){
		if (confirm(msg)) return true;
		return false;
	}

	//첨부파일 다운로드(파일경로,파일명)
	function FileDown(Path, File, Org){
		x=screen.availWidth/2-150
		y=screen.availHeight/2-100
		window.open("/common/filedown.php?Path="+Path+"&File="+File+"&Org="+Org,'', 'Left=' + x + ',Top=' + y + ',Width=0, Height=0,menubar=no,directories=no,resizable=no,status=no,scrollbars=no');
	}

	//커서자동이동
	function AutoMove(obj,next,cnt){
		if($(obj).val().length==cnt) document.getElementById(next).focus();
	}