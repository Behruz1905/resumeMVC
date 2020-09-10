<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>

<?php if(isset($_REQUEST['cat_parent'])) { $cat_parent = intval($_REQUEST['cat_parent']); } else { $cat_parent = 0; } ?>

<?php 

	if($action == "show"){

			

?>

	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">

    	<tr class="ui_table_title">

        	<td colspan="7">Xüsusiyyətlərin kateqoriyası - <?php if($cat_parent != 0) { print "<u>".getCatPropertyTypeName($cat_parent)."</u>"; } ?>

            				<input type="button" name="add_new" id="add_new" value="Geri" class="main_ui_button" onclick="window.location.href='?smode=page&item=prodpropertycat&action=show&cat_parent=0'"  />

            				<input type="button" name="add_new" id="add_new" value="Əlavə et" class="main_ui_button" onclick="window.location.href='?smode=page&item=prodpropertycat&action=add&cat_parent=<?php echo $cat_parent; ?>'"  />

            </td>

        </tr>

        <tr class="iu_table_header">

        	<td class="iu_center_short">№</td>

            <td>Ad</td>

            <td width="50">Xüsusiyyətlər</td>

            <td class="iu_center_short"></td>

            <td class="iu_center_short"></td>

        </tr>

        <?php 

			$query_cats = "SELECT catPropertyTypeId,catPropertyTypeName FROM cat_property_types WHERE parentId='$cat_parent' ";

			$result_cats = mysql_query($query_cats);

			$n = 1;

			while($row_cats = mysql_fetch_array($result_cats)){

				print "<tr class=\"iu_table_mean\">

							<td class=\"iu_center_short\" valign=\"top\">$n</td>

							<td valign=\"top\"><a href=\"?smode=page&item=prodpropertycat&action=show&cat_parent=".$row_cats[0]."\" class='table_item_link'>".$row_cats['1']."</a></td>

							<td class=\"iu_center_short\"><a href=\"?property_type=".$row_cats[0]."&ok=Filtr&smode=page&item=prodproperty&action=show\"><img src=\"jpanel/jpanel_img/items.png\" border=0 /></a></td>

							<td class=\"iu_center_short\"><a href=\"?smode=page&item=prodpropertycat&action=edit&key=".$row_cats[0]."&cat_parent=".$cat_parent."\"><img src=\"jpanel/jpanel_img/edit.png\" border=0></a></td>

							<td class=\"iu_center_short\"><a href=\"?smode=page&item=prodpropertycat&action=delete&key=".$row_cats[0]."&cat_parent=".$cat_parent."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>

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

                        <td colspan="2">Xüsusiyyətlərin kateqoriya  əlavə et <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>

                    </tr>

                    <tr>

                        <td class="ui_labels">Ad:</td><td><input type="text" name="cat_name" id="brand_name"  /></td>

                    </tr>

                </table>

                <input type="hidden" name="smode" value="page"  />

                <input type="hidden" name="item" value="prodpropertycat"  />

                <input type="hidden" name="action" value="do_add">

                <input type="hidden" name="cat_parent" value="<?php echo $cat_parent; ?>">

            </form>

<?php } ?>

<?php 

	if($action == "do_add") {

		$name = $_POST['cat_name'];

		

		$result = mysql_query("INSERT INTO cat_property_types (catPropertyTypeName,parentId) VALUES ('$name','$cat_parent') ");

		

		if($result) {

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodpropertycat&action=show\">";  //change redirect

			exit("<center>Success</center>"); 

		} else {

			print "Error";

			print mysql_error();	

		}

	}

?>

<?php 

	if($action == "edit") {

		$catPropertyTypeId = (int) $_GET['key'];

		$result_seller = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName,parentId FROM cat_property_types WHERE catPropertyTypeId='".$catPropertyTypeId."' ");

		$row_seller = mysql_fetch_array($result_seller);

?>

		

        	<form action="" method="post"  id="add_form">

                <table class="iu_table" border="1" cellspacing="0" >

                    <tr class="ui_table_title">

                        <td colspan="2">Xüsusiyyətlərin kateqoriya yenilə <input type="submit" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>

                    </tr>

                    <tr>

                        <td class="ui_labels">Aid olduğu kateqoriya:</td>

                        <td>

                        	<?php 

								$result_parent = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName,parentId FROM cat_property_types WHERE parentId=0 AND catPropertyTypeId<>'".$catPropertyTypeId."' ");

								print "<select name=\"cat_parent\" >";

								print 	"<option value=\"0\">Root</option>";

								while($row_parent = mysql_fetch_array($result_parent)){

									print "<option value=\"".$row_parent[0]."\" ";

									if($row_parent[0] == $row_seller[2]) { print " selected "; }

									print ">".$row_parent[1]."</option>";

								}

								print "</select>";

							?>

                        </td>

                    </tr>

                    <tr>

                        <td class="ui_labels">Ad:</td><td><input type="text" name="cat_name" id="brand_name"  value="<?php echo $row_seller['catPropertyTypeName']; ?>" /></td>

                    </tr>

                </table>

                <input type="hidden" name="smode" value="page"  />

                <input type="hidden" name="item" value="prodpropertycat"  />

                <input type="hidden" name="catPropertyTypeId" value="<?php echo $catPropertyTypeId; ?>"  />

                <input type="hidden" name="action" value="do_edit">

                <input type="hidden" name="cat_parent" value="<?php echo $cat_parent; ?>">

            </form>

        

        

<?php } ?>

<?php 

	if($action == "do_edit") {

		$catPropertyTypeId = $_POST['catPropertyTypeId'];

		$name = $_POST['cat_name'];



		$result = mysql_query("UPDATE cat_property_types SET catPropertyTypeName='$name',parentId='$cat_parent' WHERE catPropertyTypeId='$catPropertyTypeId' ");



		if($result) {

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodpropertycat&action=show&cat_parent=$cat_parent\">";  //change redirect

			exit("<center>Success</center>"); 

		} else {

			print mysql_error();	

		}

	}

	

	if($action == "delete") {

		$catPropertyTypeId = (int) $_GET['key'];

		$result_cat = mysql_query("DELETE FROM cat_property_types WHERE catPropertyTypeId='$catPropertyTypeId' ");

		if($result_cat){

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=prodpropertycat&action=show&cat_parent=$cat_parent\">";  //change redirect

			exit("<center>Success</center>");

		}

	}

?>

