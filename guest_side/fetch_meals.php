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

$mealsByType = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $type = strtolower($row['type']);


    if (!isset($mealsByType[$type])) {
        $mealsByType[$type] = [];
    }

    $mealsByType[$type][] = $row['meal_name'];
    
}

header('Content-Type: application/json');
echo json_encode($mealsByType);
?>
