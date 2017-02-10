<?php
/**
 * Created by PhpStorm.
 * User: hs
 * Date: 2017-02-09
 * Time: 오전 11:30
 */
include $_SERVER['DOCUMENT_ROOT']."/include/fileupload.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";

$table = $_REQUEST['tb'];
    switch($table){
        case 'notice': $table='tbl_notice'; break;
        case 'event': $table = 'tbl_event'; break;
        case 'news': $table ='tbl_news'; break;
        case 'bna': $table ='tbl_bna'; break;
//        default $table = ''
    }

$title = $_REQUEST['title'];
if($table == 'tbl_notice'){
    $name = ($_REQUEST['name']) ? $_REQUEST['name'] : '관리자';
}else{
    $name =  $_REQUEST['name'];
}

$phone1 = $_REQUEST['phone1'];
$phone2 = $_REQUEST['phone2'];
$phone3 = $_REQUEST['phone3'];
$phone = $phone1.$phone2.$phone3;

$date = ($_REQUEST['date']) ? $_REQUEST['date'] : date('Y-m-d H:i:s', time());
$count = ($_REQUEST['count']) ? $_REQUEST['count'] : 0;
$ip	= $HTTP_SERVER_VARS["REMOTE_ADDR"];
$content = $_REQUEST['strComment'];
$division = $_REQUEST['division'];

$sql = "INSERT into ".$table." set";
$sql .= " tblIntFid= 1,";
$sql .= " tblStrThread= 'A',";
$sql .= " tblStrId='".$_SESS["ss_id"]."',";
$sql .= " tblStrSubject='".$title."',";
$sql .= " tblStrMobile='".$phone."',";
$sql .= " tblStrEmail='".$email."',";
$sql .= " tblStrName='".$name."',";
$sql .= " tblStrComment='".$content."',";
$sql .= " tblDtmRegDate='".$date."',";
$sql .= " division='".$division."'";

mysql_query($sql);

if ($_SESSION['ss_level'] <= 2) {			// 부관리자 이상만 로그
    $pk = mysql_insert_id();
    // 관리자 로그분석
    $logData = array(
        "table" => "tbl_".$tb,
        "pk" => $pk,
        "content" => $Data["subject"],
        "act" => "insert"
    );
    setAnalysis($logData);
}



echo json_encode($name);