<?php 
	if($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>"); 
	if($user_data['root'] == false) { exit("<center>Access denied</center>"); } 
?>

<?php 
	if($action == "show_access") {
?>
        <table id="access_table" cellpadding="3" cellspacing="0" border="1">
            <tr id="head_tr">
                <td width="50" align="center">№</td>
                <td width="200">Obyektin adi</td>
                <td width="200">Modul və ya kateqoriya</td>
                <td width="100">Tip</td>
                <td width="50" align="center">Sil</td>
            </tr>
            <?php 
				$result_access = mysql_query("SELECT objectId,objectCode,subjectId,accessId,subjectCode,objectType,subjectType,accessType,(SELECT CONCAT(userName,' ',userSurname) FROM jusers u WHERE u.userCode=a.objectCode) AS userData FROM module_access a WHERE   objectType='user' AND  subjectType='module' GROUP BY objectCode ");
				$a_n = 1;
				while($row_access = mysql_fetch_array($result_access)){
					
					if($row_access['subjectCode'] == "poll") {
						$module = "Sorğular";
					} else if($row_access['subjectCode'] == "ideas") {
						$module = "İdeyalar";
					} else {
						$module = get_category_name($row_access['subjectCode']);
					}
					print "<tr>
							<td align=\"center\">1</td>
							<td>".$row_access['userData']."</td>
							<td>".$module."</td>
							<td>";
							
							$result_acccess_item = mysql_query("SELECT accessType FROM module_access WHERE subjectCode='".$row_access['subjectCode']."' AND objectType='user' AND  subjectType='module' AND objectCode='".$row_access[1]."'   ");
							while($row_access_item = mysql_fetch_array($result_acccess_item)) {
								if($row_access_item[0] == "read") {
									print "<span class=\"access_item_type\">Oxu</span>";
								} 
								if($row_access_item[0] == "write") {
									print "<span class=\"access_item_type\">Yaz</span>";
								} 
								if($row_access_item[0] == "edit") {
									print "<span class=\"access_item_type\">Dəyiş</span>";
								} 
								if($row_access_item[0] == "delete") {
									print "<span class=\"access_item_type\">Sil</span>";
								} 
							}
							
					print	"</td>
							<td align=\"center\"><a href='?smode=page&item=access&action=delete_access&accessId=".$row_access['accessId']."' onclick=\"return confirm('Silmeye eminsiniz');\"><img src=\"resources/images/delete.png\" border=0  /></a></td>
						</tr>";
					
				}
				
			?>
            
            <tr>
                <td colspan="5"><input type="button" id="add_access" value="Giriş hüququ əlavə et" class="main_ui_button"  onclick="window.location.href='?smode=page&item=access&action=add_access'" /></td>
            </tr>
        </table>
<?php } ?>
<?php 
	if($action == "add_access") {
			
?>
	<form action="?" method="post" >
        <table id="access_table" cellpadding="3" cellspacing="0" border="1">
            <tr id="head_tr">
                <td colspan="2">&nbsp;Moderator hüquqları</td>
            </tr>
            <tr>
                <td><strong>Obyekt:</strong></td><td><input type="text" class="main_ui_text" id="object_name" /> <img src="jpanel/jpanel_img/add_big.png" id="fill_object_name"  /> <div id="access_object_name"><span id="access_object_span"></span> <img src="jpanel/jpanel_img/remove.png" id="remove_found_access" /></div><input type="hidden" name="access_object_code" id="access_object_code" value="0" /></td>
            </tr>
            <tr>
                <td><strong>Modul və ya kateqoriya:</strong></td>
                <td>
                	<select id="subject" name="subject">
                		<?php 
							$result_cats = mysql_query("SELECT id,name FROM cats ");
							while($row_cats = mysql_fetch_array($result_cats)){
								print "<option value=\"".$row_cats[0]."\">".$row_cats[1]."</option>";	
							}
						?>
                        <option value="poll" >Sorğular</option>
                        <option value="ideas" >İdeyalar</option>
                	</select>
                </td>
             </tr>
            <tr>
                <td width="150"><strong>Tip:</strong></td><td>&nbsp;Oxu <input type="checkbox" name="read_access" id="read_access" class="access_checks"  /> Yaz <input type="checkbox" name="write_access" id="read_access" class="access_checks"  /> Dəyiş <input type="checkbox" name="edit_access" id="read_access" class="access_checks" /> Sil <input type="checkbox" name="delete_access" id="read_access" class="access_checks"  /></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type="submit" id="add_access" value="Giriş hüququ əlavə et" class="main_ui_button"  onclick="window.location.href='?smode=page&item=access&action=add_access'" /></td>
            </tr>
        </table>
    	<input type="hidden" name="smode" value="page"  />
        <input type="hidden" name="item" value="access"  />
        <input type="hidden" name="action" value="do_add_access"  />
    </form>
<?php } ?>

<?php 
	if($action == "do_add_access") {
		
		$object_code = $_POST['access_object_code'];
		if($object_code != ""){
			$module_id = $_POST['subject'];
			
			if($_POST['read_access'] == true){
				mysql_query("DELETE FROM module_access WHERE objectCode='".$object_code."'  AND objectType='user' AND subjectType='module' AND subjectId='$module_id' AND accessType='read' ");
				mysql_query("INSERT INTO module_access (objectCode,subjectCode,objectType,subjectType,accessType) VALUES ('".$object_code."','$module_id','user','module','read') ");
			}
			if($_POST['write_access'] == true) {
				mysql_query("DELETE FROM module_access WHERE objectCode='".$object_code."'  AND objectType='user' AND subjectType='module' AND subjectId='$module_id' AND accessType='write' ");
				mysql_query("INSERT INTO module_access (objectCode,subjectCode,objectType,subjectType,accessType) VALUES ('".$object_code."','$module_id','user','module','write') ");
			}
			
			if($_POST['edit_access'] == true) {
				mysql_query("DELETE FROM module_access WHERE objectCode='".$object_code."'  AND objectType='user' AND subjectType='module' AND subjectId='$module_id' AND accessType='edit' ");
				mysql_query("INSERT INTO module_access (objectCode,subjectCode,objectType,subjectType,accessType) VALUES ('".$object_code."','$module_id','user','module','edit') ");
			}
			if($_POST['delete_access'] == true) {
				mysql_query("DELETE FROM module_access WHERE objectCode='".$object_code."'  AND objectType='user' AND subjectType='module' AND subjectId='$module_id' AND accessType='delete' ");
				mysql_query("INSERT INTO module_access (objectCode,subjectCode,objectType,subjectType,accessType) VALUES ('".$object_code."','$module_id','user','module','delete') ");
			}
			
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=access&action=show_access \">";  //change redirect
			exit("<center>Ok</center>"); 
			
		}
	}
?>
<?php 
	if($action == "delete_access"){
		
		$accessId = (int) $_GET['accessId'];
		$result_delete = mysql_query("DELETE FROM module_access WHERE accessId='$accessId' ");
		if($result_delete) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=access&action=show_access \">";  //change redirect
				exit("<center>Ok</center>");
		}
	}
?>