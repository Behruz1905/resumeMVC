<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); ?>

<?php if($action == "show") { 

			$base_sql = "SELECT `orderId`,`orderDate`,`userId`,`orderStatus`,`orderTotalAmount`,
								`buyerNote`,`executorNote`,`orderType`,`canceled`,`cancelUserId`,`executorId`,
								`executeStartDate`,`orderSendOption`,`orderSendDate`,`delivered`,`buyerInfo`,`completed`,userLogicalRef 
						  FROM ph_orders_table WHERE userLogicalRef='".$user_data['logicalRef']."' AND orderType='AS' ";
			$where = " ";
			
			if(!empty($_REQUEST['orderType'])) { 
				$order_type = SqlInjectFilterMini($_REQUEST['orderType']);  
				$where.= " AND orderType='".SqlInjectFilterMini($_REQUEST['orderType'])."' ";	
			} 
			if(!empty($_REQUEST['user'])) { 
				$where.= " AND executorId='".SqlInjectFilterMini($_REQUEST['user'])."' ";	
			}
			if(!empty($_REQUEST['status'])) { 
				$where.= " AND orderStatus='".SqlInjectFilterMini($_REQUEST['status'])."' ";	
			}
			if(!empty($_REQUEST['orderId'])) { 
				$where.= " AND orderId='".SqlInjectFilterMini($_REQUEST['orderId'])."' ";	
			} 

			
			$comp_sql = $base_sql." ".$where;
			
			$order_result = mysql_query($comp_sql);

?>

<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="99%">
		<tr class="ui_table_title">
            <td colspan="12" ><div id="filter_shop">Sifarişlərin axtarışı</div></td>
        </tr>
    	<tr class="ui_filter_tr">
        	<td colspan="12">
            	<form action="?" method="get" >
                <table class="ui_filter_table"  width="600" <?php if(empty($_GET['do_filter'])) { ?>style="display:none;"<?php } ?> id="filter_head_table">
                	<tr><td class="ui_filter_label">Sifarişin kodu:</td><td><input type="text" class="main_ui_text" name="orderId" <?php if(!empty($_GET['orderId'])){ print " value='".SqlInjectFilterMini($_GET['orderId'])."' "; }?>  /></td></tr>
                    <tr>
                    	<td class="ui_filter_label">Status:</td>
                        <td>
                        	<select name="status" class="ui_select" >
                            	<option value="">Seçin</option>
                        	<?php 
								$result_st = mysql_query("SELECT statusCode,statusName FROM order_statuses");
								while($row_st = mysql_fetch_array($result_st)){
									print "<option value=\"".$row_st[0]."\">".$row_st['1']."</option>";
								}
							?>
                            </select>
                    	</td>
                    </tr>
                    <tr><td></td><td><input type="submit" class="main_ui_button" value="Filtr" name="do_filter"  /> &nbsp;&nbsp;<input type="button" class="main_ui_button" value="Filtri təmizlə" name="clear_filter" onclick="window.location.href='?smode=page&item=orderm&action=show'"  /></td></tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="orderm"  />
                <input type="hidden" name="action" value="show"  />
                <input type="hidden" name="orderType" value="<?php echo $order_type; ?>"  />
                </form>
            </td>
        </tr>
        <tr class="ui_table_title">
        	<td colspan="12" height="24">Sifarişlər <a href="?smode=page&item=pharmacy_face&action=add_order" id="new_order" class="main_ui_button" onclick="return confirm('Yeni sifariş verməyə əminsiniz?');">Yeni sifarish</a>
            
            </td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">ID</td>
            <td >Sifariş tarixi</td>
            <td>İcraçı</td>
            <td>İcraçı qeydi</td>
            <td>Göndərilmə tarixi</td>
            <td class="iu_center_short">Ətraflı</td>
            <td class="iu_center_short">Status</td>
            <td class="iu_center_short">Sil</td>
        </tr>
        <?php 
			$inc = 1;
			while($order_row = mysql_fetch_array($order_result)){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\">".$order_row['orderId']."</td>
							<td>".$order_row['orderDate']."</td>
							<td>".getCpuserName($order_row['executorId'])."</td>
							<td>".$order_row['executorNote']."</td>
							<td>".$order_row['orderSendDate']."</td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_row['orderId']."\"><img src=\"jpanel/jpanel_img/read_more.png\" border=0 width=24 /></a></td>
							<td class=\"iu_center_short\">".getOrderStatusByCode($order_row['orderStatus'])."</td>";
							//<td class=\"iu_center_short\">";
							//if($order_row['canceled'] == 1) { print "<img src=\"jpanel/jpanel_img/cancel.png\" width=24   />".getCpuserName($order_row['cancelUserId']).""; } 
							//else { print "<a href=\"#\" onclick=\"return confirm('Ləğv etməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/cancel_ds.png\" width=24 title='Ləğv et'  /></a>"; }
				print		"
							<td class=\"iu_center_short\">";
							if($order_row['completed'] == 0 && $order_row['orderStatus'] == "Y") { print "<a href='?smode=page&item=pharmacy_face&action=delete_order&order=".$order_row['orderId']."' onclick=\"return confirm('Sifarişi silməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/delete_n.png\" width=24   /></a>"; }
				print		"</td>
						</tr>";
			}
		?> 
        
</table>  
<?php } ?>

