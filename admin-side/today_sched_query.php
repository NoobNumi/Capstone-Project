<?php

$todayDate = date('F j Y');
$currentTime = date('h:i A');

$todaySchedsql = "
    SELECT 
        'appointment' AS source,
        'appointment' AS type,
        first_name AS first_name, 
        last_name AS last_name, 
        appoint_sched_date AS date, 
        appoint_sched_time AS time 
    FROM appointment_record 
    WHERE appoint_sched_date = :todayDate AND appoint_sched_time >= :currentTime
    UNION ALL
    SELECT 
        'reception' AS source,
        'reception' AS type,
        first_name, 
        last_name, 
        check_in AS date, 
        check_in AS time 
    FROM reception_reservation_record 
    WHERE check_in = :todayDate
    UNION ALL
    SELECT 
        'recollection' AS source,
        'recollection' AS type,
        first_name, 
        last_name, 
        check_in AS date, 
        check_in AS time 
    FROM recollection_reservation_record 
    WHERE check_in = :todayDate
    UNION ALL
    SELECT 
        'retreat' AS source,
        'retreat' AS type,
        first_name, 
        last_name, 
        check_in AS date, 
        check_in AS time 
    FROM retreat_reservation_record 
    WHERE check_in = :todayDate
    UNION ALL
    SELECT 
        'seminar' AS source,
        'seminar' AS type,
        first_name, 
        last_name, 
        check_in AS date, 
        check_in AS time 
    FROM seminar_reservation_record 
    WHERE check_in = :todayDate
    UNION ALL
    SELECT 
        'training' AS source,
        'training' AS type,
        first_name, 
        last_name, 
        check_in AS date, 
        check_in AS time 
    FROM training_reservation_record 
    WHERE check_in = :todayDate
    ORDER BY date, time;
";


$stmt = $conn->prepare($todaySchedsql);
$stmt->bindParam(':todayDate', $todayDate, PDO::PARAM_STR);
$stmt->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
$stmt->execute();




?>