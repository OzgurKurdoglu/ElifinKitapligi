<?php
	session_start();
	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}
	$title = "Kitabı Düzenle";
	require_once "./template/header.php";
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	} else {
		echo "Boş sorgu!";
		exit();
	}

	if(!isset($book_isbn)){
		echo "Boş ISBN! Lütfen tekrar kontrol edin!";
		exit();
	}

	$query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Veriler alınamadı: " . mysqli_error($conn);
		exit();
	}
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="kitap_düzenle.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text"  class="form-control" name="isbn" value="<?php echo $row['book_isbn']; ?>" readonly></td>
			</tr>
			<tr>
				<th>Başlık</th>
				<td><input type="text" class="form-control"  name="title" value="<?php echo $row['book_title']; ?>" required></td>
			</tr>
			<tr>
				<th>Yazar</th>
				<td><input type="text" class="form-control" name="author" value="<?php echo $row['book_author']; ?>" required></td>
			</tr>
			<tr>
				<th>Görsel</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Açıklama</th>
				<td><textarea name="descr" class="form-control" cols="40" rows="5"><?php echo $row['book_descr']; ?></textarea></td>
			</tr>
			<tr>
				<th>Fiyat</th>
				<td><input type="text" class="form-control" name="price" value="<?php echo $row['book_price']; ?>" required></td>
			</tr>
			<tr>
				<th>Yayınevi</th>
				<td><input type="text"  class="form-control" name="publisher" value="<?php echo getPubName($conn, $row['publisherid']); ?>" required></td>
			</tr>
			<tr>
				<th>Kategori</th>
				<td><input type="text" class="form-control" name="category" value="<?php echo getCatName($conn, $row['categoryid']); ?>" required></td>
			</tr>
		</table>
		<input type="submit" name="save_change" value="Değişiklikleri Kaydet" class="btn btn-primary">
		<a href="admin_kitap.php" class="btn btn-default">İptal</a>
	</form>
	<br/>
	<a href="admin_kitap.php" class="btn btn-success">Onayla</a>
<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require "./template/footer.php";
?>
