<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	
	if($authenticated_cp == false) { exit("Access denied"); }
	if($user_data['userType'] != "A") exit("Access denied");  
	
	if($action == "load_derman") {
		
		$query = "SELECT LOGICALREF,MAL_ADI,MAL_VAHIDI,MAL_OLKE,MAL_TERKIB FROM derman ";
		$result = mysql_query($query);
		$data = array();
		while($row = mysql_fetch_array($result)){
			$data_row = array();
			$data_row['LOGICALREF'] = $row['LOGICALREF'];
			$data_row['MAL_ADI'] = $row['MAL_ADI'];
			$data_row['MAL_VAHIDI'] = $row['MAL_VAHIDI'];
			$data_row['MAL_OLKE'] = $row['MAL_OLKE'];
			$data_row['MAL_TERKIB'] = $row['MAL_TERKIB'];
			$data[] = $data_row;
			
		}
		
		header("Content-type: application/json"); 
		echo "{\"data\":" .json_encode($data). "}";
		
	}
	
	
	
?>