<?php 
	if($action == "add_order") {
		
		$result_not_completed = mysql_query("SELECT orderId FROM ph_orders_table WHERE userLogicalRef='".$user_data['logicalRef']."' AND  orderType='AS' AND completed=0 ");
		if(mysql_num_rows($result_not_completed)>0){
			$row_not_completed = mysql_fetch_array($result_not_completed);
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$row_not_completed['orderId']."\">";  //change redirect
			exit("<center><img src=\"resources/images/ui/loading.gif\"  /></center>"); 
		} else {
			$result_order = mysql_query("INSERT INTO ph_orders_table (orderDate,userId,orderStatus,orderType,completed,userLogicalRef) VALUES (NOW(),'".$user_data['userId']."','Y','AS',0,'".$user_data['logicalRef']."') ");
			if($result_order){
				$order_id = mysql_insert_id();
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
				exit("<center><img src=\"resources/images/ui/loading.gif\"  /></center>"); 
			}
		
		}
		
	}
?>
<?php 
	if($action == "add_order_detail"){
			$order_id = intval($_GET['order']);
			if(getOrderUser_ph($order_id,"AS") != $user_data['logicalRef']){
				exit("Invalid order");	
			}
			$result_not_completed = mysql_query("SELECT completed FROM ph_orders_table WHERE orderId='$order_id' ");
			$row_completed = mysql_fetch_array($result_not_completed);
			$status = getOrderStatus_ph($order_id);
			
?>
			<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="99%">
                	<tr class="ui_table_title">
                        <td colspan="11" height="24" valign="middle">
                        	<table cellpadding="2" cellspacing="0">
                            	<tr>
                                	<td width="5"></td>
                                    <td width="250" align="left">
                                    <?php if($row_completed[0] == 0) { ?>Yeni sifariş<?php } else { ?>Sifariş<?php } ?>
                                    &nbsp;<?php if($row_completed[0] == 0 && $status == "Y") { ?><input type="button" name="send_btn" class="main_ui_button" value="Sifarişi göndər" onclick="if(confirm('Sifarişi göndərməyə əminsiniz?')) { window.location.href = '?smode=page&item=pharmacy_face&action=send_order&order=<?php echo $order_id; ?>'; }" /><?php } ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="11">
                            <table cellpadding="5" cellspacing="0" border="0" class="info_table" >
                                <tr>
                                    <td class="info_table_key" >Id:</td><td class="info_table_value"><?php echo $order_id; ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" ></td><td class="info_table_value"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="11" height="5" style="font-size:5px;">&nbsp;</td></tr>
                    <tr class="ui_table_title">
                        <td colspan="11" height="24">Malları seçin</td>
                    </tr>
                    <tr class="iu_table_header">
                    	<td class="iu_center_short">№</td>
                        <td class="iu_center_short" >Barkod</td>
                        <td align="center">Malın adı</td>
                        <td width="100" align="center">Ölçü vahidi</td>
                        <td width="80" align="center">Ölkə</td>
                        <td width="100" align="center"  >Tələb olunan say</td>
                        <td width="100" align="center" >Göndərilən say</td>
                        <td width="100" align="center">Qiyməti</td>
                       
                        <td width="50" align="center">Dəyiş</td>
                        <td width="50" align="center">Sil</td>
                    </tr>
                    <?php if($row_completed[0] == 0 && $status == "Y" && empty($_GET['subaction']) ) {?>
                    <tr>
                    	<form action="?" method="post" >
                            <td class="iu_center_short"></td>
                            <td class="iu_center_short" ><input type="text" id="barcode" name="barcode"  class="main_ui_text" style="width:100px;"/></td>
                            <td><!--<input type="text" id="prod_name" name="prod_name"  class="main_ui_text" style="width:230px;"/>--><div id="prod_name"></div><div id="prod_name_label" style="margin-top:5px;"></div></td>
                            <td width="100"><select id="item_unit" name="item_unit" class="ui_select" style="width:100px;min-width:100px;"></select></td>
                            <td><span id="prod_country"></span></td>
                            <td width="100"><input type="text" id="count" name="count"  class="main_ui_text" style="width:80px;"/></td>
                            <td width="100" colspan="5"><input type="submit" name="ok_add" value="Əlavə et" class="main_ui_button" /></td>
                        	<input type="hidden" name="smode" value="page"  />
                            <input type="hidden" name="item" value="pharmacy_face"  />
                            <input type="hidden" name="action" value="do_add_item"  />
                            <input type="hidden" name="order" value="<?php echo $order_id; ?>"  />
                            <input type="hidden" id="prod_code" name="code"  />
                        </form>
                    </tr>
                    <?php } ?>
                    
                    <?php 
						
						if($_GET['subaction']== "edit_items") {
							$key = intval($_GET['key']);
							$status = getOrderStatus_ph($order_id);
							if($status == "Y"  && $row_completed[0] == 0){
								$result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef,lessThanRemain FROM ph_order_details WHERE orderId='$order_id' AND tableId='$key ' ");
								$row_prods = mysql_fetch_array($result_prods);
								$item = getItemByLogicalRef($row_prods['logicalRef']);
								print "<tr>
										<form action=\"?\" method=\"post\" >
											<td class=\"iu_center_short\"></td>
											<td class=\"iu_center_short\" ><input type=\"text\" id=\"barcode\" name=\"barcode\"  class=\"main_ui_text\" style=\"width:100px;\" value='".getUnitBarcodeTg($row_prods['unit'])."' /></td>
											
											<td><input type=\"text\" id=\"prod_name\" name=\"prod_name\"  class=\"main_ui_text\" style=\"width:230px;\" value='".$item['NAME']."' /></td>
											<td width=\"100\">
												<select id=\"item_unit\" name=\"item_unit\" class=\"ui_select\" style=\"width:100px;min-width:100px;\">";
													$result_units = mysql_query("SELECT UnitShortNAME,UnitLongNAME FROM `UNIT` WHERE LogicalRef='".$row_prods['logicalRef']."' ");
													while($row_units = mysql_fetch_array($result_units)){
														print "<option value=\"".$row_units[0]."\" ";
														if($row_units[0] == $row_prods['unit']) { print " selected "; }
														print ">".$row_units[1]."</option>";
													}
								print			"</select>
											</td>
											<td><span id=\"prod_country\"></span></td>
											<td width=\"100\"><input type=\"text\" id=\"count\" name=\"count\"  class=\"main_ui_text\" style=\"width:80px;\" value='".(float)$row_prods['requestCount']."' /></td>
											<td width=\"100\" colspan=\"5\"><input type=\"submit\" name=\"ok_add\" value=\"Yadda saxla\" class=\"main_ui_button\" /></td>
											<input type=\"hidden\" name=\"smode\" value=\"page\"  />
											<input type=\"hidden\" name=\"item\" value=\"pharmacy_face\"  />
											<input type=\"hidden\" name=\"action\" value=\"do_edit_item\"  />
											<input type=\"hidden\" name=\"order\" value=\"".$order_id."\"  />
											<input type=\"hidden\" name=\"key\" value=\"".$key."\"  />
											<input type=\"hidden\" id=\"prod_code\" name=\"code\"   value='".$row_prods['logicalRef']."' />
										</form>
									</tr>";
							}
							
						} else {
							$inc = 1;
							$result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef,lessThanRemain FROM ph_order_details WHERE orderId='$order_id' ");
							$total = 0;
							while($row_prods = mysql_fetch_array($result_prods)){
								$item = getItemByLogicalRef($row_prods['logicalRef']);
								$sum = $row_prods['productPrice']*$row_prods['sendCount'];
								$total+= $sum;
								print "<tr>
										  <td align=\"center\">".$inc."</td>
										  <td>".getUnitBarcodeTg($row_prods['unit'])."</td>
										  <td>".$item['NAME']."</td>
										  <td align=\"center\">".getUnitNameTg($row_prods['unit'])."</td>
										  <td align=\"center\">".$item['COUNTRY']."</td>	
										  <td ";
										  if($row_prods['lessThanRemain'] == 1) { print " bgcolor=\"#DE4241\" title=\"Sifariş etdiyiniz say bazada olan saydan azdır\" ";} 
								print	  ">".(float)$row_prods['requestCount']."</td>
										  <td>".(float)$row_prods['sendCount']."</td>
										  <td>".$row_prods['productPrice']."</td>
										 
										  <td>";
											if($row_completed[0] == 0 && $status == "Y") { print "<a href=\"?smode=page&item=pharmacy_face&action=add_order_detail&subaction=edit_items&order=".$order_id."&key=".$row_prods['tableId']."\"><img src=\"jpanel/jpanel_img/edit_n.png\" width=\"24\"  /></a>"; }
								print	  "</td>
										  <td>";
											if($row_completed[0] == 0 && $status == "Y") { print "<a href=\"?smode=page&item=pharmacy_face&action=delete_item&order=".$order_id."&key=".$row_prods['tableId']."\" onclick=\"return confirm('Silməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/delete_n.png\" width=\"24\"  /></a>"; }
								print	  "</td>
									   </tr>";	
								$inc++;
							}
							//print "<tr><td colspan=8 align=right>Cəmi:</td><td>$total</td><td colspan=2></td></tr>";
						}
						
					?>
                </table>
<?php		
	}
