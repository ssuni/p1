<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
header("Content-Type: text/html; charset=UTF-8");

function toJson($response) {
	header("Content-Type: application/json");
	header("Cache-Control:no-cashe");
	header("Pragma:no-cashe");
	echo json_encode($response);
	exit;
}

if ($_POST['mode'] == 'insert') {

	$iQue = "insert into holiday set date='{$_POST['date']}'";
	$result = mysql_query($iQue) or die(mysql_error());

} else if ($_POST['mode'] == 'delete') {

	$iQue = "delete from holiday where date='{$_POST['date']}'";
	$result = mysql_query($iQue) or die(mysql_error());

}

if ($result) {
	$response['state'] = true;
} else {
	$response['state'] = false;
}

toJson($response);
?>