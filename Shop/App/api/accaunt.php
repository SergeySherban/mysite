<?php 
require realpath(__DIR__) . "/../connection.php";

function register($user) {
	global $link;
	$password = md5($user['password'] . 'dkssdfsi');
	$sql = "INSERT INTO User (username, password) 
    VALUES ('".$user['username']."', '".$password."')";
	mysqli_query($link, $sql);
}

function signIn($user) {
	global $link;
	
	$username = mysqli_real_escape_string($link, $user['username']);
	$password = mysqli_real_escape_string($link, $user['password']);
	$password=md5($password.'dkssdfsi');
	$sql = "SELECT id, username, role FROM User WHERE username = '$username' AND password = '$password'";
	
	$q = mysqli_query($link, $sql);
	$result = mysqli_fetch_assoc($q);
	if(!empty($result)) {
		session_start();
        $_SESSION['auth'] = true; 
		$_SESSION['id'] = $result['id'];
		$_SESSION['username'] = $result['username'];
		$_SESSION['role'] = $result['role'];
        echo "Добро пожаловать $username";
	}  
    else {
		echo "Вы не вошли";
	}
}