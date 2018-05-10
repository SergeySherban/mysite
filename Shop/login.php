<!--
 <?php require __DIR__.'/App/api/accaunt.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
<a href="/Shop/">Back to catalog</a> <br>
	<?php 
		if(!empty($_POST['login'])) {
			$user = filter_input_array(INPUT_POST);
			signIn($user);
		}
	?>

	<form action="" method="post">
		<input type="text" name="username" placeholder="username"> <br>
		<input type="password" name="password" placeholder="password"> <br>
		
		<input type="submit" name="login" value="Login">
	</form>

	
</body>
</html>
-->
