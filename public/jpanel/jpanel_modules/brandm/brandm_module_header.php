<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<script>
	$(document).ready(function(e) {
        
		if($("#prod_cat_iu").length > 0) {
			$("#prod_cat_iu").jqxDropDownList({ checkboxes: true,width: '200px', height: '25px', theme: 'arctic' });
			$("#prod_cat_iu").jqxDropDownList('loadFromSelect', 'prod_cat');
		}
		
		$("#add_button").click(function(e) {
			
				
				var items = $("#prod_cat_iu").jqxDropDownList('getCheckedItems');
				var checkedItems = "";
				$.each(items, function (index) { 
					if (index < items.length - 1) {
						checkedItems += ""+this.value + ",";
					}
					else checkedItems += ""+this.value+"";
				});
				
				$("#sel_cat").val(checkedItems);
				 $("#add_form").submit();
				
				
		});
		
		if($("#sel_cat").val() != null) {
			var str_audit = $("#sel_cat").val();
			var arr_audit = str_audit.split(',');
			for(var i=0; i<arr_audit.length; i++){
				console.log(arr_audit[i]);
				$("#prod_cat_iu").jqxDropDownList('checkItem', arr_audit[i]); 
			}
		}
		
		
    });
</script>