// JavaScript Document
function number_validate(input) { 
		var value = input.value; 
		var rep = /[-\,\|;":'a-zA-Zа-яА-Я ? u g o s c ?  - _ + = ]/ ; 
		if (rep.test(value)) { 
			value = value.replace(rep, ''); 
			input.value = value; 
		} 
}

$(document).ready(function(e) {
	
	/* date picker */
		$(function() {
			$('#start_date,#end_date').datetimepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});
	
    $("#filter_shop").click(function(e) {

            if($(this).hasClass("active_filter")) {
				$("#filter_head_table").hide();
				$(this).removeClass("active_filter");
				$(this).css("background-image","url(resources/images/down-cat.png)");
			} else {
				$("#filter_head_table").show();
				$(this).addClass("active_filter");
				$(this).css("background-image","url(resources/images/up-cat.png)");
			}

    });
	
	 
	
});