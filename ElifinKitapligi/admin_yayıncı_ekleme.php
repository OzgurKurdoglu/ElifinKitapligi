<?php
	session_start();

	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Yeni Yayıncı Ekle";

	require "./template/header.php";
	require "./fonksiyonlar/veritabanı_fonksiyonları.php";
	
	$conn = db_connect();

	if(isset($_POST['add'])){
		$name = trim($_POST['name']);
		$name = mysqli_real_escape_string($conn, $name);
		
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$name'";
		$findResult = mysqli_query($conn, $findPub);
		if(mysqli_num_rows($findResult) == 0){
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$name')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Yeni yayıncı eklenemedi: " . mysqli_error($conn);
				exit();
			}
			header("Location: admin_yayıncı.php");
			exit();
		} else {
			echo '<p style="color:red;">Yayıncı zaten mevcut</p>';
		}
	}
?>
	<form method="post" action="admin_yayıncı?ekleme.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Yayıncı İsmi</th>
				<td><input type="text" class="form-control" id="inputDefault"></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Yeni Yayıncı Ekle" class="btn btn-primary">
		<a href="admin_yayıncı.php" class="btn btn-default">İptal</a>
	</form>
	<br/>
<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
