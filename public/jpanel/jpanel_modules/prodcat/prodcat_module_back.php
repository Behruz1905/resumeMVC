<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	
	if($authenticated_cp == false) { exit("Access denied"); }
	if($user_data['userType'] != "A" && $user_data['userType'] != "S") exit("Access denied");  
	
	if($action == "load_subcategory") {
		$category_id = $_POST['categoryId'];
		if($user_data['userType'] == "A") {
			$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='$category_id' ");
		} else {
			$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='$category_id' AND categoryId IN (SELECT productCategoryId FROM seller_category WHERE sellerId='".$user_data['sellerId']."' )  ");
		}
		$res = "<option value=\"0\">Seçin</option>";
		while($row_cat = mysql_fetch_array($result_cat)){
			$res .= "<option value=\"".$row_cat[0]."\">".$row_cat[1]."</option>";
		}
		print $res;
	}
	
	if($action == "load_category_products") {
		$category_id = $_POST['categoryId'];
		$result_cat = mysql_query("SELECT productId,(SELECT productName FROM product_list p WHERE p.productId=pl.productId )  FROM  product_category_link  pl WHERE categoryId='$category_id' ");
		$res = "<option value=\"0\">Seçin</option>";
		while($row_cat = mysql_fetch_array($result_cat)){
			$res .= "<option value=\"".$row_cat[0]."\">".$row_cat[1]."</option>";
		}
		print $res;
	}
	
	if($action == "load_category_brands") {
		$category_ids = addslashes(str_replace('"','',$_REQUEST['categoryIds']));
		$query_cat = "SELECT brandId,(SELECT brandName FROM brands b WHERE b.brandId=bc.brandId )  FROM  brand_category_link  bc  "; //WHERE productCategoryId IN ($category_ids)
		$result_cat = mysql_query($query_cat);
		$res = "$query_cat<option value=\"0\">Seçin</option>";
		while($row_cat = mysql_fetch_array($result_cat)){
			$res .= "<option value=\"".$row_cat[0]."\">".$row_cat[1]."</option>";
		}
		print $res;
	}
	
?>