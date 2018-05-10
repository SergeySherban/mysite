<?php require 'downloadsFoto.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
       <div class="row">
           <div class="col">
               <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">+</button>
           </div>
       
                    <?php 
                       $file = file_get_contents('gallery.txt');
                       if(!empty($file)):
                            $galleryList = unserialize($file);
                            $i = 1;
                    ?>
                    <?php foreach ($galleryList as $key => $value): ?>
                        <?php if(($i + 2) % 3 == 0): ?>
                        <div class="row"> 
                        <?php endif; ?>
                        <div class="col rounded float-left">   
                         <figure class="figure">
                           <a href="/GalleryHome/upload/<?php echo $value['image']; ?>" data-fancybox="images" data-caption="My caption">
                               <img src="/GalleryHome/upload/<?php echo $value['image']; ?>" alt="Responsive image" class="img-thumbnail">
                            <div class="block"><?php echo $value['textSet']; ?></div>
                            </a>
                            <figcaption class="figure-caption"><?php echo $value['nameSet']; ?></figcaption>
                         </figure>
                        </div>
                        <?php if($i%3 == 0): ?>
                        </div>
                        <?php endif; ?> 
                        <?php $i++; ?>
                    <?php endforeach; ?> 
                    <?php endif; ?> 
        </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="add-photo">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Новое фото</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <form method="post" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label for="exampleInputTitle">Название фото</label>
                                <input type="text" class="form-control" id="exampleInputTitle" placeholder="Enter name" name='nameSet'>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Загрузить</label>
                                <input type="file" id="exampleInputFile" name="fileSet">
                            </div>
                            <div class="form-group">
                                <label for="InputDescription">Описание к фотографии</label> <br>
                                <textarea rows="3" cols="64" name="textSet"></textarea>
                            </div>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Загрузить</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <script src="modal.js"></script>
</body>

</html>