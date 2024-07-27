<?php

$title = "Kullanıcı Kaydı";

require_once "./template/header.php";
?>

<form class="form-horizontal" method="post" action="kullanıcı_kayıt_olma.php">
    <div class="form-group">
        <label for="exampleInputEmail1">Ad</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Adınız" name="firstname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Soyad</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Soyadınız" name="lastname">
    </div>
    <div class="form-group">
        <label for="inputEmail4">E-posta</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="E-posta adresiniz" name="email">
    </div>
    <div class="form-group">
        <label for="inputPassword4">Şifre</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Şifreniz" name="password">
    </div>
    <div class="form-group">
        <label for="inputAddress">Adres</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Adresiniz" name="address">
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputCity">Şehir</label>
            <input type="text" class="form-control" id="inputCity" name="city">
        </div>
        <div class="form-group col-md-4">
            <label for="inputZip">Posta Kodu</label>
            <input type="text" class="form-control" id="inputZip" name="zipcode">
        </div>
    </div>
    <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
    </div>
</form>

<div style="position:fixed; bottom:120px">
    <?php
    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullurl,"signup=empty") !== false){
        echo '<p style="color:red">Tüm alanları doldurmadınız.</p>';
        exit();
    }
    if(strpos($fullurl, "signup=invalidemail") !== false){
        echo '<p style="color:red">Geçerli bir e-posta adresi girmediniz.</p>';
        exit();
    }
    ?>
</div>

<?php
require_once "./template/footer.php";
?>
