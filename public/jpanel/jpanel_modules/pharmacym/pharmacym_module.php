<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<?php 
	if($action == "show"){
?>
	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="800">
    	<tr class="ui_table_title">
        	<td colspan="7">Apteklər <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=pharmacym&action=add'"  /></td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td nowrap>Ref kod</td>
            <td>Aptek</td>
            <td>Region</td>
            <td>Dərmanlar</td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			$query_ph = "SELECT pharmacyId,pharmacyName,regionId,pharmacyAddress,pharmacyDesc,isduty,refNumber,(SELECT regionName FROM regions r WHERE r.regionId=pharmacies.regionId) AS regionName FROM pharmacies ";
			$result_ph = mysql_query($query_ph);
			$n = 1;
			while($row_ph = mysql_fetch_array($result_ph)){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\" valign=\"top\">$n</td>
							<td class=\"iu_center_short\" valign=\"top\">".$row_ph['refNumber']."</td>
							<td valign=\"top\">".$row_ph['pharmacyName']."</td>
							<td valign=\"top\">".$row_ph['regionName']."</td>
							<td align=\"center\"><a href='?smode=page&item=derman&action=show&aptek=".$row_ph['pharmacyId']."'><img src='jpanel/jpanel_img/drug.png' width=24 /></a></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=pharmacym&action=edit&key=".$row_ph[0]."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=pharmacym&action=delete&key=".$row_ph[0]."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
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
                        <td colspan="2">Aptek əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"   /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı:</td><td><input type="text" name="ph_name" id="ph_name"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı ru:</td><td><input type="text" name="ph_name_ru" id="ph_name_ru"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı en:</td><td><input type="text" name="ph_name_en" id="ph_name_en"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Region:</td>
                        <td>
                        	<div id="prod_cat_iu"></div>
                            <select id="region" name="region" class="ui_select">
                                <option value="0">Seçin</option>
								<?php 
                                    $result_cat = mysql_query("SELECT regionId,regionName FROM  regions ");
                                    while($row_cat = mysql_fetch_array($result_cat)){
                                         print "<option value='".$row_cat[0]."'>".$row_cat[1]."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan:</td><td><input type="text" name="ph_address" id="ph_address"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan ru:</td><td><input type="text" name="ph_address_ru" id="ph_address_ru"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan en:</td><td><input type="text" name="ph_address_en" id="ph_address_en"  style="width:550px;" class="main_ui_text" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında:</td><td><textarea name="ph_about" style="width:450px; height:400px;"></textarea></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında ru:</td><td><textarea name="ph_about_ru" style="width:450px; height:400px;"></textarea></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında en:</td><td><textarea name="ph_about_en" style="width:450px; height:400px;"></textarea></td>
                    </tr>
                    
                    <tr>
                        <td class="ui_labels" valign="top">Kordinat:</td>
                        <td>
                        	<div style="margin-bottom:10px;">
                            	Lat: <input type="text" name="lat" id="lat"  class="main_ui_text" style="width:210px;" />
                                Lng: <input type="text" name="lng" id="lng" class="main_ui_text"  style="width:210px;" />
                            </div>
                            <div id='admin_mapdiv' style='width:550px; height:400px; border:1px solid #cccccc;'></div>
                            <input type="hidden" name="latlng" id="latlng" value="40.36698925642974, 49.83510490722654" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Növbətçi:</td><td><input type="checkbox" name="isduty" /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="pharmacym"  />
                <input type="hidden" name="action" value="do_add">
            </form>
<?php } ?>
<?php 
	if($action == "do_add") {
		
		$name = SqlInjectFilterMini($_POST['ph_name']);
		$name_ru = SqlInjectFilterMini($_POST['ph_name_ru']);
		$name_en = SqlInjectFilterMini($_POST['ph_name_en']);
		$region = intval($_POST['region']);
		$ph_address = SqlInjectFilterMini($_POST['ph_address']);
		$ph_about = addslashes($_POST['ph_about']);
		$ph_about_ru = addslashes($_POST['ph_about_ru']);
		$ph_about_en = addslashes($_POST['ph_about_en']);
		$lat = SqlInjectFilterMini($_POST['lat']);
		$lng = SqlInjectFilterMini($_POST['lng']);
		$isduty = intval($_POST['isduty']);
		if(!empty($_POST['isduty'])) { $isduty = 1; } else { $isduty = 0; }
		
		
		$result = mysql_query("INSERT INTO pharmacies (pharmacyName,regionId,pharmacyAddress,pharmacyLong,pharmacyLat,pharmacyDesc,isduty,pharmacyName_ru,pharmacyName_en,pharmacyDesc_ru,pharmacyDesc_en) 
												VALUES ('$name','$region','$ph_address','$lng','$lat','$ph_about','$isduty','$name_ru','$name_en','$ph_about_ru','$ph_about_en') ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacym&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print "Error";
			print mysql_error();	
		}
	}
?>
<?php 
	if($action == "edit") {
		if(empty($_GET['key'])) { exit("Invalid param"); }
		$pharmacy_id = (int) $_GET['key'];
		$result_pharmacy = mysql_query("SELECT pharmacyId,pharmacyName,pharmacyName_ru,pharmacyName_en,regionId,pharmacyAddress,pharmacyAddress_ru,pharmacyAddress_en,pharmacyDesc,pharmacyDesc_ru,
		pharmacyDesc_en,isduty,pharmacyLong,pharmacyLat,refNumber,mainImg FROM pharmacies WHERE pharmacyId='".$pharmacy_id."' ");
		$row_pharmacy = mysql_fetch_array($result_pharmacy);
?>
		
        	<form action="?" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Aptek əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"   /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı:</td><td><input type="text" name="ph_name" id="ph_name"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyName'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı ru:</td><td><input type="text" name="ph_name_ru" id="ph_name_ru"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyName_ru'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Aptekin adı en:</td><td><input type="text" name="ph_name_en" id="ph_name_en"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyName_en'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ref kod:</td><td><input type="text" name="refNumber" id="refNumber"  style="width:150px;" class="main_ui_text" value="<?php echo $row_pharmacy['refNumber'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Şəkil:</td>
                        <td>
                        	<input  name='mainImg' id='mainImg' style='width:550px;' class="main_ui_text" value="<?php echo $row_pharmacy['mainImg'] ?>">
							<a href="javascript:;" onclick="mcImageManager.browse({fields : 'mainImg', relative_urls : true});">[Şəkli buradan seçin]</a>
						</td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Region:</td>
                        <td>
                        	<div id="prod_cat_iu"></div>
                            <select id="region" name="region"  class="ui_select">
                                <option value="0">Seçin</option>
								<?php 
                                    $result_cat = mysql_query("SELECT regionId,regionName FROM  regions ");
                                    while($row_cat = mysql_fetch_array($result_cat)){
                                         print "<option value='".$row_cat[0]."' ";
										 if($row_cat[0] == $row_pharmacy['regionId']) { print " selected "; }
										 print ">".$row_cat[1]."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan:</td><td><input type="text" name="ph_address" id="ph_address"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyAddress'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan ru:</td><td><input type="text" name="ph_address_ru" id="ph_address_ru"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyAddress_ru'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ünvan en:</td><td><input type="text" name="ph_address_en" id="ph_address_en"  style="width:550px;" class="main_ui_text" value="<?php echo $row_pharmacy['pharmacyAddress_en'] ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında:</td><td><textarea name="ph_about" style="width:450px; height:400px;"><?php echo stripslashes($row_pharmacy['pharmacyDesc']); ?></textarea></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında ru:</td><td><textarea name="ph_about_ru" style="width:450px; height:400px;"><?php echo stripslashes($row_pharmacy['pharmacyDesc_ru']); ?></textarea></td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Haqqında en:</td><td><textarea name="ph_about_en" style="width:450px; height:400px;"><?php echo stripslashes($row_pharmacy['pharmacyDesc_en']); ?></textarea></td>
                    </tr>
                    
                    <tr>
                        <td class="ui_labels" valign="top">Kordinat:</td>
                        <td>
                        	<div style="margin-bottom:10px;">
                            	Lat: <input type="text" name="lat" id="lat"  class="main_ui_text" style="width:210px;" />
                                Lng: <input type="text" name="lng" id="lng" class="main_ui_text"  style="width:210px;" />
                            </div>
                            <div id='admin_mapdiv' style='width:550px; height:400px; border:1px solid #cccccc;'></div>
                            <input type="hidden" name="latlng" id="latlng" value="<?php echo $row_pharmacy['pharmacyLat'].",".$row_pharmacy['pharmacyLong']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_labels" valign="top">Növbətçi:</td><td><input type="checkbox"  name="isduty" <?php if($row_pharmacy['isduty'] == "1") { print " checked=\"checked\" ";} ?> /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="pharmacym"  />
                <input type="hidden" name="key" value="<?php echo $pharmacy_id; ?>"  />
                <input type="hidden" name="action" value="do_edit">
            </form>
        
        
<?php } ?>
<?php 
	if($action == "do_edit") {
		$pharmacy_id = intval($_POST['key']);
		if(empty($_POST['key'])) { exit("Invalid param"); }
		$name = SqlInjectFilterMini($_POST['ph_name']);
		$name_ru = SqlInjectFilterMini($_POST['ph_name_ru']);
		$name_en = SqlInjectFilterMini($_POST['ph_name_en']);
		
		$region = intval($_POST['region']);
		$ph_address = SqlInjectFilterMini($_POST['ph_address']);
		$ph_address_ru = SqlInjectFilterMini($_POST['ph_address_ru']);
		$ph_address_en = SqlInjectFilterMini($_POST['ph_address_en']);
		$ph_about = addslashes($_POST['ph_about']);
		$ph_about_ru = addslashes($_POST['ph_about_ru']);
		$ph_about_en = addslashes($_POST['ph_about_en']);
		$lat = SqlInjectFilterMini($_POST['lat']);
		$lng = SqlInjectFilterMini($_POST['lng']);
		$isduty = intval($_POST['isduty']);
		if(!empty($_POST['isduty'])) { $isduty = 1; } else { $isduty = 0; }
		
		$refNumber = intval($_POST['refNumber']);
		
		$mainImg = addslashes($_POST['mainImg']);
		
		
		$result = mysql_query("UPDATE pharmacies SET  
									pharmacyName='$name',pharmacyName_ru='$name_ru',pharmacyName_en='$name_en',
									regionId='$region',pharmacyAddress='$ph_address',pharmacyAddress_ru='$ph_address_ru',pharmacyAddress_en='$ph_address_en',
									pharmacyLong='$lng',pharmacyLat='$lat',pharmacyDesc='$ph_about',pharmacyDesc_ru='$ph_about_ru',
									pharmacyDesc_en='$ph_about_en',isduty='$isduty',refNumber='$refNumber',mainImg='$mainImg' WHERE pharmacyId='$pharmacy_id'	 ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacym&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print "Error";
			print mysql_error();	
		}
	}
	
	if($action == "delete") {
		$pharmacy_id = (int) $_GET['key'];
		$result = mysql_query("DELETE FROM pharmacies WHERE pharmacyId='$pharmacy_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=pharmacym&action=show\">";  //change redirect
			exit("<center>Success</center>");
		}
	}
?>
