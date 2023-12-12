<?php

require_once("../connection.php");
$reservationTypes = ['reception', 'recollection', 'retreat', 'seminar', 'training'];

$reservations = array();

$stmtAvailableDates = $conn->query("SELECT DATE_FORMAT(STR_TO_DATE(available_date, '%M %d, %Y'), '%Y-%m-%d') as date FROM available_reservation_dates");
$availableDates = $stmtAvailableDates->fetchAll(PDO::FETCH_COLUMN);

foreach ($reservationTypes as $type) {
    $stmt = $conn->query("SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') as check_in, DATE_FORMAT(STR_TO_DATE(check_out, '%M %d %Y'), '%Y-%m-%d') as check_out FROM {$type}_reservation_record"); 
    
    $reservationRanges = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($reservationRanges as $range) {
        $begin = new DateTime($range['check_in']);
        $end = new DateTime($range['check_out']);
        $end = $end->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            $date = $dt->format("Y-m-d");
            if (!in_array($date, $availableDates)) {
                $reservations[$type][] = $date;
            }
        }
    }
} 

$stmtUnavailability = $conn->query("SELECT DATE_FORMAT(STR_TO_DATE(date, '%M %d, %Y'), '%Y-%m-%d') as date FROM reservation_unavailability");
$reservations['unavailability'] = $stmtUnavailability->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reservations);
?>
