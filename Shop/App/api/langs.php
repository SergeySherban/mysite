<?php 
require realpath(__DIR__) . "/../connection.php";

function getLangs() {
	$sql = 'SELECT * FROM Langs';
	global $link;
	$q = mysqli_query($link, $sql);
	
	$langs = [];
	
	while($row = mysqli_fetch_assoc($q)) {
		$langs[] = $row;
	}
	return $langs;
}