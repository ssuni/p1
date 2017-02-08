<?php
/**
 * Created by PhpStorm.
 * User: hs
 * Date: 2017-02-07
 * Time: 오후 12:46
 */
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
$_SESS["ss_id"] = ( $_SESSION["ss_id"] ) ? $_SESSION["ss_id"] : "";
$_SESS["ss_name"] = ( $_SESSION["ss_name"] ) ? $_SESSION["ss_name"] : "";
$_SESS["ss_level"] = ( $_SESSION["ss_level"] ) ? $_SESSION["ss_level"] : "10" ;
$_SESS["ss_email"] = ( $_SESSION["ss_email"] ) ? $_SESSION["ss_email"] : "" ;
$_SESS["ss_phone"] = ( $_SESSION["ss_phone"] ) ? $_SESSION["ss_phone"] : "" ;
$_SESS["ss_mobile"] = ( $_SESSION["ss_mobile"] ) ? $_SESSION["ss_mobile"] : "" ;
$Pass["passwd"] = ( trim( $_SESSION["boardSess"] ) ) ? $_SESSION["boardSess"] : "";

$type = $_POST['type'];

if($type == 'list') {

    $boardType = $_POST['boardtype'];
    $idx = $_POST['idx'];

    switch ($boardType) {
        case 'online' :
            $boardType = 'tbl_online_counsel';
            $idxName = 'tblNumber';
            break;
        case 'kakao':
            $boardType = 'tb_counsel';
            $idxName = 'cno';
            break;
    }


    $sql = "SELECT * ";
    $sql .= "FROM " . $boardType;
    $sql .= " where " . $idxName . "=" . $idx;
    $query = mysql_query($sql);

    $rows = array();

    while ($row = mysql_fetch_array($query)) {
        $rows['idx'] = $row["tblNumber"];
        switch ($row["tblIntField"]) {
            case "1" :
                $rows['fid'] = "<font color='purple'>보톡스</font>";
                break;
            case "2" :
                $rows['fid'] = "<font color='#adff2f'>필러</font>";
                break;
            case "3" :
                $rows['fid'] = "<font color='#ff69b4'>윤곽</font>";
                break;
            case "4" :
                $rows['fid'] = "<font color='#ff69b4'>리프팅</font>";
                break;
            case "5" :
                $rows['fid'] = "<font color='#ff69b4'>제모</font>";
                break;
            case "6" :
                $rows['fid'] = "<font color='#ff69b4'>바디</font>";
                break;
            case "7" :
                $rows['fid'] = "<font color='#ff69b4'>스킨케어</font>";
                break;
            case "8" :
                $rows['fid'] = "<font color='#ff69b4'>남성</font>";
                break;
            default :
                $rows['fid'] = "<font color='blue'>기타</font>";
                break;
        }
        $rows['name'] = $row["tblStrName"];
        $rows['subject'] = $row["tblStrSubject"];
        $rows['comment'] = $row["tblStrComment"];
        $rows['reply'] = $row["tblStrReply"];
        $rows['mobile'] = $row["tblStrMobile"];
        $rows['date'] = $row["tblDtmRegDate"];
        $rows['count'] = "<font color='red'>".$row["tblIntRef"]."</font>";

    }
    echo json_encode($rows);
}

if($type == 'reply') {

    $idx = $_POST['idx'];
    $content = $_POST['reply'];

    $sql = "UPDATE tbl_online_counsel SET ";
    $sql .= "tblStrReply='".$content."',";
    $sql .= "tblStrReID='".$_SESS["ss_id"]."',";
    $sql .= "tblStrReName='".$_SESS["ss_name"]."' WHERE tblNumber='".$idx."'";
    $query = mysql_query( $sql ) or die( mysql_error() );

    echo json_encode($idx);
}



