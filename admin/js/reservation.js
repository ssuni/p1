	function calendarr(oo,aa,bb){
        var date = new Date(aa,parseInt(oo)-1,bb);
		var date_now = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();
		var day_now = date_now.getDate();
        var month_now = date_now.getMonth();
        var year_now = date_now.getFullYear();
		
		var month_nn=""+month_now;
		if(month_nn.length==1) month_nn="0"+month_nn;
		var day_nn=""+(day_now+1);
		if(day_nn.length==1) day_nn="0"+day_nn;
		var onul=year_now+""+month_nn+""+day_nn;

		var month_neil=""+month;
		if(month_neil.length==1) month_neil="0"+month_neil;
		var day_neil="";
		var neil=year+""+month_neil;
		var neill="";

		var month_gogo=""+(month+1);
		if(month_gogo.length==1) month_gogo="0"+month_gogo;

		var pre_mon=parseInt(oo)-1;
		var nex_mon=parseInt(oo)+1;
		var pre_year=year;
		var nex_year=year;
		if(pre_mon < 1){
			pre_mon=12;
			pre_year=parseInt(year)-1;
		}
		if(nex_mon > 12){
			nex_mon=1;
			nex_year=parseInt(year)+1;
		}

        if(year<=200){
                year += 1900;
        }
        months = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if(year%4 == 0 && year!=1900){
                days_in_month[1]=29;
        }
        total = days_in_month[month];
        var date_today = year+'-'+months[month];
        
		beg_j = date;
        beg_j.setDate(1);
        if(beg_j.getDate()==2){
                beg_j=setDate(0);
        }
        beg_j = beg_j.getDay();
		        
		var gomul="";
		gomul="<div class='calendarWrap'><div class='headBox'><p class='wrap'><img src='/board/skin/reservation/images/btn_prev.gif' onclick=\"calendarr('"+pre_mon+"','"+pre_year+"','"+day+"');\" style='cursor:pointer;'>&nbsp;<span class='month'>"+date_today+"</span>&nbsp;<img src='/board/skin/reservation/images/btn_next.gif' onclick=\"calendarr('"+nex_mon+"','"+nex_year+"','"+day+"');\" style='cursor:pointer;'></p></div>";
        gomul+="<table id='calendar' border='1'><colgroup><col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'></colgroup><thead><tr><th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th></tr></thead><tbody><tr>";
        week = 0;
        for(i=1;i<=beg_j;i++){
                //gomul+='<td>'+(days_in_month[month-1]-beg_j+i)+'</td>';
				gomul+='<td>&nbsp;</td>';
                week++;
        }
		var year = year.toString();
		year_af = year.substring(0,3)-190;
		year_af = year_af + year.substring(3,4);
        for(i=1;i<=total;i++){
                if(week==0){
                        gomul+='<tr>';
                }
                if(day==i && month==month_now && year==year_now){
                        gomul+='<td class="todayOn day_'+i+'">'+i+'</td>';
                }else{
						neill="";
						neill=neil;
						day_neil=""+i;
						if(day_neil.length==1) day_neil="0"+day_neil;
						neill=neill+""+day_neil;

                        gomul+='<td class="day_'+i+'">'+i;
						if(parseInt(onul) < parseInt(neill) && week!=0){
							var is_today = month_gogo+day_neil;
							if (is_today != '0101' && is_today != '0301' && is_today != '0505' && is_today != '0606' && is_today != '0815' && is_today != '1003' && is_today != '1009' && is_today != '1225'){
								gomul+="<br><input type='button' value='설정' id='"+year+"-"+month_gogo+"-"+day_neil+"'/>";
							}
						}						
						gomul+='</td>';
                }
                week++;
                if(week==7){
                        gomul+='</tr>';
                        week=0;
                }
        }
        for(i=1;week!=0;i++){
                //gomul+='<td>'+i+'</td>';
				gomul+='<td>&nbsp;</td>';
                week++;
                if(week==7){
                        gomul+='</tr>';
                        week=0;
                }
        }
        gomul+='</tbody></table></div>';
		document.getElementById('zeze').innerHTML=gomul;

		getholidayList();
		setHoliday();
        return true;
	}