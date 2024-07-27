<?php
	session_start();
	
	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Edit Publisher";

	require_once "./template/header.php";
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$conn = db_connect();

	if(isset($_GET['pubid'])){
		$pubid = $_GET['pubid'];
	} else {
		echo "Boş sorgu!";
		exit();
	}

	if(!isset($pubid)){
		echo "Boş Yayıncı ID'si! Lütfen tekrar kontrol edin!";
		exit();
	}

	$query = "SELECT * FROM publisher WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);

	if(!$result){
		echo "Veri alınamadı: " . mysqli_error($conn);
		exit();
	}

	$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="yayıncı_düzenle.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>İsim</th>
				<td><input type="text" class="form-control" name="name" value="<?php echo $row['publisher_name']; ?>" required></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $row['publisherid']; ?>">
		<input type="submit" name="save_change" value="Değişiklikleri Kaydet" class="btn btn-primary">
		<a href="admin_yayıncı.php" class="btn btn-default">İptal</a>
	</form>
	<br/>

<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}

	require "./template/footer.php";
?>
