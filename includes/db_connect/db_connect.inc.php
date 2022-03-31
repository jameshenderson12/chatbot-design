<?php
	// Setup global variables
	$db_server = "uildbv5gen01.nottingham.ac.uk";
	$db_name = "ntzjh_chatbotdes";
	$db_user_app = "ntzjh_chatbt_app";
	$db_user_app_pw = "X0ITYYUBJhJj!3pm1oXX";

	// Create DB connection
	$con_app = mysqli_connect($db_server, $db_user_app, $db_user_app_pw, $db_name);

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

?>
