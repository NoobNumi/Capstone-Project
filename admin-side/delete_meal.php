<?php
session_name("admin_session");
session_start();
require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mealId = $_POST['meal_id'];

    $conn->beginTransaction();

    $deleteMealSql = "DELETE FROM meals WHERE meal_id = :meal_id";
    $stmt = $conn->prepare($deleteMealSql);
    $stmt->bindParam(':meal_id', $mealId);

    $deleteMealSetsSql = "DELETE FROM meal_sets WHERE meal_id = :meal_id";
    $stmtMealSets = $conn->prepare($deleteMealSetsSql);
    $stmtMealSets->bindParam(':meal_id', $mealId);

    $success = true;

    if (!$stmt->execute()) {
        $success = false;
    }

    if (!$stmtMealSets->execute()) {
        $success = false;
    }

    if ($success) {
        $conn->commit();
        echo json_encode(['success' => true, 'deleted' => true, 'message' => 'Meal deleted successfully']);
    } else {
        $conn->rollBack();
        echo json_encode(['success' => false, 'message' => 'Failed to delete the meal']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
