<?php
	session_start();
	session_destroy();
	header('location: ../guest_side/login.php');
	exit;
?>