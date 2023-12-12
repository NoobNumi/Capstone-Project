<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
    $userRole = 'admin';
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        $userRole = 'assistant';
    }
}

echo json_encode(['userRole' => $userRole]);
?>
