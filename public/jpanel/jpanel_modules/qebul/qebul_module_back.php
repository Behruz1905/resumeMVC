<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	
	if($authenticated_cp == false) { exit("Access denied"); }
	if($user_data['userType'] != "A") exit("Access denied");  
	
	if($action == "load_derman") {
		
		$query = "SELECT tableId,name,email,phone,ip,insertDate,selectedDate,selectedTime,(select title from articles where id = doctor)  AS sdoctor, (select title from articles where id= service) AS sservice FROM appointments ";
		$result = $mysql->query($query,true);
		$data = array();
		foreach($result as $row){
			$data_row = array();
			$data_row['tableId'] = $row['tableId'];
			$data_row['name'] = $row['name'];
			$data_row['email'] = $row['email'];
			$data_row['phone'] = $row['phone'];
			$data_row['insertDate'] = $row['insertDate'];
			$data_row['selectedDate'] = $row['selectedDate'];
			$data_row['selectedTime'] = $row['selectedTime'];
			$data_row['doctor'] = $row['sdoctor'];
			$data_row['service'] = $row['sservice'];
			$data[] = $data_row;
		}
		
		header("Content-type: application/json"); 
		echo "{\"data\":" .json_encode($data). "}";
		
	}
	
	
	
?>