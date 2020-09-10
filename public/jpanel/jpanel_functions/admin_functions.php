<?php
	function get_sections($id)

	{

		$query = "SELECT * FROM sections";

		$result = mysql_query($query);

		if(mysql_num_rows($result)>0)

		{
			$text ="";

			$row = mysql_fetch_array($result);

			$text =  "\n<select name=section id='add_sect_name'>\n";

			do

				{

					$text .=  "<option value='".$row['id']."'";

					if($id!="nan" and $row['id'] == $id) { $text .= "selected"; }

					$text .= ">".$row['name']."</option>\n";

				

				}

			while($row = mysql_fetch_array($result));

			$text .= "</select>\n";

			return $text;
		}
		else
		{
			return "Exist section";
		}
	}

	function get_categories($id,$event,$sect_id)
	{
	    global $mysql;
		$query = "SELECT * FROM cats";

		$result = $mysql->query($query,true);

		if($result){
			$text ="";
			//$row = mysql_fetch_array($result);
			$text =  "<select name=section id=$sect_id ";
			if($event!="nan") { $text .= " onchange='".$event."()'"; }
			$text .= ">\n";
			foreach ($result as $row)
			{
					$text .=  "<option value='".$row['id']."'";
					if($id!="nan" and $row['id'] == $id) { $text .= " selected "; }
					$text .= ">".$row['name']."</option>\n";
			}

			$text.= "<option value=link ";
			if($id == "nan") { $text.= " selected "; }
			$text.=	">&raquo; Материал</option>";
			
			$text.= "<option value=page ";
			if($id == "page") { $text.= " selected "; }
			$text.=	">&raquo; Модул</option>";
			
			$text.= "<option value=urllink ";
			if($id == "urllink") { $text.= " selected "; }
			$text.=	">&raquo; Link</option>";
			
			$text .= "</select>\n";

			return $text;
		}
		else
		{
			return "Exist section";
		}
	}

	function get_menu_parents()

	{
        global $mysql;
		$text = "";

		$text .= "<select name=catparent onchange='parentsel();' id='first_select' >";

		$text .= "<option value='0'>Root</option>";

		$sqlquery="SELECT id,name,parent,(select name from menu a where a.id = b.parent) as sparentname FROM menu b  ORDER BY  parent and place";

		$res = $mysql->query($sqlquery,true);

		$i=1;

				foreach ($res as $ITEMGROUP) {

						

						$parent = $ITEMGROUP['parent'];

						$location = $ITEMGROUP['sparentname'];

						if($location == "") { $location = "Root"; }

						$text .= "<option value=\"$ITEMGROUP[id]\">&nbsp; $i. $location -> $ITEMGROUP[name]\n";

						$i++;

				}

		$text .=	"</select>";

		return $text;

	

	}

	function show_material($id,$sel_id)

	{
	    global $mysql;

		$query = "SELECT id,name FROM articles";

		$result = $mysql->query($query,true);

		if($result)

		{

		//$row = mysql_fetch_array($result);

		$content = "";

		$content .= "<select name=materials id=$sel_id >";

		$content .= "<option value='0'>Выберите материал</option>";

		foreach ($result as $row)

			{

				$content .= "<option value='".$row['id']."'";

				if($row['id'] == $id) { $content .= "selected"; }

				$content .= ">".$row['name']."</option>";

			}



		$content .= "</select>";

		return $content;
		} else {
			return "No article";
		}
	}

	function getcategory($mat_id)
	{
	    global $mysql;
		$query = "SELECT id,(SELECT name FROM cats b WHERE a.cat_id = b.id) as catname FROM articles a WHERE a.id='$mat_id' ";

		$row = $mysql->query($query);

		//$row = mysql_fetch_array($result);

		return $row[1];
	}

	function get_cat_by_material($id) {

	    global $mysql;
		$query = "SELECT cat_id FROM articles  WHERE id='$id' ";

		$result = $mysql->query($query,true);

		$row = $result['cat_id'];

		return $row;

	}

	function get_category($id) {
		global $mysql;
		$category = $mysql->limit(1)->where('id', $id)->get('cats', 'name');

		if($category) {
			return $category;
		} else {
			return "";
		}
	}

	function get_material($id) {

		global $mysql;

		$query = "SELECT name FROM articles WHERE id='$id' ";

		$result = $mysql->query($query,true);

		if($result) {

			$row = $result[0];

			return $row;

		}

		else {

			return "";

		}

	

	}

	function get_menu_types($id) {

		global $mysql;

		$query = "SELECT id,type_name FROM menu_type ";

		$result = $mysql->query($query,true);

		if($result)

		{

		//$row = mysql_fetch_array($result);

		$content = "";

		$content .= "<select name=menu_types  >";

		

		foreach ($result as $row)

			{

				$content .= "<option value='".$row['id']."' ";

				if($row['id'] == $id) { $content .= "selected"; }

				$content .= ">".$row['type_name']."</option>";

			}


		

		$content .= "</select>";

		return $content;

		}

		else

		{

			return "No article";

		}	

	

	}

	function get_menu_type($menu_id) {

	    global $mysql;

		$query = "SELECT type_id FROM menu WHERE id='$menu_id' ";

		$result = $mysql->query($query,true);

		if($result) {

			$row = $result[0];

			return $row[0];

		}

		else {

			return "";

		}	

	}

	function get_gallery_section_name($id,$lang) {

		

		if($lang=="ru") { $name = "section_name_ru"; } else

		if($lang=="en") { $name = "section_name_en"; } else 

		{ $name= "section_name"; }

		

		$query = "SELECT $name FROM gallery_sections WHERE id='$id' ";

		$result = mysql_query($query);

		if(mysql_num_rows($result)>0) {

			$row = mysql_fetch_array($result);

			return $row[0];

		}

		else {

			return "";

		}	

	}

	function get_img_src($id) {

		$query = "SELECT src FROM gallery WHERE id='$id' ";

		$result = mysql_query($query);

		if(mysql_num_rows($result)>0) {

			$row = mysql_fetch_array($result);

			return $row[0];

		}

		else {

			return "";

		}	

	}

	function get_file_name($src) {

		

		$last_slash = strrpos($src,"/");

		$filename = substr($src,$last_slash+1);

		return $filename;

	

	}

	function get_img_thumb($id) {

		$query = "SELECT thumb FROM gallery WHERE id='$id' ";

		$result = mysql_query($query);

		if(mysql_num_rows($result)>0) {

			$row = mysql_fetch_array($result);

			return $row[0];

		}

		else {

			return "";

		}	

	}

	function delete_dir($dir) {

		if ($handle = opendir($dir)) {

			

				while (false !== ($file = readdir($handle))) { 

					@unlink($file);

				}

				closedir($handle); 

				$rm = @rmdir($dir);

			}

	}

	function get_menu_link($menu_id) {
	    global $mysql;

		$query = "SELECT link FROM menu WHERE id='$menu_id'";

		$result = $mysql->query($query,true);

		if($result) {

			$row = $result[0];

			return $row[0];

		}

		else {

			return "";

		}	

	}
	/* ------------- zeferan ----------------------------------------------- */

	function getUserTypeByCode($code){

	    global $mysql;
		$result = $mysql->query("SELECT userTypeName FROM cp_usertypes WHERE userTypeCode='$code' ",true);

		if($result) {

			$row = $result[0];

			return $row[0];

		} else {

			return "";

		}	

	}

	/* from functions */

	function getDepartmentSelect($sel_id){
	    global $mysql;

		$result = $mysql->query("SELECT id,title FROM articles WHERE cat_id = 4",true);

		//print_r($result);



		print "<select name='department' id=\"department_select\" >";
		print 	  "<option value=\"0\">Seçin</option>";
		foreach($result as $row){
//			print "<optgroup label=\"".$row['name']."\">";

            print "<option value=\"".$row['id']."\" ";
            if($sel_id == $row['id']) { print " selected "; }
            print ">".$row['title']."</option>";

//			$result_sub = $mysql->query("SELECT id,name FROM articles WHERE cat_id= 4",true);
//			//var_dump($result_sub);
//			foreach( $result_sub as $row_sub){
//
//			}
			//print "</optgroup>";
		}
		print "</select>";
	}

	function getSectioinHName($sectId){

		$sectId = intval($sectId);
		global $mysql;
		$row = $mysql->query("SELECT hname FROM sections WHERE id='$sectId'");
		//$row = mysql_fetch_array($result);
		if($row[0] == "") { return "Material"; } else { return $row[0]; }
		
	}
	
	function getCvValue($cvid,$key){

	    global $mysql;
		$result = $mysql->query("SELECT cvval FROM cv_body WHERE cvId='$cvid' AND cvkey='$key' ",true);

		if($result) {

			$row = $result[0];

			return $row[0];

		} else {

			return "";	

		}

	}

	function getCv($cvid){

	    global $mysql;
		$result = $mysql->query("SELECT cvId,cvDate,cvRead,cvName,cvPhoto,vacationId,vacationId FROM cvs WHERE cvId='$cvid' ",true);

		if($result) {

			$row = $result[0];

			return $row;

		} else {

			return "";	

		}

	}
?>