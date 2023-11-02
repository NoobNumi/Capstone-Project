<?php
require_once("../connection.php");


if (isset($_GET['meal_id'])) {
    $mealId = $_GET['meal_id'];

    $sql = "SELECT meals.meal_name, meals.meal_img_path, meal_category.mealCat_name
            FROM meals
            JOIN meal_sets ON meals.meal_id = meal_sets.meal_id
            JOIN meal_category ON meal_sets.mealCat_id = meal_category.mealCat_id
            WHERE meals.meal_id = :meal_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':meal_id', $mealId);
    $stmt->execute();

    $mealDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($mealDetails) {
        echo json_encode($mealDetails);
    } else {
        echo json_encode(['error' => 'Meal not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid meal ID']);
}
?>
