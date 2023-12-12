<?php
include "../connection.php";
session_name("user_session");
session_start();

$sqlRecord = "SELECT appoint_sched_date AS date FROM appointment_record";
$resultRecord = $conn->query($sqlRecord);

$sqlUnavailability = "SELECT date FROM appointment_unavailability";
$resultUnavailability = $conn->query($sqlUnavailability);

$reservedDates = array();

while ($rowRecord = $resultRecord->fetch(PDO::FETCH_ASSOC)) {
    $formattedDateRecord = date("F j, Y", strtotime($rowRecord['date']));
    $reservedDates[] = $formattedDateRecord;
}

while ($rowUnavailability = $resultUnavailability->fetch(PDO::FETCH_ASSOC)) {
    $formattedDateUnavailability = date("F j, Y", strtotime($rowUnavailability['date']));
    $reservedDates[] = $formattedDateUnavailability;
}

header('Content-Type: application/json');
echo json_encode($reservedDates);
?>
