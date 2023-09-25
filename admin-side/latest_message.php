<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function updateLatestMessage($user_id, $conn) {
    $sql = "SELECT MAX(message_id) AS latest_message_id FROM messages WHERE receiver_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $latestMessageId = $stmt->fetch(PDO::FETCH_ASSOC)['latest_message_id'];

    if ($latestMessageId !== null) {
        $sql = "SELECT message, image_url FROM messages WHERE message_id = :latest_message_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':latest_message_id', $latestMessageId, PDO::PARAM_INT);
        $stmt->execute();
        $latestMessageData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($latestMessageData['image_url'] !== null) {
            $latestMessage = 'Image message sent';
        } elseif ($latestMessageData['message'] !== null) {
            $latestMessage = 'You sent a text message';
        } else {
            $latestMessage = 'No messages';
        }
    } else {
        $latestMessage = 'No messages';
    }

    // $sql = "UPDATE users SET latest_message = :latest_message WHERE user_id = :user_id";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(':latest_message', $latestMessage, PDO::PARAM_STR);
    // $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    // $stmt->execute();
}

updateLatestMessage(1, $conn);
?>
