<?php
	include ( $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php" );

	$whereis = ($_GET['field'])?' where tblIntField like "%['.$_GET['field'].']%"':'';
	$startnum = ( $_GET['page'] - 1 ) * $_GET['line_number'];
	$Query = "SELECT * FROM tbl_".$_GET['tblname'].$whereis." ORDER BY tblNumber desc limit ".$startnum.', '.$_GET['line_number'];
	$Sql = mysql_query( $Query );		
	while($Array = mysql_fetch_array( $Sql )) {
		$i++;
		//$Data["savefile"]		= explode( '|', $Array["tblStrSaveFile"] );
		$Data["savefile"]		= explode( '|', $Array["tblStrThum1"] ); 
		
		
		$margin_0 = ($i % 4 == 0)?'style="margin-right: 0px;"':'';
		
		$bnf_wrap_li .= '<li '.$margin_0.'><img src="'.$Data["savefile"][0].'" width="180" height="72" alt="'.$Array["tblStrSubject"].'" number="'.$Array["tblNumber"].'" style="opacity: 0.5;"/><p>'.$Array["tblStrSubject"].'</p></li>';
	}
	
	if ($i) {
		$response['page'] = $_GET['page'];
		$response['line_number'] = $_GET["line_number"];
		$response['subject'] = stripslashes( $Array["tblStrSubject"] );
		$response['bnf_wrap_li'] = $bnf_wrap_li;
		$response['result'] = true;
	}
	echo json_encode($response);
?>