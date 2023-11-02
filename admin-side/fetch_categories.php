<?php
require_once("../connection.php");

$sql = "SELECT mealCat_id, mealCat_name FROM meal_category";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($categories);
