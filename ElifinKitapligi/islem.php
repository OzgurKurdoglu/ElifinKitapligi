<?php
	session_start();

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

	$title = "Satın Alma Süreci";

	require "./template/header.php";

	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname);
		
	$lastname = trim($_POST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname);
	
	$address = trim($_POST['address']);
	$address = mysqli_real_escape_string($conn, $address);
	
	$city = trim($_POST['city']);
	$city = mysqli_real_escape_string($conn, $city);
	
	$zipcode = trim($_POST['zipcode']);
	$zipcode = mysqli_real_escape_string($conn, $zipcode);

	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id = $customer['id'];

	$query = "UPDATE customers SET 
	firstname='$firstname', lastname='$lastname', address='$address', city='$city', zipcode='$zipcode' WHERE id='$id'";
	mysqli_query($conn, $query);

	$date = date("Y-m-d H:i:s");

	insertIntoCart($conn, $customer['id'], $date);

	$Cartid = getCartId($conn, $customer['id']);

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO cartItems(cartid, productid, quantity) VALUES ('$Cartid', '$isbn', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Değer eklenemedi!" . mysqli_error($conn);
			exit;
		}
	}

	unset($_SESSION['total_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);
?>

<div class="alert alert-success" role="alert"> Siparişiniz başarıyla işlendi! </div>

<script>
	window.setTimeout(function(){
		window.location.href = "http://localhost/obs/index.php";
	}, 3000);
</script>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>
