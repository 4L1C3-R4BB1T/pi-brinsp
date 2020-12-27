<?php	
	require "./vendor/autoload.php";
	require "./config/config.php";
	
	use Config\ConfigController as Home;
	$url = new Home();
	$url->carregar();
?>
	