<?php
function hashFileName($origanalName) {
	$arr = explode('.', $origanalName); //разбиение названия файла на точки там где есть точки
	$type = $arr[count($arr) - 1]; //выбираем тип картинки
	$newName = md5(microtime() . $origanalName) . ".$type";
	return $newName;
}

function upload($file) {
	$name = hashFileName($file['name']);
	$path = realpath(__DIR__) . '/../../Uploads/Preview/';
	move_uploaded_file($file['tmp_name'], $path . $name);
	return $name;
}