<?php
session_name("admin_session");
session_start();
require_once("../connection.php");

if (!isset($_SESSION['admin_id'])) {
    exit;
}

$admin_id = $_SESSION['admin_id'];
$receiver_id = isset($_POST['receiver_id']) ? $_POST['receiver_id'] : null;

if ($receiver_id !== null) {
    try {
        $sql = "UPDATE messages SET is_read = 1 WHERE receiver_id = :admin_id AND sender_id = :receiver_id AND is_read = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo 'All messages marked as read';
        } else {
            echo 'Failed to mark messages as read';
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo "Error: 'receiver_id' is missing or NULL.";
}
?>
