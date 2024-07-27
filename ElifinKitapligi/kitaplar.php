<?php
  session_start();
  $count = 0;

  require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
  $conn = db_connect();

  if(isset($_POST['title'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM books ORDER BY book_title ASC";
    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM books ORDER BY book_title DESC";
    }else{
      $query = "SELECT * FROM books";
    }
  }else if(isset($_POST['price'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM books ORDER BY book_price ASC";
    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM books ORDER BY book_price DESC";
    }else{
      $query = "SELECT * FROM books";
    }
  }else if(isset($_POST['author'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM books ORDER BY book_author ASC";
    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM books ORDER BY book_author DESC";
    }else{
      $query = "SELECT * FROM books";
    }
  }else{
    $query = "SELECT * FROM books";
  }

  $result = mysqli_query($conn, $query);
  $title = "Tüm Kitaplar";
  
  require_once "./template/header.php";
?>


<h1 class="display-4 lead text-center">Tüm Kitaplar</h1>

<h5 class="lead text-muted">Sırala:</h5>
<form method="post" action="kitaplar.php">
  <div class="radio">
    <label><input type="radio" name="asc" >Artan</label>
  </div>
  <div class="radio">
    <label><input type="radio" name="desc">Azalan</label>
  </div>
  <button type="submit" class="btn btn-secondary" name="title">Başlık</button>
  <button type="submit" class="btn btn-secondary" name="price">Fiyat</button>
  <button type="submit" class="btn btn-secondary" name="author">Yazar</button>
  <button type="submit" class="btn btn-secondary" name="clear">Temizle</button>
</form>

<?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
  <div class="row">
    <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
      <div class="col-md-3">
        <a href="kitap.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>">
        </a>
        <table>
          <tr>
            <td><strong><?php echo $query_row['book_title']; ?></strong></td>
          </tr>
          <tr>
            <td><?php echo $query_row['book_author']; ?></td>
          </tr>
          <tr>
          <td><strong><?php echo $query_row['book_price']; ?> TL</strong></td>
          </tr>
        </table>
      </div>
    <?php
      $count++;
      if($count >= 4){
          $count = 0;
          break;
      }
    } ?> 
  </div>
  <br><br>
<?php } ?>

<?php
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>
