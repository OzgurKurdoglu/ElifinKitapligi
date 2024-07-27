<?php
	session_start();

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$conn = db_connect();

	$query = "SELECT * FROM publisher ORDER BY publisherid";
	$result = mysqli_query($conn, $query);

	if(!$result){
		echo "Veriler alınamadı " . mysqli_error($conn);
		exit;
	}

	if(mysqli_num_rows($result) == 0){
		echo "Boş yayıncı! Bir şeyler yanlış! Lütfen tekrar kontrol edin";
		exit;
	}

	$title = "Yayınevleri Listesi";
	require "./template/header.php";
?>
	<div class="container">
		<h1 class="display-4">Yayınevleri Listesi</h1>
		<ul class="list-group">
		<?php 
			while($row = mysqli_fetch_assoc($result)){
				$count = 0; 
				$query = "SELECT publisherid FROM books";
				$result2 = mysqli_query($conn, $query);
				
				if(!$result2){
					echo "Veriler alınamadı " . mysqli_error($conn);
					exit;
				}
				while ($pubInBook = mysqli_fetch_assoc($result2)){
					if($pubInBook['publisherid'] == $row['publisherid']){
						$count++;
					}
				}
		?>
			<li class="list-group-item list-group-item-action list-group-item-primary d-flex align-items-center ">
				<span class="badge bg-primary rounded-pill"><?php echo $count; ?></span>
				<a class="list-group-item " href="yayıncılarına_kitap.php?pubid=<?php echo $row['publisherid']; ?>"><?php echo $row['publisher_name']; ?></a>
			</li>
		<?php } ?>
			<li class="list-group-item list-group-item-action list-group-item-primary d-flex align-items-center">
				<a  class="list-group-item " href="kitaplar.php">Tüm kitaplar listesi</a>
			</li>
		</ul>
	</div>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>
