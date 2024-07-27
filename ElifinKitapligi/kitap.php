<?php
  session_start();

  $book_isbn = $_GET['bookisbn'];

  require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);

  if(!$result){
    echo "Veri alınamadı " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Boş kitap";
    exit;
  }

  $title = $row['book_title'];

  require "./template/header.php";
?>

<p class="lead" style="margin: 25px 0"><a href="kitaplar.php">Kitaplar</a> > <?php echo $row['book_title']; ?></p>
<div class="row">
  <div class="col-md-3 text-center">
    <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
  </div>
  <div class="col-md-6">
    <h4>Kitap Açıklaması</h4>
    <p><?php echo $row['book_descr']; ?></p>
    <h4>Kitap Detayları</h4>
    <table class="table">
      <?php 
        foreach($row as $key => $value){
          if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
            continue;
          }
          switch($key){
            case "book_isbn":
              $key = "ISBN";
              break;
            case "book_title":
              $key = "Başlık";
              break;
            case "book_author":
              $key = "Yazar";
              break;
            case "book_price":
              $key = "Fiyat";
              $value .= " TL";
              break;
          }
      ?>
      <tr>
        <td><?php echo $key; ?></td>
        <td><?php echo $value; ?></td>
      </tr>
      <?php } ?>
    </table>
    <form method="post" action="sepet.php">
      <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
      <input type="submit" value="Sepete Ekle" name="cart" class="btn btn-primary">
    </form>
  </div>
</div>

<?php
  if(isset($conn)) {mysqli_close($conn); }
  
  require "./template/footer.php";
?>
