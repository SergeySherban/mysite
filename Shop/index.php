<?php require __DIR__.'/App/api/products.php'; ?>
<?php require __DIR__.'/App/api/accaunt.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
                            <!--  Панель навигации  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a href="/Shop/" class="navbar-brand" >
            <img src="http://www.bcpls.org/images/FreeLittleLibraryLogo.jpg" alt="logo" width="60" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="/Shop/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/create.php" class="nav-link">Add new book</a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/news.php" class="nav-link">News</a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/register.php" class="nav-link" data-toggle="modal" data-target="#exampleModal1">Registration</a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/login.php" class="nav-link"  data-toggle="modal" data-target="#exampleModal">Login</a>
                </li>
            </ul> 
            <span class="navbar-brand"> 
               <?php 
                
                if(!empty($_POST['login'])) {
                $user = filter_input_array(INPUT_POST);
                signIn($user);
		        }
                
                ?> 
	        </span>
            <form class="form-inline my-2 my-lg-0" method="get">
                <input type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0">Search</button>
            </form>  
        </div>
    </nav>
<!--  Старый код
	<form method="get">
		<input type="text" name="search">
		<button>SEARCH</button>
		<br>
	</form>
	<h2>Books list</h2>
	<a href="/Shop/create.php">Add new book</a>
	<h2>Registration</h2>
	<a href="/Shop/register.php">Registration</a>
	<h2>Login</h2>
	<a href="/Shop/login.php">Enter your login</a>
	<br>
-->
                                <!--  Карусель    -->
    
        <div class="container-fluid p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                      <img class="d-block w-25" src="https://ozon-st.cdn.ngenix.net/multimedia/1018881814.jpg">
                </div>
                <div class="carousel-item">
                      <img class="d-block w-25" src="https://ozon-st.cdn.ngenix.net/multimedia/1019775280.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                      <img class="d-block w-25" src="https://ozon-st.cdn.ngenix.net/multimedia/1016798871.jpg" alt="Third slide">
                </div>
            </div>
             <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
             </a>
        </div>
    </div>
    
                            <!--   Таблица списка книг    -->
	<table class="table table-dark">
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Name</th>
			<th scope="col">Description</th>
			<th scope="col">Price</th>
			<th scope="col">Year</th>
			<th scope="col">Edit</th>
			<th scope="col">Delete</th>
		</tr>
	<?php
		$search = filter_input(INPUT_GET, 'search');
		$delete = filter_input(INPUT_GET, 'action');
		$id = filter_input(INPUT_GET, 'id');
		if(!empty('$delete') && $delete == 'delete' && !empty('$id')) {
			deleteProduct($id);
		}
		if(!empty($search)) {
			$products = searchProducts($search);
		} else {
			$products = getProducts();
		}					
		foreach($products as $value):
	?>
		<tr>      
			<th scope="row"><?php echo $value['id']; ?></th>
			<td><?php echo $value['Name']; ?></td>
			<td><?php echo $value['Description']; ?></td>
			<td><?php echo $value['Price']; ?></td>
			<td><?php echo $value['Year']; ?></td>
			<td>
				<a href="edit.php?id=<?php echo $value['id']; ?>" class="far fa-edit"></a>
			</td>
			<td>
				<a href="/Shop/?action=delete&id=<?php echo $value['id']; ?>" class="far fa-trash-alt"></a>
			</td>
		</tr>
	<?php endforeach ?>
	</table>
	
                        <!-- Попап входа на сайт -->
	<?php 
		if(!empty($_POST['login'])) {
			$user = filter_input_array(INPUT_POST);
			signIn($user);
		}
        
        //Если пользователь авторизован и администратор, то выполним какой-то код:
        if ($_SESSION['auth'] == true and $_SESSION['role'] == 'admin') {
            header('Location: http://mysite/Shop/news.php'); 
            exit();
        } 

	?>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Authorization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Login</label>
                                    <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Login" required name="username" >
                                    <small id="emailHelp" class="form-text text-muted">
                                      Enter your login 
                                    </small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputPass">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPass" placeholder="Password" required
                                    name="password">
                                    <small id="passHelp" class="form-text text-muted">
                                      Enter your pass
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Remember me
                            </label>
                        </div>
                        <input type="submit" value="Enter" name="login">
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Попап регистрации на сайте	-->
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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail">Login</label>
                            <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Login" required name="username">
                            <small id="emailHelp" class="form-text text-muted">
                          Enter your login 
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPass">Password</label>
                            <input type="password" class="form-control" id="exampleInputPass" placeholder="Password" required name="password">
                            <small id="passHelp" class="form-text text-muted">
                          Enter your pass
                       </small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPass">Confirm password</label>
                            <input type="password" class="form-control" id="exampleInputPass" placeholder="Confirm password" required name="repassword">
                            <small id="passHelp" class="form-text text-muted">
                          Repeat your pass
                           </small>
                        </div>
                        <p>
                            <?php echo $errors; ?>
                        </p>
                        <input type="submit" name="reg" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	                
                
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="JS/main.js"></script>
</body>
</html>