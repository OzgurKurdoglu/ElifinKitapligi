<?php
	session_start();

	if(!isset($_SESSION['manager']) && !isset($_SESSION['expert'])){
		header("Location:index.php");
		exit();
	}

	$title = "Yayıncıları Listele";

	require_once "./template/header.php";
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$conn = db_connect();
	$result = getAllPublishers($conn);
?>	
	<div>
		<a href="admin_çıkıs.php" class="btn btn-danger">Çıkış </a>
		<a href="admin_kitap.php" class="btn btn-primary">Kitaplar </a>
		<a href="admin_kategori.php" class="btn btn-primary">Kategoriler</a>
		<?php
		if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
			echo '<a class="btn btn-primary" href="admin_add.php">Kitap Ekle </a>';
		}
		?>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>İsim</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['publisher_name']; ?></td>
			<?php
				if(isset($_SESSION['expert']) && $_SESSION['expert']==true){
					echo '<td><a href="admin_yayıncı_düzenle.php?pubid=';
					echo $row['publisherid'];
					echo '">Düzenle</a></td>';
				}elseif(isset($_SESSION['manager']) && $_SESSION['manager']==true){
					echo '<td><a href="admin_yayıncı_silme.php?pubid=';
					echo $row['publisherid'];
					echo '">Sil</a></td>';
				}
			?>
		</tr>
		<?php } ?>
	</table>
    <?php
	
    if(isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-primary" href="admin_yayıncı_ekleme.php">Yayıncı Ekle </a>';
	}        
    ?>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
