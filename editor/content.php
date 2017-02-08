<? include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
session_cache_limiter('no-cache, must-revalidate');
include $_SERVER['DOCUMENT_ROOT']."/include/conn_save.php";

$wid=$_GET["wid"];
$high=$_GET["high"];
$tb=$_GET["tb"];
$tNum=$_GET["tNum"];
$colum_name=$_GET["colum_name"];
$field=$_GET["field"];
$textfname=$_GET["textfname"];
$content="";
$table="tbl_";
if($tb=="Reserve") $table="tbl";

if($tb!="" && $tNum!="" && $field!=""){
 $strsql="select ".$field." from ".$table.$tb." where tblNumber='".$tNum."'";
 $stmt=mysql_query($strsql,$connect);
 $rows=mysql_num_rows($stmt);
  if($rows!=0){
   $rs=mysql_fetch_array($stmt);
   $content=stripslashes($rs[$field]);
   unset($rs);
  }
 unset($rows);
 mysql_free_result($stmt);
 unset($stmt);
} ?>
<script language="javascript">
		var Editor_Root_Dir="/editor/";
		var appName		= navigator.appName;											//**	브라우저명
		var appVersion	= parseFloat(navigator.appVersion.split("MSIE")[1]);			//**	브라우저 버전
		var bitUseEditor																//**	에디터 사용 유무	
			if(appName != "Microsoft Internet Explorer" || appVersion < 5.5){
				bitUseEditor	= false;												//**	익스플로어가 아니고 버전이 5.5보다 작을때는 "사용 안함"
			}else{
				bitUseEditor	= true;													//**	에디터 사용함
			}			
		if(bitUseEditor){
			document.write('<scrip'+'t language="javascript" src="'+Editor_Root_Dir+'KNEditor.js"></scrip'+'t>');
		} //onblur="parent.ElementVar('<?=$textfname?>',this.value);"
</script>
<form name="form1" method="post">
 <textarea id="content" name="content" style="width:<?=$wid?>px; height:<?=$high?>px;"><?=$content?></textarea>
</form>
<script language="javascript">
   if(document.getElementById("content")){
	if(bitUseEditor){
		Editor_New_Generate('content');
	}
   }
</script>