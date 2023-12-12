<?php

$todayDate = date('F j Y');
$currentTime = date('h:i A');

$todaySchedsql = "
    SELECT 
        'appointment' AS source,
        'appointment' AS type,
        a.appoint_id AS id, 
        a.user_id, 
        a.first_name,
        a.last_name, 
        a.appoint_sched_date AS date, 
        a.appoint_sched_time AS time,
        u.profile_picture
    FROM appointment_record a
    JOIN users u ON a.user_id = u.user_id
    WHERE a.appoint_sched_date = :todayDate AND a.appoint_sched_time >= :currentTime
    
    UNION ALL
    
    SELECT 
        'reception' AS source,
        'reception' AS type,
        r.reception_id AS id, 
        r.user_id, 
        r.full_name_org, 
        '' AS last_name, 
        r.check_in AS date, 
        r.check_in AS time,
        u.profile_picture
    FROM reception_reservation_record r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.check_in = :todayDate
    
    UNION ALL
    
    SELECT 
        'recollection' AS source,
        'recollection' AS type,
        r.recollection_id AS id, 
        r.user_id, 
        r.full_name_org, 
        '' AS last_name, 
        r.check_in AS date, 
        r.check_in AS time,
        u.profile_picture
    FROM recollection_reservation_record r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.check_in = :todayDate
    
    UNION ALL
    
    SELECT 
        'retreat' AS source,
        'retreat' AS type,
        r.retreat_id AS id, 
        r.user_id, 
        r.full_name_org, 
        '' AS last_name,
        r.check_in AS date, 
        r.check_in AS time,
        u.profile_picture
    FROM retreat_reservation_record r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.check_in = :todayDate
    
    UNION ALL
    
    SELECT 
        'seminar' AS source,
        'seminar' AS type,
        r.seminar_id AS id, 
        r.user_id, 
        r.full_name_org, 
        '' AS last_name,
        r.check_in AS date, 
        r.check_in AS time,
        u.profile_picture
    FROM seminar_reservation_record r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.check_in = :todayDate
    
    UNION ALL
    
    SELECT 
        'training' AS source,
        'training' AS type,
        r.training_id AS id, 
        r.user_id, 
        r.full_name_org, 
        '' AS last_name,
        r.check_in AS date, 
        r.check_in AS time,
        u.profile_picture
    FROM training_reservation_record r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.check_in = :todayDate
    
    ORDER BY date, time;
";



$stmt = $conn->prepare($todaySchedsql);
$stmt->bindParam(':todayDate', $todayDate, PDO::PARAM_STR);
$stmt->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
$stmt->execute();




?>