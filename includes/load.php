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

// get site_url option
$site_url_query = "SELECT value FROM options WHERE key = 'site_url'";
$site_url_result = mysql_query($site_url_query);
$site_url_array = mysql_fetch_array($site_url_result);
$site_url = $site_url_array['value'];

// load functions
require_once($site_url"includes/functions.php");
?>