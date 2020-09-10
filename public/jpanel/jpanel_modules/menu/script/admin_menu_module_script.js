// JavaScript Document
$(document).ready(function(e) {
    $("#table tr").hover(function() {
          $(this.cells[1]).addClass('showDragHandle');
    }, function() {
          $(this.cells[1]).removeClass('showDragHandle');
    });

    // Initialise the table 3    
    $("#table").tableDnD({
	    onDragClass: "myDragClass",
		dragHandle: "dragHandle",
	    onDrop: function(table, row) {
          var rows = table.tBodies[0].rows;
          var w = "";
          for (var i = 0; i < rows.length; i++) {
            w += rows[i].id + "|";
          }
        
          $.ajax({
        		type: "POST",
         		url: "jpanel/jpanel_modules/menu/menu_module_back.php",
         		timeout: 5000,
         		data: "w=" + w,
         		success: function(data){$("#upd-dnd").html(data);},
         		error: function(data){$("#upd-dnd").html("Error" + data);}
         	});
        }
  	});
	
	
	
	
	if($("#add_cat_name").val() == "link") {
		$("#material_list").show();
		$("#material_select").show();
		
	} else if($("#add_cat_name").val() == "urllink") {
		$("#urllink_val").show();
		$("#urllink_target").show();
		
	} else {
		$("#material_list").attr("selectedIndex","0");
		$("#material_list").hide();
		$("#material_select").hide();
	}
	 
	$("#add_cat_name").change(function(){
		if($(this).val() == "link")
		{
			$("#material_list").show();
			$("#material_select").show();
			
			$("#urllink_val").hide();
			$("#urllink_target").hide();
		} else
		if($(this).val() == "urllink")
		{
			$("#urllink_val").show();
			$("#urllink_target").show();
			
			$("#material_list").attr("selectedIndex","0");
			$("#material_list").hide();
			$("#material_select").hide();
		}
		else
		{
			$("#material_list").attr("selectedIndex","0");
			$("#material_list").hide();
			$("#material_select").hide();
			
			$("#urllink_val").hide();
			$("#urllink_target").hide();
		}
	});
	
	$("#add_menu_form").submit(function(){
		if($("#add_cat_name").val() == "link" && $("#material_list").val() == 0 ) {
			alert("Material yaxud da kateqoriya seçməlisiniz.");
			return false;
		}
		
	});
	
	
	
	
});

function showlink(){
	if($("#add_cat_name").val() == "link")
	{
		$("#material_list").show();
		$("#material_select").show();
	}
	else
	{
		$("#material_list").attr("selectedIndex","0");
		$("#material_list").hide();
		$("#material_select").hide();
	}	
}