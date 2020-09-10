<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />
<?php 
	if($action == "show"){
			$cat_id = intval($_GET['catid']);
			
											
?>
	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="800">
    	<tr class="ui_table_title">
        	<td colspan="10">Fields - <?php print get_category_name($cat_id,"az"); ?> <input type="button" name="add_new" id="add_new" value="Add field" class="main_ui_button" onclick="window.location.href='?smode=page&item=catfields&action=add&catid=<?php print $cat_id; ?>'"  /></td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td>Field name</td>
            <td>Field code</td>
            <td>Field desc</td>
            <td>Type</td>
            <td>Max length</td>
            <td>Required</td>
            <td>Set id</td>
            <td class="iu_center_short"></td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			$result_fields = $mysql->query("SELECT id,
												fieldName,
												fieldDesc,
												catId,
												fieldType,
												fieldViewType,
												fieldMaxLen,
												fieldControlType,
												fieldRegEx,
												isRequired,
												fieldCode,
												fieldSetId 
											FROM cat_fields WHERE  catId='$cat_id' ",true);
			$n = 1;
			foreach( $result_fields as $row_fields){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\" valign=\"top\">$n</td>
							<td valign=\"top\">".$row_fields['fieldName']."</td>
							<td valign=\"top\">".$row_fields['fieldCode']."</td>
							<td valign=\"top\">".$row_fields['fieldDesc']."</td>
							<td valign=\"top\">".$row_fields['fieldType']."</td>
							<td valign=\"top\">".$row_fields['fieldMaxLen']."</td>
							<td valign=\"top\">".$row_fields['isRequired']."</td>
							<td valign=\"top\">";
							if($row_fields['fieldType'] == "cat"){ print "Category -> ".get_category_name($row_fields['fieldSetId'],"az"); }
							if($row_fields['fieldType'] == "section"){ print "Section -> ".get_section_name($row_fields['fieldSetId']); }
				print		"</td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=catfields&action=edit&key=".$row_fields[0]."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=catfields&action=delete&key=".$row_fields[0]."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
						</tr>";
				$n++;
			}
		?>

    </table>
<?php } ?> 
<?php if($action == "add") { 
			
			$cat_id = intval($_GET['catid']);

?>
			<form action="" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Add Field - <?php print get_category_name($cat_id,"az"); ?> <input type="submit" name="ok" value="Save" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Name:</td><td><input type="text" name="fieldName" id="fieldName"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Description:</td><td><input type="text" name="fieldDesc" id="fieldDesc"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Type:</td>
                        <td>
                        	<select id="fieldType" name="fieldType">
                            	<option value="text">Text</option>
                                <option value="big_text">Big text</option>
                                <option value="section">From section (category select)</option>
                                <option value="cat">From category (material select)</option>
                                <option value="multisection">From section (multi category select)</option>
                                <option value="multicat">From category (multi material select)</option>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td class="ui_labels">Max len:</td><td><input type="text" name="fieldMaxLen" id="fieldMaxLen"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Regular expression:</td><td><input type="text" name="fieldRegEx" id="fieldRegEx"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Required:</td><td><input type="text" name="isRequired" id="isRequired"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Set id(material or category):</td><td><input type="text" name="fieldSetId" id="fieldSetId"  /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="catfields"  />
                <input type="hidden" name="catid" value="<?php print $cat_id; ?>"  />
                <input type="hidden" name="action" value="do_add">
            </form>
<?php } ?>
<?php 
	if($action == "do_add") {
		$fieldName = addslashes(htmlspecialchars($_POST['fieldName']));
		$fieldDesc = addslashes(htmlspecialchars($_POST['fieldDesc']));
		$catId = addslashes(htmlspecialchars($_POST['catid']));
		$fieldType = addslashes(htmlspecialchars($_POST['fieldType']));
		$fieldMaxLen = addslashes(htmlspecialchars($_POST['fieldMaxLen']));
		
		$fieldRegEx = addslashes(htmlspecialchars($_POST['fieldRegEx']));
		$isRequired = addslashes(htmlspecialchars($_POST['isRequired']));
		$fieldSetId = addslashes(htmlspecialchars($_POST['fieldSetId']));
		
		$code = clearUrlName($fieldName);
		
		
		$result = mysql_query("INSERT INTO cat_fields (fieldName,
													fieldDesc,
													catId,
													fieldType,
													fieldViewType,
													fieldMaxLen,
													fieldControlType,
													fieldRegEx,
													isRequired,
													fieldCode,
													fieldSetId
												) VALUES (
													'$fieldName','$fieldDesc','$catId','$fieldType','0','$fieldMaxLen','0','$fieldRegEx','$isRequired','$code','$fieldSetId'
												) ");
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=catfields&action=show&catid=$catId\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print "Error";
			print mysql_error();	
		}
	}
