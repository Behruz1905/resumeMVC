<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<?php 
	if($action == "show"){
?>
	<table class="iu_table" border="1" cellspacing="0" cellpadding="5" width="900">
    	<tr class="ui_table_title">
        	<td colspan="8">Şirkət müraciətləri və təkliflər </td>
        </tr>
        <tr class="iu_table_header">
        	<td class="iu_center_short">№</td>
            <td>Şirkətin adı</td>
            <td>Şirkət haqqında məlumat</td>
            <td>Email</td>
            <td>Telefon</td>
            <td>Təklifin məzmunu</td>
            <td>Tarix</td>
            <td class="iu_center_short"></td>
        </tr>
        <?php 
			$result_regions = mysql_query("SELECT offerId,compName,compInfo,compEmail,compPhone,compDesc,offerDate FROM offers ");
			$n = 1;
			while($row_regions = mysql_fetch_array($result_regions)){
				print "<tr class=\"iu_table_mean\">
							<td class=\"iu_center_short\" valign=\"top\">$n</td>
							<td valign=\"top\">".$row_regions['compName']."</td>
							<td valign=\"top\">".$row_regions['compInfo']."</td>
							<td valign=\"top\">".$row_regions['compEmail']."</td>
							<td valign=\"top\">".$row_regions['compPhone']."</td>
							<td valign=\"top\">".$row_regions['compDesc']."</td>
							<td valign=\"top\">".$row_regions['offerDate']."</td>
							<td class=\"iu_center_short\"><a href=\"?smode=page&item=offerm&action=delete&key=".$row_regions[0]."\" onclick=\"return confirm('Silinsin?');\"><img src=\"jpanel/jpanel_img/remove.png\" border=0></a></td>
						</tr>";
				$n++;
			}
		?>

    </table>
<?php } ?>
<?php
	if($action == "delete") {
		$key = (int) $_GET['key'];
		$result = mysql_query("DELETE FROM offers WHERE offerId='$key' ");
		if($result){
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=?smode=page&item=offerm&action=show\">";  //change redirect
			exit("<center>Success</center>");
		}
	}
?>
