<?php 	if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); 	if($user_data['userType'] != "A") exit("Access denied");  ?><?php if($action == "show") { 			$base_sql = "SELECT cpuserId,cpUserName,cpuserStatus,sellerId,cpuserLogin,cpuserType FROM cp_users WHERE cpuserId IS NOT NULL ";			$where = "";			$comp_sql = $base_sql." ".$where;			$users_result = $mysql->query($comp_sql,true);?><table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="800">        <tr class="ui_table_title">        	<td colspan="8">Kontrol panel istifadəçiləri <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=cpuserm&action=add'"  /></td>        </tr>        <tr class="iu_table_header">        	<td class="iu_center_short">№</td>            <td >Ad</td>            <td>Login</td>            <td>Tipi</td>            <td class="iu_center_short">Status</td>            <td class="iu_center_short"></td>            <td class="iu_center_short"></td>        </tr>        <?php 			$n=1;			foreach( $users_result as $users_row){				if($users_row['cpuserStatus'] == 1) { $status = "Aktiv"; } else { $status = "Deaktiv"; }				print "<tr class=\"iu_table_mean\">						<td class=\"iu_center_short\">$n</td>						<td>".$users_row['cpUserName']."</td>						<td>".$users_row['cpuserLogin']."</td>						<td>".getUserTypeByCode($users_row['cpuserType'])."</td>						<td class=\"iu_center_short\">".$status."</td>						<td class=\"iu_center_short\"><a href=\"?smode=page&item=cpuserm&action=edit&user=".$users_row['cpuserId']."\"><img src=\"jpanel/jpanel_img/edit.png\" border=\"0\"  /></a></td>						<td class=\"iu_center_short\"><a href=\"?smode=page&item=cpuserm&action=delete&user=".$users_row['cpuserId']."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=\"0\"  /></a></td>					</tr>";				$n++;			}		?>        </table> <?php } ?><?php if($action == "add") { ?>		        <form action="" method="post"  id="add_form">            <table class="iu_table" border="1" cellspacing="0" >                <tr class="ui_table_title">                    <td colspan="2">Kontrol panelə istifadəçi əlavə et <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>                </tr>                                <tr>                    <td class="ui_labels">Ad Soyad:</td>                    <td><input type="text" class="main_ui_text" style="width:260px;"  name="name" /> </td>                </tr>                <tr>                    <td class="ui_labels">Login:</td>                    <td><input type="text" class="main_ui_text" style="width:160px;"  name="login" id="login" />  </td>                </tr>                <tr>                    <td class="ui_labels">Parol:</td>                    <td><input type="password" class="main_ui_text" style="width:160px;"  name="password" id="password" /> </td>                </tr>                <tr>                    <td class="ui_labels">Təkrar parol:</td>                    <td><input type="password" class="main_ui_text" style="width:160px;"  name="re_password" id="re_password" /> </td>                </tr>                                                                <tr>                    <td class="ui_labels">Tipi:</td>                    <td>                    	<select name="type" class="ui_select" id="user_type" >                        	<?php 								$result_type = $mysql->query("SELECT userTypeCode,userTypeName FROM cp_usertypes ",true);								foreach($result_type as $row_type){									print "<option value=\"".$row_type['userTypeCode']."\">".$row_type['userTypeName']."</option>";								}							?>                        </select>                    </td>                </tr>                                                 <tr style="display:none;" id="aptek_tr" >                    <td class="ui_labels">Aptek:</td>                    <td>                    	<select name="pharmacy" class="ui_select"  >                        	<option value="0">Apteki seçin</option>                        	<?php 								$result_ph = mysql_query("SELECT id,LogicalRef,DEFINATION FROM clcard WHERE LogicalRef NOT IN (SELECT logicalRef FROM cp_users WHERE cpUserType='AI')  AND INSERT_CHECK IS NULL");								while($row_ph = mysql_fetch_array($result_ph)){									print "<option value=\"".$row_ph['LogicalRef']."\">".$row_ph['DEFINATION']."</option>";								}							?>                        </select>                    </td>                </tr>                                                <tr>                    <td class="ui_labels">Status:</td>                    <td>                    	<select name="status" class="ui_select" >                        	<option value="1">Aktiv</option>                            <option value="0">Deaktiv</option>                        </select>                    </td>                </tr>                                            </table>            <input type="hidden" name="smode" value="page"  />            <input type="hidden" name="item" value="cpuserm"  />            <input type="hidden" name="action" value="do_add">        </form><?php } ?><?php 	if($action == "do_add") {		$login = SqlInjectFilterMini($_POST['login']);			$name = SqlInjectFilterMini($_POST['name']);			$password = encodeUserPassword($_POST['password']);			$type = SqlInjectFilterMini($_POST['type']);		$pharmacy = SqlInjectFilterMini($_POST['pharmacy']);		$status = (int) $_POST['status'];				if(!empty($login) && !empty($name) && !empty($type)) {		    $data = [                'cpUserName' => $name,                'cpuserStatus' => $status,                'cpuserLogin' => $login,                'cpuserType' => $type,                'cpuserPassword' => $password,                'logicalRef' => $pharmacy            ];            $mysql->insert('cp_users', $data);		}				if($mysql->insert_id()) {			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show\">";  //change redirect			exit("<center>Success</center>"); 		} else {			print mysql_error();			}		}?><?php 	  if($action == "edit") {			$user = (int) $_GET['user'];			//$row_user = mysql_fetch_array(mysql_query("SELECT cpuserId,cpUserName,cpuserStatus,sellerId,cpuserLogin,cpuserType FROM cp_users WHERE cpuserId='$user' "));			$result_cpuser = $mysql->query("SELECT cpuserId,cpUserName,cpuserStatus,sellerId,cpuserLogin,cpuserType FROM cp_users WHERE cpuserId='$user' ",true);            $row_user = $result_cpuser[0];?>			<form action="" method="post"  id="add_form">            <table class="iu_table" border="1" cellspacing="0" >                <tr class="ui_table_title">                    <td colspan="2">Kontrol panelə istifadəçisini dəyiş  <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>                </tr>                                <tr>                    <td class="ui_labels">Ad Soyad:</td>                    <td><input type="text" class="main_ui_text" style="width:260px;"  name="name" value="<?php echo $row_user['cpUserName'] ?>" /> </td>                </tr>                <tr>                    <td class="ui_labels">Login:</td>                    <td><input type="text" class="main_ui_text" style="width:160px;"  name="login" id="login" value="<?php echo $row_user['cpuserLogin'] ?>" />  </td>                </tr>                <tr>                    <td class="ui_labels">Parol:</td>                    <td><input type="password" class="main_ui_text" style="width:160px;"  name="password" id="password" /> </td>                </tr>                <tr>                    <td class="ui_labels">Təkrar parol:</td>                    <td><input type="password" class="main_ui_text" style="width:160px;"  name="re_password" id="re_password" /> </td>                </tr>                                <tr>                    <td class="ui_labels">Tipi:</td>                    <td>                    	<select name="type" class="ui_select" >                        	<?php 								$result_type = $mysql->query("SELECT userTypeCode,userTypeName FROM cp_usertypes ",true);								 foreach( $result_type as $row_type){									print "<option value=\"".$row_type['userTypeCode']."\" ";									if($row_type['userTypeCode'] == $row_user['cpuserType']) { print " selected "; }									print ">".$row_type['userTypeName']."</option>";								}							?>                        </select>                    </td>                </tr>                           <tr>                    <td class="ui_labels">Status:</td>                    <td>                    	<select name="status" class="ui_select" >                        	<option value="1" <?php if($row_user['cpuserStatus'] == "1") { print "selected"; } ?> >Aktiv</option>                            <option value="0" <?php if($row_user['cpuserStatus'] == "0") { print "selected"; } ?> >Deaktiv</option>                        </select>                    </td>                </tr>                                            </table>            <input type="hidden" name="smode" value="page"  />            <input type="hidden" name="item" value="cpuserm"  />            <input type="hidden" name="action" value="do_edit">            <input type="hidden" name="user" value="<?php echo $user; ?>"  />        </form><?php } ?><?php 	if($action == "do_edit") {		$user = (int) $_POST['user'];		$login = SqlInjectFilterMini($_POST['login']);			$name = SqlInjectFilterMini($_POST['name']);			$type = SqlInjectFilterMini($_POST['type']);				$status = (int) $_POST['status'];        $mysql->where("cpuserId", $user);		if(empty($_POST['password'])) {            $data = [                "cpUserName" => $name,                "cpuserStatus" =>  $status,                "cpuserLogin" => $login,                "cpuserType" => $type            ];            $result = $mysql->update("cp_users",$data);		} else {			$password = encodeUserPassword($_POST['password']);            $data = [                "cpUserName" => $name,                "cpuserStatus" =>  $status,                "cpuserLogin" => $login,                "cpuserType" => $type,                "cpuserPassword" => $password            ];            $result = $mysql->update("cp_users",$data);		}		if($result) {			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show\">";  //change redirect			exit("<center>Success</center>"); 		}	}?><?php 	if($action == "delete") {		$user = (int) $_GET['user'];			$result = $mysql->query("DELETE FROM cp_users WHERE cpuserId='$user' ");		if($result) {			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show\">";  //change redirect			exit("<center>Success</center>"); 		}	}?><?php /* user types */	if($action == "show_types") { 			$base_sql = "SELECT userTypeId,userTypeName,candelete,userTypeCode FROM cp_usertypes  ";			$users_result = $mysql->query($base_sql,true);?><table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="400">        <tr class="ui_table_title">        	<td colspan="5">Kontrol panel istifadəçi tipləri <input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=cpuserm&action=add_type'"  /></td>        </tr>        <tr class="iu_table_header">        	<td class="iu_center_short">№</td>            <td >Kod</td>            <td>Tip</td>            <td class="iu_center_short"></td>            <td class="iu_center_short"></td>        </tr>        <?php 			$n=1;			foreach($users_result as $users_row){				print "<tr class=\"iu_table_mean\">						<td class=\"iu_center_short\">$n</td>						<td>".$users_row['userTypeCode']."</td>						<td>".$users_row['userTypeName']."</td>						<td class=\"iu_center_short\"><a href=\"?smode=page&item=cpuserm&action=edit_type&type=".$users_row['userTypeId']."\"><img src=\"jpanel/jpanel_img/edit.png\" border=\"0\"  /></a></td>";						print "<td class=\"iu_center_short\">"; 						if($users_row['candelete'] == 1) print "<a href=\"?smode=page&item=cpuserm&action=delete_type&type=".$users_row['userTypeId']."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=\"0\"  /></a>";						print "</td>";								print  "</tr>";				$n++;			}		?>        </table> <?php } ?><?php if($action == "add_type") { ?>		        <form action="" method="post"  id="add_form_type">            <table class="iu_table" border="1" cellspacing="0" >                <tr class="ui_table_title">                    <td colspan="2">Kontrol panel istifadəçi tipi əlavə et <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button_type"  /></td>                </tr>                                <tr>                    <td class="ui_labels">Tip:</td>                    <td><input type="text" class="main_ui_text" style="width:260px;"  name="type" id="type" /> </td>                </tr>                <tr>                    <td class="ui_labels">Kod:</td>                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="code"  id="code" />  </td>                </tr>                          </table>            <input type="hidden" name="smode" value="page"  />            <input type="hidden" name="item" value="cpuserm"  />            <input type="hidden" name="action" value="do_add_type">        </form><?php } ?><?php 	if($action == "do_add_type") {		$type = SqlInjectFilterMini($_POST['type']);		$code = SqlInjectFilterMini($_POST['code']);			if(empty($type) || empty($code)) {			exit("Xanalari doldurun");			} else {            $data = [                'userTypeName' => $type,                'userTypeCode' => $code            ];            $mysql->insert('cp_usertypes', $data);			if($mysql->insert_id()) {				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show_types\">";  //change redirect				exit("<center>Success</center>"); 			} else {				print mysql_error();				}		}		}?><?php 	  if($action == "edit_type") {			$type = (int) $_GET['type'];			$result_user = $mysql->query("SELECT userTypeId,userTypeName,candelete,userTypeCode FROM cp_usertypes WHERE userTypeId='$type' ",true);			$row_user = $result_user[0];?>			<form action="" method="post"  id="add_form_type">            <table class="iu_table" border="1" cellspacing="0" >                <tr class="ui_table_title">                    <td colspan="2">Kontrol panel istifadəçi tipini dəyiş  <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button_type"  /></td>                </tr>                                <tr>                    <td class="ui_labels">Tip:</td>                    <td><input type="text" class="main_ui_text" style="width:260px;"  name="type_name" id="type" value="<?php echo $row_user['userTypeName'] ?>" /> </td>                </tr>                <tr>                    <td class="ui_labels">Kod:</td>                    <td><input type="text" class="main_ui_text" style="width:60px;"  name="code"  id="code" value="<?php echo $row_user['userTypeCode'] ?>" />  </td>                </tr>                                                                           </table>            <input type="hidden" name="smode" value="page"  />            <input type="hidden" name="item" value="cpuserm"  />            <input type="hidden" name="action" value="do_edit_type">            <input type="hidden" name="type" value="<?php echo $type; ?>"  />        </form><?php } ?><?php 	if($action == "do_edit_type") {		$type = (int) $_POST['type'];				$type_name = SqlInjectFilterMini($_POST['type_name']);		$code = SqlInjectFilterMini($_POST['code']);							if(empty($type) || empty($type_name) || empty($code)) {			exit("Xanalari doldurun");			} else {            $mysql->where("userTypeId", $type);            $data = [                'userTypeName' => $type_name,                'userTypeCode' => $code            ];            $result = $mysql->update('cp_usertypes', $data);			if($result) {				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show_types\">";  //change redirect				exit("<center>Success</center>"); 			} else {				print mysql_error();				}		}	}?><?php 	if($action == "delete_type") {		$type = (int) $_GET['type'];		$result = $mysql->query("DELETE FROM cp_usertypes WHERE userTypeId='$type' ");		if($result) {			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=cpuserm&action=show_types\">";  //change redirect			exit("<center>Success</center>"); 		}	}?>