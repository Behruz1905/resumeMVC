<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); ?>

<?php if($action == "show") { 


			$date_start = addslashes(htmlspecialchars(trim($_GET['start_date'])));
			$date_end =  addslashes(htmlspecialchars(trim($_GET['end_date'])));
			

			if(!empty($_REQUEST['orderType'])) { 
				$order_type = SqlInjectFilterMini($_REQUEST['orderType']);  
			} else { $order_type = "TS"; } 
			
			if($order_type == "AS") {
				$base_sql = "SELECT `orderId`,`orderDate`,`userId`,`orderStatus`,`orderTotalAmount`,
								`buyerNote`,`executorNote`,`orderType`,`canceled`,`cancelUserId`,`executorId`,
								`executeStartDate`,`orderSendOption`,`orderSendDate`,`delivered`,`buyerInfo` ,userLogicalRef 
						  FROM ph_orders_table WHERE completed=1 ";
			} else {
				$base_sql = "SELECT `orderId`,`orderDate`,`userId`,`orderStatus`,`orderTotalAmount`,
								`buyerNote`,`executorNote`,`orderType`,`canceled`,`cancelUserId`,`executorId`,
								`executeStartDate`,`orderSendOption`,`orderSendDate`,`delivered`,`buyerInfo` 
						  FROM orders_table WHERE completed=1 ";
			}
			
			
			$where = " ";
			
			
			if(!empty($date_start )){
				$where .= " AND orderDate >='$date_start' ";
			}
			if(!empty($date_end )){
				$where .= " AND orderDate <='$date_end' ";				
			}
			
			if(!empty($_REQUEST['orderType'])) { 
				$where.= " AND orderType='".SqlInjectFilterMini($_REQUEST['orderType'])."' ";	
			} else { $order_type = "TS"; } 
			if(!empty($_REQUEST['user'])) { 
				$where.= " AND executorId='".SqlInjectFilterMini($_REQUEST['user'])."' ";	
			}
			if(!empty($_REQUEST['status'])) { 
				$where.= " AND orderStatus='".SqlInjectFilterMini($_REQUEST['status'])."' ";	
			}
			if(!empty($_REQUEST['orderId'])) { 
				$where.= " AND orderId='".SqlInjectFilterMini($_REQUEST['orderId'])."' ";	
			} 
			
			if(!empty($_REQUEST['canceled'])) { 
				$where.= " AND canceled=1 ";	
			}  else {
				$where.= " AND canceled=0 ";	
			}
			
			$where.= "ORDER BY orderDate DESC LIMIT 0,50 ";
			
			$comp_sql = $base_sql." ".$where;
			$order_result = mysql_query($comp_sql);

?>

<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="98%">
		<tr class="ui_table_title">
            <td colspan="12" ><div id="filter_shop" style=" width:120px; cursor:pointer; background-image:url(jpanel/jpanel_img/seach.png); background-repeat:no-repeat; background-position:right; padding-right:25px;">Sifarişlərin axtarışı  </div> </td>
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
									print "<option value=\"".$row_st[0]."\" ";
									if($row_st[0] == $_REQUEST['status']) { print " selected "; }
									print ">".$row_st['1']."</option>";
								}
							?>
                            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td class="ui_filter_label">İcraçı:</td>
                        <td>
                        	<select name="user" class="ui_select" >
                        		<option value="">Seçin</option>
							<?php 
								$result_st = mysql_query("SELECT cpUserId,cpUserName FROM cp_users WHERE cpUserType='TS' OR cpUserType='A' ");
								while($row_st = mysql_fetch_array($result_st)){
									print "<option value=\"".$row_st[0]."\" ";
									if($row_st[0] == $_REQUEST['user']) { print " selected "; }
									print ">".$row_st['1']."</option>";
								}
							?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width=100 class="ui_filter_label">Tarix:</td>
                        <td><input type=text name='start_date' id='start_date' value='<?php echo $date_start; ?>' >&nbsp;-dən <input type=text name='end_date' id='end_date' value='<?php echo $date_end; ?>'> -ə</td>
                     </tr>
                     
                      <tr>
                        <td width=100 class="ui_filter_label">Ləğv olunmuşlar:</td>
                        <td><input type="checkbox" name="canceled" <?php if(!empty($_GET['canceled'])) { print " checked "; }?> /></td>
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
        	<td colspan="12" height="24">Sifarişlər&nbsp;
            	<a href="?smode=page&item=orderm&action=show&orderType=TS" class="order_types" <?php if($order_type == "TS") print " id=\"order_types_active\" "; ?> >Təcili sifarişlər</a>
                <a href="?smode=page&item=orderm&action=show&orderType=DS" class="order_types" <?php if($order_type == "DS") print " id=\"order_types_active\" "; ?> >Digər sifarişlər</a>
            </td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">ID</td>
            <td >Sifariş tarixi</td>
            <td >Sifarişçi</td>
            <td>İcraçı</td>
            <td>İcraçı qeydi</td>
            <td>Növ</td>
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
							<td>".$order_row['orderDate']."</td>";
				print		"<td>";
							if($order_row['orderType'] == "TS") {
								print str_replace("&","<br/>",$order_row['buyerInfo']);
							} else if($order_row['orderType'] == "DS"){
								$user = getUser($order_row['userId']);
								print "Ad/soyad:".$user['userName']." ".$user['userSurname']."<br/>Tel mob:".$user['userPhone']."<br/>Ünvan:".$user['address'];
							} else if($order_row['orderType'] == "AS"){
								$user_name = getClCardDefination($order_row['userLogicalRef']); 
								if($user_name == "") { $user_name = getCpuserName($order_row['userId']); }
								print $user_name;
							}
				print		"</td>";
							
				print		"<td>".getCpuserName($order_row['executorId'])."</td>
							<td>".$order_row['executorNote']."</td>
							<td>".getOrderTypeNameByCode($order_row['orderType'])."</td>
							<td>".$order_row['orderSendDate']."</td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=orderm&action=show_order_detail&order=".$order_row['orderId']."&type=".$order_type."\"><img src=\"jpanel/jpanel_img/read_more.png\" border=0 width=24 /></a></td>
							<td class=\"iu_center_short\">".getOrderStatusByCode($order_row['orderStatus'])."</td>";
							//<td class=\"iu_center_short\">";
							//if($order_row['canceled'] == 1) { print "<img src=\"jpanel/jpanel_img/cancel.png\" width=24   />".getCpuserName($order_row['cancelUserId']).""; } 
							//else { print "<a href=\"#\" onclick=\"return confirm('Ləğv etməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/cancel_ds.png\" width=24 title='Ləğv et'  /></a>"; }
				print		"
							<td class=\"iu_center_short\"><a href=#><img src=\"jpanel/jpanel_img/delete_n.png\" width=24   /></a></td>
						</tr>";
			}
		?> 
        
