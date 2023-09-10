<?php

session_name("admin_session");
session_start();
require_once("../connection.php");

if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
    exit;
}

if (isset($_POST['search'])) {
    $searchText = $_POST['search'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE CONCAT(first_name, ' ', last_name) LIKE :search");
    $stmt->bindValue(':search', '%' . $searchText . '%', PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo '<li>';
        echo '<a href="#" class="user-message-link" data-user-id="' . $user['user_id'] . '">';
        echo '<img src="../images/guest.png">';
        echo '<div class="msg-allText">';
        echo '<span class="guest-name">' . $user['first_name'] . ' ' . $user['last_name'] . '</span>';
        echo '<p class="msg"></p>';
        echo '</div>';
        echo '</a>';
        echo '</li>';
    }
}

?>