<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>

<script src="jpanel/jpanel_lib/jqwidgets/jqxtree.js" language="javascript" ></script>


<script src="resources/lib/jqwidgets/jqxpanel.js" language="javascript" ></script>

<script src="resources/lib/jqwidgets/jqxdragdrop.js" language="javascript" ></script>

<script>

	function isRightClick(event) {

			var rightclick;

			if (!event) var event = window.event;

			if (event.which) rightclick = (event.which == 3);

			else if (event.button) rightclick = (event.button == 2);

			return rightclick;

	}

	

	function dropTagItem(item,dropItem,dropPosition){

		var request_type = "drop_tag_item";

		var data = "action="+request_type+"&item="+item.value+"&dropItem="+dropItem.value+"&position="+dropPosition;

		

		console.log(data);

		

		$.ajax({

				type: "POST",

				url: "jpanel/jpanel_modules/tags/tags_module_back.php",

				timeout: 5000,

				data: data, 

				success: function(data){   

					if(data != "") {

						console.log(data);

					}

				},

				error: function(data){ 

					alert(data);

				}

		});

		

	}

		

	$(document).ready(function(e) {

        

		if($('#jqxTree').length > 0) {

			$('#jqxTree').jqxTree({ width: '590px' ,allowDrag: true, allowDrop: true,

				dragStart: function (item) {

                    if(item.value == 0) return false;

                },

				dragEnd: function (item, dropItem, args, dropPosition, tree) {

                    if(dropPosition == "after") { return false; }

					console.log(dropPosition);

					console.log(dropItem);

					if(item != dropItem) dropTagItem(item,dropItem,dropPosition);

                }

			});

			$('#jqxTree').css('visibility', 'visible');

			

			var contextMenu = $("#jqxMenu").jqxMenu({ width: '130px',  height: '110px', autoOpenPopup: false, mode: 'popup' });

			var clickedItem = null;	

			

			var attachContextMenu = function () {

					// open the context menu when the user presses the mouse right button.

					$("#jqxTree li").on('mousedown', function (event) {

						var target = $(event.target).parents('li:first')[0];

						var rightClick = isRightClick(event);

						if (rightClick && target != null) {

							$("#jqxTree").jqxTree('selectItem', target);

							var scrollTop = $(window).scrollTop();

							var scrollLeft = $(window).scrollLeft();

							contextMenu.jqxMenu('open', parseInt(event.clientX) + 5 + scrollLeft, parseInt(event.clientY) + 5 + scrollTop);

							return false;

						}

					});

			 }

				

			attachContextMenu();

			

			$(document).on('contextmenu', function (e) {

				if ($(e.target).parents('.jqx-tree').length > 0) {

					return false;

				}

				return true;

			});

			

			

			$("#jqxMenu").on('itemclick', function (event) {

				var item_val = $(event.args).attr("id");

				 var selectedItem = $('#jqxTree').jqxTree('selectedItem');

				 

				 if(selectedItem != null) {

						if(item_val == "add"){

							window.location.href= "?smode=page&item=tags&action=add&parent="+selectedItem.value;

						} else if(item_val == "remove") {

							if(selectedItem.value != 0) {

								if(confirm("Silinsin?")) { window.location.href= "?smode=page&item=tags&action=delete&key="+selectedItem.value; }

							}

						} else if(item_val == "edit") {

							if(selectedItem.value != 0) {

								window.location.href= "?smode=page&item=tags&action=edit&key="+selectedItem.value;

							}

						} else if(item_val == "select") {

							if(selectedItem.value != 0) {

								window.location.href= "?smode=page&item=material&action=articles&section=4&tag="+selectedItem.value;

							}

						}

				 }

				

				

				

				

			});

		}

		

		

		$("#add_button").click(function(e) {

				if($("#tag_name").val() != "") {

					$("#add_form").submit();	

				} else {

					alert("Teq elave edin.");	

				}



		});

		

		

		

    });

</script>