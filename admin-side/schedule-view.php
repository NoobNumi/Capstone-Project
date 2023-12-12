<?php
require_once("../connection.php");

$selectedDate = isset($_GET['selectedDate']) ? $_GET['selectedDate'] : '';

try {
    $contentFetchSql = "
        (
            SELECT 
                'appointment' AS type,
                a.appoint_id AS id, 
                a.user_id, 
                a.first_name, 
                a.last_name, 
                a.appoint_sched_date AS date, 
                a.appoint_sched_time AS time
            FROM appointment_record a
            WHERE DATE_FORMAT(STR_TO_DATE(a.appoint_sched_date, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
        
        UNION ALL
        
        (
            SELECT 
                'reception' AS type,
                r.reception_id AS id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                r.check_in AS date, 
                r.check_out AS time
            FROM reception_reservation_record r
            WHERE DATE_FORMAT(STR_TO_DATE(r.check_in, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
        
        UNION ALL
        
        (
            SELECT 
                'retreat' AS type,
                r.retreat_id AS id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                r.check_in AS date, 
                r.check_out AS time
            FROM retreat_reservation_record r
            WHERE DATE_FORMAT(STR_TO_DATE(r.check_in, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
        
        UNION ALL
        
        (
            SELECT 
                'recollection' AS type,
                r.recollection_id AS id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                r.check_in AS date, 
                r.check_out AS time
            FROM recollection_reservation_record r
            WHERE DATE_FORMAT(STR_TO_DATE(r.check_in, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
        
        UNION ALL
        
        (
            SELECT 
                'seminar' AS type,
                r.seminar_id AS id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                r.check_in AS date, 
                r.check_out AS time
            FROM seminar_reservation_record r
            WHERE DATE_FORMAT(STR_TO_DATE(r.check_in, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
        
        UNION ALL
        
        (
            SELECT 
                'training' AS type,
                r.training_id AS id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                r.check_in AS date, 
                r.check_out AS time
            FROM training_reservation_record r
            WHERE DATE_FORMAT(STR_TO_DATE(r.check_in, '%M %e %Y'), '%Y-%m-%d') = :selectedDate
        )
    ";

    $stmt = $conn->prepare($contentFetchSql);
    $stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
    $stmt->execute();

    $userDetails = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userDetails[] = $row;
    }

    if (empty($userDetails)) {
        // Add some debug information
        echo json_encode(['debug' => 'No data found for the selected date.', 'selectedDate' => $selectedDate]);
    } else {
        echo json_encode(['userDetails' => $userDetails, 'selectedDate' => $selectedDate]);
    }
} catch (Exception $e) {
    // Log the exception to the error log
    error_log('Exception: ' . $e->getMessage());
    // Return an error response, or handle it as needed
    echo json_encode(['error' => 'An error occurred.', 'selectedDate' => $selectedDate]);
}
?>
