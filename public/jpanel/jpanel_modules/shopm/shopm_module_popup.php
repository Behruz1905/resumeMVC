<?php
	session_start();
	$ckey = "MODULE_INCLUDE";
	require_once('../../../functions/config.php');
	require_once('../../../functions/functions.php');
	require_once('../../../functions/php_functions.php');
	require_once('../../../functions/basket_functions.php');
	require_once('../../../functions/main_settings_admin.php');
	require_once('../../../functions/language.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script src="../../../resources/script/jquery-1.10.2.min.js" language="javascript" ></script>
    <link rel="stylesheet" href="../../../resources/lib/jqwidgets/styles/jqx.base.css"  />
    <link rel="stylesheet" href="../../../resources/lib/jqwidgets/styles/jqx.arctic.css"  />
    <link rel="stylesheet" href="../../../resources/lib/jqwidgets/styles/jqx.fresh.css"  />
    <script src="../../../resources/lib/jqwidgets/jqxcore.js" language="javascript" ></script>
    <script src="../../../resources/lib/jqwidgets/jqxwindow.js" language="javascript" ></script>
    <script src="../../../resources/lib/jqwidgets/jqxnavigationbar.js" language="javascript" ></script>
    <script src="../../../resources/lib/jqwidgets/jqxdragdrop.js" language="javascript" ></script>
    <script src="../../../resources/lib/jquery_ui/jquery-ui-1.10.4.custom.min.js" language="javascript" ></script>
	<script src="../../../resources/lib/jqwidgets/jqxtree.js" language="javascript"></script>
    <script type="text/javascript" src="../../../resources/lib/jqwidgets/jqxmenu.js"></script>
	<script>
		function isRightClick(event) {
			var rightclick;
			if (!event) var event = window.event;
			if (event.which) rightclick = (event.which == 3);
			else if (event.button) rightclick = (event.button == 2);
			return rightclick;
		}
		
		function sendValue(value,text)
		{
			var propertyId = <?php echo intval($_GET['propertyId']); ?>;
			window.opener.updateTreeValue(propertyId,value, text);
			window.close();
		}

$(document).ready(function(e) {
		
		if($("#jqxTree").length > 0){
			$('#jqxTree').jqxTree({ height: '300px', width: '380px' });
			$('#jqxTree').css('visibility', 'visible');
			var contextMenu = $("#jqxMenu").jqxMenu({ width: '120px',  height: '110px', autoOpenPopup: false, mode: 'popup' });
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
								window.location.href= "?action=add_child&propertyId=<?php echo intval($_GET['propertyId']); ?>&parentId="+selectedItem.value;
							} else if(item_val == "remove") {
								console.log("remove");
							} else if(item_val == "edit") {
								if(selectedItem.value != 0) {
									window.location.href= "?action=edit&propertyId=<?php echo intval($_GET['propertyId']); ?>&itemId="+selectedItem.value;
								}
							} else if(item_val == "select") {
								console.log("select");
								if(selectedItem.value != 0) {
									sendValue(selectedItem.value,selectedItem.label);
								}
							}
					 }
					
					
					
					
				});
			
			
			
		}
		
		
		
		
		
		
	});
	</script>
    <!-- JQwidgets -->
