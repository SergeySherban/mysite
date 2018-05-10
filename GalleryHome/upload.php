<?php
function generateFileName($originalName) {
    $arr = explode('.', $originalName);
    $format = $arr[count($arr) - 1];
    $name = md5(microtime()) . '.' . $format;
    return $name;
}

function uploadPhoto($file) {
    $name = $file['name'];
    $tmp = $file['tmp_name'];
    $path = __DIR__ . '/upload/';
    $newName = generateFileName($name);
    move_uploaded_file($tmp, $path . $newName);
    return $newName;
}
