<!--
<?php require __DIR__.'/App/api/accaunt.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<body>
<a href="/Shop/">Back to catalog</a> <br>
	<?php 
		$errors = '';
	
		if(!empty($_POST['reg'])) {
	
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $repassword = filter_input(INPUT_POST, 'repassword');
		
                if (empty($password) || empty($repassword) || empty($username)) {
                    $errors = 'empty field';
                } else { 
                    if ($password == $repassword) {
                    $user = filter_input_array(INPUT_POST);
                    register($user);
                } else {
                    $errors = 'confirm password failed';
                        }					
		        }
        }
	?>
	
	<form action="" method="post">
		<input type="text" name="username" placeholder="username"> <br>
		<input type="password" name="password" placeholder="password"> <br>
		<input type="password" name="repassword" placeholder="confirm passward"> <br>
		<p><?php echo $errors; ?></p>
		<input type="submit" name="reg" value="Register">
	</form>
</body>
</html>-->