</head>
<body topmargin="5">
<?php
	$action = $_REQUEST['action'];

	if($action == "show_tree") {
		$propertyId = intval($_GET['propertyId']);
		
		$result_tree_f = mysql_query("SELECT itemId,propertyId,itemValue FROM cat_property_items WHERE parentId=0 AND propertyId='".$propertyId."' ");
		print "<div id='jqxTree' style='visibility: hidden; float: left;'>";
		print 	"<ul>";
		print		"<li item-value='0' item-expanded='true'>Root";

		
							getCatPropertyTreeListByParent(0,$propertyId);
		/*
		while($row_tree_f = mysql_fetch_array($result_tree_f)){
					print "<li item-value='".$row_tree_f[0]."' >".$row_tree_f[2]."";
					$result_tree_s = mysql_query("SELECT itemId,propertyId,itemValue FROM cat_property_items WHERE parentId='".$row_tree_f[0]."' AND propertyId='".$propertyId."' ");
					if(mysql_num_rows($result_tree_s)>0){
						print "<ul>";
								while($row_tree_s = mysql_fetch_array($result_tree_s)){
									print "<li item-value='".$row_tree_s[0]."' >".$row_tree_s[2]."</li>";
								}
						print "</ul>";	
					}
					print  "</li>";
		}
		*/
		
		print		"</li>";
		print	"</ul>";
		print "</div>";
		print "<div id='jqxMenu'>
					<ul>
						<li id='select'>Seç</li>
						<li id='add'>Əlavə et</li>
						<li id='edit'>Redaktə et</li>
						<li id='remove'>Sil</li>
					</ul>
				</div>";
		
	} else if($action == "add_child") {
		$propertyId = intval($_GET['propertyId']);
		print "<form action=\"?\" method=\"post\">";
		print 		"<div style=\"font-family:arial;\"> Yeni qiymət&nbsp;<input type='text' style='width:200px; ' name='new_child'>";
		print		"<div style='width:285px;text-align:right;'><input type='submit' name='do_add' value='Yadda saxla' class='main_ui_button' /></div>";
		print		"<input type=\"hidden\" name=\"action\" value=\"do_add_child\">";
		print		"<input type=\"hidden\" name=\"propertyId\" value=\"".$propertyId."\">";
		print		"<input type=\"hidden\" name=\"parentId\" value=\"".intval($_GET['parentId'])."\">";
		print "</form>";	
	}  else if($action == "edit") {
		
		$propertyId = intval($_GET['propertyId']);
		$itemId = intval($_GET['itemId']);
		
		$result_tree = mysql_query("SELECT itemId,propertyId,itemValue FROM cat_property_items WHERE itemId='".$itemId."' AND propertyId='".$propertyId."' ");
		$row_tree = mysql_fetch_array($result_tree);
		
		print "<form action=\"?\" method=\"post\">";
		print 		"<div style=\"font-family:arial;\"> Yeni qiymət&nbsp;<input type='text' style='width:200px;' name='new_value' value='".$row_tree[2]."' >";
		print		"<div style='width:285px;text-align:right;'><input type='submit' name='do_edit_b' value='Yadda saxla' class='main_ui_button' /></div>";
		print		"<input type=\"hidden\" name=\"action\" value=\"do_edit\">";
		print		"<input type=\"hidden\" name=\"propertyId\" value=\"".$propertyId."\">";
		print		"<input type=\"hidden\" name=\"itemId\" value=\"".$itemId."\">";
		print "</form>";	
		
		
	}  else if($action == "do_edit") {
		$propertyId = intval($_POST['propertyId']);
		$itemId = intval($_POST['itemId']);
		$new_value = addslashes(htmlspecialchars($_POST['new_value']));
		if(!empty($new_value)) {
			$result_update  = mysql_query("UPDATE cat_property_items SET itemValue='$new_value' WHERE itemId='$itemId' ");	
			if($result_update) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?action=show_tree&propertyId=".$propertyId." \">";  //change redirect
				exit("<center>Success</center>");
			}
		}
		
	}  else if($action == "do_add_child") {
		$propertyId = intval($_POST['propertyId']);
		$parentId = intval($_POST['parentId']);
		$new_value = addslashes(htmlspecialchars($_POST['new_child']));
		
		if(!empty($new_value)) {
			$result_insert  = mysql_query("INSERT INTO cat_property_items (propertyId,itemValue,parentId) VALUES ('$propertyId','$new_value','$parentId') ");	
			if($result_insert) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?action=show_tree&propertyId=".$propertyId." \">";  //change redirect
				exit("<center>Success</center>");
			}
		}
	}

	
	
?>