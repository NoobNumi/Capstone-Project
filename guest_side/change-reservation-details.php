<?php
require("../connection.php");

session_name("user_session");
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$reservationType = $_POST['reservationType'] ?? null;
$updatedReservation = $_POST['updatedReservation'] ?? null;
$reservationId = $_POST['reservationId'] ?? null;

if (!$reservationType || !$updatedReservation || !$reservationId) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

$typeToTable = [
    'reception' => 'reception_reservation_record',
    'recollection' => 'recollection_reservation_record',
    'retreat' => 'retreat_reservation_record',
    'seminar' => 'seminar_reservation_record',
    'training' => 'training_reservation_record'
];

if (!isset($typeToTable[$reservationType])) {
    echo json_encode(['success' => false, 'error' => 'Invalid reservation type']);
    exit;
}

$tableName = $typeToTable[$reservationType];
$idColumnName = $reservationType . '_id';

try {
    $selectedMeals = $_POST['updatedReservation']['selected_meals'] ?? [];

    if (empty($selectedMeals)) {
        echo json_encode(['success' => false, 'error' => 'Selected meals not provided']);
        exit;
    }

    $allowedMealTypes = ['breakfast', 'lunch', 'dinner', 'drinks', 'dessert'];
    foreach ($selectedMeals as $meal) {
        $selectedMealType = $meal['type'];
        if (!in_array($selectedMealType, $allowedMealTypes)) {
            echo json_encode(['success' => false, 'error' => 'Invalid meal type']);
            exit;
        }

        $columnName = $selectedMealType;

        $sql = "UPDATE $tableName SET 
            first_name = :first_name, 
            contact_no = :contact_no, 
            $columnName = :selected_meal
            WHERE $idColumnName = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':first_name', $updatedReservation['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':contact_no', $updatedReservation['contact_no'], PDO::PARAM_STR);
        $stmt->bindParam(':selected_meal', $meal['meal'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);

        $stmt->execute();
    }

    echo json_encode(['success' => true]);
    exit;
} catch (PDOException $e) {
    $errorMessage = "Error updating reservation: " . $e->getMessage();
    error_log($errorMessage);
    echo json_encode(['success' => false, 'error' => $errorMessage, 'debug_info' => $e->getMessage()]);
    exit;
}
?>
