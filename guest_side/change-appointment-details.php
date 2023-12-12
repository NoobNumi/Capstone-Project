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

$updatedAppointment = $_POST['updatedAppointment'] ?? null;
$appointmentId = $_POST['appointmentId'] ?? null;

if (!$updatedAppointment || !$appointmentId) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

try {
    $formattedDateString = strftime('%B %e %Y', strtotime($updatedAppointment['appoint_sched_date']));

    $sql = "UPDATE appointment_record SET 
        first_name = :first_name, 
        last_name = :last_name, 
        contact_no = :contact_no, 
        appoint_sched_date = :appoint_sched_date,
        appoint_description = :appoint_description
        WHERE appoint_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':first_name', $updatedAppointment['first_name'], PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $updatedAppointment['last_name'], PDO::PARAM_STR);
    $stmt->bindParam(':contact_no', $updatedAppointment['contact_no'], PDO::PARAM_STR);
    $stmt->bindParam(':appoint_sched_date', $formattedDateString, PDO::PARAM_STR);
    $stmt->bindParam(':appoint_description', $updatedAppointment['appoint_description'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
} catch (PDOException $e) {
    $errorMessage = "Error updating appointment: " . $e->getMessage();
    error_log($errorMessage);
    echo json_encode(['success' => false, 'error' => $errorMessage, 'debug_info' => $e->getMessage()]);
    exit;
}
?>
