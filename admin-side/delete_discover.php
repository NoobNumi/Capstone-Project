<?php
session_name("admin_session");
session_start();
require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemType = $_POST['item_type'];
    $itemId = $_POST['item_id'];

    $conn->beginTransaction();

    try {
        // Prepare the SQL statement for deleting the item based on its type
        if ($itemType === 'service') {
            $deleteItemSql = "DELETE FROM services WHERE service_id = :item_id";
        } elseif ($itemType === 'souvenir') {
            $deleteItemSql = "DELETE FROM souvenir_items WHERE item_id = :item_id";
        } else {
            throw new Exception('Invalid item type');
        }

        $stmt = $conn->prepare($deleteItemSql);
        $stmt->bindParam(':item_id', $itemId);

        if (!$stmt->execute()) {
            throw new Exception('Failed to execute delete statement');
        }

        $conn->commit();
        echo json_encode(['success' => true, 'deleted' => true, 'message' => ucfirst($itemType) . ' deleted successfully']);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