?>
<?php 
	if($action == "do_add_item") {
		$order_id = intval($_POST['order']);
		if(getOrderUser_ph($order_id,"AS") != $user_data['logicalRef']){
			exit("Invalid order");	
		} else {
			$prod_code = intval($_POST['code']);
			$item_unit =  addslashes(htmlspecialchars($_POST['item_unit']));
			$count = doubleval($_POST['count']);
			$prod = getItemByLogicalRef($prod_code);
			
			if($count>$prod['COUNT']){ $less = 1; } else { $less = 0; } 
			
			if($count <1 || empty($prod_code) || empty($item_unit) || empty($order_id)) {
				echo "<meta http-equiv=\"Refresh\" content=\"1; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
				exit("<center>Xanaları tam doldurun</center>"); 
			} else {
				$result = mysql_query("INSERT INTO ph_order_details (orderId,requestCount,unit,logicalRef,lessThanRemain) VALUES ('$order_id','$count','$item_unit','$prod_code','$less')");
				if($result){
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
					exit("<center></center>"); 
				}
			}
		}
		
	}
	if($action == "do_edit_item") {
		$order_id = intval($_POST['order']);
		$key = intval($_POST['key']);
		$status = getOrderStatus_ph($order_id);
		if(getOrderUser_ph($order_id,"AS") != $user_data['logicalRef'] || $status != "Y"){
			exit("Invalid order");	
		} else {
			$prod_code = intval($_POST['code']);
			$item_unit =  addslashes(htmlspecialchars($_POST['item_unit']));
			$count = doubleval($_POST['count']);
			
			$prod = getItemByLogicalRef($prod_code);
			if($count>$prod['COUNT']){ $less = 1; } else { $less = 0; } 
			
			if($count <1 || empty($prod_code) || empty($item_unit) || empty($order_id) || empty($key)) {
				echo "<meta http-equiv=\"Refresh\" content=\"1; URL=?smode=page&item=pharmacy_face&action=add_order_detail&subaction=edit_items&order=$order_id&key=$key \">";  //change redirect
				exit("<center>Xanaları tam doldurun</center>"); 
			} else {
				$result = mysql_query("UPDATE  ph_order_details SET requestCount='$count',unit='$item_unit',logicalRef='$prod_code',lessThanRemain='$less' WHERE tableId='$key' ");
				if($result){
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
					exit("<center></center>"); 
				}
			}
		}
		
	}
	
	if($action == "delete_item"){
		$order_id = intval($_GET['order']);
		$key = intval($_GET['key']);
		$status = getOrderStatus_ph($order_id);
		if((getOrderUser_ph($order_id,"AS") != $user_data['logicalRef']) || ($status != "Y")){
			exit("Invalid order");	
		} else {
			if(empty($key)) {
				echo "<meta http-equiv=\"Refresh\" content=\"1; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
				exit("<center>Xanaları tam doldurun</center>"); 
			} else {
				$result = mysql_query("DELETE FROM   ph_order_details WHERE tableId='$key' ");
				if($result){
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
					exit("<center></center>"); 
				}
			}
		}
		
	}
	
	if($action == "delete_order"){
		$order_id = intval($_GET['order']);
		$status = getOrderStatus_ph($order_id);
		if((getOrderUser_ph($order_id,"AS") != $user_data['logicalRef']) || ($status != "Y")){
			exit("Invalid order");	
		} else {
			$result = mysql_query("DELETE FROM   ph_orders_table WHERE orderId='$order_id' ");
			if($result){
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=show \">";  //change redirect
				exit("<center></center>"); 
			}
			
		}
		
	}
	
	if($action == "send_order"){
		$order_id = intval($_GET['order']);
		$status = getOrderStatus_ph($order_id);
		if((getOrderUser_ph($order_id,"AS") != $user_data['logicalRef']) || ($status != "Y")){
			exit("Invalid order");	
		} else {
				$result_not_completed = mysql_query("SELECT completed FROM ph_orders_table WHERE orderId='$order_id' ");
				$row_completed = mysql_fetch_array($result_not_completed);
				
				if($row_completed[0] == 0){
					
					if(hasDetailInOrder_ph($order_id)) {
						$result_details = mysql_query("UPDATE ph_order_details SET sendCount=requestCount WHERE orderId='$order_id' ");
						if($result_details){
							$result = mysql_query("UPDATE ph_orders_table SET completed='1' WHERE  orderId='$order_id' ");
							if($result){
								echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacy_face&action=add_order_detail&order=".$order_id."\">";  //change redirect
								exit("<center></center>"); 
							}	
						}	
					}
					
				}
				
			
		}
	}
?>