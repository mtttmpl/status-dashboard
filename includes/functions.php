<?php

///////////////////////////////////////
//        options			         //
///////////////////////////////////////

function get_option($key) {
	$get_option_query = "SELECT value FROM options WHERE key = '$key'";
	$get_option_result = mysql_query($get_option_query);
	$get_option_array = mysql_fetch_array($get_option_result);
	$option = $get_option_array['value'];
	
	return $option;
}

function set_option($key, $value) {
	// check if option already exsists
	$check_option_query = mysql_query("SELECT value FROM options WHERE key = '$key'");
	$check_option_result = mysql_num_rows($check_option_query);
	if($check_option_result == 1) {
	// if option exsists update value
		$set_option_query = "UPDATE options SET value = '$value' WHERE key = '$key'";
		mysql_query($set_option_query);
	} else {
	// else create option
		$create_option_query = "INSERT INTO options (key, value) VALUES ('$key', '$value')";
		mysql_query($create_option_query);
	}
}

function get_past_dates($from = date("d/m/Y"), $number) {
	$count = 1
	$result = array();
	while($count <= $number) {
		// takes date and subtacks 1 day then adds result to the end of an array
		array_push($result, date($from, strtotime("-1 day")));
		$count++
	}
	return $result;
}

///////////////////////////////////////
//        servers	                 //
///////////////////////////////////////

function get_servers() {
	$get_servers_query = "SELECT * FROM servers";
	$get_servers_result = mysql_query($get_servers_query);
	return $get_servers_result;	
}

///////////////////////////////////////
//         status      	             //
///////////////////////////////////////

function get_current_status($server_id) {
	$get_current_status_query = "SELECT * FROM status WHERE server_id = '$server_id' ORDER BY time, date DESC";
	$get_current_status_result = mysql_query($get_current_status_query);
	$num_rows = mysql_num_rows($get_current_status_result);
	if($num_rows != 0) {
		// if a status is set return status id, status (number), icon and name to detail page
		$get_current_status_array = mysql_fetch_array($get_current_status_result);
		$id = $get_current_status_array['id'];
		$status = $get_current_status_array['status'];
		// get name and icon for status
		$get_status_type_query = "SELECT * FROM status_type WHERE id = '$status'";
		$get_status_type_result = mysql_query($get_status_type_query);
		$get_status_type_array = mysql_fetch_array($get_status_type_result);
		$icon = $get_status_type_array['icon'];
		$name = $get_status_type_array['name'];
		
		$result = array('id' => $id, 'status' => $status, 'icon' => $icon, 'name' => $name);
	} else {
		// if no status is returned assume server is normal
		$status = get_option('default_status');
		// get name and icon for status
		$get_status_type_query = "SELECT * FROM status_type WHERE id = '$status'";
		$get_status_type_result = mysql_query($get_status_type_query);
		$get_status_type_array = mysql_fetch_array($get_status_type_result);
		$icon = $get_status_type_array['icon'];
		$name = $get_status_type_array['name'];
		
		$result = array('id' => "0", 'status' => $status, 'icon' => $icon, 'name' => $name);
	}
	return $result;
}

function get_prev_status_overview($server_id, $date) {
	// get defualt status for comparison
	$defualt_status = get_option('default_status');
	// get all statuses for server on date
	$get_prev_status_query = "SELECT * FROM status WHERE server_id = '$server_id' AND date = '$date' ORDER BY time ASC";
	$get_prev_status_result = mysql_query($get_prev_status_query);
	$num_rows = mysql_num_rows($get_prev_status_result);
	if($num_rows != 0) {
		// if status are returned return last on default
		while($row = mysql_fetch_array($get_prev_status_result)) {
			if($row['status'] > $defualt_status) {
				$status = $row['status'];
				$id = $row['id'];
			}
		}
				
		// get name and icon for status
		$get_status_type_query = "SELECT * FROM status_type WHERE id = '$status'";
		$get_status_type_result = mysql_query($get_status_type_query);
		$get_status_type_array = mysql_fetch_array($get_status_type_result);
		$icon = $get_status_type_array['icon'];
		$name = $get_status_type_array['name'];
		
		$result = array('id' => $id, 'status' => $status, 'icon' => $icon, 'name' => $name);		
	} else {
		// if no status are retuned assume default status
		// get name and icon for status
		$get_status_type_query = "SELECT * FROM status_type WHERE id = '$status'";
		$get_status_type_result = mysql_query($get_status_type_query);
		$get_status_type_array = mysql_fetch_array($get_status_type_result);
		$icon = $get_status_type_array['icon'];
		$name = $get_status_type_array['name'];
		
		$result = array('id' => "0", 'status' => $defualt_status, 'icon' => $icon, 'name' => $name);
	}
	return $result;
}
?>