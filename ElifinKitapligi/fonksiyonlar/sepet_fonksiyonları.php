<?php

	function total_price($cart){
		$price = 0.0;
		if(is_array($cart)){
		  	foreach($cart as $isbn => $qty){
		  		$bookprice = getbookprice($isbn);
		  		if($bookprice){
		  			$price += $bookprice * $qty;
		  		}
		  	}
		}
		return $price;
	}

	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $isbn => $qty){
				$items += $qty;
			}
		}
		return $items;
	}
	function addToCart($conn, $book_isbn) {
		$customer_id = $_SESSION['user']['id'];
	
		$query = "CALL AddToCart('$book_isbn', '$customer_id')";
		mysqli_query($conn, $query);
	
	}
?>