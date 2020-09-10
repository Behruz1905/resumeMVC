<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A" && $user_data['userType'] != "HV"  && $user_data['userType'] != "DV") { exit("Access denied"); }   ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />

<?php 
	if($action == "show_vacations"){
?>
			<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">
                <tr class="ui_table_title">
                    <td colspan="8">Vakansiyalar <?php if($user_data['userType'] == "HV") { print " Marketing"; } else if($user_data['userType'] == "DV") { print " Depo"; } ?><input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=vacationm&action=add'"  /></td>
                </tr>
                <tr class="iu_table_header">
                    <td class="iu_center_short">№</td>
                    <td>Başlıq</td>
                    <td>Məzmun</td>
                    <td>Status</td>
                    <td>Tarix</td>
                    <td>Maas</td>
                    <td align="center">Müraciətlər</td>
                    <td class="iu_center_short"></td>
                    <td class="iu_center_short"></td>
                </tr>
                <?php 
                    $query_vacations = "SELECT  vacationId,vacationTitle,vacationTitle_ru,vacationTitle_en,vacationDesc,vacationDesc_ru,vacationDesc_en,vacationDate,vacationStatus,vacationType,salary FROM vacations WHERE vacationId IS NOT NULL";
                    if($user_data['userType'] == "HV") { $query_vacations .= " AND vacationType='HV' "; }
					else if($user_data['userType'] == "DV") { $query_vacations .= " AND vacationType='DV' "; }
					$result_vacations = $mysql->query($query_vacations,true);
					if(!$result_vacations)
					    die("melumat yoxdu");
                    $n = 1;
					foreach( $result_vacations as $row_vacations){
                        print "<tr class=\"iu_table_mean\">
                                    <td class=\"iu_center_short\" >$n</td>
                                    <td >".$row_vacations['vacationTitle']."</td>
                                    <td >".$row_vacations['vacationDesc']."</td>
									<td >".$row_vacations['vacationStatus']."</td>
                                    <td >".$row_vacations['vacationDate']."</td>
                                     <td >".$row_vacations['salary']."</td>
									<td  align=\"center\"><a href=\"?smode=page&item=vacationm&action=show_cvs&key=".$row_vacations['vacationId']."\"><img src=\"jpanel/jpanel_img/read_more.png\" width=\"24\"  /></a></td>
                                    <td class=\"iu_center_short\"><a href=\"?smode=page&item=vacationm&action=edit&key=".$row_vacations['vacationId']."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>
                                    <td class=\"iu_center_short\"><a href=\"?smode=page&item=vacationm&action=delete&key=".$row_vacations['vacationId']."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
                                </tr>";
                        $n++;
                    }
                ?>
        
            </table>

<?php 	
	}
	if($action == "delete") {
		$key = intval($_GET['key']);
		if(!empty($key)){
			$query_vacations = "DELETE FROM vacations WHERE vacationId='$key' ";
			if($user_data['userType'] == "HV") { $query_vacations .= " AND vacationType='HV' "; }
			else if($user_data['userType'] == "DV") { $query_vacations .= " AND vacationType='DV' "; }
			$result = mysql_query($query_vacations);
			if($result){
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_vacations\">";  //change redirect
					exit("<center>Success</center>"); 
			}
		}
	}
	if($action == "add"){
?>
		<form action="" method="post"  id="add_form">
			<table class="iu_table" border="1" cellspacing="0" width="600" >
				<tr class="ui_table_title">
					<td colspan="2">Vakansiya əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
				</tr>
				<tr>
					<td class="ui_labels">Başlıq:</td><td><input type="text" name="title" id="title"  style="width:500px; " /></td>
				</tr>
				 <tr>
					<td class="ui_labels">Başlıq ru:</td><td><input type="text" name="title_ru" id="title_ru" style="width:500px; "  /></td>
				</tr>
				 <tr>
					<td class="ui_labels">Başlıq en:</td><td><input type="text" name="title_en" id="title_en" style="width:500px; "></td>
				</tr>
                <tr>
                    <td class="ui_labels">Maas:</td><td><input type="text" name="salary" id="salary"  style="width:500px; " /></td>
                </tr>
                
                <tr>
					<td class="ui_labels">Məzmun:</td><td><textarea name="desc" style="width:500px; height:200px;"></textarea></td>
				</tr>
                <tr>
					<td class="ui_labels" nowrap="nowrap">Məzmun ru:</td><td><textarea name="desc_ru" style="width:500px; height:200px;"></textarea></td>
				</tr>
                <tr>
					<td class="ui_labels" nowrap="nowrap">Məzmun en:</td><td><textarea name="desc_en" style="width:500px; height:200px;"></textarea></td>
				</tr>
			</table>
			<input type="hidden" name="smode" value="page"  />
			<input type="hidden" name="item" value="vacationm"  />
			<input type="hidden" name="action" value="do_add">
		</form>
<?php 		
	}
	
	if($action == "do_add"){
		
		if(!empty($_POST['title'])){
				if($user_data['userType'] == "DV") { $vacationType = "DV"; }
				else { $vacationType = "HV"; }



            $data = [
                'vacationTitle' => SqlInjectFilterMini($_POST['title']),
                'vacationTitle_ru' => SqlInjectFilterMini($_POST['title_ru']),
                'vacationTitle_en' => SqlInjectFilterMini($_POST['title_en']),
                'vacationDesc' => addslashes($_POST['desc']),
                'vacationDesc_ru' => addslashes($_POST['desc_ru']),
                'vacationDesc_en' => addslashes($_POST['desc_en']),
                'vacationDate' => date("Y-m-d H:i:s"),
                'vacationStatus' => 'A',
                'vacationType' =>  $vacationType,
                'salary' => SqlInjectFilterMini($_POST['salary'])

            ];


            $mysql->insert('vacations', $data);
				
//				$query_insert = "INSERT INTO vacations (vacationTitle,vacationTitle_ru,vacationTitle_en,vacationDesc,vacationDesc_ru,vacationDesc_en,vacationDate,
//														vacationStatus,vacationType)
//										VALUES ('".SqlInjectFilterMini($_POST['title'])."',
//												'".SqlInjectFilterMini($_POST['title_ru'])."',
//												'".SqlInjectFilterMini($_POST['title_en'])."',
//												'".addslashes($_POST['desc'])."',
//												'".addslashes($_POST['desc_ru'])."',
//												'".addslashes($_POST['desc_en'])."',NOW(),'A','$vacationType') ";
//				$result_insert = mysql_query($query_insert);
				if($mysql->insert_id()) {
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_vacations\">";  //change redirect
					exit("<center>Success</center>"); 
				} else {
					print "Error";
					print mysql_error();	
				}
		}
		
	}
	
	if($action == "edit"){
		if(empty($_GET['key'])) { exit("Invalid param"); }
		$vacation_id = intval($_GET['key']);
		
		$query_vacations = "SELECT  vacationId,vacationTitle,vacationTitle_ru,vacationTitle_en,vacationDesc,vacationDesc_ru,vacationDesc_en,vacationDate,vacationStatus,vacationType,salary FROM vacations WHERE vacationId='$vacation_id' ";
		if($user_data['userType'] == "HV") { $query_vacations .= " AND vacationType='HV' "; }
		else if($user_data['userType'] == "DV") { $query_vacations .= " AND vacationType='DV' "; }
		$result_vacations = $mysql->query($query_vacations,true);
		
		$row_vacations = $result_vacations[0];
		
?>		
		<form action="" method="post"  id="add_form">
			<table class="iu_table" border="1" cellspacing="0" width="600" >
				<tr class="ui_table_title">
					<td colspan="2">Vakansiya əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>
				</tr>
				<tr>
					<td class="ui_labels">Başlıq:</td><td><input type="text" name="title" id="title"  style="width:500px; "  value="<?php echo $row_vacations['vacationTitle']; ?>" /></td>
				</tr>
				 <tr>
					<td class="ui_labels">Başlıq ru:</td><td><input type="text" name="title_ru" id="title_ru" style="width:500px; " value="<?php echo $row_vacations['vacationTitle_ru']; ?>"  /></td>
				</tr>
				 <tr>
					<td class="ui_labels">Başlıq en:</td><td><input type="text" name="title_en" id="title_en" style="width:500px; " value="<?php echo $row_vacations['vacationTitle_en']; ?>" ></td>
				</tr>

                <tr>
                    <td class="ui_labels">Maas:</td><td><input type="text" name="salary" id="salary"  value="<?php echo $row_vacations['salary']; ?>" style="width:500px; " /></td>
                </tr>
                
                <tr>
					<td class="ui_labels">Məzmun:</td><td><textarea name="desc" style="width:500px; height:200px;"><?php echo stripslashes($row_vacations['vacationDesc']); ?></textarea></td>
				</tr>
                <tr>
					<td class="ui_labels" nowrap="nowrap">Məzmun ru:</td><td><textarea name="desc_ru" style="width:500px; height:200px;"><?php echo stripslashes($row_vacations['vacationDesc_ru']); ?></textarea></td>
				</tr>
                <tr>
					<td class="ui_labels" nowrap="nowrap">Məzmun en:</td><td><textarea name="desc_en" style="width:500px; height:200px;"><?php echo stripslashes($row_vacations['vacationDesc_en']); ?></textarea></td>
				</tr>
                <tr>
					<td class="ui_labels" nowrap="nowrap">Status:</td><td><select name="status" ><option value="A">Aktiv</option><option value="D">Deaktiv</option></select></td>
				</tr>
			</table>
			<input type="hidden" name="smode" value="page"  />
			<input type="hidden" name="item" value="vacationm"  />
			<input type="hidden" name="action" value="do_edit">
            <input type="hidden" name="key" value="<?php echo $vacation_id; ?>">
		</form>
<?php 	
	}
	
	if($action == "do_edit"){
		
		$vacation_id = intval($_POST['key']);
		if(!empty($_POST['title'])){
				if($user_data['userType'] == "DV") { $vacationType = "DV"; }
				else { $vacationType = "HV"; }

            $mysql->where("vacationId", $vacation_id);

            $data = [
                'vacationTitle' => SqlInjectFilterMini($_POST['title']),
                'vacationTitle_ru' => SqlInjectFilterMini($_POST['title_ru']),
                'vacationTitle_en' => SqlInjectFilterMini($_POST['title_en']),
                'vacationDesc' => addslashes($_POST['desc']),
                'vacationDesc_ru' => addslashes($_POST['desc_ru']),
                'vacationDesc_en' => addslashes($_POST['desc_en']),
                'vacationStatus' => SqlInjectFilterMini($_POST['status']),
                'salary' => SqlInjectFilterMini($_POST['salary'])
            ];

            $result = $mysql->update('vacations', $data);



				if($result) {
					echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_vacations\">";  //change redirect
					exit("<center>Success</center>"); 
				} else {
					print "Error";
					print mysql_error();	
				}
		}
		
	}
