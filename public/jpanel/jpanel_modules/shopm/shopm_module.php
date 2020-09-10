<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A" && $user_data['userType'] != "MK" && $user_data['userType'] != "TS") { exit("Access denied"); }  ?>

<?php if($action == "show") { 


			$base_sql = "SELECT tableId,productId,count,sellerId,addDate,brandId,productDesc,
								price,instock,productText,bonus,color,dealerPrice,productName,
								catId,productCode,featured,logicalRef,articul FROM shop_products WHERE tableId IS NOT  NULL ";
			$where = " ";
			if(!empty($_GET['logical_ref'])) {
				$where.= " AND logicalRef='".SqlInjectFilterMini($_GET['logical_ref'])."' ";	
			}
			if(!empty($_GET['prod_name'])) {
				$where.= " AND productName LIKE '%".SqlInjectFilterMini($_GET['prod_name'])."%' ";	
			}
			if(!empty($_GET['prod_sub_cat'])) {
				$where.= " AND tableId IN (SELECT shopProductId FROM shop_products_cat WHERE catId='".intval($_GET['prod_sub_cat'])."' ) ";	
			}
			if(!empty($_GET['brands'])) {
				$where.= " AND brandId='".intval($_GET['brands'])."' ";	
			}
			if(!empty($_GET['start_price']) && !empty($_GET['end_price'])) {
				$where.= " AND  price>='".SqlInjectFilterMini($_GET['start_price'])."' AND price<'".SqlInjectFilterMini($_GET['end_price'])."' ";
			}
			if(!empty($_GET['featured'])) {
				$where.= " AND featured=1 ";
			}
			if(!empty($_GET['main_page_adv'])) {
				$where.= " AND main_page_adv=1 ";
			}
			if(!empty($_GET['cat_adv'])) {
				$where.= " AND cat_adv=1 ";
			}
			
			//if($user_data['userType'] != "A") { $where.=" AND sellerId='".$user_data['sellerId']."' "; }
			$comp_sql = $base_sql." ".$where;
			$shop_result = mysql_query($comp_sql);

?>

<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="99%">
		<tr class="ui_table_title">
            <td colspan="12" ><div id="filter_shop" >Malların axtarışı</div></td>
        </tr>
    	<tr class="ui_filter_tr">
        	<td colspan="12">
            	<form action="?" method="get" >
                <table class="ui_filter_table"  width="600" <?php if(empty($_GET['do_filter'])) { ?>style="display:none;"<?php } ?> id="filter_head_table">
                	<tr><td class="ui_filter_label">Logical ref:</td><td><input type="text" class="main_ui_text" name="logical_ref" <?php if(!empty($_GET['logical_ref'])){ print " value='".SqlInjectFilterMini($_GET['logical_ref'])."' "; }?>  /></td></tr>
                    <tr><td class="ui_filter_label">Malın adı:</td><td><input type="text" class="main_ui_text" name="prod_name"  <?php if(!empty($_GET['prod_name'])){ print " value='".SqlInjectFilterMini($_GET['prod_name'])."' "; }?> /></td></tr>
                    <tr>
                    	<td class="ui_filter_label">Kateqoriya 1:</td>
                    	<td>
                    		<select id="prod_cat" name="prod_cat" class="ui_select">
                                <option value="0">Seçin</option>
                                <?php 
                                    $result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");
                                    while($row_cat = mysql_fetch_array($result_cat)){
                                            print "<option value='".$row_cat[0]."' ";
											if($_GET['prod_cat'] == $row_cat[0]) { print " selected ";}
											print ">".$row_cat[1]."</option>";
                                    }
                                ?>
                            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td class="ui_filter_label">Kateqoriya:</td>
                    	<td>
                    		<select id="prod_sub_cat" name="prod_sub_cat" class="ui_select">
                               <option value="0">Seçin</option>
                               <?php 
							   		if(!empty($_GET['prod_cat'])) {
										$result_sub_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='".intval($_GET['prod_cat'])."' "); 
										while($row_sub_cat = mysql_fetch_array($result_sub_cat)){
											print "<option value=\"".$row_sub_cat[0]."\" ";
											if($_GET['prod_sub_cat'] == $row_sub_cat[0]) { print " selected ";}
											print ">".$row_sub_cat[1]."</option>";
										}
									}
								?>
                            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td class="ui_filter_label">Brend:</td>
                        <td>
                        	<select name="brands" class="ui_select" >
                            	<option value="0">Seçin</option>
								<?php 
                                    $result_brand = mysql_query("SELECT brandId,brandName FROM brands ");
                                    while($row_brand = mysql_fetch_array($result_brand)){
                                        print "<option value='".$row_brand[0]."' ";
										if($_GET['brands'] == $row_brand[0]) { print " selected ";}
										print ">".$row_brand[1]."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="ui_filter_label">Seçilən:</td>
                        <td><input type="checkbox"   name="featured"  <?php if(!empty($_GET['featured'])) { print " checked ";} ?>  /> </td>
                    </tr>
                    <tr>
                        <td class="ui_filter_label">Ilkin sehife reklami:</td>
                        <td><input type="checkbox"   name="main_page_adv" <?php if(!empty($_GET['main_page_adv'])) { print " checked ";} ?>    /> </td>
                    </tr>
                    <tr>
                        <td class="ui_filter_label">Kateqoriya reklami:</td>
                        <td><input type="checkbox"   name="cat_adv"  <?php if(!empty($_GET['cat_adv'])) { print " checked ";} ?>   /> </td>
                    </tr>
                    
                    <tr><td class="ui_filter_label">Qiymət:</td><td><input type="text" class="main_ui_text" name="start_price" style="width:50px;" <?php if(!empty($_GET['start_price'])){ print " value='".SqlInjectFilterMini($_GET['start_price'])."' "; }?>    /> -dən  &nbsp;<input type="text" class="main_ui_text" style="width:50px;" name="end_price" <?php if(!empty($_GET['end_price'])){ print " value='".SqlInjectFilterMini($_GET['end_price'])."' "; }?>   /> -ə</td></tr>
                    <tr><td></td><td><input type="submit" class="main_ui_button" value="Filtr" name="do_filter"  /> &nbsp;&nbsp;<input type="button" class="main_ui_button" value="Filtri təmizlə" name="clear_filter" onclick="window.location.href='?smode=page&item=shopm&action=show'"  /></td></tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="shopm"  />
                <input type="hidden" name="action" value="show"  />
                </form>
            </td>
        </tr>
        <tr class="ui_table_title">
        	<td colspan="12">Satışda olan mallar <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=shopm&action=add'"  /></td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td width="100" >Logical Ref</td>
            <td width="100" >Artikul</td>
            <td >Mal</td>
            <td>Qiymət</td>
            <td>Seçilən</td>
            <td>Brend</td>
            <td class="iu_center_short">Status</td>
            <td class="iu_center_short">Şəkil</td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			//$base_sql = "SELECT tableId,productId,count,sellerId,addDate,brandId,productDesc,price,instock,productText,bonus,color FROM shop_products WHERE tableId IS NOT  NULL ";
			$n=1;
			while($shop_row = mysql_fetch_array($shop_result)){
				if($shop_row['sellerId'] == "0") { $seller = "Admin"; } else { $seller = getSellerName($shop_row['sellerId']); }
				print "<tr class=\"iu_table_mean\">
						<td class=\"iu_center_short\">$n</td>
						<td >".$shop_row['logicalRef']."</td>
						<td >".$shop_row['articul']."</td>
						<td>".$shop_row['productName']." <span class='prod_title_span'></span></td>
						<td>".$shop_row['price']."</td>
						<td class=\"iu_center_short\">";
						if($shop_row['featured'] == 1) { print "<img src=\"jpanel/jpanel_img/ok.png\"  />"; }else { print "<img src=\"jpanel/jpanel_img/stop.png\"  />"; }
				print	"</td>
						<td>".getBrandName($shop_row['brandId'])."</td>
						<td class=\"iu_center_short\">";
						if($shop_row['instock'] == 1) { print " In stock "; }
				print	"</td>
						<td class=\"iu_center_short\"><a href=\"?smode=page&item=shopm&action=product_images&shop_product_id=".$shop_row[0]."\"><img src=\"jpanel/jpanel_img/image.png\" border=\"0\" ></a></td>
						<td class=\"iu_center_short\"><a href=\"?smode=page&item=shopm&action=product_properties&shop_product_id=".$shop_row[0]."\"><img src=\"jpanel/jpanel_img/properties.png\" border=\"0\"  /></a></td>
						<td class=\"iu_center_short\"><a href=\"?smode=page&item=shopm&action=edit&shop_product_id=".$shop_row[0]."\"><img src=\"jpanel/jpanel_img/edit.png\" border=\"0\"  /></a></td>";
						if($user_data['userType'] != "MK" && $user_data['userType'] != "TS") { print "<td class=\"iu_center_short\"><a href=\"?smode=page&item=shopm&action=delete&shop_product_id=".$shop_row[0]."\" onclick=\"return confirm('Silinsin?');\" ><img src=\"jpanel/jpanel_img/remove.png\" border=\"0\"  /></a></td>"; }
				print "</tr>";
				$n++;
			}
		?>
        
</table> 
<?php } ?>
<?php if($action == "add") { ?>
		
        <form action="?" method="post"  id="add_form" enctype="multipart/form-data" >
            <table class="iu_table" border="1" cellspacing="0" bordercolor="#C1C0C0" >
                <tr class="ui_table_title">
                    <td colspan="2">Satışa mal əlavə et <input type="button" name="ok" value="Yadda saxla və malın parametrlərini doldur" class="main_ui_button" id="add_button"  /></td>
                </tr>
                <tr>
                	<td class="ui_labels" valign="top">Kateqoriya</td>
                    <td>
                    	<div id='catsTree' style='visibility: hidden; float: left; margin-left: 2px;'>
                        	<ul>
                        	<?php 
								
								$result_cat_first = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent=0 ");
								while($row_cat_first = mysql_fetch_array($result_cat_first)){
									print "<li item-value='".$row_cat_first['categoryId']."' >".$row_cat_first['categoryName']." ";
									print 		"<ul>";
													$result_cat_second = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent='".$row_cat_first['categoryId']."' ");
													while($row_cat_second = mysql_fetch_array($result_cat_second)){
														print "<li item-value='".$row_cat_second['categoryId']."' >".$row_cat_second['categoryName']."</li> ";
													}
									print  		"</ul>";
									print "</li>";
								} 
								/*
									$result_cat_second = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent='0' ");
									while($row_cat_second = mysql_fetch_array($result_cat_second)){
										print "<li item-value='".$row_cat_second['categoryId']."' >".$row_cat_second['categoryName']."</li> ";
									}
								*/
								
							?>
                            </ul>
                        </div>
                        <input type="hidden" id="prod_cat_stor" name="prod_cat_stor"  />
                    </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Brend seçin:</td>
                    <td>
                        <select name="brands" id="brands" class="ui_select" >
                            <option value="0">Seçin</option>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td class="ui_labels">Logical ref:</td>
                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="logicalRef" maxlength="150"  />  </td>
                </tr>
                 <tr>
                    <td class="ui_labels">Artikul:</td>
                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="articul" maxlength="150"  />  </td>
                </tr>
                <tr>
                	<td colspan="2">
                    	<div id='lang_content'>
										<ul>
											<li style="margin-left: 10px;">Azəri</li>
											<li>Rus</li>
											<li>İngilis</li>
										</ul>
										<div id="az_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name" maxlength="150"  id="prod_main_name"/>  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc" maxlength="150" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat:</td>
                                                    <td><textarea name="text" style="height:550px;width:550px;"  ></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="ru_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı ru:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name_ru" maxlength="150" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat ru:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc_ru" maxlength="150" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat ru:</td>
                                                    <td><textarea name="text_ru" style="height:550px;width:550px;"  ></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="en_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı en:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name_en" maxlength="150" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat en</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc_en" maxlength="150" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat en:</td>
                                                    <td><textarea name="text_en" style="height:550px; width:550px;"  ></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                         </div>
                    </td>
                </tr>
                  
                
                <tr>
                    <td class="ui_labels">Vəziyyəti:</td>
                    <td>
                        <select name="isnew" id="isnew" class="ui_select" >
                            <option value="1">Yeni</option>
                            <option value="0">İşlənmiş / Köhnə</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Qiymət:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="price" /> AZN </td>
                </tr>
                <tr>
                    <td class="ui_labels">Diler qiyməti:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="dealer_price" /> AZN </td>
                </tr>
                <?php if($user_data['userType'] == "A") { ?>
                <tr>
                    <td class="ui_labels">Bonus:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="bonus"  />  </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="ui_labels">Satışda sayı:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="count" /> </td>
                </tr>
                <tr>
                    <td class="ui_labels">Satışda var:</td>
                    <td><select name="in_stock" class="ui_select"><option value="-1">Seçin</option><option value="1">Bəli</option><option value="0">Xeyr</option></select></td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Kataloq şəkil 1:</td>
                    <td>
                    	<a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                    	<input  name='main_img' id='main_img' style='width:400px;'  class="main_ui_text" >
                    </td>
                </tr>
                <tr>
                    <td class="ui_labels">Kataloq şəkil 2:</td>
                    <td>
                    	<a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img_add', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                    	<input  name='main_img_add' id='main_img_add' style='width:400px;'  class="main_ui_text" >
                    </td>
                </tr>
         
                <tr>
                    <td class="ui_labels">Seçilən:</td>
                    <td><input type="checkbox"   name="featured"    /> </td>
                </tr>
                <tr>
                    <td class="ui_labels">Ilkin sehife reklami:</td>
                    <td><input type="checkbox"   name="main_page_adv"    /> </td>
                </tr>
                <tr>
                    <td class="ui_labels">Kateqoriya reklami:</td>
                    <td><input type="checkbox"   name="cat_adv"    /> </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Subscribe:</td>
                    <td><input type="checkbox"   name="subscribe"    /> </td>
                </tr>
                
                 <tr>
                	<td class="ui_labels" valign="top" >Teqlər</td>
                    <td><input type="text" id="tagbox" class="main_ui_text" name="tagbox" style="width:500px;"/></td>
                </tr>
            </table>
            <br/><br/>
            <input type="hidden" name="smode" value="page"  />
            <input type="hidden" name="item" value="shopm"  />
            <input type="hidden" name="action" value="do_add">
        </form>
<?php } ?>
<?php 
	if($action == "do_add") {
		if(!empty($_POST['prod_cat_stor']) && !empty($_POST['name'])) {
			$brand_id = (int)  $_POST['brands'];
			$isnew = (int) $_POST['isnew'];
			$price = SqlInjectFilterMini($_POST['price']); 
			$dealer_price = SqlInjectFilterMini($_POST['dealer_price']);
			$count = SqlInjectFilterMini($_POST['count']);
			$bonus = SqlInjectFilterMini($_POST['bonus']);
			$in_stock = (int)  $_POST['in_stock'];
			$desc = SqlInjectFilterMini($_POST['desc']);
			$name = SqlInjectFilterMini($_POST['name']);
			$text = addslashes(str_replace("<script","script",$_POST['text']));
			$tagbox = SqlInjectFilterMini($_POST['tagbox']);
			$logicalRef = SqlInjectFilterMini($_POST['logicalRef']);
			$articul = SqlInjectFilterMini($_POST['articul']);
			$upload_success = true; 
			$path = "";
			$productCode = $user_data['userId']."".time();
			
			if(!empty($_POST['featured'])) { $featured = 1; } else { $featured = 0; }
			if(!empty($_POST['main_page_adv'])) { $main_page_adv = 1; } else { $main_page_adv = 0; }
			if(!empty($_POST['cat_adv'])) { $cat_adv = 1; } else { $cat_adv = 0; }
			if(!empty($_POST['subscribe'])) { $subscribe = 1; } else { $subscribe = 0; }
			
			
			$desc_ru = SqlInjectFilterMini($_POST['desc_ru']);
			$name_ru = SqlInjectFilterMini($_POST['name_ru']);
			$text_ru = addslashes(str_replace("<script","script",$_POST['text_ru']));
			

			$desc_en = SqlInjectFilterMini($_POST['desc_en']);
			$name_en = SqlInjectFilterMini($_POST['name_en']);
			$text_en = addslashes(str_replace("<script","script",$_POST['text_en']));
			
			$main_img = clearFileName($_POST['main_img']);
			$main_img_add = clearFileName($_POST['main_img_add']);
			
			/* upload img if not empty */
			/*
			if(!empty($_FILES["main_img"]['name'])){
				$filename =  addslashes(htmlspecialchars($_FILES['main_img']['name']));
				$filename_tmp = htmlspecialchars($_FILES['main_img']['tmp_name']);
				$ext = substr($filename,1 + strrpos($filename,"."));
				$date_file = date("YmdHis");
				
				//if($user_data['userType'] == "A") {
					$uploaddir = "resources/content_img/shop/";
				} else if($user_data['userType'] == "S") {
					if(getSellerFolder($user_data['userId']) != "") {
						$uploaddir = "resources/content_img/sellers/".getSellerFolder($user_data['userId'])."/";	
					} else {
						$uploaddir = "resources/content_img/shop/";	
					}
					
				//} 
				
				$uploaddir = "content_img/shop/";
				
				if($_FILES["main_img"]['size'] > $max_image_size) {
					$errMsg .= 'Error: File size > '.($max_image_size/1024*1024)." MB ";
					$upload_success = false;
				} elseif (!in_array($ext, $valid_img_types)) {
					$errMsg .= 'Error: Invalid file type.';
					$upload_success = false;
				} else {
					$path = $uploaddir."".$date_file."__".$filename;
					if (move_uploaded_file($filename_tmp, $path)) {
						$upload_success = true;
						
						// thumb
						$path_thumb = $uploaddir."".$date_file."__tmp__".$filename;
						//$thumb_name = resizeImageByWidth($path,$ext,200,$path_thumb);
						
						// big
						$path_big = $uploaddir."".$date_file."__big__".$filename;
						//$big_name = resizeImageByHeight($path,$ext,640,$path_big);
						
					} else {
						$upload_success = false;
						$errMsg .= 'Error while uploading. ';
					}
				}
				
			}
			*/
			/* ---------------------------------------------------------- */
			
			
				
				$result_shop = mysql_query("INSERT INTO shop_products 
														(productId,
														count,
														sellerId,
														addDate,
														brandId,
														productDesc,
														price,
														instock,
														productText,
														bonus,
														dealerPrice,
														main_img,
														main_img_add,
														isnew,
														productName,
														productCode,
														thumb,productName_ru,productDesc_ru,productName_en,
														productDesc_en,productText_ru,productText_en,
														featured,logicalRef,main_page_adv,cat_adv,articul,subscribe) 
										VALUES ('$product_id','$count','".$user_data['userId']."',NOW(),'$brand_id',
										'$desc','$price','$in_stock','$text','$bonus','$dealer_price',
										'$main_img','$main_img_add','$isnew','$name','$productCode','$path','$name_ru','$desc_ru','$name_en','$desc_en','$text_ru',
										'$text_en','$featured','$logicalRef','$main_page_adv','$cat_adv','$articul','$subscribe') ");
				if($result_shop) {
						$shop_product_id = mysql_insert_id();
						
						
						/* cat interting */
						$cat_str = addslashes($_POST['prod_cat_stor']);
						$cat_arr = explode(",",$cat_str);
						foreach($cat_arr as $cat_val) {
							if(!empty($cat_val) && is_numeric($cat_val)) {
								mysql_query("INSERT INTO shop_products_cat (catId,shopProductId) VALUES ('$cat_val','$shop_product_id') ");
							}
						}
						
						$tag_arr = explode(",",$tagbox);
						foreach($tag_arr as $val) {
							
							$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));
							if(!empty($tagId) && $tagId != 0) {
								mysql_query("INSERT INTO shop_product_tags (shopProductId,tagId) VALUES ('$shop_product_id','$tagId') ");	
							}
						}
						
						mysql_query("UPDATE  `product_category_list` SET `prodCount`=(SELECT COUNT(tableId) FROM shop_products_cat WHERE shop_products_cat.catId=product_category_list.categoryId)");
						
						updateChildsProdCount();
						
						//echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=product_properties&shop_product_id=".$shop_product_id." \">";  //change redirect
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=show\">";
						exit("<center>Success</center>"); 
						
				}
			
			
			
		}
		
		
	}
?>
<?php 
	if($action == "product_properties") {
		$shopProductId = (int) $_GET['shop_product_id'];
		
		//if($user_data['userType'] != "A") { if(getShopProductSellerId($shopProductId) != $user_data['userId']) { exit("Access denied"); }  }
		
		$shop_product_obj = getShopProduct($shopProductId,"az");
		//$result_prop = mysql_query("SELECT tableId,propertyId,propertyValue,productId,(SELECT propertyName FROM cat_properties cp WHERE cp.propertyId=sp.propertyId ) AS propertyName FROM shop_product_prop sp WHERE shopProductId='$shopProductId' ");
	
		$query_prop = "SELECT sp.propertyId AS propertyId,
										   p.propertyName AS propertyName,
										   p.propertyType AS propertyType 
									FROM cat_properties_link  sp , cat_properties p 
									WHERE p.propertyId=sp.propertyId AND sp.categoryId IN (SELECT catId FROM shop_products_cat WHERE shopProductId='$shopProductId' )   ";
		
		
		$result_prop = mysql_query($query_prop);
		
		print "<form action=\"\" method=\"post\">
				<table class=\"iu_table\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" width=\"98%\">
				<tr class=\"ui_table_title\">
					<td colspan=\"9\">".$shop_product_obj['productName']." -  xüsusiyyətləri <input type=\"submit\" name=\"save\"  value=\"Yadda saxla\" class=\"main_ui_button\"   /></td>
				</tr>
				<tr class=\"iu_table_header\">
					<td class=\"iu_center_short\">№</td>
					<td>Xüsusiyyətin növü</td>
					<td>Xüsusiyyət</td>
					<td>Qiymət</td>
					<td>Yeni qiymət</td>
					<td>İxtiyari qiymət</td>
				</tr>";
				$n = 1;
				$last_type = 0 ;
				while($row_prop = mysql_fetch_array($result_prop)){
					$property_obj = getCatProperty($row_prop[0]);
					if($property_obj['ismain'] == 1) { $style = " style='background-color:#99FF99;' "; } else { $style = ""; }
					
					$prop_path = getCatPropertyTypePathByProperty($row_prop[0]);
					
					print "<tr class=\"iu_table_mean\" $style>
							<td class=\"iu_center_short\">$n</td>
							<td>";
							// group by property cat
							//if($last_type == $row_prop['propCat']) { } else {  print "<b>".getCatPropertyTypeName($row_prop['propCat'])."</b>"; $last_type = $row_prop['propCat']; }
							print $prop_path;
					print   "</td>
							<td>".$row_prop['propertyName']."</td>
							<td>";
							if($row_prop['propertyType'] == "select") {
								print "<select name=\"sel_value_".$row_prop[0]."\" class=\"ui_select\">";
								print "<option value=\"0\">Seçin</option>";
								$result_value = mysql_query("SELECT itemId,itemValue FROM cat_property_items WHERE propertyId='".$row_prop[0]."' ");
								while($row_value = mysql_fetch_array($result_value)){
									print "<option value=\"".$row_value[0]."\" ";
									if(hasShopProductPropertyValue($shopProductId,$row_prop[0],$row_value[0])) { print " selected  "; }
									print ">".$row_value[1]."</option>";
								}
								
								print "</select>";
							} if($row_prop['propertyType'] == "tree"){
								
								print "<input type=\"button\" class=\"main_ui_button open_tree_popup\" value=\"Qiyməti seçin\" rel='".$row_prop[0]."' >";
								$result_value = mysql_query("SELECT propertyValue FROM shop_product_prop WHERE shopProductId='".intval($shopProductId)."' AND propertyId='".$row_prop[0]."'  ");
								
								$row_value = mysql_fetch_array($result_value);
								print "<div name=\"prop_tree_value_".$row_prop[0]."\"  id=\"prop_tree_value_".$row_prop[0]."\" class=\"prop_tree_value_class\">".getProductPropertyValue($row_value[0])."</div>";
								
								print "<input type=\"hidden\" name=\"prop_tree_".$row_prop[0]."\" id=\"prop_tree_".$row_prop[0]."\" value=\"".$row_value[0]."\">";
								
							} else {
								
								$result_value = mysql_query("SELECT itemId,itemValue FROM cat_property_items WHERE propertyId='".$row_prop[0]."' ");
								
								while($row_value = mysql_fetch_array($result_value)){
									print "<div class='prop_item_label'><input type=\"checkbox\" name=\"prop_item_".$row_prop[0]."_".$row_value[0]."\" id=\"prop_item_".$row_prop[0]."_".$row_value[0]."\" value='ok' ";
									if(hasShopProductPropertyValue($shopProductId,$row_prop[0],$row_value[0])) { print " checked "; }
									print "><label for=\"prop_item_".$row_prop[0]."_".$row_value[0]."\"  >".$row_value[1]."</label></div>";
								}
							}
							
							print "<div class='prop_item_label_custom'>".hasShopProductPropertyCustomValue($shopProductId,$row_prop[0])."</div>";
							
							print "</td>
								   <td>";
							if($row_prop['propertyType'] != "tree") print "<input type=\"checkbox\" name=\"prop_new_value_".$row_prop['propertyId']."\" id=\"prop_new_value_".$row_prop['propertyId']."\" class=\"prop_new_value_class\" value=\"yes\" /><input type=\"text\" class=\"main_ui_text\" name=\"input_value_".$row_prop['propertyId']."\" id=\"input_value_".$row_prop['propertyId']."\" placeholder=\"Yenisini əlavə edin\" disabled style='width:120px;' >";
							print 	"</td>
								   	<td>";
							if($row_prop['propertyType'] != "tree") print "<input type=\"checkbox\" name=\"prop_custom_value_".$row_prop['propertyId']."\" id=\"prop_custom_value_".$row_prop['propertyId']."\" class=\"prop_custom_value_class\" value=\"yes\" /><input type=\"text\" class=\"main_ui_text\" name=\"custom_input_value_".$row_prop['propertyId']."\" id=\"custom_input_value_".$row_prop['propertyId']."\" placeholder=\"İstənilən qiymət\" disabled style='width:120px;' >";
					print	"</td>
						</tr>";
					$n++;
				}
				
		print	"</table>
				<input type=\"hidden\" name=\"smode\" value=\"page\">
				<input type=\"hidden\" name=\"item\" value=\"shopm\">
				<input type=\"hidden\" name=\"action\" value=\"do_product_properties\">
				<input type=\"hidden\" name=\"shop_product_id\" value=\"".$shopProductId."\">";
		
	}
	if($action == "do_product_properties") {
		$shopProductId = (int) $_POST['shop_product_id'];
		
		//if($user_data['userType'] != "A") { if(getShopProductSellerId($shopProductId) != $user_data['userId']) { exit("Access denied"); }  }
		
		$shop_product_obj = getShopProduct($shopProductId);
		
		$result_del = mysql_query("DELETE FROM shop_product_prop WHERE shopProductId='$shopProductId' ");
		//$result_prop = mysql_query("SELECT tableId,propertyId,propertyValue,productId,(SELECT propertyName FROM cat_properties cp WHERE cp.propertyId=sp.propertyId ) AS propertyName FROM shop_product_prop sp WHERE shopProductId='$shopProductId' ");
		
		$query_prop = "SELECT propertyId FROM cat_properties_link  
										WHERE categoryId  IN (SELECT catId FROM shop_products_cat WHERE shopProductId='$shopProductId' )  ";
		
		$result_prop = mysql_query($query_prop);
		
		
		while($row_prop = mysql_fetch_array($result_prop)) {
			$property_type = getCatPropertyType($row_prop[0]);
			
			if(!empty($_POST['prop_custom_value_'.$row_prop[0]])) {
					$custom_val = SqlInjectFilterMini($_POST["custom_input_value_".$row_prop[0]]);
					if(!empty($custom_val)) { $result_prop_add = mysql_query("INSERT INTO shop_product_prop (shopProductId,propertyId,propertyValue,productId,customValue) VALUES ('$shopProductId','".$row_prop[0]."','0','".$shop_product_obj['productId']."','$custom_val') "); }
					updatePropertyValue($row_prop[0],$custom_val);
			} else {
					if(!empty($_POST['prop_new_value_'.$row_prop[0]])) {
						if(!empty($_POST["input_value_".$row_prop[0]])){
							$val_text = SqlInjectFilterMini($_POST["input_value_".$row_prop[0]]);
							if(!empty($val_text)) {
								$result_check = mysql_query("SELECT itemId FROM cat_property_items WHERE propertyId='".$row_prop[0]."' AND itemValue='$val_text' ");
								if(mysql_num_rows($result_check)>0) {
									$row_check = mysql_fetch_array($result_check);
									$val = $row_check[0];
								} else {
									$result_insert = mysql_query("INSERT INTO cat_property_items SET propertyId='".$row_prop[0]."',itemValue='$val_text' ");
									$val = mysql_insert_id();
								}
								$result_prop_add = mysql_query("INSERT INTO shop_product_prop (shopProductId,propertyId,propertyValue,productId) VALUES ('$shopProductId','".$row_prop[0]."','$val','".$shop_product_obj['productId']."') ");
								//updatePropertyValue($row_prop[0],$val_text);
							}
							
						}
					} else {
						
						if($property_type == "select") {
							$val = $_POST['sel_value_'.$row_prop[0]];
							$result_prop_add = mysql_query("INSERT INTO shop_product_prop (shopProductId,propertyId,propertyValue,productId) VALUES ('$shopProductId','".$row_prop[0]."','".$val."','".$shop_product_obj['productId']."') ");
						} else if($property_type == "tree") {
							$val = $_POST['prop_tree_'.$row_prop[0]];
							$result_prop_add = mysql_query("INSERT INTO shop_product_prop (shopProductId,propertyId,propertyValue,productId) VALUES ('$shopProductId','".$row_prop[0]."','".$val."','".$shop_product_obj['productId']."') ");
						} else {
							$result_value = mysql_query("SELECT itemId,itemValue FROM cat_property_items WHERE propertyId='".$row_prop[0]."' ");
							while($row_value = mysql_fetch_array($result_value)){
								if(!empty($_POST["prop_item_".$row_prop[0]."_".$row_value[0]])){
									//print $row_prop[0]." _ ".$row_value[0]
									$result_prop_add = mysql_query("INSERT INTO shop_product_prop (shopProductId,propertyId,propertyValue,productId) VALUES ('$shopProductId','".$row_prop[0]."','".$row_value[0]."','".$shop_product_obj['productId']."') ");
								}
							}	
						}
						
						
					}
			}
			
			
		}
		
		/*
		$val = "";
		while($row_prop = mysql_fetch_array($result_prop)){
			
			if($_POST['sel_value_'.$row_prop[0]] == "00") {
				if(!empty($_POST['input_value_'.$row_prop[0]]))	{
					$val_text = $_POST['input_value_'.$row_prop[0]];
					
					$result_check = mysql_query("SELECT itemId FROM cat_property_items WHERE propertyId='".$row_prop['propertyId']."' AND itemValue='$val_text' ");

				if(mysql_num_rows($result_check)>0) {
						$row_check = mysql_fetch_array($result_check);
						$val = $row_check[0];
					} else {
						$result_insert = mysql_query("INSERT INTO cat_property_items SET propertyId='".$row_prop['propertyId']."',itemValue='$val_text' ");
						$val = mysql_insert_id();
					}
					
				} else {
					print "Qiymeti daxil edin";
				}
			} else {
				$val = $_POST['sel_value_'.$row_prop[0]];	
			}
			if($val != "") {
				$result_update = mysql_query("UPDATE shop_product_prop SET propertyValue='$val' WHERE tableId='".$row_prop[0]."' ");
			}
			$val = "";
		}	
	
		*/
		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=product_properties&shop_product_id=".$shopProductId." \">";  //change redirect
		exit("<center>Success</center>");
	}
?>

<?php if($action == "edit") { 
			$shopProductId = (int) $_GET['shop_product_id'];
			
			//if($user_data['userType'] != "A") { if(getShopProductSellerId($shopProductId) != $user_data['userId']) { exit("Access denied"); }  }
			
			$base_sql = "SELECT tableId,productId,count,sellerId,addDate,brandId,productDesc,price,instock,
			productText,bonus,color,dealerPrice,main_img,isnew,productCode,productName,catId,thumb,productName_ru,main_img_add,thumb_add,
			productDesc_ru,productName_en,productDesc_en,productText_ru,productText_en,featured,logicalRef,main_page_adv,cat_adv,articul,subscribe,email_sent FROM shop_products WHERE tableId='$shopProductId' ";
			$result_sql = mysql_query($base_sql);
			$row_shop = mysql_fetch_array($result_sql);
			
			$parent_cat = getProductCategoryParentId($row_shop['catId']);
?>
		
        <form action="?" method="post"  id="add_form" enctype="multipart/form-data">
            <table class="iu_table" border="1" cellspacing="0" >
                <tr class="ui_table_title">
                    <td colspan="2"><?php echo $row_shop['productName']; ?> - redaktə et<input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
                </tr>
                
                <tr>
                	<td class="ui_labels" valign="top">Kateqoriya</td>
                    <td>
                    	<div id='catsTree' style='visibility: hidden; float: left; margin-left: 2px;'>
                        	<ul>
                        	<?php 
								
								$result_cat_first = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent=0 ");
								while($row_cat_first = mysql_fetch_array($result_cat_first)){
									print "<li item-value='".$row_cat_first['categoryId']."' ";
									if(hasProductCategoryLink($row_cat_first['categoryId'],$shopProductId)) { print " item-checked='true' "; }
									print ">".$row_cat_first['categoryName']." ";
									print 		"<ul>";
													$result_cat_second = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent='".$row_cat_first['categoryId']."' ");
													while($row_cat_second = mysql_fetch_array($result_cat_second)){
														print "<li item-value='".$row_cat_second['categoryId']."' ";
														if(hasProductCategoryLink($row_cat_second['categoryId'],$shopProductId)) { print " item-checked='true' "; }
														print ">".$row_cat_second['categoryName']."</li> ";
													}
									print  		"</ul>";
									print "</li>";
								}
								
								/*
								$result_cat_second = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent=0 ");
								while($row_cat_second = mysql_fetch_array($result_cat_second)){
									print "<li item-value='".$row_cat_second['categoryId']."' ";
									if(hasProductCategoryLink($row_cat_second['categoryId'],$shopProductId)) { print " item-checked='true' "; }
									print ">".$row_cat_second['categoryName']."</li> ";
								}
									
								*/
							?>
                            </ul>
                        </div>
                        <input type="hidden" id="prod_cat_stor" name="prod_cat_stor" 
                       		<?php 
								$result_stor = mysql_query("SELECT tableId,catId FROM shop_products_cat WHERE shopProductId='$shopProductId'  ");
								if(mysql_num_rows($result_stor)>0) {
									print " value='";
											$inc_stor=0;
											while($row_stor = mysql_fetch_array($result_stor)){
												if($inc_stor == 0) { print $row_stor[1]; } else { print ",".$row_stor[1]; }
												$inc_stor++;
											}
									print "'";	
								}
							?> 
                         />
                    </td>
                </tr>                
                <tr>
                    <td class="ui_labels">Brend seçin:</td>
                    <td>
                        <select name="brands" class="ui_select" >
                            <option value="0">Seçin</option>
                            <?php 
                                $result_brand = mysql_query("SELECT brandId,brandName FROM brands  ");
                                while($row_brand = mysql_fetch_array($result_brand)){
                                    print "<option value='".$row_brand[0]."' ";
									if($row_shop['brandId'] == $row_brand['brandId'] ) { print "selected"; }
									print ">".$row_brand[1]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="ui_labels">Malın kodu:</td>
                    <td><?php echo $row_shop['productCode']; ?> </td>
                </tr>
                <tr>
                    <td class="ui_labels">Logical ref:</td>
                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="logicalRef" maxlength="150" value="<?php echo stripslashes($row_shop['logicalRef']); ?>"  id="prod_main_name" />   </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Artikul:</td>
                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="articul" maxlength="150" value="<?php echo stripslashes($row_shop['articul']); ?>"  id="prod_main_name" />   </td>
                </tr>
                
                <tr>
                	<td colspan="2">
                    	<div id='lang_content'>
										<ul>
											<li style="margin-left: 10px;">Azəri</li>
											<li>Rus</li>
											<li>İngilis</li>
										</ul>
										<div id="az_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name" maxlength="150" value="<?php echo stripslashes($row_shop['productName']); ?>"  id="prod_main_name" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc" maxlength="150" value="<?php echo stripslashes($row_shop['productDesc']); ?>" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat:</td>
                                                    <td><textarea name="text" style="height:450px;"  ><?php echo stripslashes($row_shop['productText']); ?></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="ru_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı ru:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name_ru" maxlength="150" value="<?php echo stripslashes($row_shop['productName_ru']); ?>"  />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat ru:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc_ru" maxlength="150" value="<?php echo stripslashes($row_shop['productDesc_ru']); ?>" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat ru:</td>
                                                    <td><textarea name="text_ru" style="height:450px;"  ><?php echo stripslashes($row_shop['productText_ru']); ?></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="en_cont">
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td class="ui_labels">Malın adı en:</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="name_en" maxlength="150"  value="<?php echo stripslashes($row_shop['productName_en']); ?>"  />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels">Qisa məlumat en</td>
                                                    <td><input type="text" class="main_ui_text" style="width:500px;"  name="desc_en" maxlength="150" value="<?php echo stripslashes($row_shop['productDesc_en']); ?>" />  </td>
                                                </tr>
                                                <tr>
                                                    <td class="ui_labels" valign="top">Ətraflı məlumat en:</td>
                                                    <td><textarea name="text_en" style="height:450px;"  ><?php echo stripslashes($row_shop['productText_en']); ?></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                         </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Vəziyyəti:</td>
                    <td>
                        <select name="isnew" id="isnew" class="ui_select" >
                            <option value="1" <?php if($row_shop['isnew'] == "1") { print "selected"; } ?> >Yeni</option>
                            <option value="0" <?php if($row_shop['isnew'] == "0") { print "selected"; } ?>>İşlənmiş / Köhnə</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Qiymət:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="price"  value="<?php echo $row_shop['price']; ?>"/> AZN </td>
                </tr>
                <tr>
                    <td class="ui_labels">Diler qiyməti:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="dealer_price" value="<?php echo $row_shop['dealerPrice']; ?>" /> AZN </td>
                </tr>
                <tr>
                    <td class="ui_labels">Bonus:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="bonus" value="<?php echo $row_shop['bonus']; ?>" />  </td>
                </tr>
                <tr>
                    <td class="ui_labels">Satışda sayı:</td>
                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="count" value="<?php echo $row_shop['count']; ?>"  /> </td>
                </tr>
                <tr>
                    <td class="ui_labels">Satışda var:</td>
                    <td>
                    	<select name="in_stock" class="ui_select">
                    		<option value="-1">Seçin</option>
                            <option value="1" <?php if($row_shop['instock'] == "1") { print "selected"; } ?> >Bəli</option>
                            <option value="0" <?php if($row_shop['instock'] == "0") { print "selected"; } ?> >Xeyr</option>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td class="ui_labels">Kataloq şəkil 1:</td>
                    <td>
                    	<a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                    	<input  name='main_img' id='main_img' style='width:400px;'  class="main_ui_text"  value="<?php print $row_shop['main_img']; ?>">
                        <?php if(!empty($row_shop['main_img'])) { print "<div style=\"margin-top:5px;\"><img src=\"".$row_shop['main_img']."\" width=150></div>"; } ?>
                    </td>
                </tr>
                <tr>
                    <td class="ui_labels">Kataloq şəkil 2:</td>
                    <td>
                    	<a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img_add', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                    	<input  name='main_img_add' id='main_img_add' style='width:400px;'  class="main_ui_text" value="<?php print $row_shop['main_img_add']; ?>" >
                        <?php if(!empty($row_shop['main_img_add'])) { print "<div style=\"margin-top:5px;\"><img src=\"".$row_shop['main_img_add']."\" width=150></div>"; } ?>
                    </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Digər şəkillər:</td>
                    <td>
                    	<a href="javascript:;" onclick="mcImageManager.browse({fields : 'other_img', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                    	<input  name='other_img' id='other_img' style='width:400px;'  class="main_ui_text" value="" >
 						<img src="jpanel/jpanel_img/upload.png"  width="24" style="vertical-align:bottom; cursor:pointer;" id="prod_img_upload"  />
                        <div id="prod_images_cont">
                        	<div class="prod_img_item" style="visibility:hidden; width:1px;"></div>
                            <?php
								$result_imgs = mysql_query("SELECT tableId,img,big_img FROM shop_product_img WHERE shopProductId='$shopProductId' ");
								while($row_imgs = mysql_fetch_array($result_imgs)){
									print "<div class=\"prod_img_item\"><img src=\"".$row_imgs['big_img']."\" class=\"prod_img\"><img src=\"jpanel/jpanel_img/remove.png\"  class=\"prod_img_remove\" id='prod_img_row_".$row_imgs['tableId']."'/></div>";
								}
							?>
                        </div>
                    </td>
                </tr>
                
                
                <tr>
                    <td class="ui_labels">Seçilən:</td>
                    <td><input type="checkbox"   name="featured"  <?php if($row_shop['featured'] == 1) { print " checked=true "; }?>  /> </td>
                </tr>
                
                 <tr>
                    <td class="ui_labels">Ilkin sehife reklami:</td>
                    <td><input type="checkbox"   name="main_page_adv"  <?php if($row_shop['main_page_adv'] == 1) { print " checked=true "; }?>  /> </td>
                </tr>
                
                 <tr>
                    <td class="ui_labels">Kateqoriya reklami:</td>
                    <td><input type="checkbox"   name="cat_adv"  <?php if($row_shop['cat_adv'] == 1) { print " checked=true "; }?>  /> </td>
                </tr>
                
                <tr>
                    <td class="ui_labels">Subscribe:</td>
                    <td>
                    	<input type="checkbox"   name="subscribe"  <?php if($row_shop['subscribe'] == 1) { print " checked=true "; }  ?>  /> 
						<?php print "<span "; if($row_shop['email_sent'] == 1) { print " style='background-color:green; width:50px;display:inline-block;' ";} else { print " style='background-color:red; width:50px;display:inline-block;' "; } print ">&nbsp;</div>"; ?>
                     </td>
                </tr>
                
                
                <tr>
                	<td class="ui_labels" valign="top" >Teqlər</td>
                    <td>
                    	<input type="text" id="tagbox" class="main_ui_text" name="tagbox" style="width:500px;"/>
                    	<div>&nbsp;</div>
                        <div id="edit_tags">
                        	<?php 
								$result_tags = mysql_query("SELECT tableId,tagId,(SELECT tagText FROM tags WHERE tags.tagId=shop_product_tags.tagId ) AS tagText FROM shop_product_tags WHERE shopProductId='$shopProductId' ");
								while($row_tags = mysql_fetch_array($result_tags)){
									print "<span>".$row_tags['tagText']."<a href=\"?smode=page&item=shopm&action=delete_tag&backaction=edit&shop_product_id=$shopProductId&record=".$row_tags['tableId']."\" onclick=\"return confirm('Teqi silməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/remove.png\" /></a></span>";
								}
							?>
                        </div>
                    </td>
                </tr>

            </table><br /><br />
			<input type="hidden" name="smode" value="page"  />
			<input type="hidden" name="path" value="<?php echo $row_shop['main_img']; ?>"  />
            <input type="hidden" name="item" value="shopm"  />
            <input type="hidden" name="action" value="do_edit">
            <input type="hidden" name="product_shop_id" value="<?php echo $shopProductId; ?>">
        </form>

<?php } ?>

<?php 

	if($action == "do_edit") {

		if(!empty($_POST['prod_cat_stor']) && !empty($_POST['product_shop_id']) && !empty($_POST['name'])) {
				$shop_product_id = intval($_POST['product_shop_id']);
				$prod_sub_cat = intval($_POST['prod_sub_cat']);
				$product_id = (int) $_POST['prod_select']; 
				$brand_id = (int)  $_POST['brands'];
				
				if(!empty($_POST['featured'])) { $featured = 1; } else { $featured = 0; }
				if(!empty($_POST['main_page_adv'])) { $main_page_adv = 1; } else { $main_page_adv = 0; }
				if(!empty($_POST['cat_adv'])) { $cat_adv = 1; } else { $cat_adv = 0; }
				if(!empty($_POST['subscribe'])) { $subscribe = 1; } else { $subscribe = 0; }
				
				$price = SqlInjectFilterMini($_POST['price']); 
				$dealer_price = SqlInjectFilterMini($_POST['dealer_price']);
				$count = SqlInjectFilterMini($_POST['count']);
				$bonus = SqlInjectFilterMini($_POST['bonus']);
				$in_stock = (int)  $_POST['in_stock'];
				$desc = SqlInjectFilterMini($_POST['desc']);
				$name = SqlInjectFilterMini($_POST['name']);
				$text = addslashes(str_replace("<script","script",$_POST['text']));
				$main_img = SqlInjectFilterMini($_POST['main_img']);
				$isnew = (int) $_POST['isnew'];
				$tagbox = SqlInjectFilterMini($_POST['tagbox']);
				$upload_success = true;
				
				$logicalRef = SqlInjectFilterMini($_POST['logicalRef']);
				$articul = SqlInjectFilterMini($_POST['articul']);
				
				$desc_ru = SqlInjectFilterMini($_POST['desc_ru']);
				$name_ru = SqlInjectFilterMini($_POST['name_ru']);
				$text_ru = addslashes(str_replace("<script","script",$_POST['text_ru']));
				
				$desc_en = SqlInjectFilterMini($_POST['desc_en']);
				$name_en = SqlInjectFilterMini($_POST['name_en']);
				$text_en = addslashes(str_replace("<script","script",$_POST['text_en']));

				$productCode = $user_data['userId']."".time();
				
				$main_img = clearFileName($_POST['main_img']);
				$main_img_add = clearFileName($_POST['main_img_add']);
				/*/
				$row_images = mysql_fetch_array(mysql_query("SELECT main_img,thumb FROM shop_products WHERE tableId='$shop_product_id' "));
				$big_name = $row_images[0];
				$thumb_name = $row_images[1];
				
				// upload img if not empty 
				if(!empty($_FILES["main_img"]['name'])){
					$filename =  addslashes(htmlspecialchars($_FILES['main_img']['name']));
					$filename_tmp = htmlspecialchars($_FILES['main_img']['tmp_name']);
					$ext = substr($filename,1 + strrpos($filename,"."));
					$date_file = date("YmdHis");
					
					$uploaddir = "content_img/shop/";
					
					//if($user_data['userType'] == "A") {
						$uploaddir = "resources/content_img/shop/";
					} else if($user_data['userType'] == "S") {
						if(getSellerFolder($user_data['userId']) != "") {
							$uploaddir = "resources/content_img/sellers/".getSellerFolder($user_data['userId'])."/";	
						} else {
							$uploaddir = "resources/content_img/shop/";	
						}
						
					//} 
					
					if($_FILES["main_img"]['size'] > $max_image_size) {
						$errMsg .= 'Error: File size > '.($max_image_size/1024*1024)." MB ";
						$upload_success = false;
					} elseif (!in_array($ext, $valid_img_types)) {
						$errMsg .= 'Error: Invalid file type.';
						$upload_success = false;
					} else {
						$path = $uploaddir."".$date_file."__".$filename;
						if (move_uploaded_file($filename_tmp, $path)) {
							$upload_success = true;
							
							// thumb
							$path_thumb = $uploaddir."".$date_file."__tmp__".$filename;
							//$thumb_name = resizeImageByWidth($path,$ext,200,$path_thumb);
							$thumb_name = $path;
							
							// big
							$path_big = $uploaddir."".$date_file."__big__".$filename;
							//$big_name = resizeImageByHeight($path,$ext,640,$path_big);
							$big_name = $path;
						} else {
							$upload_success = false;
							$errMsg .= 'Error while uploading. ';
						}
					}
					
				}
				*/
				/* ---------------------------------------------------------- */
				
				
					
						$result_shop = mysql_query("UPDATE shop_products SET 
																		productId='$product_id',
																		count='$count',
																		sellerId='".$user_data['userId']."',
																		brandId='$brand_id',
																		productDesc='$desc',
																		price='$price',
																		instock='$in_stock',
																		productText='$text',
																		bonus='$bonus',
																		dealerPrice='$dealer_price',main_img='$main_img',main_img_add='$main_img_add',
																		isnew='$isnew',
																		productName='$name',
																		catId='$prod_sub_cat',
																		featured='$featured',logicalRef='$logicalRef',
																		productName_ru='$name_ru',productDesc_ru='$desc_ru',productText_ru='$text_ru',
																		productName_en='$name_en',productDesc_en='$desc_en',productText_en='$text_en',
																		main_page_adv='$main_page_adv',cat_adv='$cat_adv',articul='$articul',subscribe='$subscribe' 
												WHERE tableId='$shop_product_id' ");
						
						
						if($result_shop) {
								
								
								/* cat interting */
								$cat_str = addslashes($_POST['prod_cat_stor']);
								$cat_arr = explode(",",$cat_str);
								mysql_query("DELETE FROM shop_products_cat WHERE  shopProductId='$shop_product_id' ");
								foreach($cat_arr as $cat_val) {
									if(!empty($cat_val) && is_numeric($cat_val)) {
										mysql_query("INSERT INTO shop_products_cat (catId,shopProductId) VALUES ('$cat_val','$shop_product_id') ");
									}
								}
								
								if(!empty($tagbox)) {
									$tag_arr = explode(",",$tagbox);
									foreach($tag_arr as $val) {
										
										$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));
										if(!empty($tagId) && $tagId != 0) {
											mysql_query("INSERT INTO shop_product_tags (shopProductId,tagId) VALUES ('$shop_product_id','$tagId') ");	
										}
									}
								}
								
								mysql_query("UPDATE  `product_category_list` SET `prodCount`=(SELECT COUNT(tableId) FROM shop_products_cat WHERE shop_products_cat.catId=product_category_list.categoryId)");
								
								updateChildsProdCount();
								
								echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=show \">";  //change redirect
								exit("<center>Success</center>"); 
								
						}
					
				
											
			
		}
	}
?>
<?php 

	if($action == "delete") {

		$shop_product_id = (int) $_GET['shop_product_id'];

		$result = mysql_query("DELETE FROM shop_products WHERE tableId='$shop_product_id' ");	

		if($result) {
			$result_cat = mysql_query("DELETE FROM shop_products_cat WHERE shopProductId='$shop_product_id' ");	
			$result_tags = mysql_query("DELETE FROM shop_product_tags WHERE shopProductId='$shop_product_id' ");	
			
			$result_prop = mysql_query("DELETE FROM shop_product_prop WHERE shopProductId='$shop_product_id' ");
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=show \">";  //change redirect
			exit("<center>Success</center>"); 

		}

	}

	if($action == "delete_tag") {

		

		$shopProductId = (int) $_GET['shop_product_id'];	

		$tag_id = (int) $_GET['record'];

		//if($user_data['userType'] != "A") { if(getShopProductSellerId($shopProductId) != $user_data['userId']) { exit("Access denied"); }  }

		$result_del = mysql_query("DELETE FROM shop_product_tags WHERE tableId='$tag_id' AND shopProductId='$shopProductId' ");

		if($result_del){

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=".$_GET['backaction']."&shop_product_id=".$shopProductId." \">";  //change redirect

			exit("<center>Success</center>"); 

		}

	}

?>

<?php if($action == "product_images") { 

			$shop_product_id = (int) $_GET['shop_product_id'];

			//if($user_data['userType'] != "A") { if(getShopProductSellerId($shop_product_id) != $user_data['userId']) { exit("Access denied"); }  }

		

			$shop_product_obj = getShopProduct($shop_product_id,$lang);

?>

			

            <table id="material_gallery_table" width="600" cellpadding="5" cellspacing="0" border="1"  bordercolor="#DDDDDD" style="margin-left:15px;">

            <tr class="ui_table_title">

            	<td colspan="2"><?php print $shop_product_obj['productName']; ?></td>

            </tr>

            <tr>

                <td>

                	<form action="jpanel.php" method="post" id="prod_img_form" enctype="multipart/form-data">

                    	<input type="file" name="thumb"  />

                        <input type="hidden" name="smode" value="page" />

                        <input type="hidden" name="item" value="shopm" />

                        <input type="hidden" name="action" value="add_product_images" />

                        <input type="hidden" name="shop_product_id" value="<?php echo $shop_product_id; ?>" />

                        <input type="submit" class="main_ui_button" value="Yüklə" />

                    </form>

                </td>

                <td width="70" align="center"></td>

            </tr>

            

	<?php 

		$query_list = "SELECT img,tableId FROM shop_product_img WHERE shopProductId='$shop_product_id' ";

		$result_list = mysql_query($query_list);

    	 while($row = mysql_fetch_array($result_list)){

		 	print "<tr id='material_gallery_row_".$row['tableId']."'>

					<td><img src='".$row['img']."' width='100' height='100'></td>

					<td class='material_gallery_delete_td'><a href=\"?smode=page&item=shopm&action=delete_product_images&img=".$row['tableId']."&shop_product_id=".$shop_product_id."\"><img src='jpanel/jpanel_img/remove.png' width='20' id='".$row['tableId']."' class='material_gallery_delete_img' border=0 title='Sil' ></a></td>

				  </tr>";

		 }

        

    ?>

		

     </table>

<?php } ?>



<?php 

	if($action == "add_product_images") {

		$shop_product_id = (int) $_POST['shop_product_id'];

		//if($user_data['userType'] != "A") { if(getShopProductSellerId($shop_product_id) != $user_data['userId']) { exit("Access denied"); }  }

		$upload_success = false;

		if(!empty($shop_product_id) && !empty($_FILES["thumb"]['name'])) {
			$filename =  addslashes(htmlspecialchars($_FILES['thumb']['name']));
			$filename_tmp = htmlspecialchars($_FILES['thumb']['tmp_name']);
			$ext = substr($filename,1 + strrpos($filename,"."));
			$date_file = date("YmdHis");
			$uploaddir = "content_img/shop/";
/*
			if($user_data['userType'] == "A") {

				$uploaddir = "resources/content_img/shop/";

			} else if($user_data['userType'] == "S") {

				if(getSellerFolder($user_data['userId']) != "") {

					$uploaddir = "resources/content_img/sellers/".getSellerFolder($user_data['userId'])."/";	

				} else {

					$uploaddir = "resources/content_img/shop/";	

				}

				

			}*/

			
			if($_FILES["thumb"]['size'] > $max_image_size) {

				$errMsg .= 'Error: File size > '.($max_image_size/1024*1024)." MB ";
				$upload_success = false;

			} elseif (!in_array($ext, $valid_img_types)) {

				$errMsg .= 'Error: Invalid file type.';
				$upload_success = false;

			} else {

				$path = $uploaddir."".$date_file."__".$filename;
				if (move_uploaded_file($filename_tmp, $path)) {

					$upload_success = true;
					// thumb
					$path_thumb = $uploaddir."".$date_file."__tmp__".$filename;
					$thumb_name = resizeImageByWidth($path,$ext,90,$path_thumb);


					// big
					$path_big = $uploaddir."".$date_file."__big__".$filename;
					$big_name = resizeImageByHeight($path,$ext,640,$path_big);

				} else {

					$upload_success = false;
					$errMsg .= 'Error while uploading. ';

				}

			}


			if($upload_success) {

				$result = mysql_query("INSERT INTO shop_product_img (shopProductId,img,big_img)  VALUES ('$shop_product_id','$thumb_name','$big_name') ");
				if($result) {
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=product_images&shop_product_id=".$shop_product_id." \">";  //change redirect
					exit("<center>Success</center>"); 
				}

			} else {
				exit($errMsg);	
			}
			

		}
		

	}

	if($action == "delete_product_images") {

		$shop_product_id = (int) $_GET['shop_product_id'];
		$img = (int) $_GET['img'];
		$result = mysql_query("DELETE FROM shop_product_img WHERE tableId='$img' ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=shopm&action=product_images&shop_product_id=".$shop_product_id." \">";  //change redirect
			exit("<center>Success</center>"); 
		}

	}

?>