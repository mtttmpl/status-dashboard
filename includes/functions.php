<?php
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
?>