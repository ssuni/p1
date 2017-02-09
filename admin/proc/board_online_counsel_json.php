<?php
/**
 * Created by PhpStorm.
 * User: hs
 * Date: 2017-02-06
 * Time: 오후 2:14
 */
/* Database connection start */
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
    0 =>'tblNumber',
    1 =>'tblNumber',
    2 =>'tblStrSubject',
    3=> 'tblStrReply',
    4=> 'tblStrName',
    5=> 'tblDtmRegDate',
    6=> 'division'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM tbl_online_counsel";
$query=mysql_query($sql);
$countQuery = mysql_query( "SELECT tblNumber FROM tbl_online_counsel" );
$totalData = mysql_num_rows($countQuery);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT * ";
    $sql.=" FROM tbl_online_counsel";
    $sql.=" WHERE tblStrName LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR tblStrSubject LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tblStrMobile LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tblDtmRegDate LIKE '".$requestData['search']['value']."%' ";
    $query=mysql_query($sql);
    $totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysql_query($sql); // again run query with limit

} else {

    if($requestData['length'] == '-1'){
        $sql = "SELECT * ";
        $sql .= " FROM tbl_online_counsel";
        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'];
        $query = mysql_query($sql);
    }else {
        $sql = "SELECT * ";
        $sql .= " FROM tbl_online_counsel";
        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        $query = mysql_query($sql);
    }

}

$data = array();
$lTmp = 0;
$newDate = date( 'Y-m-d 00:00:00', time() - ( 86400*3 ) ); /* 3일간 표시 */
while( $row = @mysql_fetch_array($query) ) {  // preparing an array
    $nestedData=array();
    $nestedData[] = $row["tblNumber"];
    $nestedData[] = $row["tblNumber"];
//    $nestedData[] = $row["tblStrSubject"];
    $nestedData[] = ( $row["tblDtmRegDate"] >= $newDate ) ? $row["tblStrSubject"]."&nbsp;<img src='/board/skin/counsel/images/icon_new.gif' align='absmiddle' alt='새글'>" :$row["tblStrSubject"];
    $nestedData[] = $row["tblStrReply"] ? "<span class='end'><font color='FF6600'>답변완료</font></span>" : "<span class='ing'><font color='blue'>답변대기</font></span>";
    $nestedData[] = $row["tblStrName"];
    $nestedData[] = $row["tblDtmRegDate"];
    
    //지점구분
    switch( $row["division"] ) {
        case "1" : $row["division"]		= "<font color='purple'>논현</font>"; break;
        case "2" : $row["division"]		= "<font color='#adff2f'>강남</font>"; break;
        case "3" : $row["division"]		= "<font color='#ff69b4'>청담</font>"; break;
        default : $row["division"]			= "<font color='blue'>전체</font>"; break;
    }
    $nestedData[] = $row["division"];

    $data[] = $nestedData;
    $lTmp++;
}



$json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>