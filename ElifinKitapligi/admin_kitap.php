<?php
	session_start();

	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Kitapları Listele";
	require_once "./template/header.php";
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();
	$result = getAll($conn);
?>	
	<div>
		<a href="admin_çıkıs.php" class="btn btn-danger">Çıkış</a>
		<a href="admin_yayıncı.php" class="btn btn-primary">Yayınevleri</a>
		<a href="admin_kategori.php" class="btn btn-primary">Kategoriler</a>
		<?php
		if(isset($_SESSION['manager']) && $_SESSION['manager']){
			echo '<a class="btn btn-primary" href="admin_ekleme.php">Kitap Ekle</a>';
		}
		?>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Başlık</th>
			<th>Yazar</th>
			<th>Resim</th>
			<th>Açıklama</th>
			<th>Fiyat</th>
			<th>Yayınevi</th>
			<th>Kategori</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>

		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td>
				<div class="col-md-3 text-center">
					<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
				</div>
				<?php echo $row['book_image']; ?>
			</td>
			<td><?php echo $row['book_descr']; ?></td>
			<td><?php echo $row['book_price']; ?></td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
			<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
			<?php
				if(isset($_SESSION['expert']) && $_SESSION['expert']){
					echo '<td><a href="admin_düzenle.php?bookisbn=' . $row['book_isbn'] . '">Düzenle</a></td>';
				}else if(isset($_SESSION['manager']) && $_SESSION['manager']){
					echo '<td><a href="admin_silme.php?bookisbn=' . $row['book_isbn'] . '">Sil</a></td>';
				}
			?>

		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
