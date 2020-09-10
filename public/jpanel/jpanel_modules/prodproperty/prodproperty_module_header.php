<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />
<style>

	#proeprty_table {
		border-collapse:collapse;
		border-color:#CCC;
		border:1px solid #CCC;
		width:800px;
	}

	#property_table_header {

	}

	#property_table_title td {

		height: 25px;
		padding-left: 12px;
		filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FFD2DBE4', endColorstr='#FFBDC8D6');
		background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #d2dbe4), color-stop(100%, #bdc8d6));
		background-image: -webkit-linear-gradient(#d2dbe4, #bdc8d6);
		background-image: -moz-linear-gradient(#d2dbe4, #bdc8d6);
		background-image: -o-linear-gradient(#d2dbe4, #bdc8d6);
		background-image: -ms-linear-gradient(#d2dbe4, #bdc8d6);
		background-image: linear-gradient(#d2dbe4, #bdc8d6);
		font-family: Arial, Helvetica, sans-serif;
		font-size: 13px;
		font-weight: bold;
	}

</style>

<script src="jpanel/jpanel_lib/jqwidgets/jqxtree.js" language="javascript" ></script>

<script>

	$(window).ready(function(e) {

		if ($("#jqxTree").length > 0){

				$("#jqxTree").jqxTree({   checkboxes: true,hasThreeStates: true, width: '330px'});
				$('#jqxTree').css('visibility', 'visible');

				$("#save_button").click(function(e) {
					var items = $('#jqxTree').jqxTree('getCheckedItems');
					var res_str = "";
					if(items.length>0) {
						for(var i = 0; i < items.length; i++) {
							 var item = items[i];
							 if(i==0) { res_str += item.value; } else { res_str += ","+item.value; } 
						}

						console.log(res_str);
						$("#prop_type_stor").val(res_str);
						if($("#item_name").val() != "") { $("#main_form").submit(); }

					} else {
						alert("Xanalari doldurun");	
					}

				});

				

				$("#add_property").click(function(e) {

					var items = $('#jqxTree').jqxTree('getCheckedItems');
					var res_str = "";
					if(items.length>0) {
						for(var i = 0; i < items.length; i++) {
							 var item = items[i];
							 if(item.level==2) {
								 if(res_str.length==0) { res_str += item.value; } else { res_str += ","+item.value; }
							 }
						}

						console.log(res_str);
						$("#prop_type_stor").val(res_str);
						if($("#cat_stor").val() != "") { $("#main_form").submit(); }
					} else {
						alert("Xanalari doldurun");	
					}
                });

		}

		
		$("#cat_type").change(function(e) {

				var request_type = "load_sub_cat_type";
				var data = "action="+request_type+"&parent_id="+$(this).val();

				$.ajax({
						type: "POST",
						url: "jpanel/jpanel_modules/prodproperty/prodproperty_module_back.php",
						timeout: 5000,
						data: data, 
						success: function(data){    
							if(data != "") {
								$("#cat_type_sub").html(data);
							}
						},
						error: function(data){ 
							alert(data);
						}

				});

			

        });


    });

</script>