<?php
	function get_menu_mode($menuid) {
		global $mysql;
		$menu_mode = $mysql->limit(1)->where('id', $menuid)->get('menu', 'mode');
		return $menu_mode;
	}

	function get_menu_name_link($link,$lang) {
        global $mysql;
		$name_link = $mysql->link(1)->where('link', $link)->get('menu', 'id');
	    return get_menu_name($name_link, $lang);
	}
	
	function get_article_publicity($id) {
		global $mysql;
        $publicity = $mysql->limit(1)->where('id', $id)->get('articles', 'publicity');
        if($publicity == 1) {
            return 1;
        } else {
            return 0;
        }
	}

	function clean($var) { // deyishenlerin temizlenmesi
		$new = trim($var);
		$new = addslashes($new);
		$new = htmlspecialchars($new);
		return $new;
	}
	
	function get_table_record_count($table,$ident) {
			$queryc = "SELECT count(".$ident.") FROM ".$table." ";
			$resultc = mysql_query($queryc);
			$rowc = mysql_fetch_array($resultc);
			return $rowc[0];
	}

	/* latest */
	
	function get_menu_row_by_parent($parent,$lang) {
	
		if($lang == "az") { $table = "menu_az"; }
		else 
		if($lang == "ru" ) { $table = "menu_ru"; }
		else { $table = "menu_en"; }
		
		$result = mysql_query("SELECT id,link,article,mode,(SELECT name FROM ".$table." b WHERE a.id=b.menu_id) as menu_name FROM menu a WHERE parent='$parent' ORDER BY place ");

		if(mysql_num_rows($result)>0) {
			return $result;
		} else {
			return false;
		}
	}

	/**/
	function get_menu_name($menu_id,$lang) {
		if($menu_id == "" or !is_numeric($menu_id) ) { return ""; }

        global $mysql;
		$name = 'name_' + $lang;
		$result = $mysql->limit(1)->where('id', $menu_id)->get('menu', $name);

		if($result) {
			return $result;
		}	
	}
	
	function get_menu_url($menu_id,$basename) {
		if(!is_numeric($menu_id)) { exit("Access denied url"); }

		global $mysql;
		$result = $mysql->limit(1)->where('id', $menu_id)->get('menu', 'name');

		if($result) {
			$link = $basename."".$result.".html";
			return $link;
		}	
	}
	
	function get_menu_id_by_name($menu) {
	
		if($menu == "index") {
			$menu_id = get_index_id();
		} else {
			$result = mysql_query("SELECT id FROM menu WHERE name='$menu' ");
			if(mysql_num_rows($result)>0) {
				$row = mysql_fetch_array($result);
				$menu_id = $row[0];
			}
		}
		return $menu_id;
	}
	
	function get_menu_parent($menu_id) {
	
		if(!is_numeric($menu_id)) { exit("Access denied2"); }
		$query = "SELECT parent FROM menu WHERE id = '$menu_id' ";
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			return $row[0];
		}
		
	}
	
	function get_index_id() {
		return 1;
	}

	function get_menu_mater_id($menu_id) {
	
		$query = "SELECT article FROM menu WHERE id='$menu_id'";
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			return $row[0];
		}
	}
	
	function get_content($menu_id,$lang) {
		$mater = get_menu_mater_id($menu_id);
		$publicity = get_article_publicity($mater);
		if($lang == "ru") {
			$query = "SELECT text FROM articles_ru WHERE article_id='$mater' ";
		} else if($lang == "en") {
			$query = "SELECT text FROM articles_en WHERE article_id='$mater' ";
		} else {
			$query = "SELECT text FROM articles_az WHERE article_id='$mater' ";
		}
		
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			if($publicity == 1) {
				return trim($row[0]);
			} else {
				return "";
			}
		}
	
	}
	
	function get_content_header($menu_id,$lang) {
		$mater = get_menu_mater_id($menu_id);
		$publicity = get_article_publicity($mater);
		if($lang == "ru") {
			$query = "SELECT title FROM articles_ru WHERE article_id='$mater' ";
		} else if($lang == "en") {
			$query = "SELECT title FROM articles_en WHERE article_id='$mater' ";
		} else {
			$query = "SELECT title FROM articles_az WHERE article_id='$mater' ";
		}
		
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			if($publicity == 1) {
				return trim($row[0]);
			} else {
				return "";
			}
		}
	
	}
	
	function get_menu_page($menu_id) {
		if(!is_numeric($menu_id)) { exit("Invalid menu id"); }
		$query = "SELECT link FROM menu WHERE id='$menu_id'";
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			return $row[0];
		}
		
	}
	
	function get_article_by_id($article,$lang){
		
		if($lang == "en") {
			$query = "SELECT name_en AS name,title_en AS title,text_en AS text,description_en AS description,tags,main_img FROM articles WHERE id='$article' ";
		} else if($lang == "ru") {
			$query = "SELECT name_ru AS name,title_ru AS title,text_ru AS text,description_ru AS description,tags,main_img FROM articles WHERE id='$article' ";
		} else {
			$query = "SELECT name,title,text,description,tags,main_img FROM articles WHERE id='$article' ";
		}
		$result = mysql_query($query);
		if($result) {
			$row = mysql_fetch_array($result);
			return $row;
		}
		
	}
	
	function getMetaInf($meta,$lang){
	
		$query = "SELECT $meta FROM meta_inf WHERE lang='$lang' ";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function get_siteparam_value($paramname){
		$query = "SELECT value FROM site_params WHERE `key`='$paramname' ";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function get_date_description($date,$month_array_az,$month_array_ru,$month_array_en,$lang){
		$date_array = explode("-",$date);
		$year = $date_array[0];
		$month = $date_array[1];
		$mdate = $date_array[2];
		
		if($lang =="az"){ $month_list = $month_array_az; }
		else if($lang=="ru") { $month_list = $month_array_ru; }
		else { $month_list = $month_array_en; }
		$monthName = $month_array_en[$month-1];
		return $mdate." ".$monthName." ".$year;
	} 
	
	function get_wdate_name($wdate,$day_array_az,$day_array_ru,$day_array_en,$lang){
		if($lang =="az"){ $date_list = $day_array_az; }
		else if($lang=="ru") { $date_list = $day_array_ru; }
		else { $date_list = $day_array_en; }
		
		return $date_list[$wdate-1];
	
	}

	function get_section_name($section_id){
        global $mysql;
		$section =  $mysql->limit(1)->where('id', $section_id)->get('sections', 'name');
		return $section;
	}

	function get_category_name($category_id,$lang){
	    global $mysql;
		if($lang == "ru") { $fld = " `name_ru` ";} else if($lang == "en") { $fld = " `name_en` ";} else { $fld = " `name` "; }
		$query = "SELECT ".$fld." FROM cats WHERE id='$category_id' ";
		$result = $mysql->query($query,true);
		$row = $result[0];
		return $row[0];
	}
	
	function get_menu_catId($menu_id){
		$result = mysql_query("SELECT cat_id FROM menu WHERE id='$menu_id' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}

	function getUser($user_id){
		$query_user = "SELECT  userName,userSurname,userBirthday,userCode,userAvatar,userAvatarThumb,blocked,userBonus,userId,userEmail,userPhone,address FROM jusers WHERE userId='".intval($user_id)."' ";
		$result_user = mysql_query($query_user);
		$row_user = mysql_fetch_array($result_user);
		return $row_user;
	}

	function updateOnlineList($user_id){
		$result_chk = mysql_query("SELECT tableId FROM jonline WHERE userId='$user_id' ");
		if(mysql_num_rows($result_chk)>0){
			$result_upd = mysql_query("UPDATE jonline SET lastTime=NOW() WHERE userId='$user_id' ");	
		} else {
			$result_ins = mysql_query("INSERT INTO jonline (lastTime,userId) VALUES (NOW(),'$user_id') ");
		}
	}
	
	function isUserOnline($user_id){
		$result = mysql_query("SELECT tableId FROM jonline WHERE  userId='$user_id' ");
		if(mysql_num_rows($result)>0){
			return true;
		} else {
			return false;
		}
	}

    function ifSameEmailExist($email){
        $query = "SELECT userEmail FROM jusers WHERE userEmail='$email' ";
        $result = mysql_query($query);
        if(mysql_num_rows($result)>0) {
            $row = mysql_fetch_array($result);
            if($row[0] == $email) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	function hasAccess($userId,$ouId,$functionName){
			if(isUserRoot($userId) == true) {
				return true;	
			} else {
				return true;		
			}
	}
	
	function isUserRoot($userId){
		$userId = (int) $userId;
		$result = mysql_query("SELECT isroot FROM jusers WHERE userId='$userId' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			if($row[0] == "1"){
				return true;	
			}else {
				return false;
			}
		} else {
			return false;	
		}
	}
	
	function hasModuleAccess($objectCode,$subjectCode,$objectType,$subjectType,$accessType){
		return true;
	}

	function getObjectCodeById($objectId,$objectType){
		if($objectType == "ou") {
			$result = mysql_query("SELECT ouCode FROM organizationalunits WHERE ouId='$objectId' ");	
		}
	}
	
	function hasActiveUser($userCode){
		$result_user = mysql_query("SELECT userId FROM jusers WHERE userCode='$userCode'  AND blocked=0 ");
		if(mysql_num_rows($result_user)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasUserInChat($userCode,$chat_session){
		$query_chk = "SELECT tableId FROM chat_session_users WHERE userCode='".$userCode."' AND chatSessionId='".$chat_session."' ";
		$result_chk = mysql_query($query_chk);	
		if(mysql_num_rows($result_chk)>0) {
			return true;
		} else {
			return false;	
		}
	}

	function getSellerName($sellerId){
		//$result = mysql_query("SELECT CONCAT(sellerName,' ',sellerSurName) AS seller FROM seller_list WHERE sellerId='$sellerId' ");
		//$row = mysql_fetch_array($result);
		return "";
	}
	
	function getSellerFolder($userId){
		$result = mysql_query("SELECT `folder` FROM cp_users WHERE cpuserId='".intval($userId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}

	function getBrandName($brandId){
		$result = mysql_query("SELECT brandName FROM brands WHERE brandId='$brandId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getShopProductSellerId($shop_product_id) {
		$result = mysql_query("SELECT sellerId FROM shop_products WHERE tableId='".intval($shop_product_id)."' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return 0;	
		}
	}
	
	function getProductCategoryParentId($productCategoryId){
		$result = mysql_query("SELECT categoryParent FROM product_category_list WHERE categoryId='".intval($productCategoryId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getProductCategory($categoryId){
		$result = mysql_query("SELECT categoryId,categoryName,categoryParent,place,mainPage FROM product_category_list WHERE categoryId='$categoryId' ");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function getProductPropertyName($propertyId){
		$result = mysql_query("SELECT propertyName  FROM cat_properties WHERE propertyId='".intval($propertyId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getProductPropertyValue($propertyValue){
		$result = mysql_query("SELECT itemValue  FROM cat_property_items WHERE itemId='".intval($propertyValue)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getPropertyItemParents($itemId){
		$parents_arr = array();
		$parents_arr[] = $itemId;
		$inc = 0;
		while($inc<10){
			$result = mysql_query("SELECT parentId FROM cat_property_items WHERE itemId='$itemId' ");
			$row = mysql_fetch_array($result);
			if($row[0] == 0) { return $parents_arr; } else { $parents_arr[] = $row[0]; $itemId = $row[0]; }
			$inc++;
		}
	}
	
	function getProductPropertyValues($propertyId,$shopProductId){
		
		$type = getCatPropertyType($propertyId);
		if($type == "tree"){
			$query = "SELECT propertyValue  FROM shop_product_prop WHERE  shopProductId='".intval($shopProductId)."' AND propertyId='".intval($propertyId)."' ";
			$result = mysql_query($query);
			if(mysql_num_rows($result)>0) {
				$row = mysql_fetch_array($result);
				$arr_tree = array_reverse (getPropertyItemParents($row[0]));
				$res_value = "";
				for($i=0;$i<count($arr_tree);$i++){
					if(empty($res_value)) { $res_value.= getProductPropertyValue($arr_tree[$i]); } else 
					{ $res_value.= " &raquo; ".getProductPropertyValue($arr_tree[$i]); }
				}
				return $res_value;
			}
			
		} else {
			$query = "SELECT p.propertyValue,i.itemValue  FROM shop_product_prop p LEFT JOIN cat_property_items i ON i.itemId=p.propertyValue  WHERE p.shopProductId='".intval($shopProductId)."' AND p.propertyId='".intval($propertyId)."' ";
			$result = mysql_query($query);
			$val = "";
			$inc = 0;
			while($row = mysql_fetch_array($result)){
				if($inc == 0) { $val.= "".$row[1]; } else { $val.= " / ".$row[1]; }
				$inc++;
			}
			return $val;
		}
		
	}
	
	function getCategoryProducts($categoryId){
		$query = "SELECT productId FROM product_category_link WHERE categoryId='".intval($categoryId)."' OR categoryId IN (SELECT categoryId FROM product_category_list WHERE categoryParent='".intval($categoryId)."' ) ";
		$result = mysql_query($query);	
		$cat_list = "";
		if(mysql_num_rows($result)>0) {
			while($row = mysql_fetch_array($result)){
				if(empty($cat_list)){
					$cat_list.= $row[0];
				} else {
					$cat_list.= ",".$row[0];	
				}
			}
		} else {
			$cat_list = "0";
		}
		
		return $cat_list;
	}
	
	function isExistTag($tag) {
		$tag = trim($tag);
		$result = mysql_query("SELECT tagId FROM tags  WHERE tagText='$tag' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}

	function getTagIdByName($tagText){
		$result = mysql_query("SELECT tagId FROM tags  WHERE tagText='$tagText' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getTagsListByParent($parentId){
		$parentId = intval($parentId);
		$result = mysql_query("SELECT tagId,tagText FROM tags WHERE parentId='$parentId' ORDER BY place ");
		if(mysql_num_rows($result)>0) {
			print "<ul>";
			while($row = mysql_fetch_array($result)){
				print "<li item-value='".$row[0]."' >".$row[1];
				getTagsListByParent($row[0]);
				print "</li>";
			}
			print "</ul>";
		}
		
	}
	
	function addArticleTag($tagId){
		$result = mysql_query("UPDATE tags SET articleCount=(articleCount+1) WHERE tagId='$tagId' ");
	}

	function removeArticleTag($tagId){
		$result = mysql_query("UPDATE tags SET articleCount=(articleCount-1) WHERE tagId='$tagId' ");
	}

	function getShopProduct($shop_product_id,$lang){
		$result = mysql_query("SELECT productId,count,sellerId,
									brandId,price,bonus,color,
									main_img,accepted,isnew,
									productDesc,productName,productDesc_ru,productName_ru,productDesc_en,productName_en,
									catId,thumb,productText,productText_ru,productText_en,
									productValute,rate FROM shop_products WHERE tableId='".intval($shop_product_id)."' ");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function addRateToProduct($shop_product_id){
		$shop_product_id = intval($shop_product_id);
		$result = mysql_query("UPDATE shop_products SET rate=rate+1 WHERE tableId='$shop_product_id' ");
	}
	
	function addRateToArticle($articleId){
		$articleId = intval($articleId);
		$result = mysql_query("UPDATE articles SET rate=rate+1 WHERE id='$articleId' ");
	}

	function getShopProductName($shop_product_id,$lang){
		$result = mysql_query("SELECT productName,productName_ru,productName_en FROM shop_products WHERE tableId='".intval($shop_product_id)."' ");
		$row = mysql_fetch_array($result);
		if($lang == "en") {
			return $row['productName_en'];
		} else if($lang == "ru") {
			return $row['productName_ru'];
		} else {
			return $row['productName'];
		}
	}

	function getShopProductThumb($shop_product_id){
		$result = mysql_query("SELECT thumb FROM shop_products WHERE tableId='$shop_product_id' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function existShopProduct($shop_product_id){
		$result = mysql_query("SELECT tableId FROM shop_products WHERE tableId='$shop_product_id' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;
		}
	}
	
	function getColorName($colorId){
		$result = mysql_query("SELECT colorName  FROM colors WHERE colorId='".intval($colorId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getCategoryArticles($categoryId){
		$query = "SELECT id FROM articles WHERE cat_id='".intval($categoryId)."'  ";
		$result = mysql_query($query);	
		$cat_list = "";
		if(mysql_num_rows($result)>0) {
			while($row = mysql_fetch_array($result)){
				if(empty($cat_list)){
					$cat_list.= $row[0];
				} else {
					$cat_list.= ",".$row[0];	
				}
			}
		} else {
			$cat_list = "0";
		}
		
		return $cat_list;
	}
	
	function hasShopProductPropertyValue($shop_product_id,$propertyId,$valueId){
		$result = mysql_query("SELECT tableId FROM shop_product_prop WHERE shopProductId='".intval($shop_product_id)."' AND propertyId='".intval($propertyId)."' AND propertyValue='".intval($valueId)."' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasShopProductPropertyCustomValue($shop_product_id,$propertyId){
		$result = mysql_query("SELECT customValue FROM shop_product_prop WHERE shopProductId='".intval($shop_product_id)."' AND propertyId='".intval($propertyId)."' AND customValue IS NOT NULL ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];	
		} else {
			return "";	
		}
	}
	
	function getCatPropertyType($propertyId){
		$result = mysql_query("SELECT propertyType FROM cat_properties WHERE propertyId='".intval($propertyId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}

	function getCatPropertyTypePathByProperty($propertyId){
		$res_str = "";
		$result = mysql_query("SELECT catPropertyTypeId FROM cat_property_types_link WHERE propertyId='$propertyId' ");
		while($row = mysql_fetch_array($result)){
			$type_parent = getCatPropertyTypeParent($row[0]);
			$type_name = getCatPropertyTypeName($row[0]);
			if($type_parent == 0) {
				$res_str.= "<div>".$type_name."</div>";	
			} else {
				$parent_name = getCatPropertyTypeName($type_parent);
				$res_str.= "<div>".$parent_name." -> ".$type_name."</div>";	
			}
		}
		return $res_str;
	}
	
	function getCatPropertyTreeListByParent($parentId,$propertyId){
		$parentId = intval($parentId);
		$result = mysql_query("SELECT itemId,itemValue FROM cat_property_items WHERE parentId='$parentId' AND propertyId='$propertyId' ");
		if(mysql_num_rows($result)>0) {
			print "<ul>";
			while($row = mysql_fetch_array($result)){
				print "<li item-value='".$row[0]."' >".$row[1];
				getCatPropertyTreeListByParent($row[0],$propertyId);
				print "</li>";
			}
			print "</ul>";
		}
		
	}
	
	function getCatProperty($propertyId){
		$result = mysql_query("SELECT propertyId,propertyName,propertyType,propertyView,propertyDesc,`minValue`,`maxValue`,ismain FROM cat_properties WHERE propertyId='".intval($propertyId)."' ");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function getCatPropertyTypeName($propertyTypeId){
		$result = mysql_query("SELECT catPropertyTypeName FROM cat_property_types WHERE catPropertyTypeId='".intval($propertyTypeId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getCatPropertyTypeParent($propertyTypeId){
		$result = mysql_query("SELECT parentId FROM cat_property_types WHERE catPropertyTypeId='".intval($propertyTypeId)."' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getCatPropertyValue($propertyId,$value_type){
		if($value_type == "min") { $result = mysql_query("SELECT minValue FROM cat_properties WHERE propertyId='$propertyId' "); }
		else if($value_type == "max") { $result = mysql_query("SELECT maxValue FROM cat_properties WHERE propertyId='$propertyId' "); }
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function updatePropertyValue($propertyId,$new_value){
		if(getCatPropertyType($propertyId) == "interval" || getCatPropertyType($propertyId) == "text"){
			 if(floatval(getCatPropertyValue($propertyId,"min")) > $new_value){
				 $result_upd = mysql_query("UPDATE cat_properties SET minValue='".$new_value."' WHERE propertyId='$propertyId' ");
			 } else if(floatval(getCatPropertyValue($propertyId,"mmax")) < $new_value) {
				 $result_upd = mysql_query("UPDATE cat_properties SET maxValue='".$new_value."' WHERE propertyId='$propertyId' ");
			 }
		}
	}
	
	function validateUserPassword($userId,$input_password){
		$result = mysql_query("SELECT userPassword FROM jusers WHERE userId='".intval($userId)."' ");
		$row = mysql_fetch_array($result);
		if($row[0] == encodeUserPassword($input_password)) {
			return true;	
		} else {
			return false;	
		}
	}
	 
	function hasRequestForUser($user_id,$friend_id){
		$user_id = intval($user_id);
		$friend_id = intval($friend_id);
		$result = mysql_query("SELECT tableId FROM friends_table WHERE (sendUserId='$user_id' AND acceptUserId='$friend_id') OR  (sendUserId='$friend_id' AND acceptUserId='$user_id') ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function isUsersFriend($user_id,$friend_id){
		$user_id = intval($user_id);
		$friend_id = intval($friend_id);
		$result = mysql_query("SELECT tableId FROM friends_table WHERE ((sendUserId='$user_id' AND acceptUserId='$friend_id') OR  (sendUserId='$friend_id' AND acceptUserId='$user_id')) AND accepted=1 ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasProductCatProperty($categoryId,$propertyId){
		$result = mysql_query("SELECT tableId FROM cat_properties_link WHERE propertyId='$propertyId' AND categoryId='$categoryId' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasProductBeforeBasketProperty($shopProductId){
		$result = mysql_query("SELECT s.tableId FROM shop_product_prop s,cat_properties c WHERE s.propertyId=c.propertyId AND s.shopProductId='$shopProductId' AND c.basketSelect=1 ");
		if(mysql_num_rows($result)>0) {
			return 1;	
		} else {
			return 0;	
		}
	}
	
	function hasProductCategoryLink($catId,$shopProductId){
		$result = mysql_query("SELECT tableId FROM shop_products_cat WHERE catId='$catId' AND shopProductId='$shopProductId' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function getCpuserName($cpUserId){
		$result = mysql_query("SELECT cpUserName FROM cp_users WHERE cpuserId='$cpUserId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderTypeNameByCode($typeCode){
		$result = mysql_query("SELECT typeName FROM order_types WHERE typeCode='$typeCode' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderStatusByCode($statusCode){
		$result = mysql_query("SELECT statusName FROM order_statuses WHERE statusCode='$statusCode' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderStatus($orderId){
		$result = mysql_query("SELECT orderStatus FROM orders_table WHERE orderId='$orderId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderStatus_ph($orderId){
		$result = mysql_query("SELECT orderStatus FROM ph_orders_table WHERE orderId='$orderId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderUser($orderId,$orderType){
		$query = "SELECT userId FROM orders_table WHERE orderId='$orderId' AND orderType='$orderType' ";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderUser_ph($orderId,$orderType){
		$query = "SELECT userLogicalRef FROM ph_orders_table WHERE orderId='$orderId' AND orderType='$orderType' ";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderExecutor($orderId){
		$result = mysql_query("SELECT executorId FROM orders_table WHERE orderId='$orderId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getOrderExecutor_ph($orderId){
		$result = mysql_query("SELECT executorId FROM ph_orders_table WHERE orderId='$orderId' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function sendWelcomeMsgToUser($userId){
		
	}
	
	function hasShopProductInBasket($userId,$shop_product_id){
		$result = mysql_query("SELECT tableId FROM basket_table WHERE  userId='$userId' AND shopProductId='$shop_product_id' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasItemInUserBasket($userId){
		$result = mysql_query("SELECT tableId FROM basket_table WHERE  userId='$userId'  ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function getUnitName($unitCode){
		$result = mysql_query("SELECT unitName FROM units WHERE unitShortName='$unitCode' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getUnitNameTg($unitCode){
		$result = mysql_query("SELECT UnitLongNAME FROM UNIT WHERE UnitShortNAME='$unitCode' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getUnitBarcodeTg($unitCode){
		$result = mysql_query("SELECT Barcode FROM UNIT WHERE UnitShortNAME='$unitCode' ");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function getItemByLogicalRef($logical_ref){
		$result = mysql_query("SELECT TABLE_ID,LOGICALREF,NAME,COUNTRY,SIT,`COUNT` FROM `ITEM` WHERE LOGICALREF='$logical_ref' ");	
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function hasDetailInOrder($orderId){
		$result = mysql_query("SELECT tableId FROM order_details WHERE orderId='$orderId' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function hasDetailInOrder_ph($orderId){
		$result = mysql_query("SELECT tableId FROM ph_order_details WHERE orderId='$orderId' ");
		if(mysql_num_rows($result)>0) {
			return true;	
		} else {
			return false;	
		}
	}
	/*
	
	function getCvValue($cvid,$key){
		$result = mysql_query("SELECT cvval FROM cv_body WHERE cvId='$cvid' AND cvkey='$key' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return "";	
		}
	}
	
	function getCv($cvid){
		$result = mysql_query("SELECT cvId,cvDate,cvRead,cvName,cvPhoto,vacationId,vacationId FROM cvs WHERE cvId='$cvid' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row;
		} else {
			return "";	
		}
	}*/

	function getClCardDefination($logicalRef){
		$result = mysql_query("SELECT DEFINATION FROM clcard WHERE LogicalREF='$logicalRef' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return "";	
		}
	}
	
	function getArticleMainImg($articleId){
		$result = mysql_query("SELECT main_img FROM articles WHERE id='".intval($articleId)."' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return "";	
		}
	}
	
	function getArticleName($articleId){
		$result = mysql_query("SELECT name FROM articles WHERE id='".intval($articleId)."' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return "";	
		}
	}
	
	function updateChildsProdCount(){

		$result = mysql_query("SELECT categoryId FROM product_category_list ");
		while($row = mysql_fetch_array($result)){
			$query_sub = "SELECT SUM(prodCount) FROM product_category_list WHERE categoryParent='".$row[0]."' OR 
			 categoryId IN (SELECT categoryId FROM product_category_list WHERE categoryParent IN (SELECT categoryId FROM product_category_list WHERE   categoryParent='".$row[0]."') ) ";
			
			$result_sub = mysql_query($query_sub );	
			$row_sub = mysql_fetch_array($result_sub);
			$result_upd = mysql_query("UPDATE product_category_list SET childsProdCount='".$row_sub[0]."' WHERE categoryId='".$row[0]."' ");
		}
	}
	
	function getPharmacyName($id){
		$result = mysql_query("SELECT pharmacyName FROM pharmacies WHERE pharmacyId='".intval($id)."' ");
		if(mysql_num_rows($result)>0) {
			$row = mysql_fetch_array($result);
			return $row[0];
		} else {
			return "";	
		}
	}
	
	function getAddFieldValue($fieldCode,$articleId){

	    global $mysql;
		$result = $mysql->query("SELECT fieldValue FROM article_fields WHERE articleId='$articleId' AND fieldCode='$fieldCode' ",true);
	
		if($result) {

			$row = $result[0];
			return $row['fieldValue'];
		} else {
			return "";	
		}
	}
?>