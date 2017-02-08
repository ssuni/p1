 <?	$listnum = ( !$boardSet["mpagenumber"]  ) ? 10: $boardSet["mpagenumber"];
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
		echo "<li><a href=$PHP_SELF?$get_val&p=$pre10page><img src='/board/skin/default/images/icon_prev2.gif' border='0'></a></li>";
	}
	if($p == 1) { 
		echo "<li><img src='/board/skin/default/images/icon_prev.gif'></li>"; 
	} else { 
		$prevpage = $p-1; 
		echo "<li><a href=$PHP_SELF?$get_val&p=$prevpage><img src='/board/skin/default/images/icon_prev.gif' border='0'></a></li>";
	}
	echo "<li><ul class='paging'>";
	for ($page = $fpage; $page <= $lpage; $page++) {
		if( $page > 1 ) { echo ""; }
		if ($page == $p) { echo "<li class='over'>".$page."</li>"; }
		else { echo "<li><a href=$PHP_SELF?$get_val&p=$page>".$page."</a></li>"; }
	}
	echo "</ul><div class='clr'></div></li>";
	if($p == $total_page) {	
		echo "<li><img src='/board/skin/default/images/icon_next.gif'></li>"; 
	}	else { 
		$nextpage = $p+1; 
		echo"<li><a href=$PHP_SELF?$get_val&p=$nextpage><img src='/board/skin/default/images/icon_next.gif' border='0'></a></li>"; 
	}
	if($lpage<$total_page) {
		$next10page=$lpage+1;
		echo"<li><a href=$PHP_SELF?$get_val&p=$next10page><img src='/board/skin/default/images/icon_next2.gif' border='0'></a></li>";
	}	?>