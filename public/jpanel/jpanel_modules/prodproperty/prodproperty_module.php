<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A" ) { exit("Access denied"); }  ?>

<?php $property_type = intval($_REQUEST['property_type']); ?>

<?php 

	if($action == "show") {

?>

<table id="proeprty_table" cellpadding="5" cellspacing="0" border="1" style='width:98%; margin-left:15px;'>
	<tr id="property_table_title">
    	<td colspan="12">Malların xüsusiyyətləri</td>
    </tr>

    <tr>
    	<td colspan="12">

        	<!-- <form action="?">
            	<?php 
					print	"<select name=\"property_type\" id=\"property_type\">";
					print		"<option value=\"0\"> Kateqoriyani seçin</option>";
					$result_type = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types ");
					while($row_type = mysql_fetch_array($result_type)){
						print "<option value=\"".$row_type[0]."\" ";
						if($_GET['property_type'] == $row_type[0]) { print " selected "; }
						print ">".$row_type[1]."</option>";
					}
					print	"</select>";
				?>

                <?php 
					print	"<select name=\"property_type_sub\" id=\"property_type_sub\">";
					print		"<option value=\"0\"> Sub kateqoriyani seçin</option>";
					$result_type = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types ");
					while($row_type = mysql_fetch_array($result_type)){
						print "<option value=\"".$row_type[0]."\" ";
						if($_GET['property_type'] == $row_type[0]) { print " selected "; }
						print ">".$row_type[1]."</option>";
					}
					print	"</select>";

				?>

                <select name="prop_comment" >

                	<?php 
						print		"<option value=\"0\"> İstənilən</option>";
						$result_comm = mysql_query("SELECT DISTINCT propertyDesc FROM cat_properties");
						while($row_comm = mysql_fetch_array($result_comm)){
							print "<option value=\"".$row_comm[0]."\" ";
							if($_GET['prop_comment'] == $row_comm[0]) { print " selected "; }
							print ">".$row_comm[0]."</option>"; 
						}
					?>

                </select>
                <input type="submit" name="ok" value="Filtr">
            	<input type="hidden" name="smode" value="page" />
                <input type="hidden" name="item" value="prodproperty" />
                <input type="hidden" name="action" value="show" />
            </form>-->

        </td>

    </tr>

    <tr id="property_table_header">
    	<td align="center" width="40"><strong>№</strong></td>
        <td align="left"><strong>Xüsusiyyət</strong></td>
        <td align="left"><strong>Qısa məlumat</strong></td>
        <td align="left"><strong>Xüsusiyyətin kateqoriyası</strong></td>
        <td align="left"><strong>Malın kateqoriyası</strong></td>
        <td align="center" width="100"><strong>Tip</strong></td>
        <td align="center" width="40"><strong>Görüntü</strong></td>
        <td align="center" width="40"><strong>Əsas</strong></td>
        <td align="center" width="40"><strong>Səbətdə seçim</strong></td>
        <td align="center" width="40"></td>
        <td align="center" width="40"></td>
        <td align="center" width="40"></td>

    </tr>

    <?php 
		$query_prop = "SELECT propertyId,propertyName,propertyType,propertyDesc,propertyView,ismain,basketSelect FROM cat_properties WHERE propertyId IS NOT NULL ";
		if(!empty($_GET['property_type'])) {
			$query_prop.= " AND propertyId IN (SELECT propertyId FROM cat_property_types_link WHERE catPropertyTypeId='".intval($_GET['property_type'])."'  ) "; 	
		}

		if(!empty($_GET['prop_comment'])) {
			$query_prop.= " AND propertyDesc='".addslashes($_GET['prop_comment'])."' "; 	
		}

		
		$result_prop = mysql_query($query_prop);	
		$n = 1;

		while($row_prop = mysql_fetch_array($result_prop)){
			print "<tr>
						<td>".$n."</td>
						<td>".$row_prop[1]."</td>
						<td>".$row_prop['propertyDesc']."</td>
						<td>";

						$result_cat_types = mysql_query("SELECT catPropertyTypeId FROM cat_property_types_link WHERE propertyId='".$row_prop[0]."' ");
						while($row_cat_types = mysql_fetch_array($result_cat_types)){
							print "<div>".getCatPropertyTypeName($row_cat_types[0])."</div>";
						}
			print		"</td>
						<td>";
						
						$result_cat_prods = mysql_query("SELECT l.categoryId,c.categoryName FROM cat_properties_link l LEFT JOIN product_category_list c ON c.categoryId=l.categoryId  WHERE propertyId='".$row_prop[0]."' ");
						while($row_cat_prods = mysql_fetch_array($result_cat_prods)){
							print "<div>".$row_cat_prods[1]."</div>";
						}

			print		"</td>
						<td>".$row_prop[2]."</td>
						<td>".$row_prop['propertyView']."</td>
						<td align=\"center\">".($row_prop['ismain']==1?'<img src="jpanel/jpanel_img/check.png" />':'')."</td>
						<td align=\"center\">".($row_prop['basketSelect'] == 1?'<img src="jpanel/jpanel_img/check.png" />':'')."</td>
						<td align=\"center\"><a href=\"?smode=page&item=prodproperty&action=edit&prop=".$row_prop['propertyId']."&catPropertyTypeId=".intval($_GET['property_type'])."\"><img src=\"jpanel/jpanel_img/edit.png\" border=\"0\" /></a></td>
						<td align=\"center\"><a href=\"?smode=page&item=prodproperty&action=delete&prop=".$row_prop['propertyId']."&catPropertyTypeId=".intval($_GET['property_type'])."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=\"0\" /></a></td>
						<td  align=\"center\"><a href=\"?smode=page&item=prodproperty&action=show_values&prop=".$row_prop['propertyId']."\"><img src=\"jpanel/jpanel_img/values.png\" border=\"0\" title='Hazirki qiymetler' /></a></td>
					</tr>";

			$n++;
		}
	?>
    <tr><td colspan="12"><button onclick="window.location.href='?smode=page&item=prodproperty&action=add&property_type=<?php echo $property_type; ?>'" ><img src="jpanel/jpanel_img/add.png"  style="vertical-align:middle;" /> Əlavə et </button></td></tr>
</table> 

<?php
	}
