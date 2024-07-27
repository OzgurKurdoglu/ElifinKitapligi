<?php
	$catid = $_GET['catid'];

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$conn = db_connect();

	$query = "DELETE FROM category WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Veri silinemedi: " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_kategori.php");
?>
