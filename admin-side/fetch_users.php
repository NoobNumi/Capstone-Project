<?php
require_once("../connection.php");

try {
    $sql = "SELECT user_id, first_name, last_name FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header("Content-Type: application/json");
    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(array("error" => "Database error: " . $e->getMessage()));
}
?>
