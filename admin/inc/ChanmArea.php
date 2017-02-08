<?
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
//include $_SERVER['DOCUMENT_ROOT']."/inc/function.php";

$trigger = $_GET['trigger'];
$target = $_GET['target'];
$form = $_GET['form'];



$coM_querY = mysql_query("SELECT * FROM tblBoardManager WHERE tblBtable='".$trigger."'");
//$coM_querY_Num = mysql_num_rows($coM_querY);
$coM_Fetch_row = mysql_fetch_array($coM_querY);	

$List["category"] = str_replace( "\r", '', $coM_Fetch_row["tblCategory"] );

	if($List["category"])
	{
		$List["categoryarr"] = split( "\n", $List["category"] );	

		$coM_querY_Num = count( $List["categoryarr"] )+1;
		header("Content-Type: application/x-javascript");

		echo "document.forms['$form'].elements['$target'].length = $coM_querY_Num; \n";
		echo "document.forms['$form'].elements['$target'].options[0].text = '선택'; \n";
		echo "document.forms['$form'].elements['$target'].options[0].value = ''; \n";
		echo "document.forms['$form'].elements['$target'].options[0].selected = true; \n";

		for ($i=1; $i < $coM_querY_Num; $i++) {
			$ii = $i-1;
			$dd = $List[categoryarr][$ii];
			echo "document.forms['$form'].elements['$target'].options[$i].text = '$dd'; \n";
			echo "document.forms['$form'].elements['$target'].options[$i].value = '$ii'; \n";
		}
	} else {
		header("Content-Type: application/x-javascript");
		echo "document.forms['$form'].elements['$target'].length = 1; \n";
		echo "document.forms['$form'].elements['$target'].options[0].text = '선택'; \n";
		echo "document.forms['$form'].elements['$target'].options[0].value = ''; \n";
	}
?>