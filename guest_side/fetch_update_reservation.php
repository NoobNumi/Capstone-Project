<?php
require("../connection.php");

session_name("user_session");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

$reservation_id = $_GET['reservation_id'];
$reservation_type = $_GET['reservation_type'];

$typeToTableColumn = array(
    'reception' => array('table' => 'reception_reservation_record', 'id_column' => 'reception_id'),
    'recollection' => array('table' => 'recollection_reservation_record', 'id_column' => 'recollection_id'),
    'retreat' => array('table' => 'retreat_reservation_record', 'id_column' => 'retreat_id'),
    'seminar' => array('table' => 'seminar_reservation_record', 'id_column' => 'seminar_id'),
    'training' => array('table' => 'training_reservation_record', 'id_column' => 'training_id')
);

if (isset($typeToTableColumn[$reservation_type])) {
    $table = $typeToTableColumn[$reservation_type]['table'];
    $id_column = $typeToTableColumn[$reservation_type]['id_column'];

    $sql = "SELECT * FROM $table WHERE $id_column = :reservation_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation_id', $reservation_id, PDO::PARAM_INT);
    $stmt->execute();

    $reservationDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($reservationDetails);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid reservation type']);
}
?>
