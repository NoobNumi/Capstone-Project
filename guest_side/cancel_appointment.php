<?php
require("../connection.php");

session_name("user_session");
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$appointmentId = $_POST['appointmentId'] ?? null;

if (!$appointmentId) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

try {
    $checkSql = "SELECT appoint_status FROM appointment_record WHERE appoint_id = :id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
    $checkStmt->execute();

    $appointmentStatus = $checkStmt->fetchColumn();

    if ($appointmentStatus !== 'pending') {
        echo json_encode(['success' => false, 'error' => 'Appointment cannot be cancelled.']);
        exit;
    }

    $updateSql = "UPDATE appointment_record SET 
        appoint_status = 'cancelled'
        WHERE appoint_id = :id";

    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
    $updateStmt->execute();

    echo json_encode(['success' => true]);
    exit;
} catch (PDOException $e) {
    $errorMessage = "Error cancelling appointment: " . $e->getMessage();
    error_log($errorMessage);
    echo json_encode(['success' => false, 'error' => 'Failed to cancel the appointment.', 'debug_info' => $e->getMessage()]);
    exit;
}
?>
