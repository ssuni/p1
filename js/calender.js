isIE=document.all;
isNN=!document.all&&document.getElementById;
isN4=document.layers;
isHot=false;

now=new Date();
static_now=new Date();
week=new Array("일","월","화","수","목","금","토");


	//달력함수
	function calender(val,element_name){
	var p;
	var z=0;
	
	switch(val){
		case 1:now.setYear(now.getFullYear()-1);break;
		case 2:now.setMonth(now.getMonth()-1);break;
		case 3:now.setMonth(now.getMonth()+1);break;
		case 4:now.setYear(now.getFullYear()+1);break;
				//	now.setMonth(now.getMonth() - val);
	}

	sc="<input type=\"button\" onclick=\"calender(1,'"+element_name+"')\" style=\"cursor:pointer\" value=\" ◀\">";
	sc+="<input type=\"button\" onclick=\"calender(2,'"+element_name+"')\" style=\"cursor:pointer\" value=\" ◁\"> ";
	sc+="<b><font color='white'>"+now.getFullYear()+" 년 / ";
	sc+=(now.getMonth()+1)+" 월</font></b>";  
	sc+="<input type=\"button\" onclick=\"calender(3,'"+element_name+"')\" style=\"cursor:pointer\" value=\"▷ \">";
	sc+="<input type=\"button\" onclick=\"calender(4,'"+element_name+"')\" style=\"cursor:pointer\" value=\"▶ \">";

	

	//해당월 마지막 일자
	last_date = new Date(now.getFullYear(),now.getMonth()+1,1-1);
	
	//해당월 처음일자 요일
	first_date= new Date(now.getFullYear(),now.getMonth(),1);

	//스킨
	calender_area="<table style='border:1 solid #dcdcdc' cellspacing='0' cellpadding='0'><tr><td><table cellpadding='1' cellspacing='0' bgcolor='#dcdcdc' style='border:1 solid #808080'>";
	calender_area+="<tr bgcolor='#006699'><td colspan='10' style='border-bottom:1 solid #808080;font-size:9pt' align='right' style='color:#FF6600'><a href='javascript:' onClick=\"divHide('s_area');\"><font color='#FF6600'>[닫기]</font></a></td></tr>";
	calender_area+="<tr bgcolor='#006699'><td colspan='10' style='border-bottom:1 solid #808080;font-size:9pt' align='center' style='color:#ffffff'>"+sc+"</td></tr><tr>";

		//요일표시
		var color='#FF6600';
		for(i=0;i<week.length;i++){
			calender_area+="<td bgcolor='#2E8BAF'  style='border-left:1 solid #dcdcdc;border-bottom:1 solid #808080;color:"+color+";font-size:9pt' align='center'><b>"+week[i]+"</b></td>";
			color='#ffffff';
		}
			calender_area+="</tr><tr>";

		for(i=1;i<=first_date.getDay();i++){
			calender_area+="<td align='right' valign='top' bgcolor='#ffffff'  style='border-left:1 solid #dcdcdc;border-bottom:1 solid #dcdcdc'>&nbsp;</td>";
		}
		
		
		z=(i-1);
		for (i=1;i<=last_date.getDate();i++)
		{
			z++;
			p=z%7;
			var pmonth=now.getMonth()+1;
			if(i<10){var ii="0"+i;}else{var ii=i;}
			if(pmonth<10){pmonth="0"+pmonth;}

			calender_area+="<td align='right' valign='top' bgcolor='#ffffff' style='border-left:1 solid #dcdcdc;border-bottom:1 solid #dcdcdc'  align='center'  onclick=\"change_date('"+now.getFullYear()+"-"+pmonth+"-"+ii+"','"+element_name+"')\"  onmouseover=\"this.bgColor='#eeeeee'\" onmouseout=\"this.bgColor='#ffffff'\" style='cursor:hand' height='22' width='22'>";
				
						//오늘의 색상
						if(i == now.getDate() && now.getFullYear()==static_now.getFullYear() && now.getMonth()==static_now.getMonth()) {
														   calender_area+="<span style='color:#339900;font-size:8pt'><B>"+i+"</B></span>";}
							else if(p == 0){calender_area+="<span style='color:#0000ff;font-size:8pt' ><B>"+i+"</B></span>";}
							else if(p == 1){calender_area+="<span style='color:#ff0000;font-size:8pt'><B>"+i+"</B></span>";}
												else{calender_area+="<span style='color:#4b4b4b;font-size:8pt'><B>"+i+"</B></span>";}

			calender_area+="</td>";
			
			if(p==0 && last_date.getDate() != i){calender_area+="</tr><tr>";}
		}
	
		if(p !=0){
			for(i=p;i<7;i++){
					calender_area+="<td align='right' valign='top' bgcolor='#ffffff' style='border-left:1 solid #dcdcdc;border-bottom:1 solid #dcdcdc'>&nbsp;</td>";
			}
		}

	//스킨
	calender_area+="</tr></table>";
	s_area.innerHTML=calender_area;
	

	}
	function check_mouse(val){
		
		calender('not',val);
		document.getElementById('s_area').style.visibility="visible";
		document.getElementById('s_area').style.left=event.clientX-10;
		document.getElementById('s_area').style.top=event.clientY+0;
	}
	function change_date(val,element_name){

		eval(element_name).value=val;
		s_area.style.visibility="hidden";
	}
	function divHide(id) {
	  if (isIE||isNN) document.getElementById(id).style.visibility="hidden";
		else if (isN4) document.getElementById(id).visibility="hide";  
	}
	document.write("<div id='s_area' style='font-size:9pt;position:absolute;width:200px;height:100px;z-index:999;top:0px;'>&nbsp;</div>");