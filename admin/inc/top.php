<?	$pageNum1 = ""; $pageNum2 = ""; $pageNum3 = ""; $pageNum4 = ""; $pageNum5 = ""; $pageNum6 = ""; $pageNum7 = ""; $pageNum8 = ""; $pageNum9 = ""; $pageNum10 = "";

switch($pageNum){
	case('1'): $pageNum1 = "_o"; break;
	case('2'): $pageNum2 = "_o"; break;
	case('3'): $pageNum3 = "_o"; break;
	case('4'): $pageNum4 = "_o"; break;
	case('5'): $pageNum5 = "_o"; break;
	case('6'): $pageNum6 = "_o"; break;
	case('7'): $pageNum7 = "_o"; break;
	case('8'): $pageNum8 = "_o"; break;
	case('9'): $pageNum9 = "_o"; break;
	case('10'): $pageNum10 = "_o"; break;
}
?>
	<div id="topArea">
		<h1><a href="/admin/main.php"><img src="/admin/images/ci.gif" /></a></h1>
			<div class="info"><strong><?=$_SESSION["ss_name"]?></strong> 님 반갑습니다! &nbsp;&nbsp;<a href="./?proc=logout"><img src="/admin/images/btn/top_btn1.gif"></a>&nbsp;<a href="http://<?=$bagData["host"]?>" target="_blank"><img src="/admin/images/btn/top_btn2.gif" /></a></div>
	</div>
		<div id="menuArea">
			<ul>
				<? if ($_SESSION['ss_level'] == 1) { ?>
				<li><a href="/admin/admin_01_01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu1','','/admin/images/common/menu1_o.gif',0)"><img src="/admin/images/common/menu1<?=$pageNum1?>.gif" name="menu1" border="0" id="menu1" /></a></li>
				<? } ?>
				<? if ($auth['200']) { ?>
				<li><a href="<?=$auth['200'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu2','','/admin/images/common/menu2_o.gif',0)"><img src="/admin/images/common/menu2<?=$pageNum2?>.gif" name="menu2" border="0" id="menu2" /></a></li>
				<? } ?>
				<? if ($auth['300']) { ?>
				<li><a href="<?=$auth['300'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu3','','/admin/images/common/menu3_o.gif',0)"><img src="/admin/images/common/menu3<?=$pageNum3?>.gif" name="menu3" border="0" id="menu3" /></a></li>
				<? /*<li><a href="/admin/admin_04_01.php?act=calendar" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu4','','/admin/images/common/menu4_o.gif',0)"><img src="/admin/images/common/menu4<?=$pageNum4?>.gif" name="menu4" border="0" id="menu4" /></a></li>*/ ?>
				<? } ?>
				<? if ($auth['400']) { ?>
				<li><a href="<?=$auth['400'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu4','','/admin/images/common/menu4_o.gif',0)"><img src="/admin/images/common/menu4<?=$pageNum4?>.gif" name="menu4" border="0" id="menu4" /></a></li>
				<? } ?>
				<? if ($auth['500']) { ?>
				<li><a href="<?=$auth['500'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu5','','/admin/images/common/menu5_o.gif',0)"><img src="/admin/images/common/menu5<?=$pageNum5?>.gif" name="menu5" border="0" id="menu5" /></a></li>
				<? } ?>
				<? if ($auth['600']) { ?>
				<li><a href="<?=$auth['600'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu6','','/admin/images/common/menu6_o.gif',0)"><img src="/admin/images/common/menu6<?=$pageNum6?>.gif" name="menu6" border="0" id="menu6" /></a></li>
				<? } ?>
				<? if ($auth['700']) { ?>
				<li><a href="<?=$auth['700'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu7','','/admin/images/common/menu7_o.gif',0)"><img src="/admin/images/common/menu7<?=$pageNum7?>.gif" name="menu7" border="0" id="menu7" /></a></li>
				<? } ?>
				<? if ($auth['900']) { ?>
				<? /*<li><a href="/admin/admin_08_01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu8','','/admin/images/common/menu8_o.gif',0)"><img src="/admin/images/common/menu8<?=$pageNum8?>.gif" name="menu8" border="0" id="menu8" /></a></li>*/ ?>
				<li><a href="<?=$auth['900'];?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('menu9','','/admin/images/common/menu9_o.gif',0)"><img src="/admin/images/common/menu9<?=$pageNum9?>.gif" name="menu9" border="0" id="menu9" /></a></li>
				<? } ?>
			</ul><div class="clr"></div>
	</div>