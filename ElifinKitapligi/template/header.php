<?php
    
    if (!isset($_SESSION)) { 
        session_start(); 
    } 

    
    require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

 
    if (isset($_SESSION['email'])) {
        $customer = getCustomerIdbyEmail($_SESSION['email']);
        $name = $customer['firstname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>
    
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-primary ">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="index.php">
              <i class="fas fa-home"></i>
              <img class="logo" src="./bootstrap/img/logo_!.png" width="30" height="30"  alt="" loading="lazy" >  Elif'in Kitaplığı
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ">
                <li class="nav-item ">
                  <a class="nav-link text-light" href="yayıncı_listesi.php">Yayıncılar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light" href="kategori_listesi.php">Kategoriler</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light" href="kitaplar.php">Kitaplar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light" href="sepet.php">Sepetim</a>
                <?php if (isset($_SESSION['user'])): ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light"  role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $name; ?></a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="profil.php">Profilim</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="çıkıs.php">Çıkış Yap</a></li>
                    </ul>
                  </li>  
                <?php else: ?>
                    <li><a class="nav-link text-light" href="giris.php">Giriş Yap</a></li>
                    <li><a class="nav-link text-light" href="kayıt_olma.php">Kayıt Ol</a></li>
                <?php endif; ?>    
              </ul>
            </div>
          <form class="d-flex" role="search" method="post" action="kitap_arama.php">
              <input class="form-control me-auto " type="search" placeholder="Arama" aria-label="Search" name="text">
              <button class="btn btn-primary" type="submit">Ara</button>
          </form>
        </div>
    </nav>

    <div class="container" id="main">
