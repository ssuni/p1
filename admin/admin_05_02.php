<? include "inc/head.php" ?>
<?
$sub_menu = '500200';
auth_check($auth[$sub_menu]);

$pageNum = 5;
$subNum = 2;
?>
<style>
    /**************************
  DEFAULT BOOTSTRAP STYLES
**************************/

    .btn {
        display: inline-block;
        /*padding: 6px 12px;*/
        margin-bottom: 0;
        font-size: 12px;
        font-weight: normal;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        /*padding: 1px 16px;*/
    }

    .btn-lg {
        font-size: 10px;
        line-height: 1.33;
        border-radius: 6px;
    }

    .btn-primary {
        color: #fff;
        background-color: #428bca;
        border-color: #357ebd;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open .dropdown-toggle.btn-primary {
        color: #fff;
        background-color: #3276b1;
        border-color: #285e8e;
    }

    /***********************
      SHARP BUTTONS
    ************************/
    .sharp {
        border-radius:0;
    }

    /***********************
      CUSTON BTN VALUES
    ************************/

    .btn {
        padding: 10px 24px;
        border: 0 none;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .btn:focus, .btn:active:focus, .btn.active:focus {
        outline: 0 none;
    }

    .btn-primary {
        background: #0099cc;
        color: #ffffff;
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
        background: #33a6cc;
    }
    .btn-primary:active, .btn-primary.active {
        background: #007299;
        box-shadow: none;
    }
    .ta6 {
        border: 3px double #CCCCCC;
        width: 230px;
        height: 60px;
    }


</style>

<script>
    $(document).ready(function() {
        var inst = $('[data-remodal-id=modal]').remodal();

        $( window ).bind('beforeunload', function()
        {

            inst.destroy();
        });
        var table = $('#example').DataTable({
            fixedHeader: {
                header: false,
                footer: true
            },
            "autoWidth": false,

            processing: true,
            serverSide: true,
            ajax:{
                url :"/admin/proc/online_counsel_json.php", // json datasource
                type: "post"  // method  , by default get
//			error: function(){  // error handling
//				$(".employee-grid-error").html("");
//				$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//				$("#employee-grid_processing").css("display","none");
//
//			}
            },



//		scrollY:     300,
//		scroller:    true,
//		iDisplayLength: 15,
            language: {
                "search": "검색",
                "lengthMenu": "정렬수 _MENU_ ",
                "zeroRecords": "검색 결과가 없습니다.",
                "info": "현재페이지: _START_ ~ _END_  전체결과:_TOTAL_ 개",
                "infoEmpty":      "검색결과: 0 개",
                "infoFiltered": " 총 데이터 _MAX_ 개"
            },
            pagingType: "full_numbers",
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],

            columnDefs: [{
                'targets': 0,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            order: [[ 5, 'desc' ]]


        });

//	table
//			.order( [ 4, 'desc' ] )
//			.draw();

//	$('#example tbody').on('click', 'tr', function () {
//		var data = table.row( this ).data();
//		alert( 'You clicked on '+data[0]+'\'s row' );
//	} );


        $('#example tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
//			console.log($(this).data('value'))
//			console.log($(this)[0])
                var obj =$(this).find('input');
                console.log(obj.is(':checked'))
//			obj.prop('checked', !obj.is(':checked'));
                if(obj.is(':checked') == false) {
//				$(location).attr('href','<?=$PHP_SELF?>?act=modify&tNum='+$(this).data('value'))
                }
            }
        } );


        $('#example tbody').on('dblclick', 'tr', function (event) {

            var data = table.row( this ).data();
            var obj =$(this).find('input');

            if(event.target.type !== 'checkbox') {
                $("#popuptbody").empty()
                $(".ta6").val("")

//		alert( 'You clicked on '+data[0]+'\'s row' );
                inst.open();
                var html = ""
                var boardtype = "online"
                var idx = data[0]
                $.post("/admin/proc/boardAjax.php", {
                    'type': 'list',
                    'boardtype': boardtype,
                    'idx': idx
                }, function (response) {
                    var result = JSON.parse(response)
                    console.log(result)
                    html += "<tr>"
                    html += "<th scope='row'>분류</th>"
                    html += "<td>" + result['fid'] + "</td>"
                    html += "<input type='hidden' id='hiddenIdx' value='" + result['idx'] + "'/>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>실명</th>"
                    html += "<td>" + result['name'] + "</td>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>연락처</th>"
                    html += "<td>" + result['mobile'] + "</td>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>작성일</th>"
                    html += "<td>" + result['date'] + "</td>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>조회수</th>"
                    html += "<td>" + result['count'] + "</td>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>글제목</th>"
                    html += "<td>" + result['subject'] + "</td>"
                    html += "</tr>"
                    html += "<tr>"
                    html += "<th scope='row'>상담내용</th>"
                    html += "<td>" + result['comment'] + "</td>"
                    html += "</tr>"
                    if (result['reply']) {
                        $(".ta6").val(result['reply'].replace(/(<([^>]+)>)/gi, "").replace(/&nbsp;/gi, ''))
                    }
                    $("#popuptbody").append(html)
                });
            }
            $(".ta6").focus()

        } );

        // Handle click on "Select all" control
        $('#example-select-all').on('click', function(){
            // Check/uncheck all checkboxes in the table
            var rows = table.rows({ page: 'current'}).nodes();
            console.log(rows.length)
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        $('#example tbody').on('change', 'input[type="checkbox"]', function(){
            // If checkbox is not checked
            if(!this.checked){
                var el = $('#example-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if(el && el.checked && ('indeterminate' in el)){
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });
        $('#button').click( function () {
            table.$('input[type="checkbox"]').each(function(){
                // If checkbox doesn't exist in DOM

                // If checkbox is checked
                if(this.checked){
                    // Create a hidden element
                    console.log(this.value)

                }

            });

//		var data = table
//				.rows()
//				.data();
//		console.log(data)
//
//		alert( 'The table has '+data.length+' records' );
//		table.row('.selected').remove().draw( false );
        } );
        $('#example').on( 'page.dt',   function () {
            if($('#example-select-all').is(":checked") == true){
                $('#example-select-all').prop('checked',false)
            }
//			alert('paging click')
        }).DataTable();

        //온라인상담 답변
        $(".remodal-confirm").on('click',function(){
            var idx = $("#hiddenIdx").val();
            var content = $(".ta6").val();
            if(content == "") {
                alert('답변내용이 없습니다.')
            }else {
                $.post('/admin/proc/boardAjax.php', {'type': 'reply', 'idx': idx, 'reply': content}, function (response) {
                    var result = JSON.parse(response)
                    console.log(result)
                })//답변내용ajax
            }
        })
        $('textarea').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                var s = $(this).val();
                $(this).val(s+"\n");
            }
        });
    } );

</script>
<style>
    table.type09 {
        border-collapse: collapse;
        text-align: left;
        line-height: 1.5;

    }
    table.type09 thead th {
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
        color: #369;
        border-bottom: 3px solid #036;
    }
    table.type09 tbody th {
        width: 150px;
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
        background: #f3f6f7;
    }
    table.type09 td {
        width: 400px;
        padding: 10px;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
    }
</style>

<body class="commonBg">
<div id="bodyWrap">
	<? include "inc/top.php" ?>
	<div id="contentsWrap">
		<div class="leftArea">
			<? include "inc/left.php" ?>
		</div>
		<div class="rightArea">
			<div id="locationBar">
				<h2><?=$sub_tit2_2?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_2?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
                <!--팝업폼-->
                <div class="remodal" data-remodal-id="modal"
                     data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
                    <button data-remodal-action="close" class="remodal-close"></button>
                    <h1><span id="subject"></span></h1>
                    <table class="type09">
                        <thead>
                        <tr>
                            <th scope="cols"></th>
                            <th scope="cols"></th>
                        </tr>
                        </thead>
                        <tbody id="popuptbody">

                        </tbody>
                    </table>
                    <table class="type09">
                        <thead>
                        <tr>
                            <th scope="cols"></th>
                            <th scope="cols"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope='row'>답변자</th>
                            <td>관리자</td>
                        </tr>
                        <tr>
                            <th scope='row'>답변내용</th>
                            <td><textarea class="ta6" style="height:180px;width:380px;"></textarea></td>
                        </tr>
                        <!--<tr>-->
                        <!--<th scope='row'>발송</th>-->
                        <!--<td><input type="checkbox"/> 답변시 메일발송 <input type="checkbox"/> 답변시 문자발송</td>-->
                        <!--</tr>-->
                        </tbody>
                    </table>

                    <br>
                    <button data-remodal-action="cancel" class="remodal-cancel">닫기</button>
                    <button data-remodal-action="confirm" class="remodal-confirm">저장</button>
                </div>
                <!--팝업폼-->

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                        <th>번호</th>
                        <th>글제목</th>
                        <th>처리현황</th>
                        <th>글쓴이</th>
                        <th>작성일</th>
                        <th>지점</th>

                    </tr>
                    </thead>

                </table>
                <button type="button" class="btn btn-primary sharp" id="button">삭제</button>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>