<?php
	session_start();
	
	require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
	$title = "Ödeme yapılıyor";
	require "./template/header.php";

	if(!isset($_SESSION['user'])){
		echo '<div class="alert alert-danger" role="alert">
		Önce <a href="giris.php">giriş yapmanız</a> gerekiyor! 
	  </div>';
	}

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
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
			<td><?php echo $book['book_price'] . " TL"; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $qty * $book['book_price'] . " TL"; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo $_SESSION['total_price'] . " TL"; ?></th>
		</tr>
	</table>
	<?php 
		if(isset($_SESSION['user'])){
			echo '<form method="post" action="satın_alma.php" class="form-horizontal">
			<div class="form-group" style="margin-left:0px">
				<input type="submit" name="submit" value="Satın Al" class="btn btn-primary" >
				<a href="sepet.php" class="btn btn-primary">Sepeti Düzenle</a> 
			</div>
		</form>
		<p class="lead">Satın almak için "Satın Al" butonuna basın veya "Sepeti Düzenle"ye giderek ürünleri ekleyin veya çıkarın.</p>';
		}
	?>
	
<?php
	} else {
		echo "<p class=\"text-warning\">Sepetiniz boş! Lütfen birkaç kitap eklediğinizden emin olun!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