?>

<?php 

	if($action == "add") {
		$property_type = intval($_GET['property_type']);
		
		print "<form action=\"\" method=\"post\" id=\"main_form\">
					<table id=\"proeprty_table\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" width=\"700\" style=\"margin-left:10px;\">
						<tr id=\"property_table_title\">
							<td colspan=\"4\">Malların xüsusiyyətləri əlavə et - <u>".getCatPropertyTypeName($property_type)."</u></td>
						</tr>
						<tr id=\"property_table_header\">
							<td align=\"left\"><strong>Xüsusiyyət</strong></td><td><input type='text' name='name' id='item_name' style='width:250px;' /></td>
						</tr>
						<tr>	
							<td align=\"left\"><strong>Qisa melumat</strong></td><td><input type='text' name='desc' style='width:350px;' /></td>
						</tr>
						<tr>
							<td align=\"left\"><strong>Kateqoriyası</strong></td>
							<td>";
							
							print "<div id='jqxTree' style='visibility: hidden; float: left; margin-left: 0px;'>
											<ul>";

												$result_root = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId=0 ");
												while($row_root = mysql_fetch_array($result_root)){
													print "<li class=\"no_check\" item-value='".$row_root[0]."' ";
													if($row_root[0] == $property_type) { print " item-checked='true'  "; }
													print  ">".$row_root['catPropertyTypeName']." ";
													$result_sub = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId='".$row_root[0]."' "); 
													if(mysql_num_rows($result_sub)>0) {
														print "<ul>";
														while($row_sub = mysql_fetch_array($result_sub)){
															print "<li class=\"no_check\" item-value='".$row_sub[0]."' ";
															if($row_sub[0] == $property_type) { print " item-checked='true'  "; }
															print ">".$row_sub[1]."</li>";
														}
														print "</ul>";
													}
													print  "</li>";

												}

							print		" </ul>
										</div>";
							print		"<input type=\"hidden\" id=\"prop_type_stor\" name=\"prop_type_stor\" >";

		print				"</td>
						</tr>
						<tr>
							<td align=\"left\" width=\"100\"><strong>Tip</strong></td>
							<td>
								<select name=\"type\" >
									<option value=\"text\">Text</option>
									<option value=\"select\">Select</option>
									<option value=\"check\">Checkbox</option>
									<option value=\"interval\">İnterval</option>
									<option value=\"tree\">Tree</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align=\"left\" width=\"100\"><strong>Görüntü</strong></td>
							<td>
								<select name=\"view\" >
									<option value=\"text\">Text</option>
									<option value=\"select\">Select</option>
									<option value=\"check\">Checkbox</option>
									<option value=\"interval\">İnterval</option>
									<option value=\"tree\">Tree</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Əsas/əlavə</strong></td>
							<td>
								<select name=\"ismain\">
									<option value='1'>Əsas</option>
									<option value='0'>Əlavə</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Səbətdə seçim</strong></td>
							<td>
								<input type=\"checkbox\" name=\"basketSelect\" \>
							</td>
						</tr>
						<tr>
							<td colspan=\"2\"><input type=\"button\" name=\"ok\" value=\"Save\" id='save_button' /></td>
						</tr>
					</table>
					<input type=\"hidden\" name=\"smode\" value=\"page\" >
					<input type=\"hidden\" name=\"item\" value=\"prodproperty\" >
					<input type=\"hidden\" name=\"action\" value=\"do_add\" >
					<input type=\"hidden\" name=\"property_type\" value=\"".$property_type."\" >
				</form>";	

	}

	if($action == "do_add") {

		$name = $_POST['name'];
		$type = $_POST['type'];	
		$desc = $_POST['desc'];	
		$ismain = $_POST['ismain'];	
		$view = $_POST['view'];	

		if(!empty($_POST['basketSelect'])) { $basketSelect = 1; } else { $basketSelect = 0; }

		$property_type = $_POST['property_type'];
		$prop_type_str = addslashes($_POST['prop_type_stor']);
		
		$result = mysql_query("INSERT INTO cat_properties (propertyName,propertyType,propertyDesc,propertyView,ismain,basketSelect) VALUES ('$name','$type','$desc','$view','$ismain','$basketSelect') ");

		
		if($result) {
			$prop = mysql_insert_id();

				$type_arr = explode(",",$prop_type_str);
				for($i=0;$i<count($type_arr);$i++){
					if(!empty($type_arr[$i])) {
						mysql_query("INSERT INTO cat_property_types_link (catPropertyTypeId,propertyId) VALUES ('".$type_arr[$i]."','$prop') ");	
					}
				}
		
		}

		
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show&property_type=".$property_type."\">";  //change redirect
			exit("<center>Success</center>");
		}

	}

	if($action == "edit") {

		$prop = $_GET['prop'];
		$result_prop = mysql_query("SELECT propertyId,propertyName,propertyType,propertyDesc,propertyView,ismain,basketSelect FROM cat_properties WHERE propertyId='$prop' ");

		$row_prop = mysql_fetch_array($result_prop);
		$property_type = intval($_GET['catPropertyTypeId']);

		print "<form action=\"\" method=\"post\" id=\"main_form\">
					<table id=\"proeprty_table\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" width=\"500\">
						<tr id=\"property_table_title\">
							<td colspan=\"2\">Malların xüsusiyyətləri redakte et</td>
						</tr>

						<tr id=\"property_table_header\">
							<td align=\"left\">Xüsusiyyət</td><td><input type='text' name='name' id='item_name' style='width:250px;' value='".$row_prop[1]."' /></td>
						 </tr>

						 <tr>
							<td align=\"left\">Qisa melumat</td><td><input type='text' name='desc' style='width:350px;' value='".$row_prop['propertyDesc']."' /></td>
						 </tr>

						 <tr>	
							<td align=\"left\" valign=\"top\">Kateqoriyası</td>";

							print "<td>";

							print "<div id='jqxTree' style='visibility: hidden; float: left; margin-left: 0px;'>

											<ul>";
												$stor_arr = array();
												$result_types_link = mysql_query("SELECT catPropertyTypeId,propertyId FROM cat_property_types_link WHERE  propertyId='$prop' ");
												while($row_types_link = mysql_fetch_array($result_types_link)){
													$stor_arr[] = $row_types_link[0];
												}


												$result_root = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId=0 ");
												while($row_root = mysql_fetch_array($result_root)){
													print "<li class=\"no_check\" item-value='".$row_root[0]."' ";
													
													if(in_array($row_root[0],$stor_arr)) { print " item-checked='true'  "; }
													print  ">".$row_root['catPropertyTypeName']." ";
													$result_sub = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId='".$row_root[0]."' "); 

													if(mysql_num_rows($result_sub)>0) {
														print "<ul>";
														
														while($row_sub = mysql_fetch_array($result_sub)){
															print "<li class=\"no_check\" item-value='".$row_sub[0]."' ";
															if(in_array($row_sub[0],$stor_arr)) { print " item-checked='true'  "; }
															print ">".$row_sub[1]."</li>";
														}
														print "</ul>";
													}

													print  "</li>";
												}

												
							print		"	</ul>
										</div>";
							print		"<input type=\"hidden\" id=\"prop_type_stor\" name=\"prop_type_stor\" ";

										if(count($stor_arr)>0) { $res_str = ""; print " value='"; for($i=0;$i<count($stor_arr);$i++) { if($i==0) { $res_str.=$stor_arr[$i]; } else { $res_str.=",".$stor_arr[$i]; } } print $res_str; print "' "; } 

							print 		">";


					 print "</td>";
		print			 "</tr>

						 <tr>
							<td align=\"left\" width=\"100\">Tip</td>
							<td>
								<select name=\"type\" >
									<option value=\"text\" ";
									
									if($row_prop['propertyType'] == "text") { print " selected "; }
									print ">Text</option>
									
									<option value=\"select\" ";						
									if($row_prop['propertyType'] == "select") { print " selected "; }
									print ">Select</option>
									
									<option value=\"check\" ";
									if($row_prop['propertyType'] == "check") { print " selected "; }
									print ">Checkbox</option>
								
									<option value=\"interval\" ";
									if($row_prop['propertyType'] == "interval") { print " selected "; }
									print ">İnterval</option>

									<option value=\"tree\" ";
									if($row_prop['propertyType'] == "tree") { print " selected "; }
									print ">Tree</option>

								</select>
							</td>

						</tr>		

						<tr>
							<td align=\"left\" width=\"100\">Görüntü</td>
							<td>
								<select name=\"view\" >
									<option value=\"text\" ";
									if($row_prop['propertyView'] == "text") { print " selected "; }
									print ">Text</option>

									<option value=\"select\" ";
									if($row_prop['propertyView'] == "select") { print " selected "; }
									print ">Select</option>

									<option value=\"check\" ";
									if($row_prop['propertyView'] == "check") { print " selected "; }
									print ">Checkbox</option>

									<option value=\"interval\" ";
									if($row_prop['propertyView'] == "interval") { print " selected "; }
									print ">İnterval</option>

									<option value=\"tree\" ";
									if($row_prop['propertyType'] == "tree") { print " selected "; }
									print ">Tree</option>

								</select>
							</td>
						</tr>	
						<tr>
							<td>Əsas/əlavə</td>
							<td>
								<select name=\"ismain\">
									<option value='1' ";
									if($row_prop['ismain'] ==1) { print " selected "; }
				print				">Əsas</option>

									<option value='0' ";
									if($row_prop['ismain'] ==0) { print " selected "; }
				print				">Əlavə</option>
								</select>
							</td>
						</tr>	
						<tr>
							<td>Səbətdə seçim</td>
							<td>
								<input type=\"checkbox\" name=\"basketSelect\" ";
								if($row_prop['basketSelect'] == 1) { print " checked "; }
				print			"\>
							</td>

						</tr>
						<tr>
							<td colspan=\"2\"><input type=\"button\" id='save_button' name=\"ok\" value=\"Yadda saxla\" /></td>
						</tr>

					</table>
					<input type=\"hidden\" name=\"smode\" value=\"page\" >
					<input type=\"hidden\" name=\"item\" value=\"prodproperty\" >
					<input type=\"hidden\" name=\"action\" value=\"do_edit\" >
					<input type=\"hidden\" name=\"prop\" value=\"$prop\" >
					<input type=\"hidden\" name=\"catPropertyTypeId\" value=\"".$property_type."\" >

				</form>";	

	}

	if($action == "do_edit"){

		if(empty($_POST['prop']) || !is_numeric($_POST['prop'])) { exit("Invalid paramater"); }
		$prop = intval($_POST['prop']);
		$name = $_POST['name'];
		$desc = $_POST['desc'];	
		$ismain = (int)$_POST['ismain'];	
		$view = $_POST['view'];	

		$property_type = (int)$_POST['catPropertyTypeId'];
		$prop_type_str = addslashes($_POST['prop_type_stor']);

		if(!empty($_POST['basketSelect'])) { $basketSelect = 1; } else { $basketSelect = 0; }

		$result = mysql_query("UPDATE cat_properties SET propertyName='$name',propertyType='$type',propertyDesc='$desc',propertyView='$view',ismain='$ismain',basketSelect='$basketSelect' WHERE  propertyId='$prop' ");


		if($result) {
			$result_delete = mysql_query("DELETE FROM cat_property_types_link WHERE propertyId='$prop' ");
			if($result_delete) {
				$type_arr = explode(",",$prop_type_str);
				for($i=0;$i<count($type_arr);$i++){
					if(!empty($type_arr[$i])) {
						mysql_query("INSERT INTO cat_property_types_link (catPropertyTypeId,propertyId) VALUES ('".$type_arr[$i]."','$prop') ");	
					}
				}
			}
		}

		

		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show&property_type=".$property_type."\">";  //change redirect
			exit("<center>Success</center>");
		}

	}

	if($action == "delete") {

		$prop = $_GET['prop'];
		$catPropertyTypeId = intval($_GET['catPropertyTypeId']);
		$result = mysql_query("DELETE FROM cat_properties WHERE  propertyId='$prop' ");

		if($result) {
			$result_link_type = mysql_query("DELETE FROM cat_property_types_link WHERE propertyId='$prop' ");
			$result_shop = mysql_query("DELETE FROM shop_product_prop WHERE propertyId='$prop' ");
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show&property_type=".$catPropertyTypeId."\">";  //change redirect
			exit("<center>Success</center>");

		}
	}

