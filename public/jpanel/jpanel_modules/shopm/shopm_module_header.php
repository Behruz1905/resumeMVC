<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />


<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>

<link rel="stylesheet" href="jpanel/jpanel_lib/jquery_ui/smoothness/jquery-ui-1.10.4.custom.min.css"  />
<script src="jpanel/jpanel_lib/jquery_ui/jquery-ui-1.10.4.custom.min.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxtree.js" language="javascript"></script>


<script src="jpanel/jpanel_modules/shopm/script/shopm_module_script.js" language="javascript" ></script>

<link rel="stylesheet" href="jpanel/jpanel_modules/shopm/style/shopm_module_style.css" />

<script src="jpanel/jpanel_lib/fancybox/jquery.fancybox.js" language="javascript" ></script>
<link rel="stylesheet" href="jpanel/jpanel_lib/fancybox/jquery.fancybox.css" />

<script type="text/javascript">

	function split( val ) {
	  return val.split( /,\s*/ );
	}

	function extractLast( term ) {
	  return split( term ).pop();
	}


	<!-- TinyMCE -->
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		editor_deselector : "answer_area",
		plugins : "imagemanager,filemanager,pastehtml,pagebreak,style,table,advhr,advimage,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,preview",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,fullscreen,|,insertfile,insertimage,pastehtml",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		//content_css : "css/content.css",
		
		language: "ru",
		// Drop lists for link/image/media/template dialogs
		
		//extended_valid_elements : "object[width|height|classid|codebase],param[name|value],embed[src|type|width|height|flashvars|wmode]",
		cleanup:false,
		convert_urls : false,
		relative_urls : false,
		remove_script_host : false,
		//forced_root_block : false,
		//force_br_newlines : true,
		//force_p_newlines : false,    
		//convert_newlines_to_brs : true
	});

	<!-- /TinyMCE -->

	

	$(document).ready(function(e) {
		
		if($('#lang_content').length>0) { $('#lang_content').jqxTabs({ width: '850', position: 'top',selectionTracker: true,collapsible: true}); }
		
		$(".prod_img").click(function() {    
				$.fancybox.open(this.src);    
				return false;  
		});

        $("#filter_shop").click(function(e) {
            if($(this).hasClass("active_filter")) {
				$("#filter_head_table").hide();
				$(this).removeClass("active_filter");
				$(this).css("background-image","url(jpanel/jpanel_img/filter_add.png)");
			} else {
				$("#filter_head_table").show();
				$(this).addClass("active_filter");
				$(this).css("background-image","url(jpanel/jpanel_img/filter_delete.png)");

			}

        });
		
		<?php if(!empty($_GET['shop_product_id'])) { ?>
		$("#prod_img_upload").click(function(){
			
			var imgsrc = $("#other_img").val();
			
			if(imgsrc != "") {
				
				window.imgsrc = imgsrc;
				$.ajax({
				   type: "POST",
				   url: "admin_backend.php?module=shopm&action=upload",
				   data: "imgsrc="+window.imgsrc+"&add=add&shop_product_id="+<?php echo $_GET['shop_product_id']; ?>,
				   success: function(msg){
					 var pic_id = msg;
					 $('.prod_img_item:last').after("<div class='prod_img_item' ><img src='"+window.imgsrc+"' class='prod_img'><img src='jpanel/jpanel_img/remove.png'  class='prod_img_remove' id='prod_img_row_"+msg+"'/></div>");
					 $("#other_img").val("");
				   },
				   error: function(msg){
					 alert(msg);
					 $("#other_img").val("");
				   }
				 });
			}
		});
		
		
		
		$(document).on('click','.prod_img_remove',function(){
			var selId_txt = $(this).attr("id");
			var selId_arr = selId_txt.split("_");
			var selId = selId_arr[3];
			window.selId = selId;
			$.ajax({
			   type: "POST",
			   url: "admin_backend.php?module=shopm&action=remove",
			   data: "remove=remove&id="+window.selId ,
			   success: function(msg){
				 $("#prod_img_row_"+window.selId).parent(".prod_img_item").hide();
			   },
			   error: function(msg){
				 alert('Error');
			   }
			 }); 
		});
		
		<?php } ?>

		
		$("#tagbox" ).bind( "keydown", function( event ) {

			  if(event.keyCode === $.ui.keyCode.TAB &&
					$(this).data( "ui-autocomplete" ).menu.active ) {
				  		event.preventDefault();
					}
			  })
			  .autocomplete({

				source: function( request, response ) {
				  $.getJSON("jpanel/jpanel_modules/productm/productm_module_back.php?action=complete_tags", {
					term: extractLast( request.term )
				  }, response );
				},

				search: function() {
				  // custom minLength
				  var term = extractLast( this.value );
				  if ( term.length < 2 ) {
					return false;
				  }
				},

				focus: function() {
				  // prevent value inserted on focus
				  return false;
				},

				select: function( event, ui ) {

				  var terms = split( this.value );
				  // remove the current input
				  terms.pop();
				  // add the selected item
				  terms.push( ui.item.value );
				  // add placeholder to get the comma-and-space at the end
				  terms.push( "" );
				  this.value = terms.join( ", " );
				  return false;

				}
		});


    });

</script>