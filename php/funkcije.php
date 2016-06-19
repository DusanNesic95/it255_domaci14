<?php
	include("config.php");

	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	function registracija($ime, $prezime, $email, $username, $password) {
		global $conn;
		if (proveriPostojanje($username)) {
			echo "Nije moguće registrovanje, korisnik sa istim korisničkim imenom već postoji!";
		} else {
			$insert = "INSERT INTO korisnici (ime, prezime, email, username, password) VALUES (?,?,?,?,?)";
			$query = $conn->prepare($insert);
			$query->bind_param('sssss',$ime,$prezime,$email,$username,md5($password));
			$query->execute();
			$query->close();
			echo "Uspešno ste se registrovali!";
		}
	}

	function proveriPostojanje($username) {
		global $conn;
		$check = "SELECT * FROM korisnici WHERE username = ?";
		$query = $conn->prepare($check);
		$query->bind_param('s',$username);
		$query->execute();
		$query->store_result();
		if ($query->num_rows == 0) {
			return false;
		}
		$query->close();
		return true;
	}

	registracija($ime, $prezime, $email, $username, $password);
?>