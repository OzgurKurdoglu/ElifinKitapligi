<?php
	session_start();
	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Yeni Kategori Ekle";
	require "./template/header.php";
	require "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		
		$name = trim($_POST['name']);
		$name = mysqli_real_escape_string($conn, $name);
		
		$findCat = "SELECT * FROM category WHERE category_name = '$name'";
		$findResult = mysqli_query($conn, $findCat);
		if(mysqli_num_rows($findResult) == 0){
			$insertCat = "INSERT INTO category(category_name) VALUES ('$name')";
			$insertResult = mysqli_query($conn, $insertCat);
			if(!$insertResult){
				echo "Yeni kategori eklenemedi " . mysqli_error($conn);
				exit();
			}
			header("Location: admin_kategori.php");
			exit();
		} else {
            echo '<p style="color:red;">Kategori zaten mevcut</p>';
		}
	}
?>
	<form method="post" action="admin_kategori_ekleme.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Kategori</th>
				<td><input type="text" class="form-control"	 id="inputDefault"></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Yeni Kategori Ekle" class="btn btn-primary">
		<a href="admin_kategori.php" class="btn btn-default">İptal</a>
	</form>
	<br/>
<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
