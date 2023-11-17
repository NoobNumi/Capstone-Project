<?php
require_once("../connection.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['fetch_details'])) {
        $itemId = $_POST['item_id'];
        $itemType = $_POST['item_type'];

        if ($itemType === "service") {
            $data = fetchServiceDetails($itemId);
        } elseif ($itemType === "souvenir") {
            $data = fetchSouvenirDetails($itemId);
        } else {
            echo json_encode(['error' => 'Invalid item type']);
            exit;
        }

        echo json_encode($data);
        exit;
    }
}

header('HTTP/1.1 400 Bad Request');
echo "Invalid request";
exit;

function fetchServiceDetails($serviceId) {
    global $conn;

    $sql = "SELECT * FROM services WHERE service_id = :service_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':service_id', $serviceId, PDO::PARAM_INT);
    
    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        echo "Error executing service query: " . print_r($errorInfo, true);
        exit;
    }

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data) {
        echo "No service data found for service ID: " . $serviceId;
        exit;
    }

    return $data;
}

function fetchSouvenirDetails($itemId) {
    global $conn;

    $sql = "SELECT * FROM souvenir_items WHERE item_id = :item_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':item_id', $itemId, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        echo "SQL Execution Error: " . json_encode($errorInfo);
        exit;
    }

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data) {
        echo "No souvenir data found for item ID: " . $itemId;
        exit;
    }

    return $data;
}
?>
