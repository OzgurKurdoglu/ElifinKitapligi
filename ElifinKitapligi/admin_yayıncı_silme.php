<?php
	$pubid = $_GET['pubid'];

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$conn = db_connect();

	$query = "DELETE FROM publisher WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Veri silinemedi: " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_yayıncı.php");
?>
