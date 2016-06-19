<?php
	include("config.php");

	$brojSobe = $_POST['brojSobe'];
	$brojKreveta = $_POST['brojKreveta'];
	$rezervisano = $_POST['rezervisano'];

	function dodajSobu($brojSobe, $brojKreveta, $rezervisano) {
		global $conn;
		if (proveriSobu($brojSobe)) {
			echo "Nije moguće dodati sobu, ta soba već postoji!";
		} else {
			$insert = "INSERT INTO sobe (brojSobe,brojKreveta,rezervisano) VALUES (?,?,?)";
			$query = $conn->prepare($insert);
			$query->bind_param('sss', $brojSobe, $brojKreveta, $rezervisano);
			$query->execute();
			$query->close();
			echo "Uspešno ste dodali sobu!";
		}
	}

	function proveriSobu($brojSobe) {
		global $conn;
		$check = "SELECT * FROM sobe WHERE brojSobe = ?";
		$query = $conn->prepare($check);
		$query->bind_param('s', $brojSobe);
		$query->execute();
		$query->store_result();
		if ($query->num_rows == 0) {
			return false;
		}
		$query->close();
		return true;
	}

	dodajSobu($brojSobe, $brojKreveta, $rezervisano);
?>