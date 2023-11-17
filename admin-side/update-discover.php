<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = isset($_POST['service_id']) ? $_POST['service_id'] : $_POST['souvenir_id'];
    $serviceName = isset($_POST['service_name']) ? $_POST['service_name'] : $_POST['souvenir_name'];
    $serviceDescription = isset($_POST['service_description']) ? $_POST['service_description'] : $_POST['souvenir_description'];
    $category = $_POST['category_id'];

    if (isset($_FILES['imageInput'])) {
        $imageFile = $_FILES['imageInput'];

        if ($imageFile['error'] === UPLOAD_ERR_OK) {
            $imageTmpName = $imageFile['tmp_name'];
            $imagePath = '../uploads/' . basename($imageFile['name']);

            if (move_uploaded_file($imageTmpName, $imagePath)) {
                $updateDiscoverSql = "UPDATE " . (isset($_POST['service_id']) ? "services" : "souvenir_items") . " SET 
                    service_name = :service_name,
                    service_description = :service_description,
                    img_path = :img_path
                    WHERE service_id = :service_id";

                $stmt = $conn->prepare($updateDiscoverSql);
                $stmt->bindParam(':service_name', $serviceName);
                $stmt->bindParam(':service_description', $serviceDescription);
                $stmt->bindParam(':img_path', $imagePath);
                $stmt->bindParam(':service_id', $serviceId);


                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Details updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update details']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded image']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Image upload error: ' . $imageFile['error']]);
        }
    } else {
        $updateDiscoverSql = "UPDATE " . (isset($_POST['service_id']) ? "services" : "souvenir_items") . " SET 
            service_name = :service_name,
            service_description = :service_description
            WHERE service_id = :service_id";

        $stmt = $conn->prepare($updateDiscoverSql);
        $stmt->bindParam(':service_name', $serviceName);
        $stmt->bindParam(':service_description', $serviceDescription);
        $stmt->bindParam(':service_id', $serviceId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Details updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update details']);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
