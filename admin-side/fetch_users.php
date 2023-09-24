<?php
session_name("admin_session");
session_start();
error_reporting(E_ALL);
require_once("../connection.php");

if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
    exit;
}

$admin_id = $_SESSION['admin_id'];

try {
    $query = "
    SELECT u.user_id, u.first_name, u.last_name, m.message AS latest_message, m.is_admin AS is_admin_message
    FROM users u
    LEFT JOIN (
        SELECT MAX(message_id) AS latest_message_id, 
            CASE
                WHEN sender_id = :admin_id THEN receiver_id
                ELSE sender_id
            END AS user_id
        FROM messages
        WHERE sender_id = :admin_id OR receiver_id = :admin_id
        GROUP BY user_id
    ) AS latest_msg ON u.user_id = latest_msg.user_id
    LEFT JOIN messages m ON latest_msg.latest_message_id = m.message_id
    WHERE latest_msg.latest_message_id IS NOT NULL
    ORDER BY m.timestamp DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as &$user) {
        if ($user['is_admin_message'] == 1) {
            $user['latest_message'] = 'You: ' . base64_decode($user['latest_message']);
        } else {
            $user['latest_message'] = base64_decode($user['latest_message']);
        }
    }

    echo json_encode($users);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
