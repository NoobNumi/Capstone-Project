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

";

$statement = $conn->prepare($query);
$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$check_out = $statement->fetchAll(PDO::FETCH_ASSOC);

$display_modal = false;
foreach ($check_out as $check_out_datess) {
    $check_out_date = strtotime($check_out_datess['check_out_date']);
    $yesterday = strtotime('-1 day', strtotime(date('Y-m-d')));

    if ($check_out_date == $yesterday) {
        $display_modal = true;
        break;
    }
}

echo json_encode($check_out_datess);

if ($display_modal) {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalContainer = document.createElement("div");
            modalContainer.className = "modal-container";
            modalContainer.innerHTML = `';
    include("ratingModal.php");

    echo '            `;
            document.body.appendChild(modalContainer);
        });
    </script>';
}
?>