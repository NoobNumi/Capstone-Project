<?php
    require_once("../connection.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reviewId'])) {
        $reviewId = $_POST['reviewId'];

        file_put_contents('debug.log', 'Received reviewId: ' . $reviewId . PHP_EOL, FILE_APPEND);

        $deleteQuery = "DELETE FROM feedback WHERE feedback_id = :reviewId";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':reviewId', $reviewId);

        try {
            $deleteStmt->execute();
            echo json_encode(['success' => true, 'message' => 'Review deleted successfully']);
        } catch (PDOException $e) {
            file_put_contents('debug.log', 'Error deleting review: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);

            echo json_encode(['success' => false, 'message' => 'Error deleting review']);
        }
        } else {
            file_put_contents('debug.log', 'Invalid request' . PHP_EOL, FILE_APPEND);
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
?>