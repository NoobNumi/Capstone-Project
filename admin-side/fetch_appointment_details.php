<?php
require_once("../connection.php");

$appointmentId = $_GET['appoint_id'];

$sql = "SELECT a.*, u.profile_picture
        FROM appointment_record a
        JOIN users u ON a.user_id = u.user_id
        WHERE appoint_id = :appointmentId";
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
