<?php
session_name("user_session");
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];
$message_id = isset($_POST['message_id']) ? $_POST['message_id'] : '';

if (!empty($message_id)) {
    $sql = "SELECT receiver_id FROM messages WHERE message_id = :message_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['receiver_id'] == $user_id) {
        $sql = "UPDATE messages SET is_read = 1 WHERE message_id = :message_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo 'Message marked as read';
        } else {
            echo 'Failed to mark message as read';
        }
    } else {
        echo 'Invalid message_id or unauthorized access';
    }
} else {
    echo 'Invalid message_id';
}
?>
