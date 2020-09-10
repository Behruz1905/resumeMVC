<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<?php 
	if($action == "show"){
?>
	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">
    	<tr class="ui_table_title">
        	<td colspan="8">Brendlər <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=brandm&action=add'"  /></td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td>Brend</td>
            <td>Kateqoriyalar</td>
            <td>Şəkil</td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			$result_brands = mysql_query("SELECT brandId,brandName,brandImg FROM brands ");
			$n = 1;
			while($row_brands = mysql_fetch_array($result_brands)){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\" valign=\"top\">$n</td>
							<td valign=\"top\">".$row_brands['brandName']."</td>
							<td valign=\"top\">";
							$result_cats = mysql_query("SELECT productCategoryId,(SELECT categoryName FROM product_category_list c WHERE b.productCategoryId=c.categoryId) FROM brand_category_link b WHERE brandId='".$row_brands[0]."' ");
							while($row_cats = mysql_fetch_array($result_cats)){
								print "<div>".$row_cats[1]."</div>";
							}
				print		"</td>
							<td valign=\"top\" align=\"center\"><img src=\"".$row_brands['brandImg']."\" width='50' /></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=brandm&action=edit&key=".$row_brands[0]."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=brandm&action=delete&key=".$row_brands[0]."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
						</tr>";
				$n++;
			}
		?>

    </table>
<?php } ?>
<?php if($action == "add") { ?>
			<form action="" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Brend əlavə et <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ad:</td><td><input type="text" name="brand_name" id="brand_name"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Kateqoriyalar:</td>
                        <td>
                        	<div id="prod_cat_iu"></div>
                            <select id="prod_cat" name="prod_cat" style="display:none;">
                                <?php 
									/*
                                    $result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");
                                    while($row_cat = mysql_fetch_array($result_cat)){
                                        print "<optgroup label=\"".$row_cat[1]."\">";
                                        $result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='".$row_cat[0]."' ");
                                        while($row_sub = mysql_fetch_array($result_sub)){
                                            print "<option value='".$row_sub[0]."'>".$row_sub[1]."</option>";
                                        }
                                        print "</optgroup>";
                                    } */
									  
									$result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");
									while($row_sub = mysql_fetch_array($result_sub)){
										print "<option value='".$row_sub[0]."'>".$row_sub[1]."</option>";
									}
								
                                    
                                ?>
                            </select>
                            <input type="hidden" name="sel_cat" value="" id="sel_cat"  />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Şəkil:</td>
                        <td>
                            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                            <input  name='main_img' id='main_img' style='width:400px;'  class="main_ui_text" >
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="brandm"  />
                <input type="hidden" name="action" value="do_add">
            </form>
<?php } ?>
<?php 
	if($action == "do_add") {
		$name = $_POST['brand_name'];
		$cat = $_POST['sel_cat'];
		$main_img = $_POST['main_img'];
		$cat_arr = explode(",",$cat);
		$result = mysql_query("INSERT INTO brands (brandName,brandImg) VALUES ('$name','$main_img') ");
		$brand_id = mysql_insert_id();
		if($result) {
			foreach($cat_arr as $val) {
				mysql_query("INSERT INTO brand_category_link (brandId,productCategoryId) VALUES ('$brand_id','$val') ");
			}
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=brandm&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print "Error";
			print mysql_error();	
		}
	}
?>
<?php 
	if($action == "edit") {
		$brand_id = (int) $_GET['key'];
		$result_seller = mysql_query("SELECT brandId,brandName,brandImg FROM brands WHERE brandId='".$brand_id."' ");
		$row_seller = mysql_fetch_array($result_seller);
?>
		
        	<form action="" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Brendi yenilə <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ad:</td><td><input type="text" name="brand_name" id="brand_name"  value="<?php echo $row_seller['brandName']; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Kateqoriyalar:</td>
                        <td>
                        	<div id="prod_cat_iu"></div>
                            <select id="prod_cat" name="prod_cat" style="display:none;">
                                <?php 
                                    
									$cat_inc = 0;
									$cat_ids = "";	
									$result_cats = mysql_query("SELECT productCategoryId FROM brand_category_link WHERE  brandId='".$brand_id."'  ");	
									while($row_cats = mysql_fetch_array($result_cats)) {
										if($cat_inc == 0) { $cat_ids .= $row_cats[0]; } else { $cat_ids .= ",".$row_cats[0]; }
										$cat_inc++;	
									}
									/*
									$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");
                                    while($row_cat = mysql_fetch_array($result_cat)){
                                        print "<optgroup label=\"".$row_cat[1]."\">";
                                        $result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='".$row_cat[0]."' ");
                                        while($row_sub = mysql_fetch_array($result_sub)){
                                            print "<option value='".$row_sub[0]."'>".$row_sub[1]."</option>";
                                        }
                                        print "</optgroup>";
                                    }
									*/
									$result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");
									while($row_sub = mysql_fetch_array($result_sub)){
										print "<option value='".$row_sub[0]."'>".$row_sub[1]."</option>";
									}
                                     
                                ?>
                            </select>
                            <input type="hidden" name="sel_cat" value="<?php print $cat_ids; ?>" id="sel_cat"  />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Şəkil:</td>
                        <td>
                            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'main_img', relative_urls : true});"><img src="jpanel/jpanel_img/image_add.png" style="vertical-align:bottom;" width="24"></a>
                            <input  name='main_img' id='main_img' style='width:400px;'  class="main_ui_text"  value="<?php print $row_seller['brandImg']; ?>">
                            <?php if(!empty($row_seller['brandImg'])) { print "<div style=\"margin-top:5px;\"><img src=\"".$row_seller['brandImg']."\" width=150></div>"; } ?>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="brandm"  />
                <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>"  />
                <input type="hidden" name="action" value="do_edit">
            </form>
        
        
<?php } ?>
<?php 
	if($action == "do_edit") {
		$brand_id = $_POST['brand_id'];
		$name = $_POST['brand_name'];
		$cat = $_POST['sel_cat'];
		$main_img = $_POST['main_img'];
		$cat_arr = explode(",",$cat);
		$result = mysql_query("UPDATE brands SET brandName='$name',brandImg='$main_img' WHERE brandId='$brand_id' ");
		$res_delete = mysql_query("DELETE FROM brand_category_link WHERE brandId='$brand_id' ");
		if($result) {
			foreach($cat_arr as $val) {
				mysql_query("INSERT INTO brand_category_link (brandId,productCategoryId) VALUES ('$brand_id','$val') ");
			}
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=brandm&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print mysql_error();	
		}
	}
	
	if($action == "delete") {
		$brand_id = (int) $_GET['key'];
		$result_cat = mysql_query("DELETE FROM brand_category_link WHERE brandId='$brand_id' ");
		$result = mysql_query("DELETE FROM brands WHERE brandId='$brand_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=brandm&action=show\">";  //change redirect
			exit("<center>Success</center>");
		}
	}
?>
