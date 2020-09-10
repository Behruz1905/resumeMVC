<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>

<?php if($action == "show") { ?>

			

			<table id="prod_table" cellpadding="0" cellspacing="0" border="0">

            	<tr>

                	<td>

                    	<form action="#" method="get" >

                            <table cellpadding="5" cellspacing="0" border="1" id="prod_filter_table">

                                <tr>

                                    <td class="filter_label">Kateqoriya 1</td>

                                    <td>

                                        <select id="prod_cat" name="prod_cat">

                                        	<option value="0">Seçin</option>

											<?php 

												$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");

												while($row_cat = mysql_fetch_array($result_cat)){

														print "<option value='".$row_cat[0]."'>".$row_cat[1]."</option>";

												}

											?>

                                        </select>

                                    </td>

                                </tr>

                                <tr>

                                    <td class="filter_label">Kateqoriya 2</td>

                                    <td>

                                        <select id="prod_sub_cat" name="prod_sub_cat">

                                           <option value="0">Seçin</option>

                                        </select>

                                    </td>

                                </tr>

                                <tr>

                                    <td class="filter_label">Ad</td>

                                    <td><input type="text" name="name" id="name" <?php if(!empty($_GET['name'])) { print "value='".SqlInjectFilterMini($_GET['name'])."'"; } ?>  /></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td><input type="submit" name="ok_search" value="Axtar"  /> <input type="button" id="add_product" value="Əlavə et" onclick="window.location.href='?smode=page&item=productm&action=add_prod'" /></td>

                                </tr>

                            </table>

                            <input type="hidden" name="smode" value="page"  />

                            <input type="hidden" name="item" value="productm"  />

                            <input type="hidden" name="action" value="show"  />

                        </form>

                  	</td>

                </tr>

                <tr>

                	<td>

                    	<table cellpadding="3" cellspacing="0" width="800" style="border-collapse:collapse; border-color:#CCCCCC;" border="1" >

                        	<tr>

                            	<td align="center" width="40"><strong>№</strong></td>

                                <td><strong>Adi</strong></td>

                                <td><strong>Kateqoriya</strong></td>

                                <td><strong>Brend</strong></td>

                                <td><strong>Teqlər</strong></td>

                                <td width="30"></td>

                                <td width="30"></td>

                            </tr>

                            

						<?php 

							$base_sql = "SELECT productId,productName,productAccepted,brandId FROM product_list WHERE productId IS NOT NULL ";

							$where = "";

							if($_GET["prod_sub_cat"] != "0" && !empty($_GET["prod_sub_cat"])) {

								$where.=" AND productId IN (SELECT productId FROM product_category_link WHERE categoryId='".intval($_GET['prod_sub_cat'])."' ) ";		

							} else {

								if($_GET["prod_cat"] != "0" && !empty($_GET["prod_cat"])) {

									$where.=" AND productId IN (SELECT productId FROM product_category_link WHERE categoryId IN (SELECT categoryId FROM product_category_list WHERE categoryParent='".intval($_GET['prod_cat'])."') ) ";

								}

							}

							if(!empty($_GET['name'])) {

									$where.= "AND productName LIKE '".SqlInjectFilterMini($_GET['name'])."%' ";

							}

							

							

							$sql_query = $base_sql." ".$where." ORDER BY productName ASC ";

							//print $sql_query;

							$result_prod = mysql_query($sql_query);

							$n=1;

							while($row_prod = mysql_fetch_array($result_prod)){

								print "<tr>

									  		<td align=\"center\">$n</td>

											<td valign=\"top\">".$row_prod[1]."</td>

											<td>";

											$result_cats = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE  categoryId IN (SELECT categoryId FROM product_category_link WHERE productId='".$row_prod[0]."' ) ");	

											while($row_cats = mysql_fetch_array($result_cats)) {

												print "<div>".$row_cats[1]."</div>";	

											}

								print		"</td>

											<td>".getBrandName($row_prod['brandId'])."</td>

											<td>";

											

											$result_tag = mysql_query("SELECT tagId,(SELECT tagText FROM tags t WHERE p.tagId=t.tagId ) AS tagName FROM product_tags p WHERE productId='".$row_prod[0]."' "); 

											if(mysql_num_rows($result_tag)>0) {

												$tgi = 0;

												$tags = "";

												while($row_tag = mysql_fetch_array($result_tag)){

													if($tgi == 0) {

														$tags.=$row_tag[1];

													} else {

														$tags.=",".$row_tag[1];

													}

													$tgi++;

												}

												print $tags;	

											}	

											

								print		"</td>

											<td align=\"center\"><a href=\"?smode=page&item=productm&action=edit&prod=".$row_prod[0]."\"><img src=\"jpanel/jpanel_img/edit.png\"  /></a></td>

											<td align=\"center\"><a href=\"?smode=page&item=productm&action=delete&prod=".$row_prod[0]."\"><img src=\"jpanel/jpanel_img/remove.png\"  /></a></td>

									  </tr>";

								$n++;

							}

						?>

                    </td>

                </tr>

            </table> 



<?php } ?>

