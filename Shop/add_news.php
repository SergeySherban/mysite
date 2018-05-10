<?php 
require __DIR__.'/App/api/news_db.php';

$news = filter_input_array(INPUT_POST);
if(!empty($news)) {
	$news['preview'] = $_FILES;
	addNewNews($news);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create new book</title>
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
            <form class="form-inline my-2 my-lg-0" method="get">
                <input type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0">Search</button>
            </form>  
        </div>
    </nav>
                    <!-- Форма добавления новой новости   -->
                
    <div class="container p-3">
        <h3>Add new news</h3>
        <a href="/Shop/news.php">Back to news</a> <br>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">News title</label>
                <input type="text" name="title" placeholder="Title" class="form-control" id="exampleFormControlInput1" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="exampleFormControlUrl">Preview</label>
                <input type="url" name="preview" class="form-control" id="exampleFormControlUrl"
               placeholder="http://" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" style="width: 300px;"></textarea>
            </div>
            <div>
                <button class="btn btn-outline-primary my-2 my-sm-0">Create</button>
            </div>
      </form>
	</div>           
                    
                    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="JS/main.js"></script>
</body>
</html>