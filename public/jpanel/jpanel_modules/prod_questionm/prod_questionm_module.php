<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");   ?>
<?php 

	$subaction = $_REQUEST['subaction'];
	
	if(!isset($_REQUEST['subaction'])) {
		
			if(isset($_GET['archieve'])) { $archieve = 1; } else { $archieve = 0; }
			
			print  "<a href='?smode=page&item=prod_questionm&action=show' class=\"quess_link\" ";
			if($archieve != 1) { print " id=\"active_link\" "; }
			print  ">Cavablanmamishlar</a>&nbsp;&nbsp;";
			print  "<a href='?smode=page&item=prod_questionm&action=show&archieve=1' class=\"quess_link\" ";
			if($archieve == 1) { print " id=\"active_link\" "; }
			print  ">Cavablanmishlar</a>";
			if($archieve == 1) {
				$query = "SELECT id,question,question_date,answer,username,answered,applied,productId FROM product_question_answer WHERE answered=1 ";
			} else {
				$query = "SELECT id,question,question_date,answer,username,answered,applied,productId FROM product_question_answer WHERE answered=0 ";
			}
			$result = mysql_query($query);
			if(mysql_num_rows($result)>0) {
				$row = mysql_fetch_array($result);
				do {
						print "<table width='700' border='1' cellspacing='0' cellpadding='5' style='margin-top:5px; border-collapse:collapse;'>
								  <tr>
									<td>&nbsp;".$row['username']."  &nbsp; ".$row['question_date']." &nbsp;&nbsp;&nbsp;";
										if($row['applied'] == 1) { print "<a href=\"?smode=page&item=prod_questionm&action=show&subaction=apply&qw=".$row['id']."&type=deny\" title='Deaktiv et'><img src=\"jpanel/jpanel_img/ok.png\" border='0' ></a>"; }
										else { print "<a href=\"?smode=page&item=prod_questionm&action=show&subaction=apply&qw=".$row['id']."&type=apply\" title='Aktiv et'><img src=\"jpanel/jpanel_img/stop.png\" border='0' ></a>"; }
						print		"</td>
								  </tr>
								  <tr>
									<td><strong>Mal:</strong>&nbsp;<a href=\"index.php?smode=page&item=product&product=".$row['productId']."\">".getShopProductName($row['productId'],"az")."</a></td>
								  </tr>
								  <tr>
									<td><strong>Sual:</strong>&nbsp;".$row['question']."</td>
								  </tr>
								  <tr>
									<td><strong>Cavab:</strong>&nbsp;".$row['answer']."</td>
								  </tr>
								  <tr>
									<td>&nbsp;";
									if($row['answered']==0) { 
										print "<a href='?smode=page&item=prod_questionm&action=show&subaction=edit_question&question_id=".$row['id']."'>Answer</a>";
									} else {
										print "<a href='?smode=page&item=prod_questionm&action=show&subaction=edit_question&question_id=".$row['id']."'><img src='jpanel/jpanel_img/edit.png' ></a>";
									}
						print			"&nbsp;<a href='?smode=page&item=prod_questionm&action=show&subaction=delete_question&question_id=".$row['id']."' onclick=\"return confirm('Silinsin?');\"><img src='jpanel/jpanel_img/remove.png' ></a>";
						print		"</td>
								  </tr>
								</table>";
				
				} while($row = mysql_fetch_array($result));	
			}	
	
	}
	
	if($subaction == "apply") {
		
			$type = $_GET['type'];
			$qw_id = $_GET['qw'];
			if(!is_numeric($qw_id)) { exit("Invalid question"); }
			
			if($type == "apply") {
				$result = mysql_query("UPDATE product_question_answer SET applied=1 WHERE id='$qw_id' ");
			}
			
			if($type == "deny") {
				$result = mysql_query("UPDATE product_question_answer SET applied=0 WHERE id='$qw_id' ");
			}
			
			if($result) {
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prod_questionm&action=show \">";  //change redirect
				exit("<center>Success</center>"); 
			}
			else { exit("Error in setting"); }
			
		
	}
	
	if($subaction == "edit_question") {
			
			$id = $_GET['question_id'];
			$query = "SELECT id,question,question_date,answer,username,answered,productId FROM product_question_answer WHERE id='$id' ";
			$result = mysql_query($query);
			if(mysql_num_rows($result)>0) {
				$row = mysql_fetch_array($result);
				
						print "<form action='$sname' method=post>";
						print "<table width='700' border='1' cellspacing='0' cellpadding='5' style='margin-top:5px; border-collapse:collapse;'>
								  <tr>
									<td>&nbsp;".$row['username']."  &nbsp; ".$row['question_date']."</td>
								  </tr>
								  <tr>
									<td valign=top><strong>Sual:</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
						print			"<textarea name=question class='answer_area' style=\"vertical-align:top;\">".$row['question']."</textarea>";
						print		"</td>
								  </tr>
								  <tr>
									<td><strong>Cavab:</strong>&nbsp;";
						print			"<textarea name=answer class='answer_area' style=\"vertical-align:top;\">".$row['answer']."</textarea>";
						print		"</td>
								  </tr>
								  <tr>
									<td align=right>&nbsp;";
						print 			"<input type='submit' name='ok' value='Yadda saxla'>";
						print			"&nbsp;<input type=button name=cancel value='Imtina' onclick=\"javascript:window.location.href='?action=question_answer'\" >";
						print		"&nbsp;</td>
								  </tr>
								</table>";
						print   "<input type=hidden name=id value='$id'>";
						print   "<input type=hidden name=action value='show'>";
						print   "<input type=hidden name=subaction value='do_edit_question'>";
						print   "<input type=hidden name=smode value='page'>";
						print   "<input type=hidden name=item value='prod_questionm'>";
						print  "</form>";
			}	
			
	}
	
	if($subaction == "do_edit_question") {
	
		$id = clean($_POST['id']);
		if($id == "") { exit(""); }
		$answer = clean($_POST['answer']);
		$question = clean($_POST['question']);
		$date = date("Y-m-d");
		
		if(clean($answer) !="" ) { $answered = 1; } else { $answered = 0; }
		
		$query = "UPDATE product_question_answer SET question='$question',answer='$answer',answer_date='$date',answered='$answered'  WHERE id='$id' ";
		$result = mysql_query($query);
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prod_questionm&action=show \">";  //change redirect
			exit("<center>Success</center>"); 
		}
		else { exit("Error in adding"); }	
	}
	
	if($subaction == "delete_question") {
		$id = clean($_GET['question_id']);
		if($id == "") { exit(""); }
		
		$query = "DELETE FROM product_question_answer WHERE id='$id' ";
		$result = mysql_query($query);
		if($result) {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prod_questionm&action=show \">";  //change redirect
			exit("<center>Success</center>"); 
		}
		else { exit("Error in adding"); }	
	
	}

?>