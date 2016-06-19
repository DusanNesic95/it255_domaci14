<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "methotels";

	$conn = new mysqli($servername, $username, $password, $database);

	if (!$conn->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		exit();
	}
?>