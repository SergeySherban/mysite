<?php 
require realpath(__DIR__) . "/../connection.php";

function getPublishers() {
	$sql = 'SELECT * FROM Publishers';
	global $link;
	$q = mysqli_query($link, $sql);
	
	$publishers = [];
	
	while($row = mysqli_fetch_assoc($q)) {
		$publishers [] = $row;
	}
	return $publishers;
}