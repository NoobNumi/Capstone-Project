<?php
	global $conn;
	$db_host = 'localhost';
	$db_name = 'trinitas';
	$db_user = 'root';
	$db_pass = '';
	
	try {
		$conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die("Database connection failed: " . $e->getMessage());
	}

?>