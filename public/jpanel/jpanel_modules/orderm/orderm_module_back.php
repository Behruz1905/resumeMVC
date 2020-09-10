<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");

	if($action == "has_new_orders") {
		$result = mysql_query("SELECT orderId FROM orders_table WHERE orderStatus='Y' ");
		if(mysql_num_rows($result)>0){
			print "1";
		} else {
			print "0";	
		}
	}

?>