<?php if($action == "add_prod") { ?>

			

            <form action="#" method="post" id="add_prod_btn" >

    		<table cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse;" >

            	<tr>

                	<td>Kateqoriya</td>

                    <td>

                    	<div id="prod_cat_iu"></div>

                        <select id="prod_cat" name="prod_cat" style="display:none;">

                            <?php 

								$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");

								while($row_cat = mysql_fetch_array($result_cat)){

									print "<optgroup label=\"".$row_cat[1]."\">";

									$result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='".$row_cat[0]."' ");

									while($row_sub = mysql_fetch_array($result_sub)){

										print "<option value='".$row_sub[0]."'>".$row_sub[1]."</option>";

									}

									print "</optgroup>";

								}

							?>

                        </select>

                        <input type="hidden" name="sel_cat" value="" id="sel_cat"  />

                    </td>

                </tr>

                <tr>

                	<td>Adı</td>

                    <td><input type="text" name="name_val" id="name_val" style="width:350px;"  /></td>

                </tr> 

                <tr>

                	<td>Teqlər</td>

                    <td><input type="text" id="tagbox" name="tagbox" style="width:400px;"/></td>

                </tr>

                <tr>

                	<td>Brend</td>

                    <td>

                    	<select name="brand" class="ui_select" >

                            	<option value="0">Seçin</option>

								<?php 

                                    $result_brand = mysql_query("SELECT brandId,brandName FROM brands ");

                                    while($row_brand = mysql_fetch_array($result_brand)){

                                        print "<option value='".$row_brand[0]."'>".$row_brand[1]."</option>";

                                    }

                                ?>

                            </select>

                    </td>

                </tr>

                <tr>

                	<td></td>

                    <td><input type="button" name="ok" id="add_prod_submit" value="Yadda saxla"  /></td>

                </tr>

            </table>

            <input type="hidden" name="smode" value="page"  />

            <input type="hidden" name="item" value="productm"  />

            <input type="hidden" name="action" value="do_add"  />

        </form>



<?php }?>

<?php 

	if($action == "do_add") {

		$name = SqlInjectFilterMini($_POST['name_val']);

		$cat = $_POST['sel_cat'];

		$brand = $_POST['brand'];

		$tagbox = $_POST['tagbox'];

		$cat_arr = explode(",",$cat);

		$result_insert = mysql_query("INSERT INTO product_list (productName,productAutorId,productAccepted,adminAdded,brandId) VALUES ('$name','0','1','1','$brand') ");

		$prod_id = mysql_insert_id();

		

		

		

		if($result_insert) {

			foreach($cat_arr as $val) {

				mysql_query("INSERT INTO product_category_link (productId,categoryId) VALUES ('$prod_id','$val') ");

			}

			if(!empty($tagbox)){

				$tag_arr = explode(",",$tagbox);

				foreach($tag_arr as $val) {

					

					$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));

					if(!empty($tagId) && $tagId != 0) {

						mysql_query("INSERT INTO product_tags (productId,tagId) VALUES ('$prod_id','$tagId') ");	

					}

				}

			}

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=productm&action=show\">";  //change redirect

			exit("<center>Success</center>"); 

		}

		

	}

?>

