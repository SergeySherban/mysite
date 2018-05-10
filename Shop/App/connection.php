<?php
	$config = parse_ini_file('configs/db.ini');

	if(empty($config)) {
		echo 'Unlouded configs';
		exit();
	}

	$link = mysqli_connect($config['host'], 
                           $config['username'],
                           $config['password'],
                           $config['database']);
    mysqli_set_charset($link, 'utf8');
	if(mysqli_connect_errno()) {
		echo 'Conection to DB is not available';
		exit();
	}