</table>  
<?php } else if($action == "show_order_detail") { 
			
			$order = intval($_GET['order']);
			$order_type = SqlInjectFilterMini($_GET['type']);
			if(empty($order)) { exit("Sifarish secilmeyib"); }
			if($order_type == "AS") {
				$base_sql = "SELECT `orderId`,`orderDate`,`userId`,`orderStatus`,`orderTotalAmount`,
								`buyerNote`,`executorNote`,`orderType`,`canceled`,`cancelUserId`,`executorId`,
								`executeStartDate`,`orderSendOption`,`orderSendDate`,`delivered`,`buyerInfo`,userLogicalRef  
						  FROM ph_orders_table WHERE orderId='$order' ";
			} else {
				$base_sql = "SELECT `orderId`,`orderDate`,`userId`,`orderStatus`,`orderTotalAmount`,
								`buyerNote`,`executorNote`,`orderType`,`canceled`,`cancelUserId`,`executorId`,
								`executeStartDate`,`orderSendOption`,`orderSendDate`,`delivered`,`buyerInfo` 
						  FROM orders_table WHERE orderId='$order' ";
			}
			
			
			
			$result_order = mysql_query($base_sql);
			$row_order = mysql_fetch_array($result_order);
?>
			
				<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="99%">
                	<tr class="ui_table_title">
                        <td colspan="11" height="24" valign="middle">
                        	<table cellpadding="2" cellspacing="0">
                            	<tr>
                                	<td width="5"></td><td width="50" align="left">Sifariş</td>
                                    <td align="left">
										<?php if($row_order['orderStatus'] == "Y" && $row_order['canceled'] == 0) { 
													print "<a href=\"?smode=page&item=orderm&action=execute_order&order=".$order."&type=".$order_type."\" onclick=\"return confirm('İcraya başlamağa əminsiniz?');\"><img src=\"jpanel/jpanel_img/accept_n.png\" width=\"24\" title=\"Icra et\" ></a>"; 
											  }
											  if($row_order['orderStatus'] == "W" && $row_order['executorId'] == $user_data['userId'] && $row_order['canceled'] == 0) {  
													print "<a href=\"?smode=page&item=orderm&action=send_order&order=".$order."&type=".$order_type."\" onclick=\"return confirm('Sifarişi göndərməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/send_n.png\" width=\"24\" title=\"Gonder\" ></a>";
											  }
											  if($row_order['orderStatus'] == "S" && $row_order['canceled'] == 0) {
													print "<span id=\"order_sent\">Sifariş göndərilib</span>";  
											  }
										?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="11">
                            <table cellpadding="5" cellspacing="0" border="0" class="info_table" >
                                <tr>
                                    <td class="info_table_key" >Id:</td><td class="info_table_value"><?php echo $row_order['orderId']; ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >Sifariş tarixi:</td><td class="info_table_value"><?php echo $row_order['orderDate']; ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >Status:</td><td class="info_table_value"><?php echo getOrderStatusByCode($row_order['orderStatus']); ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >Növ:</td><td class="info_table_value"><?php echo getOrderTypeNameByCode($row_order['orderType']); ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >Sifarişçi:</td><td class="info_table_value">
                                    	<?php 
											if($row_order['orderType'] == "TS") {
												print str_replace("&","<br/>",$row_order['buyerInfo']);
											} else if($row_order['orderType'] == "DS"){
												$user = getUser($row_order['userId']);
												print "Ad/soyad:".$user['userName']." ".$user['userSurname']."<br/>Tel mob:".$user['userPhone']."<br/>Ünvan:".$user['address'];
											} else if($row_order['orderType'] == "AS"){
												$user_name = getClCardDefination($row_order['userLogicalRef']); 
												if($user_name == "") { $user_name =  getCpuserName($row_order['userId']);  }
												print $user_name;
											}
										?>
                                    </td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >Sifarişçinin qeydi:</td><td class="info_table_value"><?php echo $row_order['buyerNote']; ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >İcraçı:</td><td class="info_table_value"><?php echo getCpuserName($row_order['executorId']);  ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >İcraçının qeydi:</td><td class="info_table_value"><?php echo $row_order['executorNote']; ?><?php if($row_order['executorId'] == $user_data['userId']) { print " <a href=\"?smode=page&item=orderm&action=set_execute_note&order=".$order."&type=".$order_type."\"><img src=\"jpanel/jpanel_img/note_n.png\" width=\"24\"  /></a>"; } ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >İcra tarixi:</td><td class="info_table_value"><?php echo $row_order['executeStartDate']; ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >Göndərilmə tarixi:</td><td class="info_table_value"><?php echo $row_order['orderSendDate'];  ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >Ləğvi:</td><td class="info_table_value"><?php if($row_order['canceled'] == 0) { print "<a href=\"?smode=page&item=orderm&action=cancel_order&order=".$order."&type=".$order_type."\" onclick=\"return confirm('Ləğv etməyə əminsiniz?');\">Ləğv et</a>"; } else { print "Ləğv olunub"; } ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >Ləğv edən:</td><td class="info_table_value"><?php echo getCpuserName($row_order['cancelUserId']); ?></td>
                                </tr>
                                <tr>
                                    <td class="info_table_key" >Çatdırılma tarixi:</td><td class="info_table_value"></td>
                                    <td width="10">&nbsp;</td>
                                    <td class="info_table_key" >&nbsp;<?php echo $row_order['deliveryDate'];  ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="11" height="5" style="font-size:5px;">&nbsp;</td></tr>
                    <tr class="ui_table_title">
                        <td colspan="11" height="24">Sifarişdə olan mallar</td>
                    </tr>
                    <tr class="iu_table_header">
                    	<td class="iu_center_short">№</td>
                        <td class="iu_center_short" >Id</td>
                        <td width="80" align="center">Logical ref</td>
                        <td>Malın adı</td>
                        <td width="60">Qiyməti</td>
                        <td width="100">Tələb olunan say</td>
                        <td width="85">Göndərilən say</td>
                        <td width="80">Ölçü vahidi</td>
                        <td width="60">Məbləğ</td>
                        <td width="40">Dəyiş</td>
                        <td width="40">Sil</td>
                    </tr>
                    <?php 
						
						if($_GET['subaction']== "edit_items") {
							$key = intval($_GET['key']);
							if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order); }
							else { $status = getOrderStatus($order);  $executor = getOrderExecutor($order);}
							
							
							if($status == "W"  && $executor == $user_data['userId']){
								if($order_type == "AS") { $result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef FROM ph_order_details WHERE tableId='$key' "); }
								else { $result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef FROM order_details WHERE tableId='$key' "); }
								$total = 0;
								$row_prods = mysql_fetch_array($result_prods);
								if($row_order['orderType'] == "AS") { 
									$shop_product = getItemByLogicalRef($row_prods['logicalRef']);
									$prod_name = $shop_product['NAME'];
								} else {					
									$shop_product = getShopProduct($row_prods['shopProductId'],"az"); 
									$prod_name = $shop_product['productName'];
								}
								
								$sum = $row_prods['productPrice']*$row_prods['sendCount'];
								$total+= $sum;
								print "<form action=\"?\" method=\"post\">";
								print "<tr>
										  <td>".$inc."</td>
										  <td>".$row_prods['shopProductId']."</td>
										  <td>".$row_prods['logicalRef']."</td>
										  <td>".$prod_name."</td>
										  <td align=\"center\"><input name='price' type=\"text\" class=\"main_ui_text\" value=\"".$row_prods['productPrice']."\" style=\"width:80px;\" onkeyup=\"number_validate(this);\"></td>
										  <td>".$row_prods['requestCount']."</td>	
										  <td align=\"center\"><input name='sendCount' type=\"text\" class=\"main_ui_text\" value=\"".(float)$row_prods['sendCount']."\" style=\"width:80px;\" onkeyup=\"number_validate(this);\"></td>
										  <td>".$row_prods['unit']."</td>
										  <td>".$sum."</td>
										  <td><input type=submit name='ok' value='Yadda saxla' class='main_ui_button' /></td>
										  <td>";
											if($row_order['orderStatus'] == "W" && $row_order['executorId'] == $user_data['userId']) { print "<a href=\"?smode=page&item=orderm&action=delete_item&order=".$order."&key=".$row_prods['tableId']."&type=".$order_type."\" onclick=\"return confirm('Silməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/delete_n.png\" width=\"24\"  /></a>"; }
								print	  "</td>
									   </tr>";	
								
								print "<tr><td colspan=8 align=right>Cəmi:</td><td>$total</td><td colspan=2></td></tr>";
								
								print "<input type=\"hidden\" name=\"smode\" value=\"page\" />";
								print "<input type=\"hidden\" name=\"item\" value=\"orderm\" />";
								print "<input type=\"hidden\" name=\"action\" value=\"do_edit_items\" />";
								print "<input type=\"hidden\" name=\"order\" value=\"".$order."\" />";
								print "<input type=\"hidden\" name=\"key\" value=\"".$key."\" />";
								print "<input type=\"hidden\" name=\"type\" value=\"".$order_type."\" />";
								print "</form>";
							}
							
						} else {
							$inc = 1;
							if($order_type == "AS") { $result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef FROM ph_order_details WHERE orderId='$order' "); }
							else { $result_prods = mysql_query("SELECT tableId,shopProductId,productPrice,requestCount,sendCount,unit,logicalRef FROM order_details WHERE orderId='$order' "); } 
							$total = 0;
							while($row_prods = mysql_fetch_array($result_prods)){
								if($row_order['orderType'] == "AS") { 
									$shop_product = getItemByLogicalRef($row_prods['logicalRef']);
									$prod_name = $shop_product['NAME'];
								} else {
									$shop_product = getShopProduct($row_prods['shopProductId'],"az"); 
									$prod_name = $shop_product['productName'];
								}
								
								$sum = $row_prods['productPrice']*$row_prods['sendCount'];
								$total+= $sum;
								print "<tr>
										  <td>".$inc."</td>
										  <td>".$row_prods['shopProductId']."</td>
										  <td>".$row_prods['logicalRef']."</td>
										  <td><a href='index.php?smode=product&item=".$row_prods['shopProductId']."'>".$prod_name."</a></td>
										  <td>".$row_prods['productPrice']."</td>
										  <td>".(float)$row_prods['requestCount']."</td>	
										  <td>".(float)$row_prods['sendCount']."</td>
										  <td>".$row_prods['unit']."</td>
										  <td>".$sum."</td>
										  <td>";
											if($row_order['orderStatus'] == "W" && $row_order['executorId'] == $user_data['userId']) { print "<a href=\"?smode=page&item=orderm&action=show_order_detail&subaction=edit_items&order=".$order."&key=".$row_prods['tableId']."&type=".$order_type."\"><img src=\"jpanel/jpanel_img/edit_n.png\" width=\"24\"  /></a>"; }
								print	  "</td>
										  <td>";
											if($row_order['orderStatus'] == "W" && $row_order['executorId'] == $user_data['userId']) { print "<a href=\"?smode=page&item=orderm&action=delete_item&order=".$order."&key=".$row_prods['tableId']."&type=".$order_type."\" onclick=\"return confirm('Silməyə əminsiniz?');\"><img src=\"jpanel/jpanel_img/delete_n.png\" width=\"24\"  /></a>"; }
								print	  "</td>
									   </tr>";	
							}
							print "<tr><td colspan=8 align=right>Cəmi:</td><td>$total</td><td colspan=2></td></tr>";
						}
						
					?>
                </table>
                
<?php } ?>
<?php 
	if($action == "execute_order") {
		$order = intval($_GET['order']);
		$order_type = $_GET['type'];
		if(!empty($order)) {
			if($order_type == "AS") { $status = getOrderStatus_ph($order); } else { $status = getOrderStatus($order); }
			if($status == "Y") {
				if($order_type == "AS") { 
					$result_update = mysql_query("UPDATE ph_orders_table SET orderStatus='W',executorId='".$user_data['userId']."',executeStartDate=NOW() WHERE orderId='$order' ");
				} else {
					$result_update = mysql_query("UPDATE orders_table SET orderStatus='W',executorId='".$user_data['userId']."',executeStartDate=NOW() WHERE orderId='$order' ");
				}
				if($result_update) {
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
					exit("<center>Success</center>"); 
				}
			} else {
				print "Yalnish status";	
			}
		}
	}
	
	if($action == "set_execute_note") {
			$order = intval($_GET['order']);
			$order_type = $_GET['type'];
			if(!empty($order)) {
				if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order);  } else { $status = getOrderStatus($order); $executor = getOrderExecutor($order);  }
				if(($status == "W" || $status == "S") && $executor == $user_data['userId']){
					if($order_type == "AS"){
						$result = mysql_query("SELECT executorNote FROM ph_orders_table WHERE orderId='$order' ");
					} else {
						$result = mysql_query("SELECT executorNote FROM orders_table WHERE orderId='$order' ");
					}
					
					$row = mysql_fetch_array($result);
					print "<form action=\"?\" method=\"post\">";
					print "<table class=\"iu_table\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" width=\"400\">
								<tr class=\"ui_table_title\">
									<td><div id=\"filter_shop\">Sifariş ".$order." icraçının qeydi</div></td>
								</tr>
								<tr>
									<td><textarea class=\"main_ui_textarea\"  style='width:400px; height:80px;' name='exec_note'>".stripslashes($row[0])."</textarea></td>
								</tr>
								<tr><td><input type=submit name='ok' value='Yadda saxla' class='main_ui_button' /></td></tr>";
					
					print "</table>";
					print "<input type=\"hidden\" name=\"smode\" value=\"page\" />";
					print "<input type=\"hidden\" name=\"item\" value=\"orderm\" />";
					print "<input type=\"hidden\" name=\"action\" value=\"do_set_execute_note\" />";
					print "<input type=\"hidden\" name=\"order\" value=\"".$order."\" />";
					print "<input type=\"hidden\" name=\"type\" value=\"".$order_type."\" />";
					print "</form>";
				} else {
					print "Yalnish sifarish";	
				}
			}
	}
	if($action == "do_set_execute_note") {
		$order = intval($_POST['order']);
		$order_type = $_POST['type'];
		if(!empty($order)) {
			if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order);  } else { $status = getOrderStatus($order); $executor = getOrderExecutor($order);  }
				
				if(($status == "W" || $status == "S") && $executor == $user_data['userId']){
					$note = SqlInjectFilterMini($_POST['exec_note']);
					if($order_type == "AS"){
						$result = mysql_query("UPDATE ph_orders_table SET executorNote='$note' WHERE orderId='$order' ");
					} else {
						$result = mysql_query("UPDATE orders_table SET executorNote='$note' WHERE orderId='$order' ");
					}
					
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
					exit("<center>Success</center>"); 
				} else {
					print "Yalnish sifarish";	
				}
		}
	}
	
	
	if($action == "cancel_order") {
		$order = intval($_GET['order']);
		$order_type = $_GET['type'];
		if(!empty($order)) {
			if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order);  } else { $status = getOrderStatus($order); $executor = getOrderExecutor($order);  }
				
				
				if($executor == $user_data['userId']){
					if($order_type == "AS"){
						$result = mysql_query("UPDATE ph_orders_table SET canceled=1,cancelUserId='".$user_data['userId']."' WHERE orderId='$order' ");
					} else {
						$result = mysql_query("UPDATE orders_table SET canceled='1',cancelUserId='".$user_data['userId']."' WHERE orderId='$order' ");
					}
					
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
					exit("<center>Success</center>"); 
				} else {
					if($status == "Y") {
						if($order_type == "AS") { 
							$result = mysql_query("DELETE FROM  ph_order_details WHERE orderId='$order' "); 
							$result_order = mysql_query("DELETE FROM ph_orders_table WHERE orderId='$order' ");
						} else { 
							$result_detail = mysql_query("DELETE FROM  order_details WHERE orderId='$order' ");  
							$result_order = mysql_query("DELETE FROM orders_table WHERE orderId='$order' ");
						}
						
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show&orderType=$order_type \">";  //change redirect
					exit("<center>Success</center>"); 
					} else { print "Yalnish sifarish";	 }
				}
		}
	}
	
	
	if($action == "do_edit_items"){
		$key = intval($_POST['key']);
		$order_type = $_POST['type'];
		if(empty($key)) { exit("Invalid input"); }
		$order = intval($_POST['order']);
		if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order); }
		else { $status = getOrderStatus($order); $executor = getOrderExecutor($order); }
		if($status == "W"  && $executor == $user_data['userId']){
			$sendCount = doubleval($_POST['sendCount']);
			$price = doubleval($_POST['price']);
			if($order_type == "AS") { $result = mysql_query("UPDATE ph_order_details SET productPrice='$price',sendCount='$sendCount' WHERE tableId='$key' "); }
			else { $result = mysql_query("UPDATE order_details SET productPrice='$price',sendCount='$sendCount' WHERE tableId='$key' "); }
			if($result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
				exit("<center>Success</center>"); 	
			}
		}
	}
	
	if($action == "delete_item"){
		$key = intval($_GET['key']);
		$order_type = $_GET['type'];
		if(empty($key)) { exit("Invalid input"); }
		$order = intval($_GET['order']);
		if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order); }
		else { $status = getOrderStatus($order); $executor = getOrderExecutor($order); }
		if($status == "W"  && $executor == $user_data['userId']){
			if($order_type == "AS") {  $result = mysql_query("DELETE FROM  ph_order_details WHERE tableId='$key' "); }
			else {  $result = mysql_query("DELETE FROM  order_details WHERE tableId='$key' "); }
			if($result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
				exit("<center>Success</center>"); 	
			}
		}
	}
	
	if($action == "send_order"){
		$order = intval($_GET['order']);
		$order_type = $_GET['type'];
		if($order_type == "AS") { $status = getOrderStatus_ph($order); $executor = getOrderExecutor_ph($order); }
		else { $status = getOrderStatus($order); $executor = getOrderExecutor($order); }
		
		if($status == "W"  && $executor == $user_data['userId']){
			if($order_type == "AS") { $result = mysql_query("UPDATE ph_orders_table SET orderStatus='S',orderSendDate=NOW() WHERE orderId='$order' "); }
			else { $result = mysql_query("UPDATE orders_table SET orderStatus='S',orderSendDate=NOW() WHERE orderId='$order' "); }
			if($result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=orderm&action=show_order_detail&order=".$order."&type=".$order_type."\">";  //change redirect
				exit("<center>Success</center>"); 	
			}
		}
	}
	
	
?>