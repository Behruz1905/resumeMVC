<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A" && $user_data['userType'] != "MK") exit("Access denied");   ?>
<div id="module_cont"  style="margin-left:10px;">
	<div id="module_header">Malların kateqoriyaları</div>
    <div id="module_mean" >
    	
    	<div class="module_mean_left">
        	<table class="module_mean_table" cellspacing="0" border="1">
            <tr><td colspan="7"><b>1 ci səviyyə</b></td></tr>
            	<?php 
					if(empty($_GET['parent'])) {
						$parent = 0;	
					}
					$result_cat = mysql_query("SELECT categoryId,categoryName,categoryName_ru,categoryName_en,place,mainPage,tooltip_az,tooltip_ru,tooltip_en,
												(SELECT MIN(place) FROM product_category_list WHERE categoryParent=0) AS minCat,
												(SELECT MAX(place) FROM product_category_list WHERE categoryParent=0) AS maxCat 
												 FROM product_category_list WHERE categoryParent=0  ORDER BY place ");
					$n=1;
					while($row_cat = mysql_fetch_array($result_cat)){
						if($action == "edit_cat" && $_GET['cat'] == $row_cat[0]){
							print "<tr>
								   	<td colspan=\"7\" nowrap=\"nowrap\">
										<form action=\"?\" method=\"post\">
											<select name=\"new_parent\">
												<option value=\"0\">Root</option>";
												$result_cat_sub = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent=0 ");
												while($row_cat_sub = mysql_fetch_array($result_cat_sub)){
													print "<option value=\"".$row_cat_sub[0]."\">".$row_cat_sub[1]."</option>";
												}
							print			"</select>
											<input type='text' name='cat_name' style='width:160px;'  value=\"".$row_cat[1]."\"/>
											<input type='text' name='cat_name_ru' style='width:160px;' placeholder=\"ru\"  value=\"".$row_cat['categoryName_ru']."\"/>
											<input type='text' name='cat_name_en' style='width:160px;' placeholder=\"en\"  value=\"".$row_cat['categoryName_en']."\"/>
											
											<input type=\"submit\" name=\"ok\" value=\"Send\" />
											<br/>
											<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" >".$row_cat['tooltip_az']."</textarea>
											<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\" >".$row_cat['tooltip_ru']."</textarea>
											<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" >".$row_cat['tooltip_en']."</textarea>
											
											
											<input type=\"hidden\" name=\"smode\" value=\"page\" />
											<input type=\"hidden\" name=\"item\" value=\"prodcat\" />
											<input type=\"hidden\" name=\"parent\" value=\"0\" />
											<input type=\"hidden\" name=\"cat\" value=\"".$_GET['cat']."\" />
											<input type=\"hidden\" name=\"action\" value=\"do_edit_cat\" /> 
										</form>
									</td>
								   </tr>";
						} else {
							if($row_cat['mainPage'] == "1") {
								$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=stop_main&parent=0&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/ok.png\"  /></a>";
							} else {
								$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=set_main&parent=0&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/stop.png\"  /></a>";
							}
							print "<tr>
								<td align=\"center\" width=\"30\">".$n."</td>
								<td><a href=\"?smode=page&item=prodcat&parent=".$row_cat[0]."\">".$row_cat[1]."</a></td>
								<td width=\"40\" align=\"center\"><a href=\"?smode=page&item=prodcat&action=edit_cat&parent=".$parent."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/edit.png\"   border=\"0\" /></a></td>
									<td class=\"sowting_arrows\" width=\"40\" align=\"center\">";
									if($row_cat['place'] != $row_cat['minCat']) { print "<a href='?smode=page&item=prodcat&parent=".$parent."&action=sort&type=up&cat=".$row_cat[0]."'>&uarr;</a>"; }
									if($row_cat['place'] != $row_cat['maxCat']) { print "<a href='?smode=page&item=prodcat&parent=".$parent."&action=sort&type=down&cat=".$row_cat[0]."'>&darr;</a>"; }
							print "</td>
								<td width=\"40\" align=\"center\" title=\"Xususiyyetleri\"><a href=\"?smode=page&item=prodproperty&action=add_property_to_cat&parent=0&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/properties.png\" border=0  /></a></td>
								<td align=\"center\" title=\"Bash sehife\">$main_p</td>";
								if($user_data['userType'] != "MK") { print "<td width=\"40\" align=\"center\"><a onclick=\"return confirm('Silinsin?');\" href=\"?smode=page&item=prodcat&action=delete_cat&parent=".$parent."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/remove.png\"   border=\"0\" /></a></td>"; }
								
							print "</tr>";	
							$n++;
						}
						
					}
				?>
               	<tr>
                	<td colspan="7" align="left">&nbsp;<a href="?smode=page&item=prodcat&action=add_cat&parent=0" ><img src="jpanel/jpanel_img/add.png" border="0" /></a></td>
                </tr>
                <?php 
					if($action == "add_cat" && $_GET['parent'] == 0) {
						print "<tr>
									<td colspan=7 align='left'>
										<form action='' method='post'>
											<input type='text' name='cat_name' style='width:160px;' />
											<input type='text' name='cat_name_ru' style='width:160px;' placeholder=\"ru\" />
											<input type='text' name='cat_name_en' style='width:160px;' placeholder=\"en\" />
											
											
											<br/>
											<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" ></textarea>
											<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\"></textarea>
											<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" ></textarea>
											<input type=\"submit\" name=\"ok\" value=\"Save\" />
											
											<input type=\"hidden\" name=\"smode\" value=\"page\" />
											<input type=\"hidden\" name=\"item\" value=\"prodcat\" />
											<input type=\"hidden\" name=\"parent\" value=\"0\" />
											<input type=\"hidden\" name=\"action\" value=\"do_add_cat\" /> 
										</form>
									</td>
							  </tr>";	
					}
				?>
            </table>
        </div>
        
        <?php if($_GET['parent'] != 0) { ?>
   			
                    <div class="module_mean_left">
                    <table class="module_mean_table" cellspacing="0" border="1">
                    	<tr><td colspan="7"><b>2 ci səviyyə</b></td></tr>
                        <?php 
                            $result_cat = mysql_query("SELECT categoryId,categoryName,categoryName_ru,categoryName_en,place,mainPage,tooltip_az,tooltip_ru,tooltip_en,
							(SELECT MIN(place) FROM product_category_list WHERE categoryParent='".$_GET['parent']."') AS minCat,
							(SELECT MAX(place) FROM product_category_list WHERE categoryParent='".$_GET['parent']."') AS maxCat  
							 FROM product_category_list WHERE categoryParent='".$_GET['parent']."' ORDER BY place ");
                            $n=1;
							while($row_cat = mysql_fetch_array($result_cat)){
                                if($_GET['action'] == "edit_cat" && $_GET['cat'] == $row_cat[0] && empty($_GET['subparent'])){
                                    print "<tr>
                                            <td colspan=\"7\" nowrap=\"nowrap\">
                                                <form action=\"?\" method=\"post\">
                                                    <select name=\"new_parent\">
                                                        <option value=\"0\">Root</option>";
                                                        $result_cat_sub = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent=0 ");
                                                        while($row_cat_sub = mysql_fetch_array($result_cat_sub)){
                                                            print "<option value=\"".$row_cat_sub[0]."\" ";
															if($row_cat_sub[0] == $_GET['parent']) { print " selected "; }
															print ">".$row_cat_sub[1]."</option>";
                                                        }
                                    print			"</select>
                                                    <input type='text' name='cat_name' style='width:160px;'  value=\"".$row_cat[1]."\"/>
													<input type='text' name='cat_name_ru' style='width:160px;'  value=\"".$row_cat['categoryName_ru']."\" placeholder=\"ru\"/>
													<input type='text' name='cat_name_en' style='width:160px;'  value=\"".$row_cat['categoryName_en']."\" placeholder=\"en\"/>
													<input type=\"submit\" name=\"ok\" value=\"Send\" />
													
													<br/>
													<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" >".$row_cat['tooltip_az']."</textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\" >".$row_cat['tooltip_ru']."</textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" >".$row_cat['tooltip_en']."</textarea>
													
													
                                                    
                                                    <input type=\"hidden\" name=\"smode\" value=\"page\" />
                                                    <input type=\"hidden\" name=\"item\" value=\"prodcat\" />
                                                    <input type=\"hidden\" name=\"parent\" value=\"".$_GET['parent']."\" />
                                                    <input type=\"hidden\" name=\"cat\" value=\"".$_GET['cat']."\" />
                                                    <input type=\"hidden\" name=\"action\" value=\"do_edit_cat\" /> 
												</form>
                                            </td>
                                           </tr>";
                                } else {
                                    if($row_cat['mainPage'] == "1") {
										$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=stop_main&parent=".$_GET['parent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/ok.png\"  /></a>";
									} else {
										$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=set_main&parent=".$_GET['parent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/stop.png\"  /></a>";
									}
									
									print "<tr>
										<td align=\"center\" width=\"30\">".$n."</td>
                                        <td><a href=\"?smode=page&item=prodcat&parent=".$_GET['parent']."&subparent=".$row_cat[0]."\">".$row_cat[1]."</a></td>
                                        <td width=\"40\" align=\"center\"><a href=\"?smode=page&item=prodcat&action=edit_cat&parent=".$_GET['parent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/edit.png\"   border=\"0\" /></a></td>
                                        <td class=\"sowting_arrows\" width=\"40\" align=\"center\">";
											if($row_cat['place'] != $row_cat['minCat']) { print "<a href='?smode=page&item=prodcat&parent=".$_GET['parent']."&action=sort&type=up&cat=".$row_cat[0]."'>&uarr;</a>"; }
											if($row_cat['place'] != $row_cat['maxCat']) { print "<a href='?smode=page&item=prodcat&parent=".$_GET['parent']."&action=sort&type=down&cat=".$row_cat[0]."'>&darr;</a>"; }
									print "</td>
										<td width=\"40\" align=\"center\" title=\"Xususiyyetleri\"><a href=\"?smode=page&item=prodproperty&action=add_property_to_cat&parent=0&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/properties.png\" border=0  /></a></td>
										<td align=\"center\"  width=\"40\" >$main_p</td>";
										if($user_data['userType'] != "MK") { print "<td width=\"40\" align=\"center\"><a onclick=\"return confirm('Silinsin?');\" href=\"?smode=page&item=prodcat&action=delete_cat&parent=".$_GET['parent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/remove.png\"   border=\"0\" /></a></td>"; }
                                    print "</tr>";	
									$n++;
                                }
                                
                            }
                        ?>
                        <tr>
                            <td colspan="7" align="left">&nbsp;<a href="?smode=page&item=prodcat&action=add_cat&parent=<?php echo $_GET['parent']; ?>" ><img src="jpanel/jpanel_img/add.png" border="0" /></a></td>
                        </tr>
                        <?php 
                            if($action == "add_cat" && empty($_GET['subparent'])) {
                                print "<tr>
                                            <td colspan=7 align='left'>
                                                <form action='' method='post'>
                                                    <input type='text' name='cat_name' style='width:160px;' placeholder=\"az\" />
													<input type='text' name='cat_name_ru' style='width:160px;' placeholder=\"ru\" />
													<input type='text' name='cat_name_en' style='width:160px;' placeholder=\"en\" />
													
													<br/>
													<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" ></textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\"></textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" ></textarea>
													<br/>
                                                    <input type=\"submit\" name=\"ok\" value=\"Send\" />
                                                    <input type=\"hidden\" name=\"smode\" value=\"page\" />
                                                    <input type=\"hidden\" name=\"item\" value=\"prodcat\" />
                                                    <input type=\"hidden\" name=\"parent\" value=\"".$_GET['parent']."\" />
                                                    <input type=\"hidden\" name=\"action\" value=\"do_add_cat\" /> 
                                                </form>
                                            </td>
                                      </tr>";	
                            }
                        ?>
                    </table>
                </div>
        
        <?php } ?>
        
        <!------------------------- Third layer ----------------------------------------->
        <?php if($_GET['subparent'] != 0) { ?>
   			
                    <div class="module_mean_left">
                    <br/>
                    <table class="module_mean_table" cellspacing="0" border="1">
                    	<tr><td colspan="7"><b>3 cü səviyyə</b></td></tr>
                        <?php 
                            $result_cat = mysql_query("SELECT categoryId,categoryName,categoryName_ru,categoryName_en,place,mainPage,tooltip_az,tooltip_ru,tooltip_en,
							(SELECT MIN(place) FROM product_category_list WHERE categoryParent='".$_GET['subparent']."') AS minCat,
							(SELECT MAX(place) FROM product_category_list WHERE categoryParent='".$_GET['subparent']."') AS maxCat  
							 FROM product_category_list WHERE categoryParent='".$_GET['subparent']."' ORDER BY place ");
                            $n=1;
							while($row_cat = mysql_fetch_array($result_cat)){
                                if($_GET['action'] == "edit_cat" && $_GET['cat'] == $row_cat[0]){
                                    print "<tr>
                                            <td colspan=\"7\" nowrap=\"nowrap\">
                                                <form action=\"?\" method=\"post\">
                                                    <select name=\"new_parent\">
                                                        <option value=\"0\">Root</option>";
                                                        $result_cat_sub = mysql_query("SELECT categoryId,categoryName FROM product_category_list WHERE categoryParent='".$_GET['parent']."' ");
                                                        while($row_cat_sub = mysql_fetch_array($result_cat_sub)){
                                                            print "<option value=\"".$row_cat_sub[0]."\" ";
															if($row_cat_sub[0] == $_GET['subparent']) { print " selected "; }
															print ">".$row_cat_sub[1]."</option>";
                                                        }
                                    print			"</select>
                                                    <input type='text' name='cat_name' style='width:160px;'  value=\"".$row_cat[1]."\"/>
													<input type='text' name='cat_name_ru' style='width:160px;'  value=\"".$row_cat['categoryName_ru']."\" placeholder=\"ru\"/>
													<input type='text' name='cat_name_en' style='width:160px;'  value=\"".$row_cat['categoryName_en']."\" placeholder=\"en\"/>
													<input type=\"submit\" name=\"ok\" value=\"Send\" />
													
													<br/>
													<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" >".$row_cat['tooltip_az']."</textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\" >".$row_cat['tooltip_ru']."</textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" >".$row_cat['tooltip_en']."</textarea>
													
													
                                                    
                                                    <input type=\"hidden\" name=\"smode\" value=\"page\" />
                                                    <input type=\"hidden\" name=\"item\" value=\"prodcat\" />
                                                    <input type=\"hidden\" name=\"parent\" value=\"".$_GET['parent']."\" />
													<input type=\"hidden\" name=\"subparent\" value=\"".$_GET['subparent']."\" />
                                                    <input type=\"hidden\" name=\"cat\" value=\"".$_GET['cat']."\" />
                                                    <input type=\"hidden\" name=\"action\" value=\"do_edit_cat\" /> 
												</form>
                                            </td>
                                           </tr>";
                                } else {
                                    if($row_cat['mainPage'] == "1") {
										$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=stop_main&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/ok.png\"  /></a>";
									} else {
										$main_p = "<a href=\"?smode=page&item=prodcat&action=switch_to_main&type=set_main&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/stop.png\"  /></a>";
									}
									
									print "<tr>
										<td align=\"center\" width=\"30\">".$n."</td>
                                        <td><a href=\"#\">".$row_cat[1]."</a></td>
                                        <td width=\"40\" align=\"center\"><a href=\"?smode=page&item=prodcat&action=edit_cat&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/edit.png\"   border=\"0\" /></a></td>
                                        <td class=\"sowting_arrows\" width=\"40\" align=\"center\">";
											if($row_cat['place'] != $row_cat['minCat']) { print "<a href='?smode=page&item=prodcat&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&action=sort&type=up&cat=".$row_cat[0]."'>&uarr;</a>"; }
											if($row_cat['place'] != $row_cat['maxCat']) { print "<a href='?smode=page&item=prodcat&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&action=sort&type=down&cat=".$row_cat[0]."'>&darr;</a>"; }
									print "</td>
										<td width=\"40\" align=\"center\" title=\"Xususiyyetleri\"><a href=\"?smode=page&item=prodproperty&action=add_property_to_cat&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/properties.png\" border=0  /></a></td>
										<td align=\"center\"  width=\"40\" >$main_p</td>";
										if($user_data['userType'] != "MK") { print "<td width=\"40\" align=\"center\"><a onclick=\"return confirm('Silinsin?');\" href=\"?smode=page&item=prodcat&action=delete_cat&parent=".$_GET['parent']."&subparent=".$_GET['subparent']."&cat=".$row_cat[0]."\"><img src=\"jpanel/jpanel_img/remove.png\"   border=\"0\" /></a></td>"; }
                                    print "</tr>";	
									$n++;
                                }
                                
                            }
                        ?>
                        <tr>
                            <td colspan="7" align="left">&nbsp;<a href="?smode=page&item=prodcat&action=add_cat&parent=<?php echo $_GET['parent']; ?>&subparent=<?php echo $_GET['subparent']; ?>" ><img src="jpanel/jpanel_img/add.png" border="0" /></a></td>
                        </tr>
                        <?php 
                            if($action == "add_cat") {
                                print "<tr>
                                            <td colspan=7 align='left'>
                                                <form action='' method='post'>
                                                    <input type='text' name='cat_name' style='width:160px;' placeholder=\"az\" />
													<input type='text' name='cat_name_ru' style='width:160px;' placeholder=\"ru\" />
													<input type='text' name='cat_name_en' style='width:160px;' placeholder=\"en\" />
													
													<br/>
													<textarea class=\"tooltip_area\" name=\"tooltip_az\" placeholder=\"Tooltip az\" ></textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_ru\" placeholder=\"Tooltip ru\"></textarea>
													<textarea class=\"tooltip_area\" name=\"tooltip_en\" placeholder=\"Tooltip en\" ></textarea>
													<br/>
                                                    <input type=\"submit\" name=\"ok\" value=\"Send\" />
                                                    <input type=\"hidden\" name=\"smode\" value=\"page\" />
                                                    <input type=\"hidden\" name=\"item\" value=\"prodcat\" />
                                                    <input type=\"hidden\" name=\"parent\" value=\"".$_GET['parent']."\" />
													<input type=\"hidden\" name=\"subparent\" value=\"".$_GET['subparent']."\" />
                                                    <input type=\"hidden\" name=\"action\" value=\"do_add_cat\" /> 
                                                </form>
                                            </td>
                                      </tr>";	
                            }
                        ?>
                    </table>
                </div>
        
        <?php } ?>
        
        
        
        
        
        <div style="clear:both;"></div>
    </div>
</div>
<?php 
	if($action == "switch_to_main") {
		$type = $_GET['type'];
		$cat = $_GET['cat'];
		$parent = $_GET['parent'];
		$subparent = $_GET['subparent'];
		if($type == "set_main") {
			$result = mysql_query("UPDATE product_category_list SET mainPage=1 WHERE categoryId='$cat' ");	
		} else {
			$result = mysql_query("UPDATE product_category_list SET mainPage=0 WHERE categoryId='$cat' ");	
		}
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodcat&parent=$parent&subparent=$subparent\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
?>
<?php 
	if($action == "do_add_cat") {
		$parent  = (int) $_POST['parent'];
		$subparent  = (int) $_POST['subparent'];
		$cat_name = htmlspecialchars($_POST['cat_name']);
		$cat_name_ru = htmlspecialchars($_POST['cat_name_ru']);
		$cat_name_en = htmlspecialchars($_POST['cat_name_en']);
		
		$tooltip_az = htmlspecialchars($_POST['tooltip_az']);
		$tooltip_ru = htmlspecialchars($_POST['tooltip_ru']);
		$tooltip_en = htmlspecialchars($_POST['tooltip_en']);
		
		$row_max = mysql_fetch_array(mysql_query("SELECT (MAX(place)+1) FROM product_category_list WHERE categoryParent='$parent' "));
		if(!empty($subparent)) {
			$result = mysql_query("INSERT INTO product_category_list (categoryName,categoryParent,place,categoryName_ru,categoryName_en,tooltip_az,tooltip_ru,tooltip_en)
								 VALUES ('$cat_name','$subparent','".$row_max[0]."','$cat_name_ru','$cat_name_en','$tooltip_az','$tooltip_ru','$tooltip_en') ");
		} else {
			$result = mysql_query("INSERT INTO product_category_list (categoryName,categoryParent,place,categoryName_ru,categoryName_en,tooltip_az,tooltip_ru,tooltip_en)
								 VALUES ('$cat_name','$parent','".$row_max[0]."','$cat_name_ru','$cat_name_en','$tooltip_az','$tooltip_ru','$tooltip_en') ");
		
		}
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodcat&parent=$parent&subparent=$subparent\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
	if($action == "do_edit_cat") {
		$parent  = (int) $_POST['parent'];
		$subparent  = (int) $_POST['subparent'];
		$cat  = (int) $_POST['cat'];
		$new_parent = (int) $_POST['new_parent'];
		$cat_name = htmlspecialchars($_POST['cat_name']);
		$cat_name_ru = htmlspecialchars($_POST['cat_name_ru']);
		$cat_name_en = htmlspecialchars($_POST['cat_name_en']);
		
		$tooltip_az = htmlspecialchars($_POST['tooltip_az']);
		$tooltip_ru = htmlspecialchars($_POST['tooltip_ru']);
		$tooltip_en = htmlspecialchars($_POST['tooltip_en']);
		
		if(!empty($subparent)) {
			$query_edit = "UPDATE product_category_list SET categoryName='$cat_name',categoryParent='$new_parent',categoryName_ru='$cat_name_ru',
														categoryName_en='$cat_name_en',
														tooltip_az='$tooltip_az',
														tooltip_ru='$tooltip_ru',
														tooltip_en='$tooltip_en' 
											WHERE categoryId='$cat' ";
		} else {
			$query_edit = "UPDATE product_category_list SET categoryName='$cat_name',categoryParent='$new_parent',categoryName_ru='$cat_name_ru',
														categoryName_en='$cat_name_en',
														tooltip_az='$tooltip_az',
														tooltip_ru='$tooltip_ru',
														tooltip_en='$tooltip_en' 
											WHERE categoryId='$cat' ";
		}
		
		$result = mysql_query($query_edit); 
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodcat&parent=$parent&subparent=$subparent\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
	if($action == "delete_cat") {
		$parent  = (int) $_GET['parent'];
		$subparent  = (int) $_GET['subparent'];
		$cat  = (int) $_GET['cat'];
		$result = mysql_query("DELETE FROM  product_category_list  WHERE categoryId='$cat' ");
		$result_delete_cat = mysql_query("DELETE FROM product_category_link WHERE categoryId='$cat' ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodcat&parent=$parent&subparent=$subparent\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
	if($action == "sort") {
		$type = $_GET['type'];
		$parent = $_GET['parent'];
		$subparent = $_GET['subparent'];
		$cat = $_GET['cat'];
		$curr_place_row = mysql_fetch_array(mysql_query("SELECT place,categoryParent FROM product_category_list WHERE categoryId='$cat' "));
		if($type == "down") {
			$result_next = mysql_query("SELECT categoryId,place FROM product_category_list WHERE categoryParent='".$curr_place_row['categoryParent']."' AND place>'".$curr_place_row['place']."' ORDER BY place ASC LIMIT 0,1 ");	
		}
		if($type == "up") {
			$result_next = mysql_query("SELECT categoryId,place FROM product_category_list WHERE categoryParent='".$curr_place_row['categoryParent']."' AND place<'".$curr_place_row['place']."' ORDER BY place DESC LIMIT 0,1 ");	
		}
		if(mysql_num_rows($result_next)>0) {
			$row_next = mysql_fetch_array($result_next);
			$query_this_update = "UPDATE product_category_list SET place='".$row_next['place']."' WHERE categoryId='$cat'  ";
			//print $query_this_update."<br>";
			$update_this_result = mysql_query($query_this_update);
			if($update_this_result) { 
				$query_next_update = "UPDATE  product_category_list SET place='".$curr_place_row['place']."' WHERE categoryId='".$row_next['categoryId']."' ";
				//print $query_next_update;
				$update_next_result = mysql_query($query_next_update);
			}
			if($update_next_result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodcat&parent=$parent&subparent=$subparent\">";  //change redirect
				exit("<center>Success</center>"); 
			}
		} else {
			print "Last item";	
		}
	}
?>