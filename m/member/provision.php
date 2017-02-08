<? include_once "../include/head.php"; ?>
<? 
//$pageNum = 1;
$tabNum = 1;
?>

<link href="../member/css/style.css" rel="stylesheet" type="text/css">
<div class="subWrap">
	<div class="contentsArea">
		<div class="conWrap">
			<!---------------------  // Start :: 본문  --------------------->
			<div class="m_contents">
				<div class="m_header">
					<h2>회원약관</h2>
				</div>
				<div class="m_con_box"> 
					<?=$bagData["clauses"];?>
				</div>
			</div>
			<!---------------------  // End :: 본문  --------------------->
		</div>
	</div>
</div>
<div class="clear_30"></div>
<?php include_once "../include/footer.php"; ?>