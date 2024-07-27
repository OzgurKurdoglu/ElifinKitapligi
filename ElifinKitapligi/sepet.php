<?php
session_start();

require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
require_once "./fonksiyonlar/sepet_fonksiyonları.php";
$conn = db_connect();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array(); 
    $_SESSION['total_items'] = 0;
    $_SESSION['total_price'] = '0.00'; 
}

if(isset($_POST['bookisbn'])){
    $book_isbn = $_POST['bookisbn'];
}

if(isset($book_isbn)){
    if(!isset($_SESSION['cart'][$book_isbn])){
        $_SESSION['cart'][$book_isbn] = 1;
    } elseif(isset($_POST['cart'])){
        $_SESSION['cart'][$book_isbn]++;
        unset($_POST);
    }
}

if(isset($_POST['save_change'])){
    foreach($_SESSION['cart'] as $isbn => $qty){
        if($_POST[$isbn] == '0'){
            unset($_SESSION['cart']["$isbn"]);
        } else {
            $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
        }
    }
}

if(isset($_POST['remove'])){
    $remove_isbn = $_POST['remove'];
    if(isset($_SESSION['cart'][$remove_isbn])){
        unset($_SESSION['cart'][$remove_isbn]);
    }
}


$title = "Sepetim";
require "./template/header.php";

if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
    $_SESSION['total_price'] = total_price($_SESSION['cart']);
    $_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
    <form action="sepet.php" method="post">
        <table class="table">
            <tr>
                <th>Ürün</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
            </tr>
            <?php foreach($_SESSION['cart'] as $isbn => $qty){ ?>
                <tr>
                    <td><?php 
                        $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                        echo $book['book_title'] . " by " . $book['book_author']; 
                    ?></td>
                    <td><?php echo $book['book_price'] . " TL"; ?></td>
                    <td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
                    <td><?php echo $qty * $book['book_price'] . " TL"; ?></td>
                    <td> <button type="submit" name="remove" value="<?php echo $isbn; ?>" class="btn btn-danger">Sil</button></td>
                    
                </tr>
            <?php } ?>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><?php echo $_SESSION['total_items']; ?></th>
                <th><?php echo $_SESSION['total_price'] . " TL"; ?></th>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary" name="save_change">Değişiklikleri Kaydet</button>
    </form>
    <br/><br/>
    <a href="ödeme.php" class="btn btn-primary">Ödeme'ye geç</a> 
    <a href="kitaplar.php" class="btn btn-primary">Alışverişe devam et.</a>
<?php
} else {
    ?>  <div class="alert alert-warning" role="alert"> Sepetiniz Boş! </div>
  <?php
}

if(isset($_SESSION['user'])){
    $customer = getCustomerIdbyEmail($_SESSION['email']);
    $customerid = $customer['id'];
    $query = "SELECT * FROM cart 
                JOIN cartitems 
                JOIN books 
                JOIN customers
                ON customers.id='$customerid' 
                AND cart.customerid='$customerid' 
                AND cart.id=cartitems.cartid 
                AND cartitems.productid=books.book_isbn";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) != 0){
        echo '<br><br><br><h4>Sipariş Geçmişin</h4>
                <table class="table">
                    <tr>
                        <th>Ürün</th>
                        <th>Adet</th>
                        <th>Tarih</th>
                    </tr>';
        while($query_row = mysqli_fetch_assoc($result)){
            echo '<tr>
                    <td>
                        <a href="kitap.php?bookisbn=' . $query_row['book_isbn'] . '">
                            <img style="height:100px;width:80px" class="img-responsive img-thumbnail" src="./bootstrap/img/' . $query_row['book_image'] . '">
                        </a>
                    </td>
                    <td>' . $query_row['quantity'] . '</td>
                    <td>' . $query_row['date'] . '</td>
                </tr>';
        }
        echo '</table>';
    }
}

if(isset($conn)){ mysqli_close($conn); }
?>
