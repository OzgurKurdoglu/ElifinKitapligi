<?php
    $book_isbn = $_GET['bookisbn'];

    require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";

    $conn = db_connect();

    $query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        echo "Veri silinemedi: " . mysqli_error($conn);
        exit;
    }
    header("Location: admin_kitap.php");
?>
