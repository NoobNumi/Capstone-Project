<?php
require_once("../connection.php");

$reservationId = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : (isset($_GET['id']) ? $_GET['id'] : null);
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

    $sql = "SELECT r.*, u.profile_picture
            FROM $tableName r
            JOIN users u ON r.user_id = u.user_id
            WHERE {$reservationType}_id = :reservationId";
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservationId', $reservationId, PDO::PARAM_INT);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($reservation) {
        $reservation['reservationType'] = $reservationType;
        echo json_encode($reservation);
    } else {
        echo json_encode(['error' => 'Reservation not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid reservation type']);
    exit;
}

?>