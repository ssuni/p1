<?php
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
include $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php";

	foreach($m_counselField2[$_POST['tblIntField1']] as $k=> $v) {
		$response['field'][] = $k;
		$response['field_name'][] = $v;
	}

toJson($response);
?>