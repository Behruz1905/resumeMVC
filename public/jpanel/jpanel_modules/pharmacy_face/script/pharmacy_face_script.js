// JavaScript Document
$(document).ready(function(e) {
	
	var source =
		{
			datatype: "json",
			datafields: [
				{ name: 'LOGICALREF' },
				{ name: 'NAME' }
			],
			url: "backend.php?module=pharmacy&action=load_item_from_items_complete",
			data: {
				featureClass: "P",
				style: "full",
				maxRows: 50,
				username: "jqwidgets"
			}
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#prod_name").jqxComboBox(
		{
			width: 400,
			height: 25,
			source: dataAdapter,
			displayMember: "NAME",
			valueMember: "LOGICALREF",
			placeHolder: "Malın adını daxil edin"
		});
		
	 
	 
	 $("#prod_name").on('select', function (event) {
		if (event.args) {
			var item = event.args.item;
			if (item) {
				
				$('#prod_code').val(item.value);
				$("#prod_country").html("");
				$("#prod_name_label").html("");
				
				var request_type = "load_item_from_items";
				var data = "module=pharmacy&logical_ref="+$('#prod_code').val()+"&action="+request_type;
				$.ajax({
						type: "POST",
						url: "backend.php",
						timeout: 5000,
						data: data,
						dataType : "json",  
						success: function(data, textStatus){
							if(data.TABLE_ID != null){
								console.log(data);
								//$("#prod_name").val(data.NAME);
								$("#prod_country").html(data.COUNTRY);
								var units = data.UNITS;
								units_html = "";
								for(i=0;i<units.length;i++){
									units_html += "<option value='"+units[i].UnitShortNAME+"' >"+units[i].UnitLongNAME+"</option>";
								}
								$("#item_unit").html(units_html);
							} else {
								alert("Mal tapilmadi");
							}
						},
						error: function(data){
							console.log(data);
						}
				 });
				
			}
		}
	});
    
	$("#barcode").change(function(e) { 
	  	
		if($('#barcode').val().length >2) {
			
				$('#prod_code').val("");
				$("#prod_country").html("");
				$("#prod_name_label").html("");
				
				
				var request_type = "load_item_from_items_barcode";
				var data = "module=pharmacy&barcode="+$('#barcode').val()+"&action="+request_type;
				$.ajax({
						type: "POST",
						url: "backend.php",
						timeout: 5000,
						data: data,
						dataType : "json",  
						success: function(data, textStatus){ console.log(data);
							if(data.TABLE_ID != null){
								console.log(data);
								$("#prod_name_label").html(data.NAME);
								$('#prod_code').val(data.LOGICALREF);
								
								//$("#prod_name").val(data.NAME);
								$("#prod_country").html(data.COUNTRY);
								var units = data.UNITS;
								units_html = "";
								for(i=0;i<units.length;i++){
									units_html += "<option value='"+units[i].UnitShortNAME+"' >"+units[i].UnitLongNAME+"</option>";
								}
								$("#item_unit").html(units_html);
							} else {
								alert("Mal tapilmadi");
							}
						},
						error: function(data){
							console.log(data);
						}
				 });
			
		}
		
	 });
	 
	 
	
	 
	 
	 
	 
	 
	 
	 
	 
	 
	
});