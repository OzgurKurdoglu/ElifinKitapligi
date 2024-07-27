<?php
$text = trim($_POST['text']);
require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
$conn = db_connect();
$query = "SELECT * FROM books 
          JOIN publisher ON books.publisherid = publisher.publisherid 
          WHERE book_isbn LIKE '%$text%' 
          OR book_author LIKE '%$text%' 
          OR book_title LIKE '%$text%' 
          OR publisher_name LIKE '%$text%' ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0){
  echo '
  <div class="alert alert-warning" role="alert">
  Sonuç Bulunamadı... 
  </div>' . ' <div class="search_top" >
     
</div>';
}else{
  $number = mysqli_num_rows($result);
  echo  '<div class="alert alert-success" role="success"> ';
  echo $number;
  echo ' Kitap Bulundu</div>' . ' <div class="search_top" >       
</div>';
}

require_once "./template/header.php";
?>


<h1 class="display-4 lead text-center">Arama Sonuçları</h1>


<div class="row">
  <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
    <div class="col-md-3">
      <a href="kitap.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
        <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>">
      </a>
    </div>
  <?php } ?> 
</div>

<?php
if(isset($conn)) { mysqli_close($conn); }
require_once "./template/footer.php";
?>
