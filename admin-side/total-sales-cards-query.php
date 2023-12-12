<?php
require_once("../connection.php");

//for the total sales card display
$totalSalesMonthQuery = 'SELECT SUM(amount) AS totalAmount
FROM sales
WHERE MONTHNAME(month) = DATE_FORMAT(CURRENT_DATE(), "%b")';

$result = $conn->query($totalSalesMonthQuery);
$row = $result->fetch(PDO::FETCH_ASSOC);


//for the total sales card display (confirmed)
$reservationsAmountQuery = 'SELECT 
    SUM(total) AS total
FROM (
    SELECT total FROM reception_reservation_record WHERE status = "confirmed"
    UNION ALL
    SELECT total FROM recollection_reservation_record WHERE status = "confirmed"
    UNION ALL
    SELECT total FROM retreat_reservation_record WHERE status = "confirmed"
    UNION ALL
    SELECT total FROM seminar_reservation_record WHERE status = "confirmed"
    UNION ALL
    SELECT total FROM training_reservation_record WHERE status = "confirmed"
) AS all_confirmed_reservations';

$resultConfirmed = $conn->query($reservationsAmountQuery);
$rowConfirmed = $resultConfirmed->fetch(PDO::FETCH_ASSOC);


//for the total sales card display (cancelled)
$reservationsAmountQueryCancelled = 'SELECT 
    SUM(total) AS totalCancelled
FROM (
    SELECT total FROM reception_reservation_record WHERE status = "cancelled"
    UNION ALL
    SELECT total FROM recollection_reservation_record WHERE status = "cancelled"
    UNION ALL
    SELECT total FROM retreat_reservation_record WHERE status = "cancelled"
    UNION ALL
    SELECT total FROM seminar_reservation_record WHERE status = "cancelled"
    UNION ALL
    SELECT total FROM training_reservation_record WHERE status = "cancelled"
) AS all_cancelled_reservations';

$resultcancelled = $conn->query($reservationsAmountQueryCancelled);
$rowcancelled = $resultcancelled->fetch(PDO::FETCH_ASSOC);
?>
