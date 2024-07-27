
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `publisher` (
  `publisherid` int(10)   NOT NULL,
  `publisher_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `category` (
  `categoryid` int(10) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zipcode` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `cartitems` (
  `id` int(10) NOT NULL,
  `cartid` int(10) UNSIGNED NOT NULL,
  `productid` varchar(20) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `customerid` int(10)  NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `manager` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `expert` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `books` (
  `book_isbn` varchar(20) NOT NULL,
  `book_title` varchar(60) DEFAULT NULL,
  `book_author` varchar(60) DEFAULT NULL,
  `book_image` varchar(40) DEFAULT NULL,
  `book_descr` longtext DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `publisherid` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `purchased_books` (
  `purchase_id` int unsigned NOT NULL,
  `book_isbn` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` tinyint unsigned NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `publisherid`, `categoryid`) VALUES
('978-605-142-642-3', 'Aşk', 'Elif Şafak', 'Aşk.jpg', 'Elif Şafak’ın klasikleşmiş eseri Aşk, aşkı, umudu ve insan ilişkilerini derinlemesine işler. Yazarın etkileyici diliyle kaleme aldığı bu eser, okuyucuya duygusal bir yolculuk sunar.', 18.90, 20, 1),
('978-605-185-478-2', 'Kürk Mantolu Madonna', 'Sabahattin Ali', 'Kürk Mantolu Madonna.jpg', 'Sabahattin Ali’nin klasikleşmiş eseri Kürk Mantolu Madonna, aşkı, özlemi ve bekleyişi derinlemesine işleyen bir romandır. Yazarın etkileyici diliyle kaleme aldığı bu eser, edebiyatseverler için kaçırılmayacak bir okuma parçasıdır.', 19.99, 2, 1),
('978-605-192-037-5', 'Bir Yaz Gecesi Rüyası', 'William Shakespeare', 'Bir Yaz Gecesi Rüyası.jpg', 'William Shakespeare’in klasikleşmiş eseri Bir Yaz Gecesi Rüyası, aşkı ve hayal gücünün sınırlarını zorlayan bir komedidir. Farklı karakterlerin bir araya geldiği bu eser, insan ilişkilerini ve toplumsal yapıyı eğlenceli bir dille ele alır.', 19.90, 8, 1),
('978-605-194-370-0', 'Yaban', 'Yakup Kadri Karaosmanoğlu', 'Yaban.jpg', 'Yakup Kadri Karaosmanoğlu’nun başyapıtlarından biri olan Yaban, Türkiye’nin kırsal yaşamını ve değişen toplumsal değerleri ele alır. Roman, köy ve şehir yaşantısını karşılaştırarak insanların yaşadığı değişimi yansıtır.', 15.00, 4, 1),
('978-605-298-043-9', 'Atomik Alışkanlıklar', 'James Clear', 'Atomik Alışkanlıklar.jpg', 'Başarıyı ve mutluluğu artırmak için güçlü alışkanlıkların önemini anlatan bir kitap.', 19.99, 28, 15),
('978-605-332-025-0', 'Aşk-ı Memnu', 'Halit Ziya Uşaklıgil', 'Aşk-ı Memnu.jpg', 'Halit Ziya Uşaklıgil’in başyapıtlarından biri olan Aşk-ı Memnu, yasak bir aşkı, çelişkileri ve toplumsal baskıları başarılı bir şekilde işler. Osmanlı döneminde İstanbul’da geçen bu eser, edebiyat tarihinde önemli bir yere sahiptir.', 22.50, 6, 1),
('978-605-332-348-0', 'İçimizdeki Şeytan', 'Sabahattin Ali', 'İçimizdeki Şeytan.jpg', 'Sabahattin Ali’nin kısa hikayelerini bir araya getiren bu eser, insan psikolojisini, toplumsal çelişkileri ve insan ilişkilerini başarılı bir şekilde ele alır. Yazarın derinlemesine hikayeleri, okuyucuyu etkileyici bir düşünce yolculuğuna çıkarır.', 12.50, 2, 13),
('978-605-338-308-8', 'Bir İdam Mahkumunun Son Günü', 'Victor Hugo', 'Bir İdam Mahkumunun Son Günü.jpg', 'Victor Hugo’nun kısa hikayelerinden biri olan Bir İdam Mahkumunun Son Günü, insanın iç dünyasını, umudu ve çaresizliği başarılı bir şekilde işler. Etkileyici diliyle okuyucuyu derinden etkileyen bu hikaye, unutulmaz bir deneyim sunar.', 16.90, 6, 13),
('978-605-360-675-3', 'Türk Edebiyatı Tarihi', ' Hüseyin Nihal Atsız', 'Türk Edebiyatı Tarihi.jpg', 'Türk edebiyatının tarihini ve gelişimini ele alan bu kitap, edebiyat tarihine ilgi duyanlar için önemli bir kaynaktır. Nihat Tarlan’ın kaleme aldığı bu eser, Türk edebiyatının farklı dönemlerini detaylı bir şekilde inceler.', 28.90, 4, 13),
('978-605-375-154-6', 'The Joy of Cooking', 'Irma S. Rombauer, Marion Rombauer Becker, Ethan Becker', 'The Joy of Cooking.jpg', 'Binlerce tarif, pişirme teknikleri ve mutfak temelleri ile kapsamlı bir yemek tarifi kitabı.', 35.00, 30, 11),
('978-605-375-154-7', 'Küçük Ağa', 'Tarık Buğra', 'Küçük Ağa.jpg', 'İlk kez 1949 yılında yayımlanan Küçük Ağa, Türk edebiyatının unutulmaz eserlerinden biridir. Tarık Buğra’nın bu kitabı, ilgiyle okunmaya devam etmektedir. Eser, çocukluk günlerini anlatırken Türk aile yapısını, geleneklerini, o dönemdeki toplumsal yapımızı gözler önüne serer.', 10.00, 4, 1),
('978-605-396-134-5', 'Fareler ve İnsanlar', 'John Steinbeck', 'Fareler ve İnsanlar.jpg', 'John Steinbeck’in klasikleşmiş eseri Fareler ve İnsanlar, Amerikan edebiyatının önemli eserlerinden biridir. İki dilsiz dostun hikayesini anlatan bu roman, insan ilişkilerini ve hayalleri etkileyici bir dille ele alır.', 18.50, 14, 1),
('978-605-418-409-1', 'Mutluluğun Formülü', 'Neil Pasricha', 'Mutluluğun Formülü.jpg', 'Mutluluğu bulmanın yollarını anlatan etkileyici bir rehber.', 22.50, 26, 15),
('978-605-460-368-5', 'Şeker Portakalı', 'Jose Mauro De Vasconcelos', 'Şeker Portakalı.jpg', 'Jose Mauro De Vasconcelos’un unutulmaz eseri Şeker Portakalı, çocukluk ve umut üzerine dokunaklı bir hikaye sunar. Küçük Zeze’nin hayatını ve hayal dünyasını konu alan bu eser, duygusal bir yolculuğa çıkarır.', 14.99, 6, 3),
('978-605-965-421-5', 'Eylül', 'Mehmet Rauf', 'Eylül.jpg', 'Mehmet Rauf’un klasikleşmiş eseri Eylül, aşkı, tutkuyu ve ayrılığı derinlemesine ele alan bir romandır. İstanbul’un güzelliklerini ve zorluklarını konu alan bu eser, edebiyatseverler için kaçırılmayacak bir okuma parçasıdır.', 13.99, 4, 1),
('978-605-999-057-5', 'Resim Sanatı Üzerine Denemeler', 'D. H. Lawrence ', 'Resim Sanatı Üzerine Denemeler.jpg', 'Resim sanatına dair derinlemesine incelemeler ve eleştiriler.', 30.00, 22, 9),
('978-605-999-057-6', 'Sinekli Bakkal', 'Halide Edib Adıvar', 'Sinekli Bakkal.jpg', 'Türk edebiyatının önemli eserlerinden biri olan Sinekli Bakkal, Halide Edib Adıvar’ın kaleme aldığı, toplumun çeşitli kesitlerini eleştirdiği bir romandır. Osmanlı İmparatorluğu’nun son dönemlerinde İstanbul’da geçen bu eser, toplumsal değişim ve dönüşüme dair önemli ipuçları sunar.', 14.50, 6, 1),
('978-975-10-1551-3', 'Kuyucaklı Yusuf', 'Sabahattin Ali', 'Kuyucaklı Yusuf.jpg', 'Sabahattin Ali’nin bu küçük kitabı, bir yanda hiçbir toplumun kurtuluşu olamayacak olan sefaletin ve yoksulluğun insanda bıraktığı acıyı; öte yanda insani duyguların, aşkın ve iyiliğin başkalarına olan gücünü anlatır.', 12.00, 2, 1),
('978-975-10-3724-8', 'Nutuk', 'Mustafa Kemal Atatürk', 'Nutuk.jpg', 'Mustafa Kemal Atatürk’ün klasikleşmiş eseri Nutuk, Türk Kurtuluş Savaşı’nı ve Cumhuriyet’in kuruluşunu anlatan önemli bir belgedir. Türk tarihine ışık tutan bu eser, edebiyatseverler için önemli bir başvuru kaynağıdır.', 25.00, 8, 13),
('978-975-20-2368-1', 'Kahve Tadında Hikayeler', ' Akif Bayrak', 'Kahve Tadında Hikayeler.jpg', 'Kahve eşliğinde keyifli hikayeler ve anekdotlar.', 12.99, 24, 11),
('978-975-342-663-0', 'Sergüzeşt', 'Samipaşazade Sezai', 'Sergüzeşt.jpg', 'Türk edebiyatının önemli eserlerinden biri olan Sergüzeşt, dönemin toplumsal yapısını, ilişkileri ve aşkı işler. Samipaşazade Sezai’nin kaleme aldığı bu eser, dönemin İstanbul’unu ve insanlarını başarılı bir şekilde betimler.', 11.75, 10, 1),
('978-975-363-640-2', 'Huzur', 'Ahmet Hamdi Tanpınar', 'Huzur.jpg', 'Ahmet Hamdi Tanpınar’ın başyapıtlarından biri olan Huzur, insan psikolojisini, aşkı ve toplumsal değişimi derinlemesine ele alan bir romandır. İstanbul’un çeşitli semtlerinde geçen bu eser, edebiyatseverler için kaçırılmayacak bir okuma parçasıdır.', 21.00, 2, 1),
('978-975-494-239-7', 'Ağrıdağı Efsanesi', 'Yaşar Kemal', 'Ağrıdağı Efsanesi.jpeg', 'Yaşar Kemal’in kaleminden çıkan bu eser, Anadolu’nun mistik dünyasını, efsanelerini ve insanların yaşadığı zorlu hayatı anlatır. Ağrı Dağı’nın eteğindeki köyde geçen bu hikaye, unutulmaz bir okuma deneyimi sunar.', 17.75, 16, 1),
('978-975-509-946-2', 'Dokuzuncu Hariciye Koğuşu', 'Peyami Safa', 'Dokuzuncu Hariciye Koğuşu.jpg', 'Peyami Safa’nın klasikleşmiş eseri Dokuzuncu Hariciye Koğuşu, insan psikolojisini, toplumsal çelişkileri ve umudu başarılı bir şekilde işler. Yazarın etkileyici diliyle kaleme aldığı bu eser, edebiyatseverler için kaçırılmayacak bir okuma parçasıdır.', 17.50, 6, 1),
('978-975-6009-16-9', 'Tutunamayanlar', 'Oğuz Atay', 'Tutunamayanlar.jpg', 'Türk edebiyatının başyapıtlarından biri olan Tutunamayanlar, toplumun çeşitli kesitlerini eleştiren, insan psikolojisini derinlemesine işleyen bir romandır. Oğuz Atay’ın bu eseri, çağdaş Türk edebiyatının en önemli eserlerinden biridir.', 22.00, 4, 1),
('978-975-807-223-2', 'Beyaz Gemi', 'Cengiz Aytmatov', 'Beyaz Gemi.jpg', 'Cengiz Aytmatov’un klasikleşmiş eseri Beyaz Gemi, insanın iç dünyasını, toplumsal çelişkileri ve umudu başarılı bir şekilde işler. Yazarın etkileyici diliyle kaleme aldığı bu eser, okuyucuya duygusal bir yolculuk sunar.', 21.50, 6, 1);

INSERT INTO `cart` (`id`, `customerid`, `date`) VALUES
(23, 1, '2024-04-15 10:30:00'),
(24, 1, '2024-04-20 14:45:00'),
(25, 2, '2024-04-25 16:20:00'),
(26, 2, '2024-04-28 09:00:00');

INSERT INTO `cartitems` (`id`, `cartid`, `productid`, `quantity`) VALUES
(24, 23, '978-0-321-94786-4', 1),
(25, 23, '978-605-338-308-8', 1),
(26, 23, '978-975-494-239-7', 5),
(27, 26, '978-975-807-223-2', 10);

INSERT INTO `category` (`categoryid`, `category_name`) VALUES
(1, 'Kurgu'),
(3, 'Çocuk Kitapları'),
(5, 'Eğitim'),
(7, 'Sağlık ve Diyet'),
(9, 'Sanat ve Eğlence'),
(11, 'Yemek, Yiyecek ve İçecek'),
(13, 'Kurgusal Olmayan'),
(15, 'Kişisel Gelişim');

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `zipcode`) VALUES
(1, 'Elif', 'Yiğitbaşı', 'elifyigitbasi@gmail.com', '1234', 'Barajyolu', 'Adana', '123456789'),
(2, 'Eflia', 'Karadeniz', 'efilakaradeniz@gmail.com', '12345', 'Bahçeşehir', 'İstanbul', '1235134623');

INSERT INTO `expert` (`name`, `pass`) VALUES
('expert', 'expert');

INSERT INTO `manager` (`name`, `pass`) VALUES
('manager', 'manager');

INSERT INTO `publisher` (`publisherid`, `publisher_name`) VALUES
(2, 'Yapı Kredi Yayınları'),
(4, 'İletişim Yayınları'),
(6, 'Can Yayınları'),
(8, 'İş Bankası Kültür Yayınları'),
(10, 'Timaş Yayınları'),
(12, 'Dergah Yayınları'),
(14, 'Sel Yayıncılık'),
(16, 'Bilgi Yayınevi'),
(18, 'Alfa Yayınları'),
(20, 'Doğan Kitap'),
(22, 'Remzi Kitabevi'),
(24, 'YEDİVEREN YAYINLARI'),
(26, 'Yakamoz Yayınları'),
(28, 'PEGASUS Yayınları'),
(30, 'Scribner (Simon & Schuster)');

DELIMITER //
CREATE TRIGGER add_to_purchased_books AFTER INSERT ON cartitems
FOR EACH ROW
BEGIN
    DECLARE v_book_title VARCHAR(60);
    DECLARE v_book_author VARCHAR(60);
    DECLARE v_book_price DECIMAL(6,2);
    DECLARE v_purchase_date TIMESTAMP;
    
    SELECT book_title, book_author, book_price
    INTO v_book_title, v_book_author, v_book_price
    FROM books
    WHERE book_isbn = NEW.productid;
    
    SELECT date INTO v_purchase_date
    FROM cart
    WHERE id = NEW.cartid;


    INSERT INTO purchased_books (book_isbn, quantity, purchase_date )
    VALUES (NEW.productid, NEW.quantity, v_purchase_date );
END;
//
DELIMITER ;



ALTER TABLE `books`
  ADD PRIMARY KEY (`book_isbn`);


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);


ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherid`);


ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;


ALTER TABLE `cartitems`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;


ALTER TABLE `category` 
  MODIFY `categoryid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `publisher`
 MODIFY `publisherid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `purchased_books`
  MODIFY `purchase_id` int unsigned NOT NULL AUTO_INCREMENT;



ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_publisher`
  FOREIGN KEY (`publisherid`)
  REFERENCES `publisher` (`publisherid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_category`
  FOREIGN KEY (`categoryid`)
  REFERENCES `category` (`categoryid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customers`
  FOREIGN KEY (`customerid`)
  REFERENCES `customers` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

  ALTER TABLE `purchased_books`
  ADD CONSTRAINT `fk_purchased_books_books`
  FOREIGN KEY (`book_isbn`)
  REFERENCES `books` (`book_isbn`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;





