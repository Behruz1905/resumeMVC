<script src="jpanel/jpanel_lib/tableDND/jquery.tablednd_0_5.js" ></script>
<link rel="stylesheet" href="jpanel/jpanel_lib/tableDND/tablednd_custom.css" />

<link rel="stylesheet" href="jpanel/jpanel_lib/jquery_ui/smoothness/jquery-ui-1.10.4.custom.min.css"  />
<script src="jpanel/jpanel_lib/jquery_ui/jquery-ui-1.10.4.custom.min.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jquery_ui/jquery-ui-timepicker-addon.js" language="javascript" ></script>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />



<link rel="stylesheet" href="jpanel/jpanel_modules/material/style/material_module_style.css" />

<script>
	$(document).ready(function(){
		
		if($("#cat_val").val()==1) {
			
			$("#mater_table tr").hover(function() {
			 	 if($(this).hasClass("nodrag") == false) $(this.cells[1]).addClass('showDragHandle');
			}, function() {
				 if($(this).hasClass("nodrag") == false)  $(this.cells[1]).removeClass('showDragHandle');
			});
		
			// Initialise the table 3    
			$("#mater_table").tableDnD({
				onDragClass: "myDragClass",
				dragHandle: "dragHandle",
				onDrop: function(table, row) {
				  var rows = table.tBodies[1].rows;
				  var w = "";
				  for (var i = 0; i < rows.length; i++) {
					w += rows[i].id + "|";
				  }
				
				
				  $.ajax({
						type: "POST",
						url: "admin_backend.php?module=material&action=sort",
						timeout: 5000,
						data: "w=" + w,
						success: function(data){  /* $("#upd-dnd").html(data); */ },
						error: function(data){$("#upd-dnd").html("Error" + data);}
					});
				}
			});
			
		}
		
				
		/* date picker */
		$(function() {
			$('#start_date,#end_date').datetimepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});
		
		<?php if(!empty($_GET['id'])) { ?>
		$("#material_gallery_upload").click(function(){
			
			var imgsrc = $("#material_gallery_input").val();
			var matName = $("#material_gallery_name").val();
			var matName_ru = $("#material_gallery_name_ru").val();
			var matName_en = $("#material_gallery_name_en").val();
			
			
			if(imgsrc != "") {
				
				window.imgsrc = imgsrc;
				$.ajax({
				   type: "POST",
				   url: "admin_backend.php?module=material&action=upload",
				   data: "imgsrc="+window.imgsrc+"&add=add&id="+<?php echo $_GET['id']; ?>+"&matName="+matName+"&matName_ru="+matName_ru+"&matName_en="+matName_en,
				   success: function(msg){
					 var pic_id = msg;
					 $('#material_gallery_table tr:last').after("<tr id='material_gallery_row_"+msg+"' ><td><img src='"+window.imgsrc+"' width='100' height='100'></td><td class='material_gallery_delete_td'><img src='jpanel/jpanel_img/remove.png' width='20' id='"+msg+"' class='material_gallery_delete_img' title='Sil' ></td></tr>");
				   	 $("#material_gallery_input").val("");
					 $("#material_gallery_input_big").val("");
					 $("#material_gallery_name").val("");
					 $("#material_gallery_name_ru").val("");
					 $("#material_gallery_name_en").val("");
				   },
				   error: function(msg){
					 alert(msg);
					 $("#material_gallery_input").val("");
					 $("#material_gallery_input_big").val("");
				   }
				 });
			}
		});
		
		
		
		$(document).on('click','.material_gallery_delete_img',function(){
			var selId = $(this).attr("id");
			console.log(selId);
			window.selId = selId;
			$.ajax({
			   type: "POST",
			   url: "admin_backend.php?module=material&action=remove",
			   data: "remove=remove&id="+window.selId ,
			   success: function(msg){
				 $("#material_gallery_row_"+window.selId).hide();
			   },
			   error: function(msg){
				 alert('Error');
			   }
			 });
		});
		
		<?php } ?>
		
		if($('#lang_content').length>0) { $('#lang_content').jqxTabs({ width: '850', position: 'top'}); }
		
		
		
		
		
				
	});
</script>

<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<script type="text/javascript">
	<!-- TinyMCE -->
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		editor_deselector : "answer_area",
		plugins : "imagemanager,pastehtml,pagebreak,style,table,advhr,advimage,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,preview",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,fullscreen,|,insertimage,pastehtml",
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
		//document_base_url: "/",

		remove_script_host : false,
		//forced_root_block : false,
		//force_br_newlines : true,
		//force_p_newlines : false,    
		//convert_newlines_to_brs : true

	});
	<!-- /TinyMCE -->
</script>

<script>
	 $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $("#tagbox" ).bind( "keydown", function( event ) {
		
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).data( "ui-autocomplete" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON("jpanel/jpanel_modules/material/material_module_back.php", {
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
