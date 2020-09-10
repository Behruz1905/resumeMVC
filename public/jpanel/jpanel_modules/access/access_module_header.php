<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
?>
<style>
	#access_table {
		border-collapse:collapse;	
	}
	#head_tr td{
		background-color:#DDE4EE;
		font-weight:bold;
	}
	#fill_object_name {
		 vertical-align:middle;
		 cursor:pointer;	
	}
	#remove_found_access {
		vertical-align:middle;
		 cursor:pointer;
	}
	.access_item_type {
		margin-right:7px;
		background-color:#03C;
		padding:3px;
		color:#FFF;
		margin-top:3px;
		margin-bottom:3px;
	}
</style>
<script >
	$(document).ready(function(){
		
			$("#fill_object_name").click(function(){
			var filled_txt = $("#object_name").val();
			if(filled_txt != "") {
				
					var action = "findUserByKeyword";
					var data = "keyword="+filled_txt+"&action="+action;
					$.ajax({
							type: "POST",
							url: "modules/userm/userm_module_back.php",
							timeout: 5000,
							data: data,
							dataType : "json",  
							success: function(data, textStatus){   
								//console.log(JSON.stringify(data));
								if(data != null) { 
									  if(data == "0") {
											alert("Access denied");
									  } else if(data == "1") {
											console.log("User not found");
									  } else {
											//console.log(data);	
											$("#access_object_span").html(data.userName+" "+data.userSurname+" ("+data.department+","+data.section+") ");  
											$("#access_object_code").val(data.userCode);
									  }
								} else { 
								
								}
							},
							error: function(data){ 
								console.log(data);
							}
					});
					
			}
			
		});
		
		$("#remove_found_access").click(function(){
				$("#access_object_span").html("");  
				$("#access_object_code").val("");
		});
		
		
	});
	
</script>