?>

<?php 

	if($action == "add_property_to_cat") {
		$cat = intval($_GET['cat']);
		if(empty($cat)) { exit("Incalid parameter"); } 
		$cat_row = mysql_fetch_array(mysql_query("SELECT categoryName FROM product_category_list WHERE categoryId='$cat' "));
		$query_cat = "SELECT propertyId,categoryId,defaultValue,tableId FROM cat_properties_link WHERE categoryId='$cat' ";
		$result_cat = mysql_query($query_cat);

		print "<table cellpadding=\"5\" cellspacing=\"0\" border=\"1\" style=\"border-collapse:collapse; margin-left:15px;\"  >
				<tr>
					<td width=\"40\"><strong>№</strong></td>
					<td><strong>Kategoriya</strong></td>
					<td><strong>Xüsusiyyət</strong></td>
					<td><strong>İlkin qiymət</strong></td>
					<td></td>
				</tr>";

		print 	"<tr>
					<td align=\"center\"><img src=\"jpanel/jpanel_img/add_big.png\"  id='add_property'  style='cursor:pointer;' /></td>
					<td>".$cat_row[0]."</td>
					<td>

						<div id='jqxTree' style='visibility: hidden; float: left; margin-left: 20px;'>
							<ul>";
								$result_root = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId=0 ");
								while($row_root = mysql_fetch_array($result_root)){
									print "<li >".$row_root['catPropertyTypeName']." ";
									print "<ul>";
										/* oz propertyleri */
										print "<li><i>Uncategorized</i>";
										print 		"<ul>";

														$result_own_prop = mysql_query("SELECT l.propertyId,n.propertyName FROM cat_property_types_link l LEFT JOIN cat_properties n ON n.propertyId=l.propertyId WHERE catPropertyTypeId='".$row_root[0]."' ");
														while($row_own_prop = mysql_fetch_array($result_own_prop)){

															print "<li item-value='".$row_own_prop[0]."' ";
															if(hasProductCatProperty($cat,$row_own_prop[0])) { print " item-checked='true' "; }
															print ">".$row_own_prop[1]."</li>"; 

														}

										print 		"</ul>";
										print "</li>";

									

									$result_sub = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId='".$row_root[0]."' "); 
									if(mysql_num_rows($result_sub)>0) {

										
										while($row_sub = mysql_fetch_array($result_sub)){
											print "<li ><i>".$row_sub[1]."</i>";
											print 		"<ul>";
														$result_sub_prop = mysql_query("SELECT l.propertyId,n.propertyName FROM cat_property_types_link l LEFT JOIN cat_properties n ON n.propertyId=l.propertyId WHERE catPropertyTypeId='".$row_sub[0]."' ");
														while($row_sub_prop = mysql_fetch_array($result_sub_prop)){

															print "<li item-value='".$row_sub_prop[0]."' ";
															if(hasProductCatProperty($cat,$row_sub_prop[0])) { print " item-checked='true' "; }
															print ">".$row_sub_prop[1]."</li>"; 

														}

											print 		"</ul>";
											print "</li>";

										}

									}

									print "</ul>";
									print  "</li>";

								}


			print		"	</ul>
						</div>
					</td>
					<td></td>
					<td></td>
				</tr>";


		$n=1;

		while($row_cat = mysql_fetch_array($result_cat)){
			$row_prop = mysql_fetch_array(mysql_query("SELECT propertyName FROM cat_properties WHERE propertyId='".$row_cat[0]."' "));
			print   "<tr>
						<td>".$n."</td>
						<td>".$cat_row[0]."</td>
						<td>".$row_prop[0]."</td>
						<td>".$row_cat['defaultValue']."</td>
						<td><a href='?smode=page&item=prodproperty&action=delete_property_to_cat&parent=0&tableId=".$row_cat['tableId']."&cat=".$cat."'><img src=\"jpanel/jpanel_img/remove.png\"  /></a></td>
					</tr>";

			$n++;

		}

		

		print "</table>";
		print 		"<form action=\"?\" method=\"post\" id=\"main_form\">";
		print		"<input type=\"hidden\" id=\"prop_type_stor\" name=\"prop_type_stor\" ";
						$result_stor = mysql_query("SELECT propertyId FROM cat_properties_link WHERE categoryId='$cat' ");				
						$res_str = "";
						$inc = 0;
						print " value='";
						while($row_stor = mysql_fetch_array($result_stor)){
							if($inc == 0) { $res_str.=$row_stor[0]; } else { $res_str.=",".$row_stor[0]; }
							$inc++;
						}
						print $res_str;
						print "' ";


		print 		">";
		print  			"<input type=\"hidden\" name=\"smode\" value=\"page\" >
						<input type=\"hidden\" name=\"item\" value=\"prodproperty\" >
						<input type=\"hidden\" name=\"action\" value=\"do_add_property_to_cat\" >
						<input type=\"hidden\" name=\"cat\" id=\"cat_stor\" value=\"$cat\" >";
		print 		"</form>";

	}

	if($action == "do_add_property_to_cat"){

		$cat = (int) $_POST['cat'];
		$prop_str = addslashes($_POST['prop_type_stor']);

		$result_delete = mysql_query("DELETE FROM cat_properties_link WHERE categoryId='$cat' ");
		if($result_delete) {

			$type_arr = explode(",",$prop_str);
			for($i=0;$i<count($type_arr);$i++){
				if(!empty($type_arr[$i])) {
					mysql_query("INSERT INTO cat_properties_link (propertyId,categoryId) VALUES ('".$type_arr[$i]."','$cat') ");	
				}
			}

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=add_property_to_cat&parent=0&cat=".$cat."\">";  //change redirect
			exit("<center>Success</center>");

		} else {

			exit("DELETE error");	

		}

		
		

	}

	if($action == "delete_property_to_cat"){
		$tableId = (int) $_GET['tableId'];
		$cat = (int) $_GET['cat'];
		$result = mysql_query("DELETE FROM cat_properties_link WHERE tableId='$tableId' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=add_property_to_cat&parent=0&cat=".$cat."\">";  //change redirect
			exit("<center>Success</center>");
		}

	}


	if($action == "show_values") {


		$prop_id = (int) $_GET['prop'];
		$row_prop_same = mysql_fetch_array(mysql_query("SELECT propertyName FROM cat_properties WHERE propertyId='$prop_id' "));

		print "<table id=\"proeprty_table\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" width=\"600\">
				<tr id=\"property_table_title\">
					<td colspan=\"5\">".$row_prop_same['0']." qiymətləri</td>
				</tr>

				<tr id=\"property_table_header\">
					<td align=\"center\" width=\"40\"><strong>№</strong></td>
					<td align=\"left\"><strong>Xüsusiyyətin qiyməti</strong></td>
					<td align=\"center\" width=\"50\"><strong>Təsdiq</strong></td>
					<td align=\"center\" width=\"50\"><strong>Dəyiş</strong></td>
					<td align=\"center\" width=\"50\"><strong>Sil</strong></td>
				</tr>";

		$n=1;	

		$result_value  = mysql_query("SELECT itemId,itemValue,accepted FROM cat_property_items WHERE propertyId='$prop_id' ");
		while($row_value = mysql_fetch_array($result_value)){
			if($row_value[2] ==1) { $status = "<a href='?smode=page&item=prodproperty&action=switch_item_status&mode=deactive&item_id=".$row_value[0]."&prop=".$prop_id."'><img src=\"jpanel/jpanel_img/ok.png\" border=\"0\"  /></a>"; }
			else { $status = "<a  href='?smode=page&item=prodproperty&action=switch_item_status&mode=active&item_id=".$row_value[0]."&prop=".$prop_id."'><img src=\"jpanel/jpanel_img/stop.png\" border=\"0\"  /></a>"; }

			print "<tr>
					   <td align=\"center\">".$n."</td>
					   <td>".$row_value[1]."</td>
					   <td align=\"center\">".$status."</td>
					   <td align=\"center\"><a href='?smode=page&item=prodproperty&action=edit_item_value&prop=".$prop_id."&item_id=".$row_value[0]."'><img src=\"jpanel/jpanel_img/edit.png\" border=\"0\"  /></a></td>
					   <td align=\"center\"><a href='?smode=page&item=prodproperty&action=delete_item_value&prop=".$prop_id."&item_id=".$row_value[0]."' onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=\"0\"  /></a></td>
				   </tr>";

			$n++;

		}

		print "</table>";

	}

	

	if($action == "switch_item_status") {
		$item_id = (int) $_GET['item_id'];
		$prop_id = (int) $_GET['prop'];
		if($_GET['mode'] == "active") {
			$result = mysql_query("UPDATE cat_property_items SET accepted='1' WHERE itemId='$item_id' ");	
		} else {
			$result = mysql_query("UPDATE cat_property_items SET accepted='0' WHERE itemId='$item_id' ");	
		}

		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show_values&prop=".$prop_id." \">";  //change redirect
			exit("<center>Success</center>");	

		}

	}

	if($action == "edit_item_value") {

		$item_id = (int) $_GET['item_id'];
		$prop_id = (int) $_GET['prop'];
		$row_item = mysql_fetch_array(mysql_query("SELECT itemValue FROM cat_property_items WHERE itemId='$item_id' "));
		
		print "<form action=\"user_mnadmin.php\" method=\"post\">
					<input type=\"text\" name=\"name\" value=\"".$row_item[0]."\" style=\"width:300px;\" >";
		print		"<input type=\"submit\" name=\"ok\" value=\"Yadda saxla\">
					<input type=\"hidden\" name=\"smode\" value=\"page\" >
					<input type=\"hidden\" name=\"item\" value=\"prodproperty\" >
					<input type=\"hidden\" name=\"action\" value=\"do_edit_item_value\" >
					<input type=\"hidden\" name=\"item_id\" value=\"".$item_id."\" >
					<input type=\"hidden\" name=\"prop\" value=\"".$prop_id."\" >
				</form>";

	}

	if($action == "do_edit_item_value") {

		$item_id = (int) $_POST['item_id'];
		$prop_id = (int) $_POST['prop'];
		$name = addslashes(htmlspecialchars($_POST['name']));
		$result_update = mysql_query("UPDATE cat_property_items SET itemValue='$name' WHERE itemId='$item_id' ");

		if($result_update){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show_values&prop=".$prop_id." \">";  //change redirect
			exit("<center>Success</center>");	

		}

	}

	if($action == "delete_item_value") {

		$item_id = (int) $_GET['item_id'];
		$prop_id = (int) $_GET['prop'];

		$result_del = mysql_query("DELETE FROM cat_property_items WHERE itemId='$item_id' ");
		if($result_del) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodproperty&action=show_values&prop=".$prop_id." \">";  //change redirect
			exit("<center>Success</center>");	

		}

	}


?>