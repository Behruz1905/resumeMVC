<?php 
	session_start();
	$ckey = "MODULE_INCLUDE";
	require_once('../../../functions/config.php');
	require_once('../../../functions/functions.php');
	require_once('../../../functions/php_functions.php');
	require_once('../../../functions/main_settings_admin.php');
	require_once('../../../functions/language.php');
	
	if($authenticated_cp == false) { exit("Access denied"); }
	if($user_data['userType'] != "A" && $user_data['userType'] != "S") exit("Access denied");  
	
	$action = $_REQUEST['action'];
	
	if($action == "drop_tag_item") {
		$item = 	intval($_REQUEST['item']);
		$dropItem = intval($_REQUEST['dropItem']);
		$position = addslashes($_REQUEST['position']);
		
		if($position == "after") {
			
		} else if($position == "before"){
			
			$result_drop_item = mysql_query("SELECT tagId,parentId,place FROM tags WHERE tagId='$dropItem' ");
			$row_drop_item = mysql_fetch_array($result_drop_item);
			$drop_parent = $row_drop_item['parentId'];
			$drop_place = $row_drop_item['place'];
			
			$query_others = "UPDATE tags SET `place`=(`place`+1) WHERE  parentId='$drop_parent' AND `place`>='$drop_place' ";
			print $query_others;
			$result_others = mysql_query($query_others);
			
			$query_drag = "UPDATE tags SET place='$drop_place',parentId='$drop_parent' WHERE  tagId='$item' ";
			$result_drag = mysql_query($query_drag);
			if($result_drag && $result_others) {
				print "success";	
			} else {
				print "error";	
			}
			
		} else if($position == "inside") {
			
			$result_max = mysql_query("SELECT MAX(place) FROM tags WHERE parentId='$dropItem' ");
			$row_max = mysql_fetch_array($result_max);
			$new_place = $row_max[0]+1;
			
			$query_drag = "UPDATE tags SET place='$new_place',parentId='$dropItem' WHERE  tagId='$item' ";
			$result_drag = mysql_query($query_drag);
			
		}
		
	}
	
?>