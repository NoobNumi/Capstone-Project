<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = isset($_POST['service_id']) ? $_POST['service_id'] : $_POST['item_id'];
    $itemName = isset($_POST['service_name']) ? $_POST['service_name'] : $_POST['item_name'];
    $itemDescription = isset($_POST['service_description']) ? $_POST['service_description'] : $_POST['souvenir_description'];

    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
        $imageFile = $_FILES['imageInput'];
        $imageTmpName = $imageFile['tmp_name'];
        $imagePath = '../uploads/' . basename($imageFile['name']);

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $tableName = isset($_POST['service_id']) ? "services" : "souvenir_items";
            $itemNameColumn = isset($_POST['service_id']) ? "service_name" : "item_name";
            $itemDescriptionColumn = isset($_POST['service_id']) ? "service_description" : "souvenir_description";
            $imgPathColumn = isset($_POST['service_id']) ? "img_path" : "souvenir_img_path";

            $updateDiscoverSql = "UPDATE $tableName SET 
                $itemNameColumn = :item_name,
                $itemDescriptionColumn = :item_description,
                $imgPathColumn = :img_path
                WHERE " . ($tableName === "services" ? "service_id" : "item_id") . " = :item_id";

            $stmt = $conn->prepare($updateDiscoverSql);
            $stmt->bindParam(':item_name', $itemName);
            $stmt->bindParam(':item_description', $itemDescription);
            $stmt->bindParam(':img_path', $imagePath);
            $stmt->bindParam(':item_id', $itemId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Details updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update details: ' . $stmt->errorInfo()[2]]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded image']);
        }
    } else {
        $tableName = isset($_POST['service_id']) ? "services" : "souvenir_items";
        $itemNameColumn = isset($_POST['service_id']) ? "service_name" : "item_name";
        $itemDescriptionColumn = isset($_POST['service_id']) ? "service_description" : "souvenir_description";

        $updateDiscoverSql = "UPDATE $tableName SET 
            $itemNameColumn = :item_name,
            $itemDescriptionColumn = :item_description
            WHERE " . ($tableName === "services" ? "service_id" : "item_id") . " = :item_id";

        $stmt = $conn->prepare($updateDiscoverSql);
        $stmt->bindParam(':item_name', $itemName);
        $stmt->bindParam(':item_description', $itemDescription);
        $stmt->bindParam(':item_id', $itemId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Details updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update details: ' . $stmt->errorInfo()[2]]);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
