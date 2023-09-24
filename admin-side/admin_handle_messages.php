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

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDirectory = 'uploads/';
            $imageName = uniqid() . '_' . $_FILES['image']['name'];
            $imagePath = $targetDirectory . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $message = '';
                $sql = "INSERT INTO messages (sender_id, receiver_id, message, image_url, timestamp, is_read) VALUES (:sender_id, :receiver_id, :message, :image_url, NOW(), 1)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':sender_id', $admin_id, PDO::PARAM_INT);
                $stmt->bindParam(':receiver_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $stmt->bindParam(':image_url', $imagePath, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo 'Image message inserted successfully';
                } else {
                    echo 'Image message insertion failed';
                }
            } else {
                echo 'Image upload failed';
            }
        } else {
            $message = $_POST['message'];

            $encryptedMessage = base64_encode($message);

            $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read, is_admin) VALUES (:sender_id, :receiver_id, :message, NOW(), 1, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':sender_id', $admin_id, PDO::PARAM_INT);
            $stmt->bindParam(':receiver_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $encryptedMessage, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo 'Message inserted successfully';
            } else {
                echo 'Message insertion failed';
            }
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
            if (!empty($message['image_url'])) {
                // Display image if image URL is not empty
                $output .= '<div class="chat incoming">';
                $output .= '<img src="' . $message['image_url'] . '" alt="Image">';
                $output .= '</div>';
            } else {
                // Display text message
                $decryptedMessage = base64_decode($message['message']);
                $messageClass = ($message['is_admin'] == 1) ? 'outgoing' : 'incoming';
                $output .= '<div class="chat ' . $messageClass . '">';

                if ($messageClass == 'incoming') {
                    $output .= '<img src="../images/guest.png">';
                }
                $output .= '<div class="details">';
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
