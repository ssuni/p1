<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/lib/pclzip.lib.php";

	$Query = "SELECT * FROM tbl_contact_model WHERE uid='".$uid."'";
	$Sql = mysql_query( $Query );
	$R = mysql_fetch_array( $Sql );

$saveDir = '../../_data/contact_model/';
$f_name = "image".time();
$zipfile = new PclZip($saveDir.$f_name.'.zip'); 

//echo "<pre>\n"; 
//print_r($zipfile); 
//echo "</pre>";

$data = array();
$data_arr = 0;
for ($file_count = 1; $file_count <= 10; $file_count++)
{
	
	$file = $R["wr_file".$file_count];

	if($file){
		$filepath = $file;
		$arr = explode("/" , $filepath); 
		$name = $arr[4];

		$filename = trim($name);            //파일이름    
		$file = "../..".$arr[0] ."/". $arr[1]."/". $arr[2]."/". $arr[3]."/".$name;        //상대경로    

		$filepath = $file;
		$filepath = addslashes($filepath);
		if (is_file($filepath) || file_exists($filepath)){
		    if (preg_match("/^utf/i", "utf-8"))
			    $original = urlencode($name);
			else
			    $original = $name;

			$data[$data_arr] = $filepath;
			$data_arr++;
			//echo "<img src='".$filepath."' width=100 /><br>";
		}
	}//$file

}

// echo "<pre>\n"; 
// print_r($data); 
// echo "</pre>";

$add_zip = $zipfile->add($data); 

// echo "<pre>\n"; 
// print_r($add_zip); 
// echo "</pre>";

$zip_dlc = $saveDir.$f_name.'.zip';

header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$f_name.".zip\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($zip_dlc));
ob_end_flush();
@readfile($zip_dlc);
?>