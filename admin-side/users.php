<?php
session_name("admin_session");
session_start();
include_once "../connection.php";

$outgoing_id = $_SESSION['user_id'];

try {
    $sql = "SELECT * FROM users WHERE NOT user_id = :outgoing_id ORDER BY user_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->execute();

    $output = "";
    if ($stmt->rowCount() == 0) {
        $output .= "No users are available to chat";
    } elseif ($stmt->rowCount() > 0) {
        include_once "data.php";
    }

    echo $output;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