<?php 

	if($action == "edit") {

		$prod = $_GET['prod'];

		$result_prod = mysql_query("SELECT productId,productName,brandId FROM product_list WHERE productId='$prod' ");

		$row_prod = mysql_fetch_array($result_prod);

?>

			 <form action="#" method="post" id="add_prod_btn" >

    		<table cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse;" >

            	<tr>

                	<td>Kateqoriya</td>

                    <td>

                    	<div id="prod_cat_iu"></div>

                        <select id="prod_cat" name="prod_cat" style="display:none;">

                            <?php 

								

								

								

								$cat_inc = 0;

								$cat_ids = "";	

								$result_cats = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE  categoryId IN (SELECT categoryId FROM product_category_link WHERE productId='".$prod."' ) ");	

								while($row_cats = mysql_fetch_array($result_cats)) {

									if($cat_inc == 0) { $cat_ids .= $row_cats[0]; } else { $cat_ids .= ",".$row_cats[0]; }

									$cat_inc++;	

								}

								

								

								$result_cat = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent=0 ");

								while($row_cat = mysql_fetch_array($result_cat)){

									print "<optgroup label=\"".$row_cat[1]."\">";

									$result_sub = mysql_query("SELECT categoryId,categoryName FROM  product_category_list WHERE categoryParent='".$row_cat[0]."' ");

									while($row_sub = mysql_fetch_array($result_sub)){

										print "<option  value='".$row_sub[0]."'>".$row_sub[1]."</option>";

									}

									print "</optgroup>";

								}

							?>

                        </select>

                        <input type="hidden" name="sel_cat" value="<?php print $cat_ids; ?>" id="sel_cat"  />

                        

                    </td>

                </tr>

                <tr>

                	<td>Adı</td>

                    <td><input type="text" name="name_val" id="name_val" style="width:250px;"  value="<?php echo $row_prod[1]; ?>" /></td>

                </tr>

                 <tr>

                	<td>Teqlər</td>

                    <td>

                    	<input type="text" id="tagbox" name="tagbox" style="width:400px;" 

                        <?php 

							$result_tag = mysql_query("SELECT tagId,(SELECT tagText FROM tags t WHERE p.tagId=t.tagId ) AS tagName FROM product_tags p WHERE productId='$prod' "); 

							if(mysql_num_rows($result_tag)>0) {

								$tgi = 0;

								$tags = "";

								while($row_tag = mysql_fetch_array($result_tag)){

									if($tgi == 0) {

										$tags.=$row_tag[1];

									} else {

										$tags.=",".$row_tag[1];

									}

									$tgi++;

								}

								print " value='".$tags."' ";	

							}							

						?>

                         />

                    </td>

                </tr>

                 <tr>

                	<td>Brend</td>

                    <td>

                    	<select name="brand" class="ui_select" >

                            	<option value="0">Seçin</option>

								<?php 

                                    $result_brand = mysql_query("SELECT brandId,brandName FROM brands ");

                                    while($row_brand = mysql_fetch_array($result_brand)){

                                        print "<option value='".$row_brand[0]."' ";

										if($row_brand[0] == $row_prod[2]) { print " selected "; }

										print ">".$row_brand[1]."</option>";

                                    }

                                ?>

                            </select>

                    </td>

                </tr>

                <tr>

                	<td></td>

                    <td><input type="button" name="ok" id="add_prod_submit" value="Yadda saxla"  /></td>

                </tr>

            </table>

            <input type="hidden" name="smode" value="page"  />

            <input type="hidden" name="item" value="productm"  />

            <input type="hidden" name="action" value="do_edit"  />

            <input type="hidden" name="prod" value="<?php echo $prod; ?>"  />

        </form>



<?php		

	}

?>

<?php 

	if($action == "do_edit") {

		$name = SqlInjectFilterMini($_POST['name_val']);

		$cat = $_POST['sel_cat'];

		$prod = $_POST['prod'];

		$brand = $_POST['brand'];

		$cat_arr = explode(",",$cat);

		$tagbox = $_POST['tagbox'];

		

		$result_insert = mysql_query("UPDATE  product_list SET productName='$name',brandId='$brand' WHERE productId='$prod' ");

		$prod_id = mysql_insert_id();

		

		$result_delete = mysql_query("DELETE FROM product_category_link WHERE productId='$prod' ");

		

		if($result_insert) {

			foreach($cat_arr as $val) {

				mysql_query("INSERT INTO product_category_link (productId,categoryId) VALUES ('$prod','$val') ");

			}

			if(!empty($tagbox)){

				$result_delete = mysql_query("DELETE FROM product_tags WHERE productId='$prod' ");

				$tag_arr = explode(",",$tagbox);

				foreach($tag_arr as $val) {

					

					$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));

					if(!empty($tagId) && $tagId != 0) {

						mysql_query("INSERT INTO product_tags (productId,tagId) VALUES ('$prod','$tagId') ");	

					}

				}

			}

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=productm&action=show\">";  //change redirect

			exit("<center>Success</center>"); 

		}

	}

?>

<?php 

	if($action == "delete") {

		$prod = $_GET['prod'];

		$result_delete = mysql_query("DELETE FROM  product_list  WHERE productId='$prod' ");

		if($result_delete) {

			$result_delete_cat = mysql_query("DELETE FROM product_category_link WHERE productId='$prod' ");

			if($result_delete_cat){

				$result_delete = mysql_query("DELETE FROM product_tags WHERE productId='$prod' ");

				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=productm&action=show\">";  //change redirect

				exit("<center>Success</center>"); 

			}

		}

	}

?>