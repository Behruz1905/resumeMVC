<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading"); if($user_data['userType'] != "A") { exit("Access denied"); }   ?>
<?php 
	if($action == "show"){
?>
		<?php if(!empty($_GET['aptek'])) { print "<h3 style=\"padding:0px; margin-left:5px; margin-bottom:3px; margin-top:0px;\">".getPharmacyName(intval($_GET['aptek']))."</h3>"; } ?>
         <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; margin-left:15px;">
            <div id="jqxgrid"></div>
         </div>
         <input type="hidden" name="aptekstor" id="aptekstor" value="<?php if(!empty($_GET['aptek'])) { } ?>" /> 
        
<?php } ?>