?>
<?php 
	if($action == "show_cvs"){
		$vacation_id = intval($_GET['key']);
		
		$result_vk = $mysql->query("SELECT vacationTitle,vacationType FROM vacations WHERE vacationId='$vacation_id' ",true);



		$row_vk = $result_vk[0];
		if($user_data['userType'] != "A") { if($ro_vk['vacationType'] != $user_data['userType']){ exit("Invalid vacation"); } }
?>
			<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">
                <tr class="ui_table_title">
                    <td colspan="8">Müraciətlər:  <?php print $row_vk['vacationTitle']; ?></td>
                </tr>
                <tr class="iu_table_header">
                    <td class="iu_center_short">№</td>
                    <td>Ad Soyad</td>
                    <td>Tarix</td>
                    <td width="70" align="center">Ətraflı bax</td>
                    <td width="70" align="center">Baxılıb</td>
                    <td class="iu_center_short"></td>
                </tr>
                <?php 
                    $result_cvs = $mysql->query("SELECT cvId,cvDate,cvRead,cvName,cvPhoto FROM cvs WHERE vacationId='$vacation_id' ", true);
                    $n = 1;
					foreach( $result_cvs as $row_cvs) {
                        print "<tr class=\"iu_table_mean\">
                                    <td class=\"iu_center_short\" >$n</td>
                                    <td >".$row_cvs['cvName']."</td>
                                    <td >".$row_cvs['cvDate']."</td>
									<td align=\"center\" ><img src=\"jpanel/jpanel_img/read_more.png\" width=\"24\" style='cursor:pointer;' onclick='show_cv(".$row_cvs['cvId'].")'  /></td>
									<td align=\"center\" >";
									if($row_cvs['cvRead'] == 1) { print "<a href=\"?smode=page&item=vacationm&action=setcv_unread&key=".$row_cvs['cvId']."&vacation=".$vacation_id."\"><img src=\"jpanel/jpanel_img/ok.png\" ></a>"; }
									else {  print "<a href=\"?smode=page&item=vacationm&action=setcv_read&key=".$row_cvs['cvId']."&vacation=".$vacation_id."\"><img src=\"jpanel/jpanel_img/stop.png\" ></a>";  }
						print		"</td>
                                    <td class=\"iu_center_short\"><a href=\"?smode=page&item=vacationm&action=delete_cv&key=".$row_cvs['cvId']."&vacation=".$vacation_id."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
                                </tr>";
                        $n++;
                    }
                ?>
        
            </table>

<?php 	
	} 
	if($action == "setcv_read") {
		$cv_id = intval($_GET['key']);
		$vacation_id = intval($_GET['vacation']);

        $mysql->where("cvId", $cv_id);
		$data = [
		  'cvRead' => 1
        ];
		//"UPDATE cvs SET cvRead=1 WHERE cvId='$cv_id' ",true
		$result = $mysql->update("cvs",$data);
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_cvs&key=$vacation_id\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
	if($action == "setcv_unread") {
		$cv_id = intval($_GET['key']);
		$vacation_id = intval($_GET['vacation']);
		$result = mysql_query("UPDATE cvs SET cvRead=0 WHERE cvId='$cv_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_cvs&key=$vacation_id\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
	if($action == "delete_cv") {
		$cv_id = intval($_GET['key']);
		$vacation_id = intval($_GET['vacation']);
		$result = $mysql->query("DELETE FROM cvs  WHERE cvId='$cv_id' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=vacationm&action=show_cvs&key=$vacation_id\">";  //change redirect
			exit("<center>Success</center>"); 
		}
	}
?>