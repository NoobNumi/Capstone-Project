<?php
require_once("../connection.php");

$reservationId = $_GET['reservation_id'];
$reservationType = $_GET['reservation_type'];

$allowedReservationTypes = ['reception', 'seminar', 'recollection', 'retreat', 'training'];

if (!in_array($reservationType, $allowedReservationTypes)) {
    echo json_encode(['error' => 'Invalid reservation type']);
    exit;
}

$tables = [
    'reception' => 'reception_reservation_record',
    'seminar' => 'seminar_reservation_record',
    'recollection' => 'recollection_reservation_record',
    'retreat' => 'retreat_reservation_record',
    'training' => 'training_reservation_record',
];

if (array_key_exists($reservationType, $tables)) {
    $tableName = $tables[$reservationType];

    $sql = "SELECT * FROM $tableName WHERE {$reservationType}_id = :reservationId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservationId', $reservationId, PDO::PARAM_INT);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($reservation) {
        echo json_encode($reservation);
    } else {
        echo json_encode(['error' => 'Reservation not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid reservation type']);
    exit;
}

?>