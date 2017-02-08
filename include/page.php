<table border="0" cellspacing="3" cellpadding="0" align="center">
	<tr>
		<td>
<?
	$listnum = ( !$boardSet["pagenumber"]  ) ? 10: $boardSet["pagenumber"];
	$fpage = 1;
	$lpage = $listnum;
	$pageSkin = ( $boardSet["skin"] ) ? $boardSet["skin"] : "notice";

	while($fpage<=$total_page) {
		if(($fpage<=$p) && ($p<=$lpage)) {
			if($lpage>$total_page) { $lpage=$total_page; }
			break;
		}		
		$fpage=$fpage+$listnum;
		$lpage=$lpage+$listnum;
	}

	if($p>$listnum) {
		$pre10page=$fpage-1;
		echo"<a href=$PHP_SELF?$get_val&p=$pre10page><img src='/admin/img/icon_prev2.gif' border='0' align='absmiddle'></a>";
	}
	echo "</td><td>";
	if($p == 1) { 
		echo "<img src='/admin/img/icon_prev.gif' align='absmiddle'>"; 
	} else { 
		$prevpage = $p-1; 
		echo "<a href=$PHP_SELF?$get_val&p=$prevpage><img src='/admin/img/icon_prev.gif' border='0' align='absmiddle'></a>";
	}
	echo "</td><td style='padding:0 10px;'>";
	for ($page = $fpage; $page <= $lpage; $page++) {
		if( $page > 1 ) { echo "&nbsp;"; }
		if ($page == $p) { echo "<font color='#da2782'>".$page."</font>"; }
		else { echo "<a href=$PHP_SELF?$get_val&p=$page>".$page."</a>"; }
	}
	echo "</td><td>";
	if($p == $total_page) {	
		echo "<img src='/admin/img/icon_next.gif' border='0' align='absmiddle'>"; 
	}	else { 
		$nextpage = $p+1; 
		echo"<a href=$PHP_SELF?$get_val&p=$nextpage><img src='/admin/img/icon_next.gif' border='0' align='absmiddle'></a>"; 
	}
	echo "</td><td>";
	if($lpage<$total_page) {
		$next10page=$lpage+1;
		echo"<a href=$PHP_SELF?$get_val&p=$next10page><img src='/admin/img/icon_next2.gif' border='0' align='absmiddle'></a>";
	}
?>
		</td>
	</tr>
</table>
