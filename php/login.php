<?php
	session_start();
	include("config.php");

	$username = $_POST['logUsername'];
	$password = $_POST['logPassword'];

	function logovanje($username, $password) {
		global $conn;
		$check = "SELECT * FROM korisnici WHERE username = ? AND password = ?";
		$query = $conn->prepare($check);
		$query->bind_param('ss',$username,md5($password));
		$query->execute();
		$query->store_result();
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		$query->close();
	}

	if (!empty($username) && !empty($password)) {
		if (logovanje($username,$password)) {
			$_SESSION['username'] = $username;
			echo "Uspešno ste se ulogovali!";
		} else {
			echo "Niste uneli prave podatke, pokušajte ponovo!";
		}
	} else {
		echo "Niste uneli sve podatke, pokušajte ponovo!";
	}
?>