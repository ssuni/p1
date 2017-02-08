<?	$s_curr_year = date(Y);
	$s_curr_month = date(n);
	$s_curr_day = date(j);
	if(!$s_year||!$s_month) { $s_year=$s_curr_year; $s_month=$s_curr_month; }
	
	$s_month1=$s_month-1; $s_month2=$s_month+1;
	if($s_month1==0) { $s_month1=12; $s_year1=$s_year-1; } else { $s_year1=$s_year; }
	if($s_month2==13) { $s_month2=1; $s_year2=$s_year+1; } else { $s_year2=$s_year; }

	$s_dd=1; 
	while(checkdate($s_month,$s_dd,$s_year)) { $s_dd++; }
	$s_total_days=$s_dd-1;
	$s_first_day = date('w', mktime(0,0,0,$s_month,1,$s_year));
	
	$s_Query = "SELECT *, UNIX_TIMESTAMP( tblDtmRsvDate ) AS s_utime FROM tblProgram WHERE UNIX_TIMESTAMP( tblDtmRsvDate ) BETWEEN '".mktime(0,0,0,$s_month,1,$s_year)."' AND '".mktime(0,0,0,$s_month,$s_dd-1,$s_year)."' ORDER BY tblDtmRsvDate ASC";
	$s_Sql = mysql_query( $s_Query );
	$s_tmp = 0;
	
	while( $s_Array = mysql_fetch_array( $s_Sql ) ) {
		$s_utime = $s_Array["s_utime"];
		$Data[$s_utime][$s_tmp]["number"]		= $s_Array["tblNumber"];
		$Data[$s_utime][$s_tmp]["subject"]	= mb_strimwidth( $s_Array["tblStrSubject"], 0, 12, "...", "utf-8");
		$Data[$s_utime][$s_tmp]["comment"]	= stripslashes( $s_Array["tblStrComment"] );
		$s_tmp++;
	}	?>
<tr>
	<td align="center" colspan="3"><strong><?=$s_year?>년 <?=$s_month?>월</strong></td>
</tr>
<tr>
	<td colspan="3"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF"><!-- bgcolor="#E6E6E6"-->
		<tr>
			<td width="14%" height="25" align="center" bgcolor="#D06D6D"><font color="#FFFFFF">일</font></td>
			<td width="14%" align="center" bgcolor="#6D90D0"><font color="#FFFFFF">월</font></td>
			<td width="14%" align="center" bgcolor="#6D90D0"><font color="#FFFFFF">화</font></td>
			<td width="14%" align="center" bgcolor="#6D90D0"><font color="#FFFFFF">수</font></td>
			<td width="14%" align="center" bgcolor="#6D90D0"><font color="#FFFFFF">목</font></td>
			<td width="15%" align="center" bgcolor="#6D90D0"><font color="#FFFFFF">금</font></td>
			<td align="center" bgcolor="#6D90D0"><font color="#FFFFFF">토</font></td>
		</tr>
		<tr>
		<?	$col=0; 
			for($i=0; $i<$s_first_day; $i++){ 
				echo"<td>&nbsp;</TD>";       
				$col++;
			} 

			for($j=1; $j<=$s_total_days; $j++){ 
				$s_tw=date('w', mktime(0,0,0,$s_month,$j,$s_year));

				if($s_curr_year==$s_year && $s_curr_month==$s_month && $s_curr_day==$j) {
					$s_todayStr = "#000000";
					$s_style = "style='font-weight:bold;color:#FFFFFF'";
				} else {
					$s_todayStr = "#FFFFFF";
					$s_style = "";
				}

				$s_programDate = $s_curr_year."-".$s_curr_month."-".$j;
				$s_vunixTime = mktime(0,0,0,$s_curr_month,$j,$s_curr_year);

				echo "<td bgcolor='".$s_todayStr."' align='center' ".$s_style.">".$j."</td>";
				$col++;

				if($col==7){
					echo"</tr>";
					if($j != $s_total_days){			
						echo"<tr>"; 
					} 
					$col=0; 
				} 
			}      

			while($col > 0 && $col < 7){ 
				echo"<td>&nbsp;</td>"; 
				$col++; 
			}	?>
		</tr>
	</table></td>
</tr>