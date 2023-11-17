<?php
	session_name("user_session");
	session_start();
	session_destroy();
	header('location: login.php');
	exit;
?>