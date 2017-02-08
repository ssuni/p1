<?php
	include ( $_SERVER['DOCUMENT_ROOT']."/board/inc/board_setting.php" );

	$Query = "SELECT * FROM tbl_".$_GET['tb']." WHERE tblNumber='{$_GET['number']}'";
	$Sql = mysql_query( $Query );		
	$Array = mysql_fetch_array( $Sql );

	$Data["savefile"]		= explode( '|', $Array["tblStrSaveFile"] );

	for($i=0; $i<sizeof($Data["savefile"]); $i++) {
		if ($Data["savefile"][$i]) { 
			switch($i) {
				case '0':
					$_ov0=(!$_ov0)?'_ov':'';
					$bnf_wrap_btn .= '<li><img src="/board/skin/'.$boardSet["skin"].'/images/btn1'.$_ov0.'.gif" alt="정면"/></li>';
				break;
				case '1':
					$_ov1=(!$_ov0)?'_ov':'';
					$bnf_wrap_btn .= '<li><img src="/board/skin/'.$boardSet["skin"].'/images/btn2'.$_ov1.'.gif" alt="45도"/></li>';
				break;
				case '2':
					$_ov2=(!$_ov0 && !$_ov1)?'_ov':'';
					$bnf_wrap_btn .= '<li><img src="/board/skin/'.$boardSet["skin"].'/images/btn3'.$_ov2.'.gif" alt="측면"/></li>';
				break;
			}
			//$response['sort'][] = $i;
			$bnf_wrap_li .= '<li '.$style.'><img src="'.$Data["savefile"][$i].'" alt="" width="780" height="310"/></li>';
			$style='style="z-index: 1; opacity: 0;"';
			//$style=($i==0)?'':'style="z-index: 1; opacity: 0;"';
		}
	}

	$response['subject'] = stripslashes( $Array["tblStrSubject"] );
	$response['comment'] = stripslashes( $Array["tblStrComment"] );
	$response['bnf_wrap_btn'] = $bnf_wrap_btn;
	$response['bnf_wrap_li'] = $bnf_wrap_li;
	
echo json_encode($response);
?>