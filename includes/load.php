<?php
// include config.php with settings and db info
require_once("config.php");

// connect to db
$sd_db = mysql_connect($db_host, $db_user, $db_password);
if(!$sd_db) {
    die('Could not connect to database');
}

// select db
$sd_db_select = mysql_select_db($db_name);
if(!$sd_db_select) {
	die('Could not select database');
}

// load functions
require_once("functions.php");
?>