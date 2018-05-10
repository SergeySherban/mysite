<?php // require __DIR__.'/App/api/products.php'; ?> 
<?php require __DIR__.'/App/api/news_db.php'; ?>
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
            <form class="form-inline my-2 my-lg-0" method="get">
                <input type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0">Search</button>
            </form>  
        </div>
    </nav>
                            <!--   Таблица списка новостей    -->
	<table class="table table-dark">
		<tr>
			<th scope="col">№</th>
			<th scope="col">Preview</th>
			<th scope="col">Title</th>
			<th scope="col">Description</th>
			<th scope="col">Publication date</th>
			<th scope="col">Edit</th>
			<th scope="col">Delete</th>
		</tr>
	<?php
		$search = filter_input(INPUT_GET, 'search');
		$delete = filter_input(INPUT_GET, 'action');
		$id = filter_input(INPUT_GET, 'id');
		if(!empty('$delete') && $delete == 'delete' && !empty('$id')) {
			deleteNews($id);
		}
		if(!empty($search)) {
			$news = searchNews($search);
		} else {
			$news = getNews();
		}						
		foreach($news as $value):
	?>
		<tr>      
			<th scope="row"><?php echo $value['id']; ?></th>
			<td><img src="<?php echo $value['preview']; ?>" alt="foto_news" style="width: 200px;"></td>
			<td><?php echo $value['title']; ?></td>
			<td><?php echo $value['description']; ?></td>
			<td><?php echo $value['date']; ?></td>
			<td>
				<a href="edit_news.php?id=<?php echo $value['id']; ?>" class="far fa-edit"></a>
			</td>
			<td>
				<a href="/Shop/news.php?action=delete&id=<?php echo $value['id']; ?>" class="far fa-trash-alt"></a>
			</td>
		</tr>
	<?php endforeach ?>
	</table>
   <div class="container">
   <button type="button" class="btn btn-secondary btn-lg btn-block"><a href="/Shop/add_news.php">Add new news</a></button>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="JS/main.js"></script>
</body>
</html>