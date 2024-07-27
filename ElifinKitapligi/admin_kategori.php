<?php
	session_start();
	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location: index.php");
		exit();
	}

	$title = "Kategorileri Listele";

	require_once "./template/header.php";
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$conn = db_connect();
	$result = getAllCategories($conn);
?>	
	<div>
		<a href="admin_çıkıs.php" class="btn btn-danger">Çıkış</a>
		<a href="admin_kitap.php" class="btn btn-primary">Kitaplar</a>
		<a href="admin_yayıncı.php" class="btn btn-primary">Yayınevleri</a>
		<?php
		if(isset($_SESSION['manager']) && $_SESSION['manager']){
			echo '<a class="btn btn-primary" href="admin_ekleme.php">Kitap Ekle</a>';
		}
		?>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>Adı</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['category_name']; ?></td>
			<?php
				if(isset($_SESSION['expert']) && $_SESSION['expert']){
					echo '<td><a href="admin_kategori_düzenle.php?catid=' . $row['categoryid'] . '">Düzenle</a></td>';
				}else if(isset($_SESSION['manager']) && $_SESSION['manager']){
					echo '<td><a href="admin_kategori_silme.php?catid=' . $row['categoryid'] . '">Sil</a></td>';
				}
			?>

		</tr>
		<?php } ?>
	</table>
    <?php

    if(isset($_SESSION['manager']) && $_SESSION['manager']){
		echo '<a class="btn btn-primary" href="admin_kategori_ekleme.php">Kategori Ekle</a>';
	}        
    ?>
<?php

	if(isset($conn)) {
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
