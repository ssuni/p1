<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";		
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

$path="/_data/edit_img/"; //첨부파일 경로
$doc_root = $_SERVER[DOCUMENT_ROOT];	
$uploaddir = $doc_root.$path;
  if(!file_exists($uploaddir)){
   if(!@mkdir($uploaddir,0777)){
    echo"퍼미션 에러!! 폴더생성 실패";
	exit;
   }
  }

function CheckFil($_FILES,$file_name,$susu,$uploaddir){
 if($_FILES != null){
   $uploadfile = $_FILES[ $file_name ]['name'][$susu];
   $uploadfile=eregi_replace(" ","_",$uploadfile);   //공백은 '_'로 바꾼다
	while(true){    ///CheckFileName() 를 이용하여 그 디렉토리에 파일이 있는지 없는지 검색합니다.
     if( CheckFileNam( $uploadfile , $uploaddir) ){     //같은이름이 발견되서 파일네임 변경
      $uploadfile = strtotime("now")."_".$uploadfile;
     }else{      //파일저장
      move_uploaded_file($_FILES[ $file_name ]['tmp_name'][$susu], $uploaddir.$uploadfile);
      break;
     }
    }
 }else{
  return null;
 }
 return $uploadfile;
}

function CheckFileNam( $uploadfile , $uploaddir ){  //중복된 파일네임체크
 if(is_file($uploaddir. $uploadfile) ){ 
  return true; 
 }else{
  return false;
 }
} 

function hisbox($vv,$oo){
  $echo = "<script>"."\r\n";
 if($vv!="") $echo .= "alert('".$vv."');"."\r\n";
 if($oo!="") $echo .= $oo."\r\n"; 
  $echo .= "</script>";
  echo $echo;
}

//********************************************************************* 파일업로드 시작
$totalsize=0;
$total_fname="";

for($i=0;$i<count($attachFile);$i++){	//첨부파일 여러개일때

$uname=$_FILES['attachFile']['size'][$i];
$uname=(double)$uname;
$totalsize+=$uname;
 if($totalsize > 10485760){
  hisbox("첨부파일은 10M까지 업로드 하실 수 있습니다.","history.back(-2);");
  exit;
 }

$fname="";
 $uploadfile = $uploaddir.$_FILES['attachFile']['name'][$i];
 $fname = $_FILES['attachFile']['name'][$i];    //파일명
 $filename = explode(".", $fname);
  $extension = $filename[sizeof($filename)-1];    
   if(!strcmp($extension,"html") || !strcmp($extension,"htm") || !strcmp($extension,"php") || !strcmp($extension,"inc") || !strcmp($extension,"php3") || !strcmp($extension,"cgi") || !strcmp($extension,"jsp")){
	 hisbox("업로드가 금지된 파일입니다.","history.back(-2);");
     exit;
   }
 $lastFileName = CheckFil($_FILES,"attachFile",$i,$uploaddir); 
 $fname=$lastFileName;
 if(($_FILES['attachFile']['size'][$i]==0 || $_FILES['attachFile']['size'][$i] > 10485760) && $fname!=""){
   $fname="";
   hisbox("첨부파일은 10M까지 업로드 하실 수 있습니다.","history.back(-2);");
   exit;
 }
//********************************************************************* 파일업로드 끝
$fname=urlencode($fname);
$imgfile="<img src='".$path.$fname."'";
 if($Alt!='') $imgfile.=" alt='".$Alt."'";
 if($Align!= '') $imgfile.=" align='".$Align."'";
 if($Border!='') $imgfile.=" border='".$Border."'";
 if($Hspace!='') $imgfile.=" hspace='".$Hspace."'";
 if($Vspace!='') $imgfile.=" vspace='".$Vspace."'";
 if($Sizeappoint=='1'){
  if($Width!='') $imgfile.=" width='".$Width."'";
  if($Height!='') $imgfile.=" height='".$Height."'";
 }
$imgfile.=">";

if($Link!='' && strtolower($Link)!='http://'){
 $ImageLink="<a href='".$Link."'";	
  if($Target!='') $ImageLink.=" target='".$Target."'>"; else $ImageLink.=" target='_blank'>";
  $imgfile==$ImageLink.$ImageHTML.'</a>';
} 
$total_fname=$total_fname.$imgfile."<br>";

}	//첨부파일 여러개일때	?>

<script language="javascript">
//**	에디터 창에 HTML 소스 삽입
// var opener = window.dialogArguments; 
// var ObjName= location.search.substring(1,location.search.length);
 var ImageHTML="";
 ImageHTML="<?=$total_fname//$imgfile?>";
 opener.Editor_InsertHTML('content', ImageHTML);
 <?//=$total_fname?>
 self.window.close();
</script>