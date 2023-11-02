<?php
require_once("../connection.php");

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$monthSQL = "SELECT
    DATE_FORMAT(date, '%Y-%m-%d') AS date,
    SUM(appoint_count) AS appoint_count,
    SUM(reserve_count) AS reserve_count
FROM (
    SELECT
    DATE_FORMAT(STR_TO_DATE(appoint_sched_date, '%M %d %Y'), '%Y-%m-%d') AS date,
    COUNT(*) AS appoint_count,
    0 AS reserve_count
    FROM appointment_record
    GROUP BY date
    UNION ALL
    SELECT
    DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') AS date,
    0 AS appoint_count,
    COUNT(*) AS reserve_count
    FROM reception_reservation_record
    GROUP BY date
    UNION ALL
    SELECT
    DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') AS date,
    0 AS appoint_count,
    COUNT(*) AS reserve_count
    FROM recollection_reservation_record
    GROUP BY date
    UNION ALL
    SELECT
    DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') AS date,
    0 AS appoint_count,
    COUNT(*) AS reserve_count
    FROM retreat_reservation_record
    GROUP BY date
    UNION ALL
    SELECT
    DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') AS date,
    0 AS appoint_count,
    COUNT(*) AS reserve_count
    FROM seminar_reservation_record
    GROUP BY date
    UNION ALL
    SELECT
    DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') AS date,
    0 AS appoint_count,
    COUNT(*) AS reserve_count
    FROM training_reservation_record
    GROUP BY date
) AS subquery
GROUP BY date, DATE_FORMAT(date, '%Y-%m'), MONTH(date);";

if ($filter === 'all_reservations') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0";
} elseif ($filter === 'seminar') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0 AND date IN (SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') FROM seminar_reservation_record)";
} elseif ($filter === 'trainings') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0 AND date IN (SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') FROM training_reservation_record)";
} elseif ($filter === 'retreat') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0 AND date IN (SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') FROM retreat_reservation_record)";
} elseif ($filter === 'recollection') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0 AND date IN (SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') FROM recollection_reservation_record)";
} elseif ($filter === 'reception') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE reserve_count > 0 AND date IN (SELECT DATE_FORMAT(STR_TO_DATE(check_in, '%M %d %Y'), '%Y-%m-%d') FROM reception_reservation_record)";
} elseif ($filter === 'appointment') {
    $monthSQL = "SELECT * FROM ($monthSQL) AS filtered_data WHERE appoint_count > 0";
}

$stmt = $conn->prepare($monthSQL);
$stmt->execute();

$calendarData = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $date = $row['date'];
    $appointCount = (int)$row['appoint_count'];
    $reserveCount = (int)$row['reserve_count'];

    $calendarData[$date] = [
        'appoint_count' => $appointCount,
        'reserve_count' => $reserveCount,
    ];
}

echo json_encode($calendarData);
?>
