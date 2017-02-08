<?session_start();
if (substr($_SERVER['HTTP_HOST'],0,4) != 'www.') {
//	header('Location: http://www.ppeum1.com'.$_SERVER['REQUEST_URI']);
//	header('Location:'.$_SERVER['REQUEST_URI']);
//	header('Location: http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
	if($HTTP_COOKIE_VARS[SESSION_CHECK] == "") {
	  setcookie("SESSION_CHECK" , "Y" , 0 , "/");
	  $PHPSESSID = session_id();
	  setcookie("PHPSESSID" , $PHPSESSID , 0 , "/");
	}
	/*
	$_SESSION["ss_id"]			= ($_SESSION["ss_id"])?$HTTP_SESSION_VARS[ss_id]:'';
	$_SESSION["ss_name"]		= $HTTP_SESSION_VARS[ss_name];
	$_SESSION["ss_nickname"]	= $HTTP_SESSION_VARS[ss_nickname];
	$_SESSION["ss_email"]		= $HTTP_SESSION_VARS[ss_email];
	$_SESSION["ss_level"]		= $HTTP_SESSION_VARS[ss_level];
	$_SESSION["ss_phone"]		= $HTTP_SESSION_VARS[ss_phone];
	$_SESSION["ss_mobile"]		= $HTTP_SESSION_VARS[ss_mobile];
	$_SESSION["ss_section"]		= $HTTP_SESSION_VARS[ss_section];
	$_SESSION["pc"]		= $HTTP_SESSION_VARS[pc];
	*/
	if($_SESSION["ss_level"]=='') $_SESSION["ss_level"]=10;
	
	$_SESS["ss_id"] = ( $_SESSION["ss_id"] ) ? $_SESSION["ss_id"] : "";
	$_SESS["ss_name"] = ( $_SESSION["ss_name"] ) ? $_SESSION["ss_name"] : "";
	$_SESS["ss_nickname"] = ( $_SESSION["ss_nickname"] ) ? $_SESSION["ss_nickname"] : "";
	$_SESS["ss_email"] = ( $_SESSION["ss_email"] ) ? $_SESSION["ss_email"] : "" ;
	$_SESS["ss_level"] = ( $_SESSION["ss_level"] ) ? $_SESSION["ss_level"] : 10 ;
	$_SESS["ss_phone"] = ( $_SESSION["ss_phone"] ) ? $_SESSION["ss_phone"] : "" ;
	$_SESS["ss_mobile"] = ( $_SESSION["ss_mobile"] ) ? $_SESSION["ss_mobile"] : "" ;
	$_SESS["ss_section"] = ( $_SESSION["ss_section"] ) ? $_SESSION["ss_section"] : "" ;
	$_SESS["pc"] = ( $_SESSION["pc"] ) ? $_SESSION["pc"] : "" ;

session_cache_limiter('no-cache, must-revalidate');
//session_cache_limiter('private');
ini_set("session.cookie_lifetime",0);//5시간
ini_set("session.cache_expire",18000);
ini_set("session.gc_maxlifetime",18000);
header("Content-Type: text/html; charset=UTF-8");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0 ?>
