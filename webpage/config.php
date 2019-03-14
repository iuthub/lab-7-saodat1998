<?php
	$dbhost  = 'localhost';    	// o'zgartirish shart emas
	$dbname  = 'blog';    		// Ma'lumotlar bazasi nomi
	$dbuser  = 'root';   		// user nomi
	$dbpass  = '';   			// parol

	
	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	$db = mysqli_connect("$dbhost","$dbuser", "$dbpass");
	mysqli_select_db($connection, $dbname);
	if ($connection->connect_error) {
	    die("MySQLga ulanishda xatolik sodir bo`ldi: ". 
	    	$connection->connect_error);
	}
	$GLOBAL['connection'] = $connection;
	
	define('SITE', 'http://localhost/dashboard.uz');

 
?>