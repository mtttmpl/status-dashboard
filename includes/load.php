<?php
// include config.php with settings and db info
require_once("config.php");

// connect to db
$sd_db = mysql_connect('DBHOST', 'DBUSER', 'DBPWORD');
if(!$sd_db) {
    die('Could not connect to database');
}

// select db
$sd_db_select = mysql_select_db('DBNAME');
if(!$sd_db_select) {
	die('Could not select database');
}
?>