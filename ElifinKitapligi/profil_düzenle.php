<?php
	session_start();

	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$title = "Profil Düzenle";
	require "./template/header.php";
	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname);
		
	$lastname = trim($_POST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname);
        
	$email = trim($_POST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	
	$address = trim($_POST['address']);
	$address = mysqli_real_escape_string($conn, $address);
		
	$city = trim($_POST['city']);
	$city = mysqli_real_escape_string($conn, $city);
        
	$zipcode = trim($_POST['zipcode']);
	$zipcode = mysqli_real_escape_string($conn, $zipcode);

	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id = $customer['id'];

	$query = "UPDATE customers SET 
	firstname='$firstname', lastname='$lastname', address='$address', city='$city', zipcode='$zipcode', email='$email' WHERE id='$id'";
	mysqli_query($conn, $query);
?>

<p class="lead text-success" id="p">Profiliniz başarıyla güncellendi.</p>

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
