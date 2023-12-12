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

$reservationType = $_POST['reservationType'] ?? null;
$reservationId = $_POST['reservationId'] ?? null;

if (!$reservationType || !$reservationId) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

$typeToTable = [
    'reception' => 'reception_reservation_record',
    'recollection' => 'recollection_reservation_record',
    'retreat' => 'retreat_reservation_record',
    'seminar' => 'seminar_reservation_record',
    'training' => 'training_reservation_record'
];

if (!isset($typeToTable[$reservationType])) {
    echo json_encode(['success' => false, 'error' => 'Invalid reservation type']);
    exit;
}

$tableName = $typeToTable[$reservationType];
$idColumnName = $reservationType . '_id';

try {
    // Fetch payment_method from the reservation record
    $fetchPaymentMethodSql = "SELECT payment_method FROM $tableName WHERE $idColumnName = :id";
    $fetchStmt = $conn->prepare($fetchPaymentMethodSql);
    $fetchStmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
    $fetchStmt->execute();
    $row = $fetchStmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(['success' => false, 'error' => 'Reservation not found']);
        exit;
    }

    // Update reservation status to 'cancelled'
    $updateStatusSql = "UPDATE $tableName SET status = 'cancelled' WHERE $idColumnName = :id";
    $updateStmt = $conn->prepare($updateStatusSql);
    $updateStmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
    $updateStmt->execute();

    // Return success along with payment_method in the response
    echo json_encode(['success' => true, 'payment_method' => $row['payment_method']]);
    exit;
} catch (PDOException $e) {
    $errorMessage = "Error updating reservation status: " . $e->getMessage();
    error_log($errorMessage);
    echo json_encode(['success' => false, 'error' => $errorMessage, 'debug_info' => $e->getMessage()]);
    exit;
}
?>
