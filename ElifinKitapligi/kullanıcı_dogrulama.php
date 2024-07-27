<?php
	session_start();

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	$name = trim($_POST['username']);
	$pass = trim($_POST['password']);

	if(empty($name) || empty($pass)){
		header("Location:../obs/giris.php?signin=empty");
		exit();
	} else { 
		$query = "SELECT name, pass FROM manager";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if($name == $row['name'] && $pass == $row['pass']) {
			$_SESSION['manager'] = true;
			unset($_SESSION['expert']);
			unset($_SESSION['user']);
			unset($_SESSION['email']);
			header("Location: admin_kitap.php");
			exit();
		} else {
			$query = "SELECT name, pass FROM expert";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			
			if($name == $row['name'] && $pass == $row['pass']) {
				$_SESSION['expert'] = true;
				unset($_SESSION['manager']);
				unset($_SESSION['user']);
				unset($_SESSION['email']);
				header("Location: admin_kitap.php");
				exit();
			} else {
				$name = mysqli_real_escape_string($conn, $name);
				$pass = mysqli_real_escape_string($conn, $pass);

				$query = "SELECT email, password FROM customers";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_assoc($result)) {
					if($name == $row['email'] && $pass == $row['password']) { 
						$_SESSION['user'] = true;	
						$_SESSION['email'] = $name;
						unset($_SESSION['manager']);
						unset($_SESSION['expert']);
						header("Location: index.php");
						exit();	
					}
					else {
						header("Location:../obs/giris.php?signin=invalidpassword");
						exit();
					}
					
				}
				

			}
		}
	}

	if(isset($conn)) {
		mysqli_close($conn);
	}
?>
