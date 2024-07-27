<?php

$title = "Kullanıcı Girişi";

require_once "./template/header.php";
?>

<form class="form-horizontal" method="post" action="kullanıcı_dogrulama.php">
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="inputEmail6" class="col-form-label">E-Posta</label>
        </div>
        <div class="col-auto">
            <input type="text" id="inputEmail6" name="username" class="form-control" placeholder="E-Postanızı girin"  aria-describedby="emailHelp " required>
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Parola</label>
        </div>
        <div class="col-auto">
            <input type="password" id="inputPassword6" name="password" class="form-control" placeholder="Parolanızı girin" aria-describedby="passwordHelpInline" required>
        </div>
        <div class="col-auto">
            <span id="passwordHelpInline" class="form-text">8-20 karakter uzunluğunda olmalıdır.</span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Giriş Yap</button>
</form>

<div style="position:fixed; bottom:400px">
<?php
$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullurl, "signin=empty") !== false) {
    echo '<div class="alert alert-danger" role="alert"> Tüm Alanları Doldurunuz. </div>';
    exit();
}


if (strpos($fullurl, "signin=invalidpassword") !== false) {
    echo '<div class="alert alert-danger" role="alert"> E-posta veya parolanız yanlış. </div>';
    exit();
}

?>
</div>

<?php
require_once "./template/footer.php";
?>
