<?php
session_name("user_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['user_id'])) {
    exit;
}

date_default_timezone_set('Asia/Manila');
$type = isset($_GET['data-type']) ? $_GET['data-type'] : 'all';

$user_id = $_SESSION['user_id'];

$query = "
SELECT 
    'reservation' AS type, 
    'reception' AS reservation_type,
    reception_id AS id, 
    r.user_id, 
    r.timestamp AS timestamp,
    r.status,
    r.check_in AS book_date,
    r.check_out AS check_out_date,
    r.is_read_user AS is_read_user
FROM reception_reservation_record r
WHERE r.user_id = :user_id AND r.status IN ('confirmed', 'cancelled')

UNION

SELECT 
    'reservation' AS type, 
    'recollection' AS reservation_type,
    recollection_id AS id, 
    r.user_id, 
    r.timestamp AS timestamp,
    r.status,
    r.check_in AS book_date,
    r.check_out AS check_out_date,
    r.is_read_user AS is_read_user
FROM recollection_reservation_record r
WHERE r.user_id = :user_id AND r.status IN ('confirmed', 'cancelled')

UNION

SELECT 
    'reservation' AS type, 
    'retreat' AS reservation_type,
    retreat_id AS id, 
    r.user_id, 
    r.timestamp AS timestamp,
    r.status,
    r.check_in AS book_date,
    r.check_out AS check_out_date,
    r.is_read_user AS is_read_user
FROM retreat_reservation_record r
WHERE r.user_id = :user_id AND r.status IN ('confirmed', 'cancelled')

UNION

SELECT 
    'reservation' AS type, 
    'seminar' AS reservation_type,
    seminar_id AS id, 
    r.user_id, 
    r.timestamp AS timestamp,
    r.status,
    r.check_in AS book_date,
    r.check_out AS check_out_date,
    r.is_read_user AS is_read_user
FROM seminar_reservation_record r
WHERE r.user_id = :user_id AND r.status IN ('confirmed', 'cancelled')

UNION

SELECT 
    'reservation' AS type, 
    'training' AS reservation_type,
    training_id AS id, 
    r.user_id, 
    r.timestamp AS timestamp,
    r.status,
    r.check_in AS book_date,
    r.check_out AS check_out_date,
    r.is_read_user AS is_read_user
FROM training_reservation_record r
WHERE r.user_id = :user_id AND r.status IN ('confirmed', 'cancelled')

UNION

SELECT 
    'appointment' AS type, 
    '' AS reservation_type,
    appoint_id AS id, 
    a.user_id, 
    a.timestamp AS timestamp,
    a.appoint_status AS status,
    a.appoint_sched_date AS book_date,
    NULL AS check_out_date,
    a.is_read_user AS is_read_user
FROM appointment_record a
WHERE a.user_id = :user_id AND a.appoint_status IN ('confirmed', 'cancelled')

ORDER BY timestamp DESC;

SELECT 
    'reservation' AS type, 
    COUNT(*) AS unread_count
FROM (
    SELECT reception_id AS id
    FROM reception_reservation_record
    WHERE user_id = :user_id AND status IN ('confirmed', 'cancelled') AND is_read_user = 0
    
    UNION
    
    SELECT recollection_id AS id
    FROM recollection_reservation_record
    WHERE user_id = :user_id AND status IN ('confirmed', 'cancelled') AND is_read_user = 0
    
    UNION
    
    SELECT retreat_id AS id
    FROM retreat_reservation_record
    WHERE user_id = :user_id AND status IN ('confirmed', 'cancelled') AND is_read_user = 0
    
    UNION
    
    SELECT seminar_id AS id
    FROM seminar_reservation_record
    WHERE user_id = :user_id AND status IN ('confirmed', 'cancelled') AND is_read_user = 0
    
    UNION
    
    SELECT training_id AS id
    FROM training_reservation_record
    WHERE user_id = :user_id AND status IN ('confirmed', 'cancelled') AND is_read_user = 0
) AS unread_reservations;

SELECT 
    'appointment' AS type, 
    COUNT(*) AS unread_count
FROM appointment_record
WHERE user_id = :user_id AND appoint_status IN ('confirmed', 'cancelled') AND is_read_user = 0;
";

$statement = $conn->prepare($query);
$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$notifications = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notifications);
?>
