<?php
	session_start();
	
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$title = "Satın Alma";
	require "./template/header.php";
	$conn = db_connect();

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
    ?>
	<table class="table">
		<tr>
			<th>Ürün</th>
			<th>Fiyat</th>
	    	<th>Miktar</th>
	    	<th>Toplam</th>
	    </tr>
	    	<?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
		<tr>
			<td><?php echo $book['book_title'] . " - " . $book['book_author']; ?></td>
			<td><?php echo $book['book_price'] . " TRY"; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $qty * $book['book_price'] . " TRY"; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo $_SESSION['total_price'] . " TRY"; ?></th>
		</tr>
		<tr>
			<td>Nakliye</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>20.00 TRY</td>
		</tr>
		<tr>
			<th>Nakliye Dahil Toplam</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo ($_SESSION['total_price'] + 20) . " TRY"; ?></th>
		</tr>
	</table>
	<br>
	<br>
	<h4 style="margin-left:-20px">Bilgileriniz</h4>
	<br>
	<form method="post" action="islem.php" class="form-horizontal">
		<div class="form-group">
	        <label for="exampleInputEmail1">Ad</label>
	        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
	    </div>
	    <div class="form-group">
	        <label for="exampleInputEmail1">Soyad</label>
	        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
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
	    <div class="form-group col-md-12" >
	        <div class="form-group" >
	            <div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
	              	<button type="reset" class="btn btn-default">İptal</button>
	              	<button type="submit" class="btn btn-primary">Satın Al</button>
	            </div>
	        </div>
	    </div>
	</form>
	<p class="lead">Satın almak için Satın Al'ı, formu sıfırlamak için İptal'i tıklayın.</p>
<?php
	} else {
		echo "<p class=\"text-warning\">Sepetiniz boş! Lütfen birkaç kitap eklediğinizden emin olun!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
