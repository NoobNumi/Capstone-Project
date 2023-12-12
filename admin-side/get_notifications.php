<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
}

date_default_timezone_set('Asia/Manila');
$type = isset($_GET['data-type']) ? $_GET['data-type'] : 'all';

$query = "
SELECT 
    'reservation' AS type, 
    'reception' AS reservation_type,
    reception_id AS id, 
    r.user_id, 
    r.full_name_org, 
    r.timestamp AS timestamp,
    r.status AS status,
    r.is_read AS is_read,
    u.profile_picture
FROM reception_reservation_record r
JOIN users u ON r.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'reservations') AND r.status = 'pending'

UNION

SELECT 
    'reservation' AS type, 
    'recollection' AS reservation_type,
    recollection_id AS id, 
    r.user_id, 
    r.full_name_org, 
    r.timestamp AS timestamp,
    r.status AS status,
    r.is_read AS is_read,
    u.profile_picture
FROM recollection_reservation_record r
JOIN users u ON r.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'reservations') AND r.status = 'pending'

UNION

SELECT 
    'reservation' AS type, 
    'retreat' AS reservation_type,
    retreat_id AS id, 
    r.user_id, 
    r.full_name_org, 
    r.timestamp AS timestamp,
    r.status AS status,
    r.is_read AS is_read,
    u.profile_picture
FROM retreat_reservation_record r
JOIN users u ON r.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'reservations') AND r.status = 'pending'

UNION

SELECT 
    'reservation' AS type, 
    'seminar' AS reservation_type,
    seminar_id AS id, 
    r.user_id, 
    r.full_name_org, 
    r.timestamp AS timestamp,
    r.status AS status,
    r.is_read AS is_read,
    u.profile_picture
FROM seminar_reservation_record r
JOIN users u ON r.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'reservations') AND r.status = 'pending'

UNION

SELECT 
    'reservation' AS type, 
    'training' AS reservation_type,
    training_id AS id, 
    r.user_id, 
    r.full_name_org, 
    r.timestamp AS timestamp,
    r.status AS status,
    r.is_read AS is_read,
    u.profile_picture
FROM training_reservation_record r
JOIN users u ON r.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'reservations') AND r.status = 'pending'

UNION

SELECT 
    'appointment' AS type, 
    '' AS reservation_type,
    appoint_id AS id, 
    a.user_id, 
    a.full_name_org, 
    a.timestamp AS timestamp,
    a.appoint_status AS status,
    a.is_read AS is_read,
    u.profile_picture
FROM appointment_record a
JOIN users u ON a.user_id = u.user_id
WHERE (:type = 'all' OR :type = 'appointments') AND a.appoint_status = 'pending'

ORDER BY timestamp DESC;

SELECT 
    'reservation' AS type, 
    COUNT(*) AS unread_count
FROM (
    SELECT reception_id AS id
    FROM reception_reservation_record
    WHERE status = 'pending' AND is_read_user = 0
    
    UNION
    SELECT retreat_id AS id
    FROM retreat_reservation_record
    WHERE status = 'pending' AND is_read_user = 0
    
    UNION
    SELECT recollection_id AS id
    FROM recollection_reservation_record
    WHERE status = 'pending' AND is_read_user = 0
    
    UNION
    SELECT seminar_id AS id
    FROM seminar_reservation_record
    WHERE status = 'pending' AND is_read_user = 0
    
    UNION
    SELECT training_id AS id
    FROM training_reservation_record
    WHERE status = 'pending' AND is_read_user = 0
    
) AS unread_reservations;

SELECT 
    'appointment' AS type, 
    COUNT(*) AS unread_count
FROM appointment_record
WHERE appoint_status = 'pending' AND is_read_user = 0;
";

$statement = $conn->prepare($query);
$statement->bindParam(':type', $type, PDO::PARAM_STR);
$statement->execute();
$notifications = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notifications);
?>
