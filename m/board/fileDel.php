<?php
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	$tb			= $_GET['tb'];
	$tNum		= $_GET['tNum'];
	$dNum		= $_GET['dNum'];

	$Query = "SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."'";
	$Sql = mysql_query( $Query );
	$Array = mysql_fetch_array( $Sql );
	$Data["savefile"] = explode( '|', $Array["tblStrSaveFile"] );
	$Data["liefile"] = explode( '|', $Array["tblStrLieFile"] );
	$Data["thumfile1"] = explode( '|', $Array["tblStrThum1"] );
	$Data["thumfile2"] = explode( '|', $Array["tblStrThum2"] );
	$Data["thumfile3"] = explode( '|', $Array["tblStrThum3"] );
	$Data["thumfile4"] = explode( '|', $Array["tblStrThum4"] );
	$Data["thumfile5"] = explode( '|', $Array["tblStrThum5"] );

	if( $dNum >= 0 ) {
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["savefile"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["liefile"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["thumfile1"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["thumfile2"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["thumfile3"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["thumfile4"][$dNum] );
		@unlink( $_SERVER['DOCUMENT_ROOT']."/_data/".$tb."/".$Data["thumfile5"][$dNum] );
		$Data["savefile"][$dNum] = "";
		$Data["liefile"][$dNum] = "";
		$Data["thumfile1"][$dNum] = "";
		$Data["thumfile2"][$dNum] = "";
		$Data["thumfile3"][$dNum] = "";
		$Data["thumfile4"][$dNum] = "";
		$Data["thumfile5"][$dNum] = "";
	}

	$dData["savefile"] = implode( '|', $Data["savefile"] );
	$dData["liefile"] = implode( '|', $Data["liefile"] );
	$dData["thumfile1"] = implode( '|', $Data["thumfile1"] );
	$dData["thumfile2"] = implode( '|', $Data["thumfile2"] );
	$dData["thumfile3"] = implode( '|', $Data["thumfile3"] );
	$dData["thumfile4"] = implode( '|', $Data["thumfile4"] );
	$dData["thumfile5"] = implode( '|', $Data["thumfile5"] );

	$uQuery = "UPDATE tbl_".$tb." SET ";
	$uQuery .= "tblStrSaveFile='".$dData["savefile"]."',";
	$uQuery .= "tblStrLieFile='".$dData["liefile"]."',";
	$uQuery .= "tblStrThum1='".$dData["thumfile1"]."',";
	$uQuery .= "tblStrThum2='".$dData["thumfile2"]."',";
	$uQuery .= "tblStrThum3='".$dData["thumfile3"]."',";
	$uQuery .= "tblStrThum4='".$dData["thumfile4"]."',";
	$uQuery .= "tblStrThum5='".$dData["thumfile5"]."' WHERE tblNumber='".$tNum."'";
	if( $uSql = mysql_query( $uQuery ) ) {
		echo "location.reload();";
	}
?>