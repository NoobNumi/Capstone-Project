<?php
session_name("user_session");
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];
$admin_id = 1;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'insert') {
    $message = $_POST['message'];
    $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read) VALUES (:sender_id, :receiver_id, :message, NOW(), 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sender_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':receiver_id', $admin_id, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo 'Message inserted successfully';
    } else {
        echo 'Message insertion failed';
    }
} elseif ($action === 'get') {
    $sql = "(SELECT * FROM messages WHERE sender_id = :user_id AND receiver_id = :admin_id)
    UNION
    (SELECT * FROM messages WHERE sender_id = :admin_id AND receiver_id = :user_id)
    ORDER BY timestamp ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    $allMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    foreach ($allMessages as $message) {
        $messageClass = ($message['is_admin'] == 1) ? 'incoming' : 'outgoing';

        $output .= '<div class="chat ' . $messageClass . '">';

        if ($messageClass == 'incoming') {
            $output .= '<img src="../images/nun.png">';
        }
        $output .= '<div class="details">';
        $output .= '<p>' . $message['message'] . '</p>';
        $output .= '</div>';
        $output .= '</div>';
    }
    echo $output;

} else {
    echo 'Invalid action';
}
