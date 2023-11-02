<?php
session_name("admin_session");
session_start();
error_reporting(E_ALL);
require_once("../connection.php");

if (!isset($_SESSION['admin_id'])) {
    header("location: ../guest_side/login.php");
    exit;
}

$admin_id = $_SESSION['admin_id'];

try {
    $query = "
    SELECT u.user_id, u.first_name, u.last_name, m.message, m.image_url, m.is_admin,
        CASE 
            WHEN m.is_admin = 1 THEN 1
            WHEN u.user_id = 1 AND m.is_admin != 1 THEN 0
            ELSE m.is_read
        END AS is_read,
        m.message_id
    FROM users u
    LEFT JOIN (
        SELECT 
            CASE 
                WHEN m.sender_id = :admin_id THEN m.receiver_id
                ELSE m.sender_id
            END AS user_id,
            MAX(m.timestamp) AS latest_message_timestamp
        FROM messages m
        WHERE m.sender_id = :admin_id OR m.receiver_id = :admin_id
        GROUP BY user_id
    ) AS latest_msg ON u.user_id = latest_msg.user_id
    LEFT JOIN messages m ON (
        (m.sender_id = :admin_id AND m.receiver_id = latest_msg.user_id) OR
        (m.sender_id = latest_msg.user_id AND m.receiver_id = :admin_id)
    ) AND m.timestamp = latest_msg.latest_message_timestamp
    ORDER BY latest_msg.latest_message_timestamp DESC;
";


        $stmt = $conn->prepare($query);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();


        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['message_id'])) {
                $messageId = $_POST['message_id'];
        
                $sql = "UPDATE messages SET is_read = 1 WHERE message_id = :message_id AND receiver_id = :admin_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
                $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    echo 'Message marked as read';
                } else {
                    echo 'Failed to mark message as read';
                }
            }
        } else {
            $usersHtml = '';
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
        $liClass = ($user['is_read'] === 0) ? 'unread' : '';
        $user['li_class'] = $liClass;

        $fontWeight = $user['is_read'] === 0 ? 'bold-message' : '';
        $user['font_weight'] = $fontWeight;

        $user['notification'] = ($user['is_read'] === 0) ? '<div class="notification"></div>' : '';
        
        $usersHtml .= "
        <li class='{$user['li_class']}'>
            <a href='admin-chat.php?user_id={$user['user_id']}'>
                <img src='../images/guest.png'>
                <div class='msg-allText'>
                    <span class='guest-name'>{$user['first_name']} {$user['last_name']}</span>
                    <p class='msg {$user['font_weight']}'>{$user['latest_message']}</p>
                    {$user['notification']}
                </div>
                
            </a>
        </li>
    ";

    $unreadMessagesQuery = "
        SELECT COUNT(*) AS unread_count
        FROM messages
        WHERE receiver_id = :admin_id AND is_read = 0
    ";

    $stmt = $conn->prepare($unreadMessagesQuery);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    $unreadCountResult = $stmt->fetch(PDO::FETCH_ASSOC);


    }
        }

        $response = [
            'admin_id' => $admin_id,
            'users' => $users,
            'users_html' => $usersHtml,
            'unread_count' => $unreadCountResult['unread_count']
        ];

        echo json_encode($response);
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
    ?>
