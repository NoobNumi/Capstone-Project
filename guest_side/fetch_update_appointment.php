<?php
require("../connection.php");

session_name("user_session");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}


$appointment_id = $_GET['appointment_id'];


$appointSQL = 'SELECT * from appointment_record where appoint_id = :appointment_id';
$stmt = $conn->prepare($appointSQL);
$stmt->bindParam(':appointment_id', $appointment_id, PDO::PARAM_INT);
$stmt->execute();
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($appointment);

