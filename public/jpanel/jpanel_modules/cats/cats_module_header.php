<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=az"></script>
<script src="jpanel/jpanel_script/gmap3.js" ></script>
<script src="jpanel/jpanel_modules/cats/script/cats_script.js" ></script>
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="jpanel/jpanel_lib/tiny_mce/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<script>
	
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
		//cleanup:false,
		convert_urls : false,
		relative_urls : false,
		remove_script_host : false,
		//forced_root_block : false,
		//force_br_newlines : true,
		//force_p_newlines : false,    
		//convert_newlines_to_brs : true
	});
	<!-- /TinyMCE -->

</script>
<style>
	.catfilter {
		border:1px solid #9ABFD9;
		background-color:#DDE4EE;
		padding:5px 6px;
		color:#555252;
		
		margin:5px 6px;
		display:inline-block;
		text-decoration:none;	
		
		-moz-border-radius: 10px; /* Firefox */
		  -webkit-border-radius: 10px; /* Safari, Chrome */
		  -khtml-border-radius: 10px; /* KHTML */
		  border-radius: 10px; /* CSS3 */
	}
	.filterselect {
		background-color:#81F7A4;
	}
</style>
