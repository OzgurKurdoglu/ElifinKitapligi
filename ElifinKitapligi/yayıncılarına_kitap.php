<?php
	session_start();
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";


	$pubid = isset($_GET['pubid']) ? $_GET['pubid'] : die("Yanlış sorgu! Lütfen tekrar kontrol edin!");


	$conn = db_connect();
	$pubName = getPubName($conn, $pubid);

	$query = "SELECT book_isbn, book_title, book_image FROM books WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);

	if(!$result){
		die("Veri alınamadı: " . mysqli_error($conn));
	}
	
	if(mysqli_num_rows($result) == 0){
		die("Boş kitap listesi! Lütfen yeni kitapların gelmesini bekleyin!");
	}

	$title = "Yayıncı Başına Kitaplar";
	require "./template/header.php";
?>
	<p class="lead"><a href="yayıncı_listesi.php">Yayıncılar</a> > <?php echo $pubName; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['book_title'];?></h4>
			<a href="kitap.php?bookisbn=<?php echo $row['book_isbn'];?>" class="btn btn-primary">Detayları Görüntüle</a>
		</div>
	</div>
	<br>
<?php
	}
	mysqli_close($conn);
	require "./template/footer.php";
?>
