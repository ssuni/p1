function selViewClick(num) {
	var dlink = new Array();

	dlink[0] = "/09_community/community02.php?tb=self_story&act=view&tNum=47&sField=&p=1";
	dlink[1] = "/09_community/community02.php?tb=self_story&act=view&tNum=41&sField=&p=1";
	dlink[2] = "/09_community/community02.php?tb=self_story&act=view&tNum=39&sField=&p=1";
	dlink[3] = "/09_community/community02.php?tb=self_story&act=view&tNum=33&sField=&p=1";
	dlink[4] = "/09_community/community02.php?tb=self_story&act=view&tNum=46&sField=&p=1";
	dlink[5] = "/09_community/community02.php?tb=self_story&act=view&tNum=43&sField=&p=1";
	dlink[6] = "/09_community/community02.php?tb=self_story&act=view&tNum=36&sField=&p=1";
	dlink[7] = "/09_community/community02.php?tb=self_story&act=view&tNum=30&sField=&p=2";
	dlink[8] = "/09_community/community02.php?tb=self_story&act=view&tNum=45&sField=&p=1";
	dlink[9] = "/09_community/community02.php?tb=self_story&act=view&tNum=42&sField=&p=1";
	dlink[10] = "/09_community/community02.php?tb=self_story&act=view&tNum=13&sField=&p=2";

	if ($('#logstate').attr('class') == 'logout') {
		dlink[num-1] = "javascript:mem_login('"+ dlink[num-1] +"')";
	}

	$('.viewimg .img a').attr('href', dlink[num-1]);
	$('.viewimg .img img').attr('src', "../images/main/sel_view"+num+".png");
	$('.close').click(function() {
		$('.viewimg .img img').attr('src', "");
		$('.viewimg').hide();
	});
	$('.viewimg').show();
}