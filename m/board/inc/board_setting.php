<?php
	include ( $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php" );
	//존재하는 테이블인가?
	$table_ok = '';

	$sql = "SHOW TABLES FROM $db_name";
	$isTable = mysql_query($sql);

	if (!$isTable) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	while( $extable = mysql_fetch_row( $isTable ) )
	{
		if ( $extable[0] == "tbl_".$tb ) {
			$table_ok = 'ok';
		}
	}
	
	if($table_ok != 'ok') {
		echo "<script language='javascript'>";
		echo "	alert('존재하지 않는 게시판입니다.');";
		echo "	history.go(-1);";
		echo "</script>";
	}

	$boardQue = "SELECT * FROM tblBoardManager WHERE tblBtable='$tb'";
	$boardSql = mysql_query( $boardQue );
	$boardArr = mysql_fetch_array( $boardSql );
	$boardSet["number"]					= $boardArr["tblNumber"];
	$boardSet["bname"]					= $boardArr["tblBname"];
	$boardSet["btable"]					= $boardArr["tblBtable"];
	$boardSet["skin"]						= $boardArr["tblSkin"];
	$boardSet["category"]				= $boardArr["tblCategory"];
	$boardSet["listlevel"]			= $boardArr["tblListLevel"];
	$boardSet["viewlevel"]			= $boardArr["tblViewLevel"];
	$boardSet["writelevel"]			= $boardArr["tblWriteLevel"];
	$boardSet["modifylevel"]		= $boardArr["tblModifyLevel"];
	$boardSet["replylevel"]			= $boardArr["tblReplyLevel"];
	$boardSet["deletelevel"]		= $boardArr["tblDeleteLevel"];
	$boardSet["head"]						= $boardArr["tblHead"];
	$boardSet["foot"]						= $boardArr["tblFoot"];
	$boardSet["sub"]						= $boardArr["tblSub"];
	$boardSet["secret"]					= $boardArr["tblSecret"];
	$boardSet["homepage"]				= $boardArr["tblHomePage"];
	$boardSet["linenumber"]			= $boardArr["tblLineNumber"];
	$boardSet["pagenumber"]			= $boardArr["tblPageNumber"];
	$boardSet["viewimage"]			= $boardArr["tblViewImage"];
	$boardSet["addfilenumber"]	= $boardArr["tblAddfileNumber"];
	$boardSet["uploadsize"]			= $boardArr["tblUploadSize"];
	$boardSet["noext"]					= ( $boardArr["tblNoExt"] ) ? $boardArr["tblNoExt"] : "html,htm,php,php3,inc,cgi,asp,jsp";
	$boardSet["notice"]					= $boardArr["tblNotice"];
	$boardSet["commentlevel"]		= $boardArr["tblCommentLevel"];
	$boardSet["viewtype"]				= $boardArr["tblViewType"];
	$boardSet["profileview"]		= $boardArr["tblProfileView"];
	$boardSet["print"]					= $boardArr["tblPrint"];
	$boardSet["control"]				= $boardArr["tblControl"];
	$boardSet["filter"]					= $boardArr["tblFilter"];
	$boardSet["group"]					= $boardArr["tblGroup"];
	$boardSet["width"]					= $boardArr["tblWidth"];
	$boardSet["streaming"]			= $boardArr["tblStreaming"];
	$boardSet["watermark"]			= $boardArr["tblWatermark"];

	$basicBoardSess = "rdfa#645qaahgdfshr"; // 기본 세션값.
	$boardSet["width"] = ( $boardSet["width"] <= 100 ) ? $boardSet["width"].'%' : $boardSet["width"]; // 테이블크기	
?>