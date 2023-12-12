<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_data = json_decode(file_get_contents("php://input"), true);
    $notificationType = $request_data['type'];

    $query = '';
    $bindings = array();

    if ($notificationType === 'All') {
        // Fetch all notifications
        $query = "
            SELECT 'Reservation' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, check_in, check_out, price, payment_method, payment_option, proof_of_payment, status, timestamp, is_read
            FROM reception_reservation_record
            UNION ALL
            SELECT 'Recollection' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, guest_count, check_in, check_out, price, payment_method, payment_option, proof_of_payment, status, timestamp, is_read
            FROM recollection_reservation_record
            UNION ALL
            SELECT 'Retreat' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, guest_count, check_in, check_out, room_type, catering, price, payment_method, payment_option, proof_of_payment, status, timestamp, is_read
            FROM retreat_reservation_record
            UNION ALL
            SELECT 'Seminar' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, guest_count, check_in, check_out, room_type, catering, price, payment_method, payment_option, proof_of_payment, status, timestamp, is_read
            FROM seminar_reservation_record
            UNION ALL
            SELECT 'Appointment' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, NULL AS guest_count, appoint_sched_date AS check_in, appoint_sched_time AS check_out, appoint_description AS room_type, NULL AS catering, NULL AS price, appoint_status AS status, timestamp, is_read
            FROM appointment_record
            ORDER BY timestamp DESC
        ";
    } else {
        switch ($notificationType) {
            case 'Reservations':
                $query = "SELECT 'Reservation' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, check_in, check_out, price, payment_method, payment_option, proof_of_payment, status, timestamp, is_read FROM reception_reservation_record";
                break;
            case 'Appointments':
                $query = "SELECT 'Appointment' AS type, user_id, full_name_org, street_add, city_municipality, province, postal_code, contact_no, NULL AS guest_count, appoint_sched_date AS check_in, appoint_sched_time AS check_out, appoint_description AS room_type, NULL AS catering, NULL AS price, appoint_status AS status, timestamp, is_read FROM appointment_record";
                break;
            default:
                break;
        }
    }

    $stmt = $conn->query($query);

    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($notifications);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
}
?>
