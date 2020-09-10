<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	$mainlink = "?smode=".$smode."&item=".$item;
	
	if($user_data['userType'] != "A" && $user_data['userType'] != "M") { exit("Access denied"); } 
	//-----------------------------------------------------articles ---------------------------------------------------------------
	
	if($_GET['action'] == "articles") {
		
		$section = intval($_REQUEST['section']);
		$base_sql = "SELECT id,cat_id,name,date_,publicity,mainpage,candelete,url_name FROM articles ";
		$where = "";
		$cat = addslashes(htmlspecialchars(trim($_GET['cat'])));


		$date_start = addslashes(htmlspecialchars(trim($_GET['start_date'])));
		$date_end =  addslashes(htmlspecialchars(trim($_GET['end_date'])));
		$keyword = addslashes(htmlspecialchars(trim($_GET['keyword'])));
		$tag = intval($_REQUEST['tag']);
		//die($cat);
		if(empty($section)) { $section = 6; }
		
		if($cat != "0") {
			if($cat != "" and $cat != "link") {
				$where .= " WHERE cat_id='$cat' ";
			} else 
			if($cat == "link") {
				$where .= " ";
			} 
		}
		if(!empty($date_start )){
			$where .= " AND date_ >='$date_start' ";
		}
		if(!empty($date_end )){
			$where .= " AND date_ <='$date_end' ";				
		}
		if(!empty($keyword )){
			$where .= " AND name LIKE '%".$keyword."%' OR title LIKE '%".$keyword."%' OR text LIKE '%".$keyword."%' ";				
		}
		
		$query = $base_sql."".$where;
		
		if($user_data['root'] != true) {
			$query = $query."  ";
		}
		
		if($user_data['userType'] == "M"){
			$query = $query." AND user_id='".$user_data['userId']."' ";
		}
		
		if(!empty($tag)) {
			$query = $query." AND id IN (SELECT articleId FROM article_tags WHERE tagId='$tag' ) ";
		}
		
//		if(!empty($section)) {
//			$query = $query." AND cat_id IN (SELECT id FROM cats WHERE sect_id='$section') ";
//		} else {
//
//		}
		
//		if($section == 7) {
//			$query = $query." OR cat_id=0 ";
//		}
		
		
		if(!empty($_REQUEST['cat'])) {
			$query = $query." ORDER BY place ASC ";
		} else {
			$query = $query." ORDER BY date_ DESC ";
		}
		
		$result_art = $mysql->query($query,true);
		
		if(!empty($_REQUEST['cat'])) { print "<input type=\"hidden\" name=\"cat_val\" id=\"cat_val\" value=\"1\">"; }
		else { print "<input type=\"hidden\" name=\"cat_val\" id=\"cat_val\" value=\"0\">"; }
		print "<form action='".$_SERVER['SCRIPT_NAME']."' >
					<table width='99%' cellspacing='0' cellpadding='3' style='border-collapse:collapse; margin-left:5px;' border='1' bordercolor=\"#dddddd\" id=\"material_head_filter_table\">
						 <tr class=\"edit_table_head_tr\">
						 	<td colspan=\"2\" id=\"section_menu_td\">";
//							$result_sections = $mysql->query("SELECT id,name FROM sections ORDER BY id",true);
//
//
//        foreach ($result_sections as $data){
//            print "<a href=\"?smode=page&item=material&action=articles&section=".$data['id']."\" ";
//            if($section == $data['id']) { print " id='selected_section_link' style=\"background-color:#95EBB4;\" "; }
//            print ">".$data['name']."</a>";
//        }


		print				"</td>
						 </tr>
						 <tr >
							<td align=left width=120>&nbsp;<strong>Kateqoriya</strong> </td><td>";
							
								print "<a href=\"?smode=page&item=material&action=articles\" class=\"catfilter\">Bütün kateqoriyalar</a>";
								
								//$result = mysql_query("SELECT id,name FROM cats WHERE sect_id='$section' ");
								$result = $mysql->query("SELECT id,name FROM cats",true);
								//var_dump($result);


								 foreach($result as $row){
									if($_REQUEST['cat'] == $row['id']) { $class = "class='catfilter filterselect'"; }
									else { $class = "class='catfilter'";  }
									print "<a href=\"?smode=page&item=material&action=articles&cat=".$row['id']."\" $class >".$row['name']."</a>";
								}
								
								print "<input type=hidden name=cat value='".$_REQUEST['cat']."' />";
							
		print				"</td>
						 </tr>
						 <tr>
							<td align=left width=120>&nbsp;<strong>Açar sözü</strong> </td><td><input type=\"text\" name=\"keyword\"  class='ui_text' style='width:360px;' "; if(!empty($keyword)) { print " value='".$keyword."' "; }print "></td>
						 </tr>
						 <tr>
							<td width=100>&nbsp;<strong>Tarix</strong> </td><td><input type=text name='start_date' id='start_date' value='$date_start' >&nbsp;-dən <input type=text name='end_date' id='end_date' value='$date_end'> -ə</td>
						 </tr>
						 <tr>	
							<td></td>
							<td>
								<input type=submit name=search value='Axtar' class='main_button' style=\"background-image:url(jpanel/jpanel_img/filter_add.png);\" >&nbsp;
								<input type=button name=search value='Filtri təmizlə' class='main_button' onclick=\"window.location.href='$mainlink&action=articles&section=".$section."'\" style=\"background-image:url(jpanel/jpanel_img/filter_delete.png);\" >&nbsp;
								<input type=\"button\" id=\"add_material_button\" value=\"Material əlavə et\" onclick=\"window.location.href='$mainlink&action=add_article&cat=$cat'\" />
							</td>
						 </tr>
					</table>
					<input type=hidden name=action value='articles'>
					<input type=hidden name=smode value='page'>
					<input type=hidden name=section value='$section'>
					<input type=hidden name=item value='material'>
				</form>"; 
		if($result_art) {
		
			$i = 1;
			
			print "<table width='99%' border='1' cellspacing='0' cellpadding='3' style='border-collapse:collapse;' id=mater_table bordercolor=\"#CCC\">";
			
			print	  "<tr class='admin_head_tr nodrag'>
						 <td width='45' bgcolor='#DDDDDD' align=\"center\"><strong>№</strong></td>";
						 if(!empty($_REQUEST['cat'])) { print "<td width=\"25\" align=\"center\"><img src=\"jpanel/jpanel_img/updown2.gif\" /></td>"; }
						 
			print		 "<td bgcolor='#DDDDDD' ><strong>&nbsp;Adı</strong></td>
						  <td bgcolor='#DDDDDD'>Link</td>
						 <td width='14%' bgcolor='#DDDDDD'>&nbsp;<strong>Tarix</strong></td>
						 <td width='15%' bgcolor='#DDDDDD'><strong>&nbsp;Kateqoriya</strong></td>
						 <td width='60' bgcolor='#DDDDDD' align=\"center\"><strong>Status</strong></td>
						 <td width='60' bgcolor='#DDDDDD' align=\"center\" >&nbsp;<strong>Silmək</strong></td>
					   </tr>"; 
			print 	"<tbody>";	   
			foreach($result_art as $row) {
			      $cat = $row['cat_id'];   // bu elave olundu...........////////////////////////////////
				  if($row['publicity'] == 1) { 
					$cont = "<a href='$mainlink&action=set_publicity&type=ok&cat=".$cat."&id=".$row['id']."&section=".$section."&cat=$cat'><img src='jpanel/jpanel_img/ok.png' border=0 title='Aktiv'></a>";
				  } 
				  else { 
					$cont = "<a href='$mainlink&action=set_publicity&type=stop&cat=".$cat."&id=".$row['id']."&section=".$section."&cat=$cat'><img src='jpanel/jpanel_img/stop.png' border=0 title='Deaktiv'></a>";
				  }
				  if($row['candelete'] == 1){
						$candelete =  "<a href='$mainlink&action=delete_article&id=".$row['id']."&section=$section&cat=$cat' onclick=\"return confirm('Silinsin ?');\" ><img src='jpanel/jpanel_img/delete.png' border='0' title='Delete' width=20></a>";
				  } else {
						$candelete = "<img src='jpanel/jpanel_img/undelete.png' border='0' title='Disable delete' width=20>";
				  }
				  
				  print "<tr id='".$row['id']."' >
						 <td align=\"center\" >$i</td>";
						 
						 if(!empty($_REQUEST['cat'])) { print "<td  class='dragHandle'></td>"; }
				  print	 "<td>&nbsp;<a href='$mainlink&action=edit_article&id=".$row['id']."&section=$section&cat=$cat'>".$row['name']."</a></td>
				  		  <td><a href='index.php?smode=content&item=".$row['url_name']."' target='_blank'>?smode=content&item=".$row['url_name']."</a></td>
						 <td >&nbsp;<a href='$mainlink&action=edit_article&id=".$row['id']."&section=$section&cat=$cat'>".$row['date_']."</a></td>
						 <td>&nbsp;<a href='$mainlink&action=edit_article&id=".$row['id']."&section=$section&cat=$cat'>".getcategory($row['id'])."</a></td>
						 <td align=center align=\"center\">".$cont."</td>
						 <td align=center>".$candelete."</td>
					   </tr>";
				 $i++;
			}
			print 	"</tbody>";	  
		
		  print "</table>";
		
		} else {
			print "<br><center><strong>Bazada ".getSectioinHName($section)." yoxdur</strong></center>";
		}
	}
	
	
	
	if($_GET['action'] == "add_article") {
		
		$section = intval($_GET['section']);
		$cat = intval($_GET['cat']);
	
		print "<form action='?' method=post enctype='multipart/form-data'>";
		print "<table width='850' border='0' cellpadding='0' cellspacing='0' bordercolor='dddddd' style='border-collapse:collapse; margin-left:15px;' id='article_add_table'>
				  <tr>
					<td align='right' style='padding-right:160px;' colspan=2></td>
				  </tr>
										  
				  <tr>
					<td colspan=2>
							<table width='850' border='0' cellpadding='3' cellspacing='0' id='az_table'>
							 <tr>
							 	<td  id=\"action_head_name\">&nbsp;".getSectioinHName($section)." əlavə et</td><td align=right id=\"action_head_btn\">  <input type='submit' name='ok_add_article' value='Yadda saxla' style='margin-right:15px;' class='main_ui_button' ></td>
							 </tr>
							 <tr>
								<td width=\"155\" valign=\"middle\">&nbsp;&nbsp;Kateqoriya   &nbsp;&nbsp;</td>
								<td>";
								
										print "<select name=\"cat\" class='filter_controls'>";
//										if($section == 6) {
//											print  	"<option value=\"page\">Modul</option>";
//										}
										
										
										$result = $mysql->query("SELECT id,name FROM cats",true);

										
										
										foreach($result as $row){
											print "<option value=\"".$row['id']."\" ";
													if($cat == $row['id']) { print " selected ";}
											print ">".$row['name']."</option>";
										}
										print "</select>";
								
		print					"</td>
							 </tr>
							
							 <tr>
								<td>&nbsp;&nbsp;Əsas şəkil</td>
								<td >
									<input  name='picture' id='picture' style='width:400px;'>
									<a href=\"javascript:;\" onclick=\"mcImageManager.browse({fields : 'picture', relative_urls : true});\">[Şəkli buradan seçin]</a>
								</td>
							  </tr> 
							  <tr>
								<td>&nbsp;&nbsp;Kiçik şəkil</td>
								<td>
									<input  name='thumb' id='thumb' style='width:400px;'>
									<a href=\"javascript:;\" onclick=\"mcImageManager.browse({fields : 'thumb', relative_urls : true});\">[Şəkli buradan seçin]</a>
								</td>
							  </tr> 
							  
							  <tr>
								<td>&nbsp;&nbsp;Fayl</td>
								<td>
									<input  name='video' id='video' style='width:400px;'>
									<a href=\"javascript:;\" onclick=\"mcFileManager.browse({fields : 'video', relative_urls : true});\">[Videonu buradan seçin]</a>
								</td>
							  </tr>
							  
							  <tr>
								<td >&nbsp;&nbsp;Adı</td>
								<td ><input name='name' type='text' id='name_az' maxlength='80'></td>
							  </tr>";
					
					print	"<tr>
								<td colspan=\"2\">";
								?>	  
							  		<div id='lang_content'>
										<ul>
											<li style="margin-left: 10px;">Azəri</li>
											<li>Rus</li>
											<li>İngilis</li>
										</ul>
										<div >
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td><strong>Başlıq</strong></td>
                                                    <td><input name='title' type='text' id='title_az' maxlength='250'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə</strong></td>
                                                    <td><textarea name='description' class='description'  rows='5' ></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn</strong></td>
                                                    <td><textarea name='text' class='text'  rows='5'></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat</strong></td>
                                                    <td><textarea name='addData'  rows='5' class='answer_area'></textarea></td>
                                                  </tr>
                                            </table>
                                        </div>
                                        <div>
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	 <tr>
                                                    <td><strong>Başlıq ru</strong></td>
                                                    <td><input name='title_ru' type='text' id='title_ru' maxlength='250'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə ru</strong></td>
                                                    <td><textarea name='description_ru' class='description'  rows='5' ></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn ru</strong></td>
                                                    <td><textarea name='text_ru' class='text'  rows='5'></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat ru</strong></td>
                                                    <td><textarea name='addData_ru'  rows='5' class='answer_area'></textarea></td>
                                                  </tr>
                                            </table>
                                        </div>
                                        <div>
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	  <tr>
                                                    <td><strong>Başlıq en</strong></td>
                                                    <td><input name='title_en' type='text' id='title_en' maxlength='250'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə en</strong></td>
                                                    <td><textarea name='description_en' class='description'  rows='5' ></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn en</strong></td>
                                                    <td><textarea name='text_en' class='text'  rows='5'></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat en</strong></td>
                                                    <td><textarea name='addData_en'  rows='5' class='answer_area'></textarea></td>
                                                  </tr>
                                         	</table>
                                        </div>
										
									</div>
                    		 <?php
					print  	  "</td>
							</tr>";	
							
					$result_cat_fields = $mysql->query("SELECT id,fieldName,fieldType,fieldMaxLen,isRequired,fieldSetId,fieldCode FROM cat_fields WHERE catId='$cat' ",true);
					if($result_cat_fields){
							print	  "<tr>
											<td valign='top' colspan=\"2\" bgcolor=\"#CAD4DF\">
												<strong>Əlavə xanalar</strong>
												<input type=\"hidden\" name=\"hasfield\" value=\"1\" />
											</td>
									  </tr>";
							foreach($result_cat_fields as $row_fields){
								print	  "<tr>
											<td valign='top'>".$row_fields['fieldName']."</td>
											<td>";
											if($row_fields['fieldType'] == "text") {
												print "<input type=\"text\" name=\"".$row_fields['fieldCode']."@fld"."\"  style='width:450px;'>";
											} else if($row_fields['fieldType'] == "big_text") {
												print "<input type=\"text\" name=\"".$row_fields['fieldCode']."@fld"."\"  style='width:450px;'>";
											} else if($row_fields['fieldType'] == "cat") {
												$result_set = $mysql->query("SELECT id,name FROM articles  WHERE cat_id='".$row_fields['fieldSetId']."' ",true);
												print "<select name=\"".$row_fields['fieldCode']."@fld"."\"  >";
												print "<option value=\0\" >Secin</option>";
												foreach($result_set as $row_set){
													print "<option value=\"".$row_set['id']."\" >".$row_set['name']."</option>";
												}
												print "</select>";
											} else if($row_fields['fieldType'] == "multicat") {
												$result_set = $mysql->query("SELECT id,name FROM articles  WHERE cat_id='".$row_fields['fieldSetId']."' ",true);
												foreach($result_set as $row_set){
													print "<div > <input type=checkbox name=\"".$row_fields['fieldCode']."_fld[]"."\" value=\"".$row_set['id']."\" id='chk_".$row_set['id']."'> <label for='chk_".$row_set['id']."'>".$row_set['name']."</label></div>";
												}
											}
											
								print		"</td>
										  </tr>";
							}
							
						print	"<tr>
									<td  bgcolor='#CAD4DF' height=10></td>
									<td  bgcolor='#CAD4DF'></td>
								  </tr>";
					} else { print "<input type=\"hidden\" name=\"hasfield\" value=\"0\" />";}
					
					
					print	  "<tr>
								<td valign='top'>Açar sözlər (vergüllə ayırın)</td>
								<td><textarea name='tags'  rows='5' class='answer_area'></textarea></td>
							  </tr>
							  <tr>
								<td valign='top'>Teqlər </td>
								<td><input type=\"text\" id=\"tagbox\" name=\"tagbox\" style=\"width:560px;\" /></td>
							  </tr>
							  
							  
						
							  <tr>
								<td>Başlama tarixi</td>
								<td><input type=text name=date id='start_date' value='".date("Y-m-d")." 00:00' ></td>
							  </tr>
							  <tr>
								<td>Bitmə tarixi</td>
								<td><input type=text name=enddate id='end_date' value='".date("Y-m-d")." 23:59' ></td>
							  </tr>
							  
							   <tr>
								<td>Seçilən</td>
								<td><input type=checkbox name=featured ></td>
							  </tr>
							 
							  <tr>
								<td >Status </td>
								<td>
								  <select name='publicity' id='publicity'>
									<option value=1 >Aktiv</option>
									<option value=0 selected>Deaktiv</option>
								  </select>
								 </td>
							  </tr>";
							  if($cat == 3):
                                             print  "<tr>
                                                <td >Həkim</td>
                                                <td>
                                                  <select name='autor' >";
                                                print				"<option value=0 >Seçin</option>";

                                                        $result_auth_cat = $mysql->query("SELECT id,name FROM articles WHERE cat_id IN (SELECT id FROM cats) ",true);
                                                        foreach($result_auth_cat as $row_auth_cat){
                                                            print "<optgroup label=\"".$row_auth_cat['name']."\">";
                                                            if($row_auth_cat['id'] == 3) {

                                                                $result_sub = $mysql->query("SELECT id,name FROM articles WHERE cat_id = '".$row_auth_cat['id']."'  ",true);
                                                                foreach($result_sub as $row_sub){
                                                                    print "<option value=\"".$row_sub['id']."\" ";
                                                                    if($sel_id == $row_sub['id']) { print " selected "; }
                                                                    print ">".$row_sub['name']."</option>";
                                                                }

                                                                break;


                                                            }

                                                            print "</optgroup>";
                                                        }
                                                        print "</select>";


                                                        print			  "</select>
                                                 </td>
                                              </tr>";

							  endif;
							  
							  print "<tr>
								<td></td>
								<td></td>
							  </tr>
													  
							</table>
					 </td>
				  </tr>"; 
		print	"</table>";
		print 	"<input type=hidden name='action' value='do_add_article'>";
		print 	"<input type=hidden name='smode' value='page'>";
		print 	"<input type=hidden name='item' value='material'>";
		//print 	"<input type=hidden name='section' value='$section'>";
		print "</form><br/>";
	}
	
	if($_POST['action'] == "do_add_article") {
		
		if(empty($_POST['name'])) { exit("<center>Materialın adını əlavə edin.</center>"); }
		if(!isset($_POST['ok_add_article'])) { exit("Error"); }
		
		$section = intval($_POST['section']);
		
		$catid = addslashes($_POST['cat']);
		if($catid == "link") {
			$catid = 0;	
		}
		
		
		if($catid == "link") {
			$catid = 0;	
		}
		
		$department = 0;
		$thumb = addslashes(htmlspecialchars($_POST['thumb']));
		$img_path  = addslashes(htmlspecialchars($_POST['picture']));
		$video  = addslashes(htmlspecialchars($_POST['video']));
		$date = htmlspecialchars(addslashes($_POST['date']));
		$enddate = htmlspecialchars(addslashes($_POST['enddate']));
		$publicity = (int) $_POST['publicity'];
		
		$autor = (int) $_POST['autor'];
		$last_news = 0;
		$send_subscribe = 0;
		if($_POST['featured']) {
			$feature_slide = 1;
		} else {
			$feature_slide = 0;
		}
		
		$lang = htmlspecialchars(addslashes($_POST['lang']));
		
		$name = htmlspecialchars(addslashes($_POST['name']));
		$title = htmlspecialchars(addslashes($_POST['title']));
		$desc = addslashes($_POST['description']);
		$text = addslashes($_POST['text']);
		
		$title_ru = htmlspecialchars(addslashes($_POST['title_ru']));
		$desc_ru = addslashes($_POST['description_ru']);
		$text_ru = addslashes($_POST['text_ru']);
		
		
		$title_en = htmlspecialchars(addslashes($_POST['title_en']));
		$desc_en = addslashes($_POST['description_en']);
		$text_en = addslashes($_POST['text_en']);
		
		
		$addData = htmlspecialchars(addslashes($_POST['addData']));
		$addData_ru = htmlspecialchars(addslashes($_POST['addData_ru']));
		$addData_en = htmlspecialchars(addslashes($_POST['addData_en']));
		
		
		$tags = htmlspecialchars(addslashes($_POST['tags']));
		
		
		$url_name = clearUrlName($name);
		
		//$row_place = mysql_fetch_array(mysql_query("SELECT MAX(place) AS maxpl FROM articles WHERE cat_id='$catid' "));

		$query_place = $mysql->query("SELECT MAX(place) AS maxpl FROM articles WHERE cat_id='$catid' ",true);
        $row_place = $query_place[0];
        $new_place  = $row_place[0]+1;
		
			/* end uploading */
		$user_id =  $user_data['userId'];

        $data = [
            'cat_id' => $catid,
            'name' => $name,
            'main_img' => $img_path,
            'date_' => $date,
            'rate' => '0',
            'publicity' => $publicity,
            'user_id' => $user_id,
            'featured_news_slide' => $feature_slide,
            'last_news' => $last_news,
            'subscribe' => $send_subscribe,
            'thumb' => $thumb,
            'title' => $title,
            'description' => $desc,
            'text' => $text,
            'tags' => $tags,
            'secondDate' => $enddate,
            'title_ru' => $title_ru,
            'title_en' => $title_en,
            'description_ru' => $desc_ru,
            'description_en' => $desc_en,
            'text_ru' => $text_ru,
            'text_en' => $text_en,
            'url_name' => $url_name,
            'department' => $department,
            'video' => $video,
            'autor' => $autor,
            'place' => $new_place,
            'addData' => $addData,
            'addData_ru' => $addData_ru,
            'addData_en' => $addData_en
        ];


        $mysql->insert('articles', $data);

		
		//$result_article = mysql_query($query_article);
		$article_id = $mysql->insert_id();
		
		if($mysql->insert_id())
		{

			if($_POST['hasfield'] == "1") {
				$result_cat_fields = $mysql->query("SELECT id,fieldName,fieldType,fieldMaxLen,isRequired,fieldSetId,fieldCode FROM cat_fields WHERE catId='$catid' ",true);
				foreach( $result_cat_fields as $row_fields){
					if($row_fields['fieldType'] == "multicat"){
						$valarr = $_POST[$row_fields['fieldCode']."_fld"];
						$val_str = "";
						$inc = 0;
						foreach($valarr as $k=>$v){
							if($inc == 0) { $val_str .= $v; } else { $val_str .= ",".$v; }
							$inc++;
						}

                        $data = [
                            'articleId' => $article_id,
                            'fieldCode' => $row_fields['fieldCode'],
                            'fieldValue' => $val_str
                            ];



						//mysql_query("INSERT INTO article_fields (articleId,fieldCode,fieldValue) VALUES ('$article_id','".$row_fields['fieldCode']."','".$val_str."') ");
					} else {

                        $data = [
                            'articleId' => $article_id,
                            'fieldCode' => $row_fields['fieldCode'],
                            'fieldValue' => $_POST[$row_fields['fieldCode']."@fld"]
                        ];
					}
                    $mysql->insert('article_fields', $data);
					
				}
			}
			
			$tagbox = $_POST['tagbox'];
			
			if(!empty($tagbox)){
				$tag_arr = explode(",",$tagbox);
				foreach($tag_arr as $val) {
					
					$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));
					if(!empty($tagId) && $tagId != 0) {
                        $data = [
                            'articleId' => $article_id,
                            'tagId' => $tagId,
                            'catId' => $catid
                        ];

                        $mysql->insert('article_tags', $data);
						//mysql_query("INSERT INTO article_tags (articleId,tagId,catId) VALUES ('$article_id','$tagId','$catid') ");
						addArticleTag($tagId);
					}
				}
			}
			
			@logw($item,$action,$query_article);
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=$mainlink&action=articles&cat=$catid\">";  //change redirect
			exit("<center>Success</center>"); 
		}
		else { exit("<center>Error in adding</center>"); }
	}
	
	
	
	if($_GET['action'] == "edit_article") {
		
		$id = (int) $_GET['id'];
		$section = intval($_GET['section']);
		if(!isset($_GET['id']) or $id == "") { exit("Non exist parameters"); }
		
		$query = "SELECT id,cat_id,name,date_,autor,rate,publicity,main_img,user_id,featured_news_slide,last_news,subscribe,is_accepted,thumb,title,description,text,tags,secondDate,title_ru,title_en,description_ru,description_en,text_ru,text_en,video,department,addData,addData_ru,addData_en FROM articles WHERE id='$id'";
		$result = $mysql->query($query,true);
		$row = $result[0];

		$query_cat = "SELECT id, name from cats WHERE id = '".$row['cat_id']."' ";

		$result_cat = $mysql->query($query_cat,true);
		$row_cat = $result_cat[0];
        $catId = $row_cat['id'];

		
		print "<form action='".$_SERVER['SCRIPT_NAME']."' method=post enctype='multipart/form-data'>";
		print "<table width='500' border='0' cellpadding='0' cellspacing='0' bordercolor='dddddd' style='border-collapse:collapse;' id='article_add_table'>
				  
				  <tr>
					<td colspan=2><table width='700' border='0' cellpadding='3' cellspacing='0' id='az_table'>
								
							  <tr>
							 	<td  id=\"action_head_name\">&nbsp; Material redaktə et</td><td align=right id=\"action_head_btn\">  <input type='submit' name='ok_edit_article' value='Yadda saxla' style='margin-right:15px;' class='main_ui_button' ></td>
							 </tr>
							 
							 <tr>
								<td width=\"155\">"; echo "Kateqoriya   " . $row_cat['name'];
								echo
                              "</td>
								<td>";

								
		print					"</td>
							 </tr>
							  
							 <tr>
								<td>Əsas şəkil</td>
								<td >
									<input  name='picture' id='picture' style='width:400px;' value='".$row["main_img"]."' >
									<a href=\"javascript:;\" onclick=\"mcImageManager.browse({fields : 'picture', relative_urls : true});\">[Şəkli buradan seçin]</a>";
									if($row["main_img"] != "" ) { print "<img src='".$row["main_img"]."' style='max-height:300px;' >"; }
		print					"</td>
							  </tr> 
							  <tr>
								<td>Kiçik şəkil</td>
								<td>
									<input  name='thumb' id='thumb' style='width:400px;' value='".$row["thumb"]."'>
									<a href=\"javascript:;\" onclick=\"mcImageManager.browse({fields : 'thumb', relative_urls : true});\">[Şəkli buradan seçin]</a>";
									if($row["thumb"] != "" ) { print "<img src='".$row["thumb"]."' style='max-height:300px;' >"; }
		print					"</td>
							  </tr> 
							  
							  <tr>
								<td>Fayl</td>
								<td>
									<input  name='video' id='video' style='width:400px;' value='".$row["video"]."'>
									<a href=\"javascript:;\" onclick=\"mcFileManager.browse({fields : 'video', relative_urls : true});\">[Videonu buradan seçin]</a>
								</td>
							  </tr>
							  
							  <tr>
								<td >Adı</td>
								<td ><input name='name' type='text' id='name_az' maxlength='80' value='".stripslashes($row['name'])."'></td>
							  </tr>
							  
							  <tr>
							  	<td colspan=\"2\">"; ?>
                                	
                                    <div id='lang_content'>
										<ul>
											<li style="margin-left: 10px;">Azəri</li>
											<li>Rus</li>
											<li>İngilis</li>
										</ul>
										<div >
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td><strong>Başlıq</strong></td>
                                                    <td><input name='title' type='text' id='title_az' maxlength='250' value='<?=stripslashes($row['title'])?>'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə</strong></td>
                                                    <td><textarea name='description' class='description'  rows='5' ><?=stripslashes($row['description'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn</strong></td>
                                                    <td><textarea name='text' class='text'  rows='5'><?=stripslashes($row['text'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat </strong></td>
                                                    <td><textarea name='addData'  rows='5' class='answer_area'><?=stripslashes($row['addData'])?></textarea></td>
                                                  </tr>
                                            </table>
                                        </div>
                                        
                                        <div >
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td><strong>Başlıq ru</strong></td>
                                                    <td><input name='title_ru' type='text' id='title_ru' maxlength='250' value='<?=stripslashes($row['title_ru'])?>'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə ru</strong></td>
                                                    <td><textarea name='description_ru' class='description'  rows='5' ><?=stripslashes($row['description_ru'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn ru</strong></td>
                                                    <td><textarea name='text_ru' class='text'  rows='5'><?=stripslashes($row['text_ru'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat ru </strong></td>
                                                    <td><textarea name='addData_ru'  rows='5' class='answer_area'><?=stripslashes($row['addData_ru'])?></textarea></td>
                                                  </tr>
                                            </table>
                                        </div>
                                        
                                        <div >
                                        	<table width="95%" class="material_langs" cellpadding="5">
                                            	<tr>
                                                    <td><strong>Başlıq en</strong></td>
                                                    <td><input name='title_en' type='text' id='title_en' maxlength='250' value='<?=stripslashes($row['title_en'])?>'></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Qısa xülasə en</strong></td>
                                                    <td><textarea name='description_en' class='description'  rows='5' ><?=stripslashes($row['description_en'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Mətn en</strong></td>
                                                    <td><textarea name='text_en' class='text'  rows='5'><?=stripslashes($row['text_en'])?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td valign='top'><strong>Əlavə məlumat en</strong></td>
                                                    <td><textarea name='addData_en'  rows='5' class='answer_area'><?=stripslashes($row['addData_en'])?></textarea></td>
                                                  </tr>
                                            </table>
                                        </div>
                                        
                                    </div>
                                    
							  	<?php
			print				"</td>
							  </tr>";
							  
							  
							  $result_cat_fields = $mysql->query("SELECT id,fieldName,fieldType,fieldMaxLen,isRequired,fieldSetId,fieldCode FROM cat_fields WHERE catId='".$row['cat_id']."' ",true);
								if($result_cat_fields){

						
										print	  "<tr>
														<td valign='top' colspan=\"2\" bgcolor=\"#CAD4DF\">
															<strong>Əlavə xanalar</strong>
															<input type=\"hidden\" name=\"hasfield\" value=\"1\" />
														</td>
												  </tr>"; 
											
										foreach( $result_cat_fields as $row_fields){

							
											$value = getAddFieldValue($row_fields['fieldCode'],$id);
                                             
											
											print	  "<tr>
														<td valign='top'>".$row_fields['fieldName']."</td>
														<td>";
														if($row_fields['fieldType'] == "text") {
															print "<input type=\"text\" name=\"".$row_fields['fieldCode']."@fld"."\" value=\"$value\"  style='width:450px;'>";
														} else if($row_fields['fieldType'] == "big_text") {
															print "<input type=\"text\" name=\"".$row_fields['fieldCode']."@fld"."\"  value=\"$value\" style='width:450px;'>";

															$result_set = $mysql->query("SELECT id,name FROM articles  WHERE cat_id='".$row_fields['fieldSetId']."' ",true);
															print "<select name=\"".$row_fields['fieldCode']."@fld"."\"  >";
															print "<option value=\0\" >Secin</option>";
															foreach($result_set as $row_set){
																print "<option value=\"".$row_set['id']."\" ";
																if($row_set['id'] == $value) { print " selected "; }
																print ">".$row_set['name']."</option>";
															}
															print "</select>";
														} else if($row_fields['fieldType'] == "multicat") {
															$result_set = $mysql->query("SELECT id,name FROM articles  WHERE cat_id='".$row_fields['fieldSetId']."' ",true);
															$value_arr = explode(",",$value);
															//print_r($value_arr);
															foreach($result_set as $row_set){
																print "<div > <input type=checkbox name=\"".$row_fields['fieldCode']."_fld[]"."\" value=\"".$row_set['id']."\" id='chk_".$row_set['id']."' ";
																if(in_array($row_set['id'],$value_arr)) { 
																	
																	print "checked";
										
																}
																print "> <label for='chk_".$row_set['id']."'>".$row_set['name']."</label></div>";
															}
														}
														
											print		"</td>
													  </tr>";
										}
										
									print	"<tr>
												<td  bgcolor='#CAD4DF' height=10></td>
												<td  bgcolor='#CAD4DF'></td>
											  </tr>";
								} else { print "<input type=\"hidden\" name=\"hasfield\" value=\"0\" />";}
					
				print		  "<tr>
								<td valign='top'>Açar sözlər (vergüllə ayırın)</td>
								<td><textarea name='tags'  rows='5' class='answer_area'>".stripslashes($row['tags'])."</textarea></td>
							  </tr>
							  <tr>
								<td valign='top'>Teqlər </td>
								<td><input type=\"text\" id=\"tagbox\" name=\"tagbox\" style=\"width:560px;\" ";
								$result_tag = $mysql->query("SELECT tagId,(SELECT tagText FROM tags t WHERE p.tagId=t.tagId ) AS tagName FROM article_tags p WHERE articleId='$id' ",true);
								if($result_tag) {
									$tgi = 0;
									$tags = "";
									foreach( $result_tag as $row_tag){
										if($tgi == 0) {
											$tags.=$row_tag['tagText'];
										} else {
											$tags.=",".$row_tag['tagText'];
										}
										$tgi++;
									}
									print " value='".$tags."' ";	
								}	
					print	    "/></td>
							  </tr>";

                                 if($catId == 3 ) {

                                           echo "<tr>
                                            <td valign='top'>Şöbə</td>
                                            <td>";

								            getDepartmentSelect($row['department']);
                                     print		    "</td>
							                      </tr>";


                                 }



							print "  <tr>
								<td  bgcolor='#CAD4DF' height=10></td>
								<td  bgcolor='#CAD4DF'></td>
							  </tr>
							  
							  <tr>
								<td>Başlama tarixi</td>
								<td><input type=text name=date id=start_date value='".$row['date_']."' ></td>
							  </tr>
							  <tr>
								<td>Bitmə tarixi</td>
								<td><input type=text name=enddate id=end_date value='".$row['secondDate']."' ></td>
							  </tr>
							  
							  
							  <tr>
								<td>Seçilən</td>
								<td><input type=checkbox name='featured' ";
								if($row['featured_news_slide']==1) { print " checked "; }
						print	"></td>
							  </tr>
							 
							  <tr>
								<td >Status </td>
								<td>";
					print		 "<select name='publicity' id='publicity'>";
					print			"<option value=1";
								if($row['publicity'] == 1) { print " selected "; }
					print 			 ">Aktiv</option>";
					print			"<option value=0";
								if($row['publicity'] != 1) { print " selected "; }
					print			">Deaktiv</option>";
					print		 "</select>
								 </td>
							  </tr>";

               if($cat == 3):
							  
				print			   "<tr>
								<td >Həkim</td>
								<td>
								  <select name='autor' >";
				print				"<option value=0 >Seçin</option>";
										
										$result_auth_cat = $mysql->query("SELECT id,name FROM articles WHERE cat_id IN (SELECT id FROM cats) ",true);
										foreach( $result_auth_cat as $row_auth_cat){
											print "<optgroup label=\"".$row_auth_cat[1]."\">";
                                            $result_sub = $mysql->query("SELECT id,name FROM articles WHERE cat_id = '".$row_auth_cat['id']."'  ",true);
											//$result_sub = $mysql->query("SELECT id,name FROM doctors WHERE department='".$row_auth_cat['id']."'  ",true);
											foreach( $result_sub as $row_sub){
												print "<option value=\"".$row_sub[0]."\" ";
												if($row['autor'] == $row_sub['id']) { print " selected "; }
												print ">".$row_sub[1]."</option>";
											}
											print "</optgroup>";
										}
										print "</select>";
										
										
				      print			  "</select>
								 </td>
							  </tr>";
							  
					endif;

				  
					print "</table></td>
				  </tr>";
		print	"<tr>
					<td colspan=2>";
					
					print "<table id=\"material_gallery_table\" width=\"100%\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\"  bordercolor=\"#DDDDDD\">
							<tr>
								<td>
									<input type=\"text\" id=\"material_gallery_input\" name=\"material_gallery_input\"  disabled> <a href=\"javascript:;\" onclick=\"mcImageManager.browse({fields : 'material_gallery_input', relative_urls : true});\">[Choose image]</a>
									<br>
									<input type=\"text\" id=\"material_gallery_name\" name=\"material_gallery_name\" style=\"width:650px; margin-top:10px;\" /> Mətn az
									<br>
									<input type=\"text\" id=\"material_gallery_name_ru\" name=\"material_gallery_name_ru\" style=\"width:650px; margin-top:10px;\" /> Mətn ru
									<br>
									<input type=\"text\" id=\"material_gallery_name_en\" name=\"material_gallery_name_en\" style=\"width:650px; margin-top:10px;\" /> Mətn en
								</td>
								<td width=\"70\" align=\"center\"><img src=\"jpanel/jpanel_img/upload.png\" width=\"24\" id=\"material_gallery_upload\" title=\"Yüklə\" ></td>
							</tr>";
						
							$query_list = "SELECT img,tableId FROM articleimg WHERE articleid='".$id."' ";
							$result_list = $mysql->query($query_list,true);
							 foreach($result_list as $row_list){
								print "<tr id='material_gallery_row_".$row_list['tableId']."'>
										<td><img src='".$row_list['img']."' width='100' height='100'></td>
										<td class='material_gallery_delete_td'><img src='jpanel/jpanel_img/remove.png' width='20' id='".$row_list['tableId']."' class='material_gallery_delete_img' title='Sil' ></td>
									  </tr>";
							 }
							
					
							
					print 	 "</table>";
					
		print		"</td>
				</tr>";						 
		print	"</table>";
		print 	"<input type=hidden name='action' value='do_edit_article'>";
		print 	"<input type=hidden name='id' value='".$id."'>";
        print 	"<input type=hidden name='cat' value='".$catId."'>";
		print 	"<input type=hidden name='smode' value='page'>";
		print 	"<input type=hidden name='item' value='material'>";
		print "</form>";
		
	}
	
	if($_POST['action'] == "do_edit_article" )
	{
		if(!isset($_POST['id']) or $_POST['id']=="" or !is_numeric($_POST['id']) ) { exit("<center>Yalnis parametr</center>"); }
		if(!isset($_POST['ok_edit_article'])) { exit("<center>Yalnis parametr</center>"); }
		if(!isset($_POST['name']) or $_POST['name'] == "") { exit("<center>Adi daxil edin</center>"); }
		
		$id = (int) $_POST['id'];
		$catid = $_POST['cat'];
		$section = intval($_POST['section']);
		$autor = intval($_POST['autor']);
		
		$lang = addslashes(htmlspecialchars($_POST['lang']));
		
		$name = addslashes(htmlspecialchars($_POST['name']));
		
		if($_POST['featured']) {
			$feature_slide = 1;
		} else {
			$feature_slide = 0;
		}
		$date = htmlspecialchars(addslashes($_POST['date']));
		$enddate = htmlspecialchars(addslashes($_POST['enddate']));
		$publicity = (int) $_POST['publicity'];
		
		$img_path = addslashes(htmlspecialchars($_POST['picture']));
		$thumb = addslashes(htmlspecialchars($_POST['thumb']));
		$video = addslashes(htmlspecialchars($_POST['video']));
		$last_news = 0;
		$send_subscribe = 0;
		
		
		$name = htmlspecialchars(addslashes($_POST['name']));
		$title = htmlspecialchars(addslashes($_POST['title']));
		$desc = addslashes($_POST['description']);
		$text = addslashes($_POST['text']);
		$tags = htmlspecialchars(addslashes($_POST['tags']));
		
		$title_ru = htmlspecialchars(addslashes($_POST['title_ru']));
		$desc_ru = addslashes($_POST['description_ru']);
		$text_ru = addslashes($_POST['text_ru']);
		
		
		$title_en = htmlspecialchars(addslashes($_POST['title_en']));
		$desc_en = addslashes($_POST['description_en']);
		$text_en = addslashes($_POST['text_en']);
		
		
		$addData = addslashes(htmlspecialchars($_POST['addData']));
		$addData_ru = addslashes(htmlspecialchars($_POST['addData_ru']));
		$addData_en = addslashes(htmlspecialchars($_POST['addData_en']));

        //$ixtisas = $_POST['Ixtisas_fld'];
		
		
		$url_name = clearUrlName($name);
		
		$department = intval($_POST['department']);


        $mysql->where("id", $id);

        $data = [
            'cat_id' => $catid,
            'name' =>$name,
            'title' =>  $title,
            'description' => $desc,
            'text' => $text,
            'tags' => $tags,
            'date_' => $date,
            'publicity' => $publicity,
            'featured_news_slide' => $feature_slide,
            'last_news' => $last_news,
            'subscribe' => $send_subscribe,
            'main_img' => $img_path,
            'thumb' => $thumb,
            'secondDate' => $enddate,
            'title_ru' => $title_ru,
            'title_en' => $title_en,
            'description_ru' => $desc_ru,
            'description_en' => $desc_en,
            'text_ru' => $text_ru,
            'text_en' => $text_en,
            'url_name' => $url_name,
            'video' => $video,
            'department' => $department,
            'autor' => $autor,
            'addData' => $addData,
            'addData_ru' => $addData_ru,
            'addData_en' => $addData_en,
        ];



        $result_articles = $mysql->update('articles', $data);


//		$query_articles = "UPDATE articles SET cat_id='$catid',name='$name',title='$title',description='$desc',text='$text',
//                             tags='$tags',date_='$date',
//												publicity='$publicity',featured_news_slide='$feature_slide',
//												last_news='$last_news',subscribe='$send_subscribe',main_img='$img_path',
//												thumb='$thumb',secondDate='$enddate',title_ru='$title_ru',title_en='$title_en'
//												,description_ru='$desc_ru',description_en='$desc_en',
//												text_ru='$text_ru',text_en='$text_en',url_name='$url_name',video='$video',
//												department='$department',autor='$autor',addData='$addData',
//												addData_ru='$addData_ru',addData_en='$addData_en' WHERE id='$id' ";
//		$result_articles = mysql_query($query_articles);
		
		if($result_articles) { 
		
			if($_POST['hasfield'] == "1") {
				$mysql->query("DELETE FROM article_fields WHERE articleId='$id' ");
				$result_cat_fields = $mysql->query("SELECT id,fieldName,fieldType,fieldMaxLen,isRequired,fieldSetId,fieldCode FROM cat_fields WHERE catId='$catid' ",true);
				foreach($result_cat_fields as $row_fields){
					if($row_fields['fieldType'] == "multicat"){
						$valarr = $_POST[$row_fields['fieldCode']."_fld"];
						$val_str = "";
						$inc = 0;
						foreach($valarr as $k=>$v){
							if($inc == 0) { $val_str .= $v; } else { $val_str .= ",".$v; }
							$inc++;
						}
						echo $val_str;

                            $data = [
                                'articleId' => $id,
                                'fieldCode' => $row_fields['fieldCode'],
                                'fieldValue' => $val_str
                            ];

						$mysql->insert('article_fields', $data);
						$a =$mysql->insert_id();
						//die($a);
                    //    if($mysql->insert_id()) {
                    //        die("aaaaaaaaaaaaaaaaa");
                    //    }

					} else {

						// $mysql->where("articleId", $id);

						// $data = [
						// 	'fieldCode' => $row_fields['fieldCode'],
						// 	'fieldValue' => $_POST[$row_fields['fieldCode']."@fld"]
							
						// ];
				
						// $result_articles = $mysql->update('article_fields', $data);
			
                            if(isset($_POST['department'])){
								$data = [
									'articleId' => $id,
									'fieldCode' => 'Sobe',
									'fieldValue' => $department
								];

							}else{
								$data = [
									'articleId' => $id,
									'fieldCode' => $row_fields['fieldCode'],
									'fieldValue' => $_POST[$row_fields['fieldCode']."@fld"]
								];


							}

                           

                        $mysql->insert('article_fields', $data);

					}
				}
			}
		
			$tagbox = $_POST['tagbox'];
			if(!empty($tagbox)){
				$result_old_tags = $mysql->query("SELECT tagId FROM article_tags WHERE articleId='$id' ",true);
				foreach( $result_old_tags as $row_old_tags){
					removeArticleTag($row_old_tags['tagId']);
				}
				$result_delete = $mysql->query("DELETE FROM article_tags WHERE articleId='$id' ");
				
				
				$tag_arr = explode(",",$tagbox);
				foreach($tag_arr as $val) {
					
					$tagId = getTagIdByName(trim(addslashes(htmlspecialchars($val))));
					if(!empty($tagId) && $tagId != 0) {
                        $data = [
                            'articleId' => $id,
                            'tagId' => $tagId,
                            'catId' => $catid
                        ];

                        $mysql->insert('article_tags', $data);

						addArticleTag($tagId);
					}
				}
			}
			
			logw($item,$action,$query_articles);
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=$mainlink&action=articles&section=$section&cat=$catid\">";  //change redirect
			exit("<center>Success</center>"); 
		} else { exit("Error in editing"); }
	
	}
	
	
	if($_GET['action'] == "set_publicity") {

		//if(hasModuleAccess($user_data['userCode'],$_GET['cat'],"user","module","edit") == false && $user_data['root'] == false) {
			//exit("<center>Access denied.</center>");
		//}
	
		$id = $_GET['id'];
		if($id == "" or !is_numeric($id)) { exit("Error"); }
		$type = $_GET['type'];
		$cat = addslashes(htmlspecialchars($_GET['cat']));
		$section = intval($_GET['section']);
		
		if($type == "ok") {

            $mysql->where("id", $id);

            $data = [
                'publicity' => '0'
            ];

		} else {
            $mysql->where("id", $id);

            $data = [
                'publicity' => '1'
            ];

		}

        $result = $mysql->update('articles', $data);
		if($result) {
			logw($item,$action,$query);
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=$mainlink&action=articles&section=".$cat."&section=$section\">";  //change redirect
			exit("<center>ok</center>"); 
		}	
	
	}
	
	
	
	if($_GET['action'] == "delete_article") {
		
		$id = $_GET['id'];
		if($id == "" or !is_numeric($id) ) { exit("Bad login"); }
		
		$cat = get_cat_by_material($id);	
		$section = intval($_GET['section']);
		
		//if(hasModuleAccess($user_data['userCode'],$cat,"user","module","edit") == false && $user_data['root'] == false) {
			//exit("<center>Access denied.</center>");
		//}
		//$result_old_tags = mysql_query("SELECT tagId FROM article_tags WHERE articleId='$id' ");
        $result_old_tags = $mysql->where('articleId', $id)->get('article_tags', 'tagId');
		foreach($result_old_tags as $row_old_tags){
			removeArticleTag($row_old_tags['tagId']);
		}
		
	
		$result_article = $mysql->query("DELETE FROM articles WHERE id='$id' ");
		$result_tags = $mysql->query("DELETE FROM article_tags WHERE articleId='$id' ");

		
		if($result_article) {
			logw($item,$action,$id);
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=$mainlink&action=articles&section=$section\">";  //change redirect
			exit("<center>Success</center>"); 
		}
		else { exit("Error"); }
	}
	
?>