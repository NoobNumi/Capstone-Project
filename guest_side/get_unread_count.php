<?php
session_name("user_session");
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];
$admin_id = 1;

try {
    $sql = "SELECT COUNT(*) AS unreadCount FROM messages WHERE receiver_id = :user_id AND is_read = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['unreadCount' => $result['unreadCount']]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database Error: ' . $e->getMessage()]);
}
?>
