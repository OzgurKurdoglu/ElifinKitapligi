<?php
	session_start();
	$title = "Kullanıcı Kaydı";
	require "./template/header.php";
	require "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$address = trim($_POST['address']);
	$city = trim($_POST['city']);
	$zipcode = trim($_POST['zipcode']);

	if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($address) || empty($city) || empty($zipcode)) {
		header("Location:../obs/kayıt_olma.php?signup=empty");
		exit();
	} else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location:../obs/kayıt_olma.php?signup=invalidemail");
			exit();
		} else {
			$findUser = "SELECT * FROM customers WHERE email = '$email'";
			$findResult = mysqli_query($conn, $findUser);
			if(mysqli_num_rows($findResult) == 0) {
				$insertUser = "INSERT INTO customers(firstname, lastname, email, address, password, city, zipcode) VALUES 
				('$firstname', '$lastname', '$email', '$address', '$password', '$city', '$zipcode')";
				$insertResult = mysqli_query($conn, $insertUser);
				if(!$insertResult) {
					echo "Yeni kullanıcı eklenemedi: " . mysqli_error($conn);
					exit;
				}
				$userid = mysqli_insert_id($conn);
				header("Location: giris.php");
				exit();
			} else {
				$row = mysqli_fetch_assoc($findResult);
				$userid = $row['id'];
				header("Location: giris.php");
				exit();
			}
		}
	}
	
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
