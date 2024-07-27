<?php	
	if(!isset($_POST['save_change'])){
		echo "Bir şeyler yanlış gitti!";
		exit;
	}

	$publisher = trim($_POST['name']);
	$id = trim($_POST['id']);

    require_once("./fonksiyonlar/veritabanı_fonksiyonları.php");
	$conn = db_connect();


	$query = "UPDATE publisher SET  
	publisher_name = '$publisher' WHERE publisherid = '$id'";
	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Veri güncellenemedi: " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_yayıncı.php");
	}
?>
