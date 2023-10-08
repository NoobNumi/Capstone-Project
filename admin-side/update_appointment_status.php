<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appoint_id'];
    $newStatus = $_POST['new_status'];

    $validStatuses = ['pending', 'confirmed', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }

    try {
        $stmt = $conn->prepare("UPDATE appointment_record SET appoint_status = :new_status WHERE appoint_id = :appoint_id");
        $stmt->bindParam(':new_status', $newStatus);
        $stmt->bindParam(':appoint_id', $appointmentId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $conn->prepare("SELECT first_name, appoint_sched_date, appoint_sched_time FROM appointment_record WHERE appoint_id = :appoint_id");
            $stmt->bindParam(':appoint_id', $appointmentId);
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($row) {
                echo json_encode([
                    'success' => true,
                    'first_name' => $row['first_name'],
                    'appoint_sched_date' => $row['appoint_sched_date'],
                    'appoint_sched_time' => $row['appoint_sched_time'],
                    'message' => 'Appointment updated successfully'
                ]);
            } else {
                echo json_encode(['success' => true, 'message' => 'Appointment updated successfully']);
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
