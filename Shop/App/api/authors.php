<?php 
require realpath(__DIR__) . "/../connection.php";

function getAuthors() {
	$sql = 'SELECT * FROM Author';
	global $link;
	$q = mysqli_query($link, $sql);
	
	$authors = [];
	
	while($row = mysqli_fetch_assoc($q)) {
		$authors [] = $row;
	}
	return $authors;
}