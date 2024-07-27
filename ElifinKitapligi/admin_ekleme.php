<?php
	session_start();
	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Yeni kitap ekle";
	require "./template/header.php";
	require "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$title = trim($_POST['title']);
		$author = trim($_POST['author']);
		$descr = trim($_POST['descr']);
		$price = floatval(trim($_POST['price']));
		$publisher = trim($_POST['publisher']);
		$category = trim($_POST['category']);
		$image = "";

		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		$publisherid = findOrInsertPublisher($conn, $publisher);

		$categoryid = findOrInsertCategory($conn, $category);

		$query = "INSERT INTO books VALUES ('$isbn', '$title', '$author', '$image', '$descr', '$price', '$publisherid', '$categoryid')";
		$result = mysqli_query($conn, $query);
		
		if(!$result){
			echo "Yeni veri eklenemedi: " . mysqli_error($conn);
			exit();
		} else {
			header("Location: admin_kitap.php");
			exit();
		}
	}
?>
	<form method="post" action="admin_ekleme.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" class="form-control" name="isbn"></td>
			</tr>
			<tr>
				<th>Başlık</th>
				<td><input type="text" class="form-control" name="title" required></td>
			</tr>
			<tr>
				<th>Yazar</th>
				<td><input type="text"  class="form-control"name="author" required></td>
			</tr>
			<tr>
				<th>Görsel</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Açıklama</th>
				<td><textarea name="descr" class="form-control" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Fiyat</th>
				<td><input type="text" class="form-control" name="price" required></td>
			</tr>
			<tr>
				<th>Yayınevi</th>
				<td><input type="text"  class="form-control" name="publisher" required></td>
			</tr>
			<tr>
				<th>Kategori</th>
				<td><input type="text" class="form-control" name="category" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Yeni kitap ekle" class="btn btn-primary">
		<a href="admin_kitap.php" class="btn btn-default">İptal</a>
	</form>
	<br/>
<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
