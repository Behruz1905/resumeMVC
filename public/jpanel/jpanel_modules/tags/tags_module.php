<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />
<?php 

	if($action == "show"){

?>

	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="600">

    	<tr class="ui_table_title">

        	<td colspan="7"><div class="table_header_div">Teqlər</div> </td>

        </tr>

        <tr>

        	<td colspan="7">

            	<?php 

					print "<div id='jqxTree' style='visibility: hidden; float: left;'>";

					print "<ul>";

					print 	 "<li item-value=0 item-expanded='true'>Root";

								getTagsListByParent(0);

					print 	 "</li>";

					print 	"</ul>";

					print "</div>";

					

					print "<div id='jqxMenu'>

								<ul>

									<li id='add'>Əlavə et</li>

									<li id='edit'>Redaktə et</li>

									<li id='remove'>Sil</li>

									<li id='select'>Materiallara bax</li>

								</ul>

							</div>";

				?>

            </td>

        </tr>

        

    </table>

<?php } ?>

<?php if($action == "add") { 

			$parentId = intval($_GET['parent']);

?>



			<form action="" method="post"  id="add_form">

                <table class="iu_table" border="1" cellspacing="0" >

                    <tr class="ui_table_title">

                        <td colspan="2">Teq əlavə et <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>

                    </tr>

                    <tr>

                        <td class="ui_labels">Teq:</td><td><input type="text" name="tag_name" id="tag_name"  /></td>

                    </tr>

                    

                </table>

                <input type="hidden" name="smode" value="page"  />

                <input type="hidden" name="item" value="tags"  />

                <input type="hidden" name="parent" value="<?php print $parentId; ?>"  />

                <input type="hidden" name="action" value="do_add">

            </form>

<?php } ?>

<?php 

	if($action == "do_add") {

		$name = addslashes(htmlspecialchars(trim($_POST['tag_name'])));

		$parentId = intval($_POST['parent']);

		if(isExistTag($name)) {

			exit("Tag artiq movcuddur.");	

		}

		$result = mysql_query("INSERT INTO tags (tagText,parentId) VALUES ('$name','$parentId') ");

		

		if($result) {

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=tags&action=show\">";  //change redirect

			exit("<center>Success</center>"); 

		} else {

			print "Error";

			print mysql_error();	

		}

	}

?>

<?php 

	if($action == "edit") {

		$tagId = (int) $_GET['key'];

		$result_seller = mysql_query("SELECT tagId,tagText FROM tags WHERE tagId='".$tagId."' ");

		$row_seller = mysql_fetch_array($result_seller);

?>

		

        	<form action="" method="post"  id="add_form">

                <table class="iu_table" border="1" cellspacing="0" >

                    <tr class="ui_table_title">

                        <td colspan="2">Teqi yenilə <input type="button" name="ok" value="Yadda saxla" class="main_ui_button" id="add_button"  /></td>

                    </tr>

                    <tr>

                        <td class="ui_labels">Teq:</td><td><input type="text" name="tag_name" id="tag_name"  value="<?php echo $row_seller['tagText']; ?>" /></td>

                    </tr>

                    

                </table>

                <input type="hidden" name="smode" value="page"  />

                <input type="hidden" name="item" value="tags"  />

                <input type="hidden" name="tagId" value="<?php echo $tagId; ?>"  />

                <input type="hidden" name="action" value="do_edit">

            </form>

        

        

<?php } ?>

<?php 

	if($action == "do_edit") {

		$tagId = intval($_POST['tagId']);

		$name = addslashes(htmlspecialchars(trim($_POST['tag_name'])));

		$result = mysql_query("UPDATE tags SET tagText='$name' WHERE tagId='$tagId' ");

		if($result) {

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=tags&action=show\">";  //change redirect

			exit("<center>Success</center>"); 

		} else {

			print mysql_error();	

		}

	}

	

	if($action == "delete") {

		$tagId = (int) $_GET['key'];

		$result = mysql_query("DELETE FROM tags WHERE tagId='$tagId' ");

		$result_parent = mysql_query("DELETE FROM tags WHERE parentId='$tagId' ");

		if($result){

			$result_delete_prod = mysql_query("DELETE FROM product_tags WHERE tagId='$tagId' ");

			$result_delete_articles = mysql_query("DELETE FROM article_tags WHERE tagId='$tagId' ");

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=tags&action=show\">";  //change redirect

			exit("<center>Success</center>");

		}

	}

?>

