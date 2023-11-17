<?php
require_once("../connection.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcement_id'])) {
    $announcement_id = $_POST['announcement_id'];

    try {
        $query = "DELETE FROM announcement_image WHERE announcement_id = :announcement_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':announcement_id', $announcement_id);
        $stmt->execute();
    
        $query = "DELETE FROM announcements WHERE announcement_id = :announcement_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':announcement_id', $announcement_id);
        $stmt->execute();
    
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    exit();
}
?>
