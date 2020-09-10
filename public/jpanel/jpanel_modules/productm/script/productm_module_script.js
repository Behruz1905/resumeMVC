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

					console.log(data);

					$("#prod_sub_cat").html(data);	

				}

			},

			error: function(data){ 

				alert(data);

			}

	});

	

}



$(document).ready(function(e) {

	

	if($("#prod_cat_iu").length > 0) {

		$("#prod_cat_iu").jqxDropDownList({ checkboxes: true,width: '200px', height: '25px', theme: 'arctic' });

    	$("#prod_cat_iu").jqxDropDownList('loadFromSelect', 'prod_cat');

	}

	

	$("#add_prod_submit").click(function(e) {

        

			var items = $("#prod_cat_iu").jqxDropDownList('getCheckedItems');

			var checkedItems = "";

			$.each(items, function (index) { console.log(this);

				if (index < items.length - 1) {

					checkedItems += ""+this.value + ",";

				}

				else checkedItems += ""+this.value+"";

			});

			

			$("#sel_cat").val(checkedItems);

			if($("#name_val").val() != "") { $("#add_prod_btn").submit(); } else { alert("Adi daxil edin"); }

    });

	

	

	$("#prod_cat").change(function(e) {

        loadSubCategory($(this).val());

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



