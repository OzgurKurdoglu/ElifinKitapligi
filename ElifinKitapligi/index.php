<?php
  session_start();

  $count = 0;  
  $title = "Anasayfa";

  require_once "./template/header.php";
  require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

  $conn = db_connect();
  $row = select4LatestBook($conn);
?> 
      <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <header>
      <div id="carouselExample" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active c_item">
            <img src="./bootstrap/img/Slide_1.jpg" class="d-block w-100 c_img" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="./bootstrap/img/Slide_2.jpg" class="d-block w-100 c_img" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="./bootstrap/img/Slide_3.jpg" class="d-block w-100 c_img" alt="Slide 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
     </header>
    
     <br/> <br/>
      <p class="lead text-center text-muted">EN SON ÇIKAN KİTAPLARIMIZ</p>
      <div class="row">
    <?php 
    if (is_array($row)) {
        foreach($row as $book) { 
    ?>
        <div class="card car" style="width: 20rem;">
                <a href="kitap.php?bookisbn=<?php echo $book['book_isbn']; ?>">
                <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
            </a>
            <div class="card-body">
                <p class="card-text"><?php echo $book['book_descr']; ?></p>
                <a href="kitap.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="btn btn-primary">Detayları Gör</a>
            </div>
        </div>
    <?php 
        } 
    } else {
        echo "<p>No books available.</p>";
    }
    ?>
    </div>

<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>
