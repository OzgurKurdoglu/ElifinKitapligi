<?php
    session_start();
    require_once "./fonksiyonlar/veritabanı_fonksiyonları.php";
    $conn = db_connect();

    $query = "SELECT * FROM category ORDER BY category_name";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Veri alınamadı " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "Boş kategori! Bir sorun olabilir, lütfen tekrar kontrol edin";
        exit;
    }

    $title = "Kategori Listesi";
    require "./template/header.php";
?>
    
    <div class="container">
        <h1 class="display-4">Kategori Listesi</h1>
        <ul class="list-group">
        <?php 
            while($row = mysqli_fetch_assoc($result)){
                $count = 0; 
                $query = "SELECT categoryid FROM books";
                $result2 = mysqli_query($conn, $query);
                if(!$result2){
                    echo "Veri alınamadı " . mysqli_error($conn);
                    exit;
                }
                while ($pubInBook = mysqli_fetch_assoc($result2)){
                    if($pubInBook['categoryid'] == $row['categoryid']){
                        $count++;
                    }
                }
        ?>
            <li class="list-group-item list-group-item-action list-group-item-primary d-flex align-items-center ">
                <span class="badge bg-primary rounded-pill"><?php echo $count; ?></span>
                <a  class="list-group-item " href="kategorilerine_kitap.php?catid=<?php echo $row['categoryid']; ?>"><?php echo $row['category_name']; ?></a>
            </li>
        <?php } ?>
            <li class="list-group-item list-group-item-action list-group-item-primary d-flex align-items-center ">
                <a  class="list-group-item " href="kitaplar.php">Tüm kitapları listeleyin</a>
            </li>
        </ul>
    </div>
<?php
    mysqli_close($conn);
    require "./template/footer.php";
?>
