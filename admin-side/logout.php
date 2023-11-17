<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
    session_destroy();
	header('location: ../guest_side/login.php');
	exit;
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        session_start();
		session_destroy();
		header('location: ../guest_side/login.php');
	exit;
	}
}
