<?php

if (!function_exists("db_connect")) {
    function db_connect() {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'kitapçı';
        $port = 3306; 

        $connection = mysqli_connect($hostname, $username, $password, $database, $port);

        if (!$connection) {     
            die('Bağlantı hatası: ' . mysqli_connect_error());
        }

        return $connection;
    }
}

if (!function_exists("select4LatestBook")) {
    function select4LatestBook($conn) {
        $row = array();
        $query = "SELECT book_isbn, book_image, book_descr FROM books ORDER BY book_isbn DESC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        for ($i = 0; $i < 4; $i++) {
            array_push($row, mysqli_fetch_assoc($result));
        }
        return $row;
    }
}

if (!function_exists("getBookByIsbn")) {
    function getBookByIsbn($conn, $isbn) {
        $query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        return $result;
    }
}

if (!function_exists("getCartId")) {
    function getCartId($conn, $customerid) {
        $query = "SELECT id FROM cart WHERE customerid = '$customerid'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    }
}

if (!function_exists("insertIntoCart")) {
    function insertIntoCart($conn, $customerid, $date) {
        $query = "INSERT INTO cart(customerid,date) VALUES('$customerid','$date') ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Sepete ekleme başarısız oldu " . mysqli_error($conn);
            exit;
        }
    }
}

if (!function_exists("getbookprice")) {
    function getbookprice($isbn) {
        $conn = db_connect();
        $query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Kitap fiyatı alınamadı! " . mysqli_error($conn);
            exit;
        }
        $row = mysqli_fetch_assoc($result);
        return $row['book_price'];
    }
}

if (!function_exists("getCustomerId")) {
    function getCustomerId($name, $address, $city, $zip_code, $country) {
        $conn = db_connect();
        $query = "SELECT customerid FROM customers WHERE 
        name = '$name' AND 
        address= '$address' AND 
        city = '$city' AND 
        zip_code = '$zip_code' AND 
        country = '$country'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['customerid'];
        } else {
            return null;
        }
    }
}

if (!function_exists("getCustomerIdbyEmail")) {
    function getCustomerIdbyEmail($email) {
        $conn = db_connect();
        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return null;
        }
    }
}

if (!function_exists("getPubName")) {
    function getPubName($conn, $pubid) {
        $query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        if (mysqli_num_rows($result) == 0) {
            echo "Belirtilmemiş";
        }

        $row = mysqli_fetch_assoc($result);
        return $row['publisher_name'];
    }
}

if (!function_exists("getCatName")) {
    function getCatName($conn, $catid) {
        $query = "SELECT category_name FROM category WHERE categoryid = '$catid'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        if (mysqli_num_rows($result) == 0) {
            echo "Belirtilmemiş";
        }

        $row = mysqli_fetch_assoc($result);
        return $row['category_name'];
    }
}

if (!function_exists("getAll")) {
    function getAll($conn) {
        $query = "SELECT * FROM books ORDER BY book_isbn DESC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        return $result;
    }
}

if (!function_exists("getAllPublishers")) {
    function getAllPublishers($conn) {
        $query = "SELECT * FROM publisher ORDER BY publisher_name ASC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        return $result;
    }
}

if (!function_exists("getAllCategories")) {
    function getAllCategories($conn) {
        $query = "SELECT * FROM category ORDER BY category_name ASC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Veri alınamadı " . mysqli_error($conn);
            exit;
        }
        return $result;
    }
}

if (!function_exists("findOrInsertPublisher")) {
    function findOrInsertPublisher($conn, $publisher) {
        $query = "SELECT publisherid FROM publishers WHERE publisher_name = '$publisher'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['publisherid'];
        } else {
            $insert_query = "INSERT INTO publishers (publisher_name) VALUES ('$publisher')";
            $insert_result = mysqli_query($conn, $insert_query);
            if ($insert_result) {
                return mysqli_insert_id($conn);
            } else {
                return -1;
            }
		}
	}
}

if(!function_exists("findOrInsertCategory")){
	function findOrInsertCategory($conn, $category) {
		$query = "SELECT categoryid FROM categories WHERE category_name = '$category'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			return $row['categoryid'];
		} else {
			$insert_query = "INSERT INTO categories (category_name) VALUES ('$category')";
			$insert_result = mysqli_query($conn, $insert_query);
			if($insert_result) {
				return mysqli_insert_id($conn);
			} else {
				return -1;
			}
		}
	}
}

?>
       
