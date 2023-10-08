<?php
require_once("../connection.php");

$appointmentId = $_GET['appoint_id'];

$sql = "SELECT * FROM appointment_record WHERE appoint_id = :appointmentId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':appointmentId', $appointmentId, PDO::PARAM_INT);
$stmt->execute();
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if ($appointment) {
    echo json_encode($appointment);
} else {
    echo json_encode(['error' => 'Appointment not found']);
}
?>
