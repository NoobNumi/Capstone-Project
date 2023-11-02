<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mealId = $_POST['meal_id'];
    $mealName = $_POST['meal_name'];
    $category = $_POST['category_id'];

    if (isset($_FILES['meal_image'])) {
        $imageFile = $_FILES['meal_image'];

        if ($imageFile['error'] === UPLOAD_ERR_OK) {
            $imageTmpName = $imageFile['tmp_name'];
            $imagePath = '../uploads/' . basename($imageFile['name']);

            if (move_uploaded_file($imageTmpName, $imagePath)) {
                $updateMealSql = "UPDATE meals SET meal_name = :meal_name, meal_img_path = :meal_img_path WHERE meal_id = :meal_id";
                $stmt = $conn->prepare($updateMealSql);
                $stmt->bindParam(':meal_name', $mealName);
                $stmt->bindParam(':meal_img_path', $imagePath);
                $stmt->bindParam(':meal_id', $mealId);
    
                if ($stmt->execute()) {
                    $updateCategorySql = "UPDATE meal_sets SET mealCat_id = :category WHERE meal_id = :meal_id";
                    $stmt = $conn->prepare($updateCategorySql);
                    $stmt->bindParam(':category', $category);
                    $stmt->bindParam(':meal_id', $mealId);
    
                    if ($stmt->execute()) {
                        echo json_encode(['success' => true, 'message' => 'Meal updated successfully']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to update meal category']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update meal details']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded image']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Image upload error: ' . $imageFile['error']]);
        }
    } else {
        $updateMealSql = "UPDATE meals SET meal_name = :meal_name WHERE meal_id = :meal_id";
        $stmt = $conn->prepare($updateMealSql);
        $stmt->bindParam(':meal_name', $mealName);
        $stmt->bindParam(':meal_id', $mealId);

        if ($stmt->execute()) {
            if (!empty($category)) {
                $updateCategorySql = "UPDATE meal_sets SET mealCat_id = :category WHERE meal_id = :meal_id";
                $stmt = $conn->prepare($updateCategorySql);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':meal_id', $mealId);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Meal updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update meal category']);
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'Meal updated successfully']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update meal details']);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}