<?php
    session_name("admin_session");
    session_start();
    require_once("../connection.php");

    if (!isset($_SESSION['admin_id'])) {
        header("location: admin_login.php");
        exit;
    }

    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];

        $stmt = $conn->prepare("SELECT * FROM messages WHERE receiver_id = :user_id OR sender_id = :user_id ORDER BY timestamp DESC LIMIT 10");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($messages);
    }
?>
