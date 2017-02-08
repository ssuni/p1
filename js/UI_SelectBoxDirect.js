/*--------------------------
셀렉트 박스 직접입력/선택
--------------------------*/
var SelectBoxDirect = function(container, textinput) {
	var owner = this;
	this.container = container;
	this.textinput = textinput;
	$(this.textinput).click(function() {
		if (owner.container.val() == "") {
			alert("우측 박스를 선택해 주세요.");
		}
	});
};

SelectBoxDirect.prototype = {
	act : function() {
		this.textinput.attr("readonly", false);
		this.textinput.val("");
		this.textinput.focus();
	},
	change : function() {
		var owner = this;

		if (this.container.val() == "self") {
			this.textinput.attr("readonly", false);
		} else {
			this.textinput.attr("readonly", true);
		}
		
		this.container.bind("change", function() {
			if ($(this).val() == "self") {
				owner.act();
			} else {
				owner.textinput.attr("readonly", true);
				owner.textinput.val($(this).val());
			}
		});		
	}		
}