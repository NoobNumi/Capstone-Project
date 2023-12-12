<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = $_POST['reservation_id'];
    $newStatus = $_POST['new_status'];
    $reservationType = $_POST['reservation_type'];

    $validStatuses = ['pending', 'confirmed', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }

    $tableName = '';
    $primaryKeyColumn = $reservationType . '_id';

    switch ($reservationType) {
        case 'reception':
            $tableName = 'reception_reservation_record';
            break;
        case 'recollection':
            $tableName = 'recollection_reservation_record';
            break;
        case 'retreat':
            $tableName = 'retreat_reservation_record';
            break;
        case 'seminar':
            $tableName = 'seminar_reservation_record';
            break;
        case 'training':
            $tableName = 'training_reservation_record';
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid reservation type']);
            exit;
    }

    try {
        $currentTimestamp = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $currentTimestamp = $currentTimestamp->format('Y-m-d H:i:s');

        $stmt = $conn->prepare("UPDATE $tableName SET status = :new_status, timestamp = :current_timestamp WHERE $primaryKeyColumn = :reservation_id");
        $stmt->bindParam(':new_status', $newStatus);
        $stmt->bindParam(':current_timestamp', $currentTimestamp);
        $stmt->bindParam(':reservation_id', $reservationId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $conn->prepare("SELECT first_name, check_in, payment_method FROM $tableName WHERE $primaryKeyColumn = :reservation_id");
            $stmt->bindParam(':reservation_id', $reservationId);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode([
                    'success' => true,
                    'first_name' => $row['first_name'],
                    'check_in' => $row['check_in'],
                    'payment_method' => $row['payment_method'],
                    'message' => 'Reservation updated successfully'
                ]);
            } else {
                echo json_encode(['success' => true, 'message' => 'Reservation updated successfully']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
