<?php 
	if($includekey !="erasiteKey") {
		exit("Access denied");
	}
	if(empty($subaction)){
	
		print "<table width='500' border='1' cellspacing='0' cellpadding='3'>
				  <tr>
					<td width=50>&nbsp;№</td>
					<td>&nbsp;Material name</td>
					<td>&nbsp;Locations</td>
				  </tr>";
		$result_list = mysql_query("SELECT id,name FROM articles WHERE cat_id=11 ");
		$row_list = mysql_fetch_array($result_list);
		$c = 1;
		do {
				$result_menu = mysql_query("SELECT table_id,menu_id,(SELECT name FROM menu b WHERE b.id=a.menu_id) as menu FROM left_banner a WHERE article_id='".$row_list['id']."' ");
				$row_menu = mysql_fetch_array($result_menu);
				print "<tr>
						<td valign=top>&nbsp;$c</td>
						<td valign=top>&nbsp;<b>".$row_list['name']."</b> &nbsp; <a href='?action=$action&subaction=add_menu&article_id=".$row_list['id']."'>Add menu</a></td>
						<td valign=top>";
						do {
							print "<div>".$row_menu[2]."&nbsp;<a href='?action=$action&subaction=delete_lm&lm_id=".$row_menu[0]."' onclick=\"return confirm('Are you sure delete?');\" ><strong>x</strong></a></div>";
						} while($row_menu = mysql_fetch_array($result_menu));
				print	"</td>
					  </tr>";
		
		
		} while($row_list = mysql_fetch_array($result_list));
		
		print "</table>";
	}
	if($subaction == "add_menu"){
		$article_id = $_GET['article_id'];
		if(!is_numeric($article_id)){
			exit("Argument error");
		}
		
		$result_name = mysql_query("SELECT name FROM articles  WHERE id='$article_id' ");
		$row_name = mysql_fetch_array($result_name);
		
		print "<form action=$sname method=post><b>&nbsp;";
		print  	$row_name['name'];
		print   "</b><br>";
		$result_menu = mysql_query("SELECT id,name FROM menu");
		$row_menu = mysql_fetch_array($result_menu);
		print "<select name=menu_id>";
		do {
		
				print "<option value='".$row_menu['id']."'>".$row_menu['name']."</option>";
		
		} while($row_menu = mysql_fetch_array($result_menu));
		print "</select><br>";
		print "<input type=submit name=ok value='Add'>";
		print  "<input type=hidden name=article_id value='".$article_id."' >";
		print  "<input type=hidden name=action value='$action' >";
		print  "<input type=hidden name=subaction value='do_add_menu' >";
		print "</form>";
	}
	
	if($subaction == "do_add_menu") {
	
		$article_id = $_POST['article_id'];
		$menu_id = $_POST['menu_id'];
		$result_chk = mysql_query("SELECT table_id FROM left_banner WHERE article_id='$article_id' and menu_id='$menu_id' ");
		if(mysql_num_rows($result_chk)>0) {
			print "Already exist";	
		} else {
			$result_insert = mysql_query("INSERT INTO left_banner (article_id,menu_id) VALUES ('$article_id','$menu_id') ");
			if($result_insert) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?action=$action \">";  //change redirect
				exit("<center></center>"); 
			} else { print "Error"; }
		}
		
	}
	
	if($subaction == "delete_lm") {
		
		$table_id = $_GET['lm_id'];
		if(!is_numeric($table_id)) {
			exit("Argument error");
		}
		$result = mysql_query("DELETE FROM left_banner WHERE table_id='$table_id' ");
		if($result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?action=$action \">";  //change redirect
				exit("<center></center>"); 
			} else { print "Error"; }
	}
?>
