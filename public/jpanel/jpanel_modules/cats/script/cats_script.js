// JavaScript Document
function getCoord(){
		var coord = new Array(40.29161166356436, 47.96742912597654);
		if($("#latlng").val().length > 5) {
			coord_arr = $("#latlng").val().split(",");
			$("#lat").val(coord_arr[0]);
			$("#lng").val(coord_arr[1]);
			coord = coord_arr;
		} else {
			coord = new Array(40.29161166356436, 47.96742912597654);
		}
		//console.log(coord);
		return coord;	
	}
	$(document).ready(function(){
		
		$(".ui_select").selectmenu();
		
		$("#save_form_button").click(function(e) {
            $("#main_form").submit();
        });
		
		$("#reloadButton").click(function(e) {
            $("#main_grid").jqxGrid('refresh');
        });
		
		
		$("#addfields").click(function(e) {
             var selectedrowindex = $('#main_grid').jqxGrid('selectedrowindex');
			if(selectedrowindex == -1) {
				alert("Please select row");
			} else {
				var dataRecord = $("#main_grid").jqxGrid('getrowdata', selectedrowindex);
				window.location.href = "?smode=page&item=catfields&action=show&catid="+dataRecord.ID;
			}
        });
		
		
		
						
		if($("#admin_mapdiv").length >0) {
			$("#admin_mapdiv").gmap3({
			 marker:{
				latLng: getCoord(),
				options:{
				  draggable:true
				},
				events:{
				  dragend: function(marker){
					console.log(marker.getPosition());
					$("#lat").val(marker.getPosition().k);
					$("#lng").val(marker.getPosition().D);
				  }
				}
			  },
			 map:{
				options:{
				 center: getCoord(),
				 zoom:8,
				 mapTypeControl: false,
				 navigationControl: true,
				 scrollwheel: true,
				 streetViewControl: false
				}
			 }
			});
		}
		
		
		
		$("#section").change(function(e) {
            var sectId = $(this).val();
			window.location.href = "?smode=page&item=cats&section="+sectId;
        });  
		
		$("#manage_section").change(function(e) {
            var sectId = $(this).val();
			window.location.href = "?smode=page&item=cats&action=add_cat&section="+sectId;
        });
		
		$("#manage_section_edit").change(function(e) {
            var sectId = $(this).val();
			var catId = $("#catid").val();
			window.location.href = "?smode=page&item=cats&action=editcat&catid="+catId+"&section="+sectId;
        });
		
		
		$("#edit_button").click(function(e) {
            var selectedrowindex = $('#main_grid').jqxGrid('selectedrowindex');
            if(selectedrowindex == -1) {
                alert("Please select row");
            } else {
				var dataRecord = $("#main_grid").jqxGrid('getrowdata', selectedrowindex);
				window.location.href = "?smode=page&item=cats&action=editcat&catid="+dataRecord.ID;
			}
        });  
		
		$("#delete_button").click(function(e) {
            
			if(confirm("Are you sure to delete?")) {
				var selectedrowindex = $('#main_grid').jqxGrid('selectedrowindex');
				if(selectedrowindex == -1) {
					alert("Please select row");
				} else {
					var dataRecord = $("#main_grid").jqxGrid('getrowdata', selectedrowindex);
					window.location.href = "?smode=page&item=cats&action=delcat&catid="+dataRecord.ID;
				}
			}
			
        }); 
		
		
		
		if($("#main_grid").length >0) {
			
				// select rows.
				var rows = $("#data_table tbody tr");
				
				// select columns.
				var columns = $("#data_table thead th");
				
				var data = [];
				for (var i = 0; i < rows.length; i++) {
					var row = rows[i];
					var datarow = {};
					for (var j = 0; j < columns.length; j++) {
						// get column's title.
						var columnName = $.trim($(columns[j]).text());
						
						// select cell.
						var cell = $(row).find('td:eq(' + j + ')');
						datarow[columnName] = $.trim(cell.text());
						
					}
					data[data.length] = datarow;
				}
	
				var source = {
					localdata: data,
					datatype: "array",
					datafields:
					[
						{ name: "№", type: "number" },
						{ name: "Adı", type: "string" },
						{ name: "Açar sözləri", type: "string" },
						{ name: "Bölmə", type: "string" },
						{ name: "Aid oldugu kateqoriya", type: "string" },
						{ name: "Sil", type: "number" },
						{ name: "ID", type: "number" }
					]
				};
				var dataAdapter = new $.jqx.dataAdapter(source);
				$("#main_grid").jqxGrid(
				{
					width: '100%',
					source: dataAdapter,
					columnsresize: true,
					autoheight: true,
					sortable: true,
					columns: [
					  { text: '№', dataField: '№', align: 'center', width: 60,cellsalign: 'center' },
					  { text: 'Adı', dataField: 'Adı', align: 'center' },
					  { text: 'Açar sözləri', dataField: 'Açar sözləri', align: 'center', width: 170 },
					  { text: 'Bölmə', dataField: 'Bölmə',  align: 'center', width: 90 },
					  { text: 'Aid oldugu kateqoriya', dataField: 'Aid oldugu kateqoriya', align: 'center',  width: 150}
					]
				});
			
		}
		
			
		
		
	});