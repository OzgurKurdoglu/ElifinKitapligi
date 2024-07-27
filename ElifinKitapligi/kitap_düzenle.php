<?php	
	if(!isset($_POST['save_change'])){
		echo "Bir şeyler yanlış gitti!";
		exit;
	}

	$isbn = trim($_POST['isbn']);
	$title = trim($_POST['title']);
	$author = trim($_POST['author']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$publisher = trim($_POST['publisher']);
	$category = trim($_POST['category']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	require_once("./fonksiyonlar/veritabanı_fonksiyonları.php");

	$conn = db_connect();

	$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
	$findResult = mysqli_query($conn, $findPub);

	if(mysqli_num_rows($findResult) == 0){
		$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
		$insertResult = mysqli_query($conn, $insertPub);
		if(!$insertResult){
			echo "Yeni yayınevi eklenemedi: " . mysqli_error($conn);
			exit;
		}
		$publisherid = mysqli_insert_id($conn);
	} else {
		$row = mysqli_fetch_assoc($findResult);
		$publisherid = $row['publisherid'];
	}

	$findCat = "SELECT * FROM category WHERE category_name = '$category'";
	$findResult = mysqli_query($conn, $findCat);

	if(mysqli_num_rows($findResult) == 0){
		$insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
		$insertResult = mysqli_query($conn, $insertCat);
		if(!$insertResult){
			echo "Yeni kategori eklenemedi: " . mysqli_error($conn);
			exit;
		}
		$categoryid = mysqli_insert_id($conn);
	} else {
		$row = mysqli_fetch_assoc($findResult);
		$categoryid = $row['categoryid'];
	}

	$query = "UPDATE books SET  
	book_title = '$title', 
	book_author = '$author', 
	book_descr = '$descr', 
	book_price = '$price',
	publisherid = '$publisherid',
	categoryid = '$categoryid'";
	if(isset($image)){
		$query .= ", book_image='$image' WHERE book_isbn = '$isbn'";
	} else {
		$query .= " WHERE book_isbn = '$isbn'";
	}
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Veri güncellenemedi: " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_düzenle.php?bookisbn=$isbn");
	}
?>
