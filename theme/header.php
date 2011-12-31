<?php 
	// get options required for header
	$site_title = get_option('site_tite');
	$site_url = get_option('site_url');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Status Dashboard</title>
	<link rel="stylesheet" href="theme/style.css" type="text/css" />
</head>
<body>
	<div id="wrapper"><!-- closes in theme/footer.php -->
		<div id="header">
			<div id="logo"><a href="index.php"><img src="<?php echo get_option('logo'); ?>" title="<?php echo $site_title; ?>" /></a></div>
		</div>
