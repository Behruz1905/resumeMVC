<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	if($action == "upload") {
	
		if(!empty($_REQUEST['imgsrc']) and is_numeric($_REQUEST['shop_product_id'])){
			$hasGd = false;
			$big_path = addslashes(mysql_real_escape_string(htmlspecialchars($_REQUEST['imgsrc'])));
			@logw("",$big_path,"uploading image");
			$big_path_info  = pathinfo($big_path);  
			$thumbdir = $big_path_info['dirname']."/jmthumbs";
			$pref = "";
			
			if (!file_exists($pref."".$thumbdir)) {
				mkdir($pref."".$thumbdir, 0755);
			}
			
			if($hasGd) {
				
				if(file_exists($pref."".$thumbdir)) {
					
					$thumb_file = $thumbdir."/".$big_path_info['filename']."_jmthumb.".$big_path_info['extension'];
					$new_thumb_file = resizeImageByWidth($big_path,$big_path_info['extension'],$MP_gallery_thumb_width,$thumb_file);
					
				}
				if(empty($new_thumb_file)){
					$new_thumb_file = $big_path;
				}
			} else {
				@logw("",$big_path,"gd is not");
				$new_thumb_file = $big_path;
			}

			$query = "INSERT INTO shop_product_img (shopProductId,img,big_img) VALUES('".intval($_REQUEST['shop_product_id'])."','".$new_thumb_file."','".$big_path."') ";
			$result = mysql_query($query);
			print mysql_insert_id();
		}
	} else
	if($action == "remove"){
		
		if(!empty($_REQUEST['id'])){
			
			
			if($authenticated_cp == false) { exit("Access denied"); }
			if($user_data['userType'] != "A") exit("Access denied");  
			
			$query = "DELETE FROM  shop_product_img  WHERE tableId=".intval($_REQUEST['id']);
			$result = mysql_query($query);
			print "success";
		}
	
	}
	if($action == "sort"){
		$places = explode("|",$_POST['w']);
		$i = 1;
		foreach($places as $item) {
			if (empty($item)) { continue; }
			$item = intval($item);
			$query = "UPDATE articles SET place='$i' WHERE id='$item' ";
			$result = mysql_query($query);
			$i++;
		}
		print "success";
	}
	
	if($action == "complete_tags") {
		if (empty($_GET['term'])) exit ;
		$qwery = SqlInjectFilterMini(strtolower($_GET["term"]));
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $qwery = stripslashes($qwery);
		
		
		$result = array();
		if(strlen($qwery)) {
			$result_qw = mysql_query("SELECT tagId,tagText FROM tags WHERE tagText LIKE '".$qwery."%' ");
			while($row = mysql_fetch_array($result_qw)){
				array_push($result, array("id"=>$row[0], "label"=>$row[1], "value" => $row[1]));
			}
		}
	
		
		echo json_encode($result);
	}

?>