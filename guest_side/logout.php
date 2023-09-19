<?php
	session_name("user_session");
	session_start();
	$_SESSION = array();

	// Destroy the session cookie
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 42000, '/');
	}
	session_destroy();

	header("Location: login.php");
	exit();
?>
