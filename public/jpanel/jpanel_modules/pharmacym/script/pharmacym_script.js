function getCoord(){
		var coord = new Array(40.36698925642974, 49.83510490722654);
		if($("#latlng").val().length > 5) {
			coord_arr = $("#latlng").val().split(",");
			$("#lat").val(coord_arr[0]);
			$("#lng").val(coord_arr[1]);
			coord = coord_arr;
		} else {
			coord = new Array(40.36698925642974, 49.83510490722654);
		}
		//console.log(coord);
		return coord;	
	}
	$(document).ready(function(){
		if($("#admin_mapdiv").length>0) {
			$("#admin_mapdiv").gmap3({
				 marker:{
					latLng: getCoord(),
					options:{
					  draggable:true
					},
					events:{
					  dragend: function(marker){
						$("#lat").val(marker.getPosition().lat());
						$("#lng").val(marker.getPosition().lng());
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
		
		
		
	});
