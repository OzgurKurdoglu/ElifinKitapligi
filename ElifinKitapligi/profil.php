<?php
	session_start();
	
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$title = "Profil";
	require "./template/header.php";
	$conn = db_connect();

	if(isset($_SESSION['email'])){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
?>

<form method="post" action="profil_düzenle.php" class="form-horizontal">
	<div class="form-group">
        <label for="exampleInputEmail1">Ad</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Soyad</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">E-posta</label>
        <input type="email" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['email']?>" name="email" readonly>
    </div>

    <div class="form-group">
        <label for="inputAddress">Adres</label>
        <input type="text" class="form-control" id="inputAddress" value="<?php echo $customer['address']?>" name="address">
    </div>
    <div class="form-row">
		<div class="form-group col-md-6">
            <label for="inputCity">Şehir</label>
            <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer['city']?>">
        </div>
        <div class="form-group col-md-6">
            <label for="inputZip">Posta Kodu</label>
            <input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer['zipcode']?>">
        </div>
    </div>
	<br>
    <div class="form-group col-md-12">
        <div class="form-group">
            <div class="col-lg-12 text-center">
              	<button type="reset" class="btn btn-default">İptal</button>
              	<button type="submit" class="btn btn-primary">Düzenle</button>
            </div>
        </div>
    </div>
</form>

<?php
	} 
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
