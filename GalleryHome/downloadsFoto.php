<?php 
require 'upload.php';

$nameSet = filter_input(INPUT_POST, 'nameSet');
$textSet = filter_input(INPUT_POST, 'textSet');
$us = [];
if(!empty($_FILES['fileSet'])) {
    $fileSet = uploadPhoto($_FILES['fileSet']);
    $galleryArray = file_get_contents('gallery.txt');
    if(!empty($galleryArray)) {
        $us = unserialize($galleryArray);
    }
    array_push($us, [
        'nameSet' => $nameSet,
        'textSet' => $textSet,
        'image' => $fileSet
    ]);
    $s = serialize($us);
    file_put_contents('gallery.txt', $s);
}