?>
<?php 
	if($action == "edit") {
		$id = (int) $_GET['key'];
		$result_fields = $mysql->query("SELECT id,
												fieldName,
												fieldDesc,
												catId,
												fieldType,
												fieldViewType,
												fieldMaxLen,
												fieldControlType,
												fieldRegEx,
												isRequired,
												fieldCode,
												fieldSetId 
											FROM cat_fields WHERE  id='$id' ",true);
	 $row_fields = $result_fields[0];
?>
		
        	<form action="" method="post"  id="add_form">
                <table class="iu_table" border="1" cellspacing="0" >
                    <tr class="ui_table_title">
                        <td colspan="2">Edit Field - <?php print get_category_name($row_fields['catId'],"az"); ?> <input type="submit" name="ok" value="Save" class="main_ui_button" id="add_button"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Name:</td><td><input type="text" name="fieldName" id="fieldName" value="<?php echo $row_fields['fieldName'];  ?>"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Description:</td><td><input type="text" name="fieldDesc" id="fieldDesc" value="<?php echo $row_fields['fieldDesc'];  ?>"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Type:</td>
                        <td>
                        	<select id="fieldType" name="fieldType">
                            	<option value="text" <?php  if($row_fields['fieldType'] == "text")  { print " selected "; } ?> >Text</option>
                                <option value="big_text" <?php  if($row_fields['fieldType'] == "big_text")  { print " selected "; } ?> >Big text</option>
                                <option value="section" <?php  if($row_fields['fieldType'] == "section")  { print " selected "; } ?> >From section (category select)</option>
                                <option value="cat" <?php  if($row_fields['fieldType'] == "cat")  { print " selected "; } ?> >From category (material select)</option>
                                <option value="multisection" <?php  if($row_fields['fieldType'] == "multisection")  { print " selected "; } ?>>From section (multi category select)</option>
                                <option value="multicat" <?php  if($row_fields['fieldType'] == "multicat")  { print " selected "; } ?>>From category (multi material select)</option>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td class="ui_labels">Max len:</td><td><input type="text" name="fieldMaxLen" id="fieldMaxLen" value="<?php echo $row_fields['fieldMaxLen'];  ?>"  /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Regular expression:</td><td><input type="text" name="fieldRegEx" id="fieldRegEx"  value="<?php echo $row_fields['fieldRegEx'];  ?>" /></td>
                    </tr>
                    <tr>
                        <td class="ui_labels">Required:</td><td><input type="text" name="isRequired" id="isRequired"  value="<?php echo $row_fields['isRequired'];  ?>"  /></td>
                    </tr>
                     <tr>
                        <td class="ui_labels">Set id(section or category):</td><td><input type="text" name="fieldSetId" id="fieldSetId"  value="<?php echo $row_fields['fieldSetId'];  ?>"   /></td>
                    </tr>
                </table>
                <input type="hidden" name="smode" value="page"  />
                <input type="hidden" name="item" value="catfields"  />
                <input type="hidden" name="key" value="<?php print $row_fields['id']; ?>"  />
                <input type="hidden" name="catid" value="<?php print $row_fields['catId']; ?>"  />
                <input type="hidden" name="action" value="do_edit">
            </form>
        
        
<?php } ?>
<?php 
	if($action == "do_edit") {
		
		$id = intval($_POST['key']);
		$catid = intval($_POST['catid']);
		$fieldName = addslashes(htmlspecialchars($_POST['fieldName']));
		$fieldDesc = addslashes(htmlspecialchars($_POST['fieldDesc']));
		$fieldType = addslashes(htmlspecialchars($_POST['fieldType']));
		$fieldMaxLen = addslashes(htmlspecialchars($_POST['fieldMaxLen']));
		
		$fieldRegEx = addslashes(htmlspecialchars($_POST['fieldRegEx']));
		$isRequired = addslashes(htmlspecialchars($_POST['isRequired']));
		$fieldSetId = addslashes(htmlspecialchars($_POST['fieldSetId']));


        $mysql->where("id", $id);

        $data = [
            'fieldName' => $fieldName,
            'fieldDesc' => $fieldDesc,
            'fieldType' => $fieldType,
            'fieldMaxLen' => $fieldMaxLen,
            'fieldRegEx' => $fieldRegEx,
            'isRequired' => $isRequired,
            'fieldSetId' => $fieldSetId
        ];

        $result_fields = $mysql->update('cat_fields', $data);

		if($result_fields) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=catfields&action=show&catid=$catid\">";  //change redirect
			exit("<center>Success</center>"); 
		} else {
			print mysql_error();	
		}
	}
	
	if($action == "delete") {
		$id = (int) $_GET['key'];
		//$result = mysql_query("DELETE FROM regions WHERE regionId='$region_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=catfields&action=show\">";  //change redirect
			exit("<center>Success</center>");
		}
	}
?>
