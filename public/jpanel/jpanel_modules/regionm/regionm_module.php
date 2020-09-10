<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<?php 
	if($action == "show"){
?>
	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">
    	<tr class="ui_table_title">
        	<td colspan="7">Regionlar <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=regionm&action=add'"  /></td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td>Region</td>
            <td>Region ru</td>
            <td>Region en</td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			$result_regions = mysql_query("SELECT regionId,regionName,regionName_ru,regionName_en,regionLong,regionLat FROM regions ");
			$n = 1;
			while($row_regions = mysql_fetch_array($result_regions)){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\" valign=\"top\">$n</td>
							<td valign=\"top\">".$row_regions['regionName']."</td>
							<td valign=\"top\">".$row_regions['regionName_ru']."</td>
							<td valign=\"top\">".$row_regions['regionName_en']."</td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=regionm&action=edit&key=".$row_regions[0]."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=regionm&action=delete&key=".$row_regions[0]."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
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
                        <td colspan="2">Region əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ad:</td><td><input type="text" name="region_name" id="region_name"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Ad ru:</td><td><input type="text" name="region_name_ru" id="region_name"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Ad en:</td><td><input type="text" name="region_name_en" id="region_name"  /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="regionm"  />
                <input type="hidden" name="action" value="do_add">
            </form>
<?php } ?>
<?php 
	if($action == "do_add") {
		$name = addslashes(htmlspecialchars($_POST['region_name']));
		$name_ru = addslashes(htmlspecialchars($_POST['region_name_ru']));
		$name_en = addslashes(htmlspecialchars($_POST['region_name_en']));
		$result = mysql_query("INSERT INTO regions (regionName,regionName_ru,regionName_en) VALUES ('$name','$name_ru','$name_en') ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=regionm&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print "Error";
			print mysql_error();	
		}
	}
?>
<?php 
	if($action == "edit") {
		$region_id = (int) $_GET['key'];
		$result_region = mysql_query("SELECT regionId,regionName,regionName_ru,regionName_en FROM regions WHERE regionId='".$region_id."' ");
		$row_region = mysql_fetch_array($result_region);
?>
		
        	<form action="" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Regionu yenilə <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Ad:</td><td><input type="text" name="region_name" id="region_name"  value="<?php echo $row_region['regionName']; ?>" /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Ad ru:</td><td><input type="text" name="region_name_ru" id="region_name"  value="<?php echo $row_region['regionName_ru']; ?>" /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Ad en:</td><td><input type="text" name="region_name_en" id="region_name"  value="<?php echo $row_region['regionName_en']; ?>" /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="regionm"  />
                <input type="hidden" name="region_id" value="<?php echo $region_id; ?>"  />
                <input type="hidden" name="action" value="do_edit">
            </form>
        
        
<?php } ?>
<?php 
	if($action == "do_edit") {
		$region_id = $_POST['region_id'];
		$name = $_POST['region_name'];
		$name_ru = $_POST['region_name_ru'];
		$name_en = $_POST['region_name_en'];
		
		$result = mysql_query("UPDATE regions SET regionName='$name',regionName_ru='$name_ru',regionName_en='$name_en' WHERE regionId='$region_id' ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=regionm&action=show\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print mysql_error();	
		}
	}
	
	if($action == "delete") {
		$region_id = (int) $_GET['key'];
		$result = mysql_query("DELETE FROM regions WHERE regionId='$region_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=regionm&action=show\">";  //change redirect
			exit("<center>Success</center>");
		}
	}
?>
