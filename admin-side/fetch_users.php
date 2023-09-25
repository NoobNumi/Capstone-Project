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
    SELECT u.user_id, u.first_name, u.last_name, m.message, m.image_url, m.is_admin
    FROM users u
    LEFT JOIN (
        SELECT
            CASE
                WHEN sender_id = :admin_id THEN receiver_id
                ELSE sender_id
            END AS user_id,
            MAX(timestamp) AS latest_message_timestamp
        FROM messages
        WHERE sender_id = :admin_id OR receiver_id = :admin_id
        GROUP BY user_id
    ) AS latest_msg ON u.user_id = latest_msg.user_id
    LEFT JOIN messages m ON (
        (m.sender_id = :admin_id AND m.receiver_id = latest_msg.user_id) OR
        (m.sender_id = latest_msg.user_id AND m.receiver_id = :admin_id)
    ) AND m.timestamp = latest_msg.latest_message_timestamp
    ORDER BY latest_msg.latest_message_timestamp DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as &$user) {
        if (!empty($user['image_url']) && !empty($user['message'])) {
            if ($user['is_admin'] == 1) {
                $user['latest_message'] = 'You sent a photo';
            } else {
                $user['latest_message'] = $user['first_name'] . ' sent a photo';
            }
        } elseif (!empty($user['message']) && empty($user['image_url'])) {
            if ($user['is_admin'] == 1) {
                $user['latest_message'] = 'You: ' . base64_decode($user['message']);
            } else {
                $user['latest_message'] = base64_decode($user['message']);
            }
        } else {
            $user['latest_message'] = 'No messages';
        }
    }
    

    $response = [
        'admin_id' => $admin_id,
        'users' => $users
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
