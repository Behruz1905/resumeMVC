// JavaScript Document

// JavaScript Document

function loadSubCategory(categoryId){

	var request_type = "load_subcategory";

	var data = "action="+request_type+"&categoryId="+categoryId;

	

	$.ajax({

			type: "POST",
			url: "admin_backend.php?module=prodcat",
			timeout: 5000,
			data: data, 
			success: function(data){   
				if(data != "") {
					//console.log(data);
					$("#prod_sub_cat").html(data);	
				}
			},
			error: function(data){ 
				alert(data);
			}
	});
}


function loadCategoryBrands(categoryIds){
	var request_type = "load_category_brands";
	var data = "action="+request_type+"&categoryIds="+categoryIds;
	console.log(data);
	$.ajax({
			type: "POST",
			url: "admin_backend.php?module=prodcat",
			timeout: 5000,
			data: data, 
			success: function(data){ 
				if(data != "") {
					$("#brands").html(data);	
				}
			},
			error: function(data){ 
				alert(data);
			}

	});

	

}





function isRightClick(event) {
	var rightclick;
	if (!event) var event = window.event;
	if (event.which) rightclick = (event.which == 3);
	else if (event.button) rightclick = (event.button == 2);
	return rightclick;
}

function updateTreeValue(propertyId,value,text) {
    console.log(text);
	$("#prop_tree_"+propertyId).val(value);
	$("#prop_tree_value_"+propertyId).html(text);
}

$(document).ready(function(e) {
	
	$(".open_tree_popup").click(function(e) {
		var opened_window = window.open('jpanel/jpanel_modules/shopm/shopm_module_popup.php?action=show_tree&propertyId='+$(this).attr("rel"),'popuppage','width=400,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=200');
    });

	$("#prod_cat").change(function(e) {
        loadSubCategory($(this).val());
    });
	
	$("#prod_sub_cat").change(function(e) {
		loadCategoryBrands($(this).val());
    });
	
	
	

	$("#add_button").click(function(e) {
		hasError = false;
		
		/* cat items */
		var items = $('#catsTree').jqxTree('getCheckedItems');
		
		var res_str = "";
		if(items.length>0) {
			for(var i = 0; i < items.length; i++) {
				 var item = items[i];
				 //if(item.level==0) {
					 if(res_str.length==0) { res_str += item.value; } else { res_str += ","+item.value; }
				 //}
			}
			console.log(res_str);
			$("#prod_cat_stor").val(res_str);
			if(res_str == "") { hasError = true;   }
		} else {
			hasError = true;
		}
		
		if($("#prod_main_name").val() == "") { hasError = true; }
		
		
		if(hasError) { alert("Xanalari doldurun"); } else {$("#add_form").submit();}
	

    });
	
	if($("#catsTree").length > 0){
				$("#catsTree").jqxTree({   checkboxes: true,hasThreeStates: false, width: '500px'});
				$('#catsTree').css('visibility', 'visible');
				
				$('#catsTree').on('click', function (event) {
					
					console.log("called");
					var items = $('#catsTree').jqxTree('getCheckedItems');
					
					var res_str = "";
					if(items.length>0) {
						for(var i = 0; i < items.length; i++) {
							 var item = items[i];
							 //if(item.level==0) {
								 if(res_str.length==0) { res_str += item.value; } else { res_str += ","+item.value; }
							 //}
						}
						console.log(res_str);
						loadCategoryBrands(res_str);
					}
					
					
				}); 
	}

	

	

	$("#material_gallery_upload").click(function(){
		$("#prod_img_form").submit();	
	});

	

	$(".prop_new_value_class").click(function(e) {

		if($(this).next("input").attr("disabled") == "disabled"){
			$(this).next("input").attr("disabled", false);
		} else {
			$(this).next("input").attr("disabled", "disabled");
		}

    });

	

	$(".prop_custom_value_class").click(function(e) {

		if($(this).next("input").attr("disabled") == "disabled"){
			$(this).next("input").attr("disabled", false);
		} else {
			$(this).next("input").attr("disabled", "disabled");
		}

    });


});

