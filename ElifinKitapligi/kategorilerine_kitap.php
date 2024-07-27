<?php
	session_start();
	
	if(isset($_GET['catid'])){
		$catid = $_GET['catid'];
	} else {
		echo "Yanlış sorgu! Lütfen tekrar kontrol edin!";
		exit;
	}

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();
	
	$catName = getCatName($conn, $catid);

	$query = "SELECT book_isbn, book_title, book_image FROM books WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Veriler alınamadı " . mysqli_error($conn);
		exit;
	}
	
	if(mysqli_num_rows($result) == 0){
		echo "Boş kitaplar! Lütfen yeni kitaplar gelene kadar bekleyin!";
		exit;
	}

	$title = "Kategorilere Göre Kitaplar";
	
	require "./template/header.php";
?>
	
<p class="lead"><a href="kategori_listesi.php">Kategoriler</a> > <?php echo $catName; ?></p>

<?php 
	while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['book_title'];?></h4>
			<a href="kitap.php?bookisbn=<?php echo $row['book_isbn'];?>" class="btn btn-primary">Detayları Gör</a>
		</div>
	</div>
	<br>
<?php
	}
	
	if(isset($conn)) { mysqli_close($conn);}
	
	require "./template/footer.php";
?>
