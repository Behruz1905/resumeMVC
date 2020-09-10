<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	if($action == "upload") {
	
		if(!empty($_REQUEST['imgsrc']) and is_numeric($_REQUEST['id'])){
			$hasGd = false;
			$big_path = addslashes(strip_tags(htmlspecialchars($_REQUEST['imgsrc'])));
			$matName = addslashes(strip_tags(htmlspecialchars($_REQUEST['matName'])));
			$matName_ru = addslashes(strip_tags(htmlspecialchars($_REQUEST['matName_ru'])));
			$matName_en = addslashes(strip_tags(htmlspecialchars($_REQUEST['matName_en'])));
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

			$data = [
				'articleId' => intval($_REQUEST['id']),
				'img' => $new_thumb_file,
				'big_img' => $big_path,
				'name' =>  $matName,
				'name_ru' => $matName_ru,
			    'name_en' => $matName_en
			];

			//$query = "INSERT INTO articleimg (articleid,img,big_img,name,name_ru,name_en) VALUES('".intval($_REQUEST['id'])."','".$new_thumb_file."','".$big_path."','$matName','$matName_ru','$matName_en') ";
			//$result = $mysql->($query);
			$mysql->insert('articleimg', $data);
			print $mysql->insert_id();

		}
	} else
	if($action == "remove"){
		
		if(!empty($_REQUEST['id'])){
			
			
			if($authenticated_cp == false) { exit("Access denied"); }
			if($user_data['userType'] != "A") exit("Access denied");  
			
			$query = "DELETE FROM  articleimg  WHERE tableId=".intval($_REQUEST['id']);
			$result = $mysql->query($query);
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

?>
