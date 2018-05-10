<?php 
require realpath(__DIR__) . "/../connection.php";
require realpath(__DIR__)."/upload.php";

function getProducts() {
	$sql = 'SELECT * FROM Books';
	global $link;
    $q = mysqli_query($link, $sql);
	$products = [];
	while($row = mysqli_fetch_assoc($q)) {
	$products[] = $row;
	}
	return $products;
}

function getProductById ($id) {
	global $link;
	$productId = $search = mysqli_real_escape_string($link, $id);
	$sql = "SELECT * FROM Books WHERE id='$productId'";
	$q = mysqli_query($link, $sql);
	$result = mysqli_fetch_assoc($q);
	return $result;
}

function searchProducts($name) {
	global $link;
	
	$search = mysqli_real_escape_string($link, $name); //обезопасим поиск от спец символов и запросов sql
	
	$sql = "SELECT * FROM Books WHERE Name LIKE '%$search%' OR Description LIKE '%$search%'";
		
	$q = mysqli_query($link, $sql);
	
	$products = [];
	
	while($row = mysqli_fetch_assoc($q)) {
		$products[] = $row;
	}
	return $products;
}

function addProductAuthors($bookId, $authors) {
	global $link;
	if(is_array($authors)) {
		foreach($authors as $v) {
			$sql = "INSERT INTO Books_authors (`book_id`, `authors_id`) 
            VALUES('".$bookId."','".$v."')";
			    if(!mysqli_query($link, $sql)){
                echo "Все плохо".mysqli_error($link);
                exit();}
		}
	}
}

function getProductAuthors($book_id) {
	global $link;
	$bookId = mysqli_real_escape_string($link, $book_id);
	$sql = "SELECT * FROM Books_authors WHERE book_id='$bookId'";
    $q=mysqli_query($link,$sql);
	$booksAuthors = [];
	
	while($row = mysqli_fetch_assoc($q)) {
		$booksAuthors[] = $row;
	}
	return $booksAuthors;
}

function addNewProducts($product) {
   	$file = $product['preview'];
    
	$preview = upload($file['preview']);
	global $link;
			
	$sql = "INSERT INTO Books(`Name`, `Description`, `Preview`, `Year`, `Publisher_id`, `Lang_id`, `Price`) VALUES('".$product['name']."', '".$product['description']."', '".$preview."', '".$product['year']."', '".$product['publisher_id']."', '".$product['lang_id']."', '".$product['price']."')";
	
	 if(!mysqli_query($link, $sql)){
        echo "Все плохо".mysqli_error($link);
        exit();
     }
	
	$lastId = mysqli_insert_id($link);
	addProductAuthors($lastId, $product['author']);
	}

function deleteProductAuthors($book_id) {
	if(!empty($book_id)) {
		global $link;
		$sql = "DELETE FROM Books_authors WHERE book_id = '$book_id'";
		mysqli_query($link, $sql);
	}
}

function deleteProduct($book_id) {
	if(!empty($book_id)) {
		global $link;
		$sql = "DELETE FROM Books WHERE id = '$book_id'";
		mysqli_query($link, $sql);
		echo mysqli_error($link);
	}
}

function editProduct($id, $product) {
    
	global $link;
	$preview = $product['preview'];
	$sql = "UPDATE Books SET 
			`Name` = '".$product['name']."',
			`Description` = '".$product['description']."',
			`Year` = '".$product['year']."',
			`Publisher_id` = '".$product['publisher_id']."',
			`Lang_id` = '".$product['lang_id']."',
			`Price` = '".$product['price']."'";
	
	if(!empty($preview['preview']['name'])) {
		$file = $product['preview'];
    	$preview = upload($file['preview']);
		$sql .= ", preview = '" . $preview . "'";
	}
	$sql .= " WHERE id='$id'";

    if(!mysqli_query($link, $sql)) {
        echo "Все плохо".mysqli_error($link);
        exit();
    }
	deleteProductAuthors($id);
	addProductAuthors($id, $product['author']);
}


