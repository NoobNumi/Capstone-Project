<?php
session_name("user_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['user_id'])) {
    exit;
}
$user_id = $_SESSION['user_id'];
$admin_id = 1;
$action = isset($_POST['action']) ? $_POST['action'] : '';

try {
    if ($action === 'insert') {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDirectory = '../uploads/';
            $imageName = uniqid() . '_' . $_FILES['image']['name'];
            $imagePath = $targetDirectory . $imageName;
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $message = ''; 
                echo 'Image Path: ' . $imagePath;
                $sql = "INSERT INTO messages (sender_id, receiver_id, message, image_url, timestamp, is_read) VALUES (:sender_id, :receiver_id, :message, :image_url, NOW(), 0)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':sender_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':receiver_id', $admin_id, PDO::PARAM_INT);
                $stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $stmt->bindParam(':image_url', $imagePath, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    echo 'Image message inserted successfully';
                } else {
                    echo 'Image message insertion failed: ' . implode(' - ', $stmt->errorInfo());
                }               
            } else {
                echo 'Image upload failed';
            }
        } else {
            echo 'Text message detected';

            $message = $_POST['message'];
            $encryptedMessage = base64_encode($message);
            
            $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read) VALUES (:sender_id, :receiver_id, :message, NOW(), 0)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':sender_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':receiver_id', $admin_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $encryptedMessage, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo 'Text message inserted successfully';
            } else {
                echo 'Text message insertion failed: ' . implode(' - ', $stmt->errorInfo());
            }            
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
            if (!empty($message['image_url'])) {
                $output .= '<div class="chat ' . $messageClass . '">';
                if ($messageClass == 'incoming') {
                    $output .= '<img class="profile-pic" src="../images/nun.png">';
                }
                $output .= '<div class="details">';
                $output .= '<input type="hidden" class="message-id" value="' . $message['message_id'] . '">';
                $output .= '<img class="image-msg" src="' . $message['image_url'] . '" alt="Image">';
                $output .= '</div>';
                $output .= '</div>';
            } else {
                $decryptedMessage = base64_decode($message['message']);
                $messageClass = ($message['is_admin'] == 1) ? 'incoming' : 'outgoing';
                $output .= '<div class="chat ' . $messageClass . '">';
                if ($messageClass == 'incoming') {
                    $output .= '<img class="profile-pic" src="../images/nun.png">';
                }
                $output .= '<div class="details">';
                $output .= '<input type="hidden" class="message-id" value="' . $message['message_id'] . '">';
                $output .= '<p>' . $decryptedMessage . '</p>';
                $output .= '</div>';
                $output .= '</div>';
            }
        }
        echo $output;
    } else {
        echo 'Invalid action';
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
