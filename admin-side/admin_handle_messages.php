<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    exit;
}

$user_id = $_POST['user_id'];

$admin_id = $_SESSION['admin_id'];

$action = isset($_POST['action']) ? $_POST['action'] : '';

try {

    if ($action === 'insert') {
        $message = $_POST['message'];
        $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read, is_admin) VALUES (:sender_id, :receiver_id, :message, NOW(), 1, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sender_id', $admin_id, PDO::PARAM_INT);
        $stmt->bindParam(':receiver_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo 'Message inserted successfully';
        } else {
            echo 'Message insertion failed';
        }
    } elseif ($action === 'get') {
        $sql = "SELECT * FROM messages WHERE (sender_id = :admin_id AND receiver_id = :user_id) OR (sender_id = :user_id AND receiver_id = :admin_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $allMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        foreach ($allMessages as $message) {
            $messageClass = ($message['is_admin'] == 1) ? 'outgoing' : 'incoming';
        
            $output .= '<div class="chat ' . $messageClass . '">';  
            
            if ($messageClass == 'incoming') {
                $output .= '<img src="../images/guest.png">';
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

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
