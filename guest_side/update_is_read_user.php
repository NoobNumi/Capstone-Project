<?php
require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['type'], $_POST['reservation_type'])) {
        $itemId = $_POST['id'];
        $notifType = $_POST['type'];
        $reservationType = $_POST['reservation_type'];
        $updateQuery = '';
        if ($notifType === 'appointments') {
            $updateQuery = "UPDATE appointment_record SET is_read_user = 1 WHERE appoint_id = :itemId";
        } elseif ($notifType === 'reservations') {
            switch ($_POST['reservation_type']) {
                case 'reception':
                    $updateQuery = "UPDATE reception_reservation_record SET is_read_user = 1 WHERE reception_id = :itemId";
                    break;
                case 'recollection':
                    $updateQuery = "UPDATE recollection_reservation_record SET is_read_user = 1 WHERE recollection_id = :itemId";
                    break;
                case 'retreat':
                    $updateQuery = "UPDATE retreat_reservation_record SET is_read_user = 1 WHERE retreat_id = :itemId";
                    break;
                case 'seminar':
                    $updateQuery = "UPDATE seminar_reservation_record SET is_read_user = 1 WHERE seminar_id = :itemId";
                    break;
                case 'training':
                    $updateQuery = "UPDATE training_reservation_record SET is_read_user = 1 WHERE training_id = :itemId";
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['error' => 'Invalid reservation type']);
                    exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid notification type']);
            exit;
        }

        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['error' => 'Missing required data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>
