<?php
require("../connection.php");

session_name("user_session");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

$sql = "SELECT meal_name, type, meal_img_path FROM meals";
$stmt = $conn->prepare($sql);
$stmt->execute();

$mealsData = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $type = strtolower($row['type']);
    $mealName = $row['meal_name'];

    if (!isset($mealsData[$type])) {
        $mealsData[$type] = [];
    }

    $mealsData[$type][$mealName] = $row['meal_img_path'];
}

header('Content-Type: application/json');
echo json_encode($mealsData);
?>
