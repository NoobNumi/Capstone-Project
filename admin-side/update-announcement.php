<?php
require_once("../connection.php");

function deleteImage($announcement_id, $img_url_path)
{
    global $conn;

    // Unlink file from server
    unlink($img_url_path);

    // Delete image from the database
    $delete_image_query = "DELETE FROM announcement_image WHERE announcement_id = :announcement_id AND img_url_path = :img_url_path";
    $delete_image_stmt = $conn->prepare($delete_image_query);
    $delete_image_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
    $delete_image_stmt->bindParam(':img_url_path', $img_url_path, PDO::PARAM_STR);
    $delete_image_stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_id = $_POST['announcement_id'];
    $post_content = $_POST['post_content'];

    error_log("Received data - announcement_id: $announcement_id, post_content: $post_content");

    $update_post_query = "UPDATE announcements SET post_content = :post_content WHERE announcement_id = :announcement_id";
    $update_post_stmt = $conn->prepare($update_post_query);
    $update_post_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
    $update_post_stmt->bindParam(':post_content', $post_content, PDO::PARAM_STR);
    $update_post_stmt->execute();

    // Handle deleted images
    if (!empty($_POST['deletedImages'])) {
        $deletedImages = json_decode($_POST['deletedImages']);
        foreach ($deletedImages as $deletedImage) {
            deleteImage($announcement_id, $deletedImage);
        }
    }

    // Retrieve existing images
    $existingImages = array();
    $select_images_query = "SELECT img_url_path FROM announcement_image WHERE announcement_id = :announcement_id";
    $select_images_stmt = $conn->prepare($select_images_query);
    $select_images_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
    $select_images_stmt->execute();

    while ($row = $select_images_stmt->fetch(PDO::FETCH_ASSOC)) {
        $existingImages[] = $row['img_url_path'];
    }

    // Handle new images
    if (!empty($_FILES['images']['name'][0])) {
        // Insert new images
        foreach ($_FILES['images']['name'] as $key => $value) {
            $image_name = $_FILES['images']['name'][$key];
            $image_tmp_name = $_FILES['images']['tmp_name'][$key];
            $upload_path = '../uploads/' . $image_name;

            move_uploaded_file($image_tmp_name, $upload_path);

            $insert_image_query = "INSERT INTO announcement_image (announcement_id, img_url_path) VALUES (:announcement_id, :img_url_path)";
            $insert_image_stmt = $conn->prepare($insert_image_query);
            $insert_image_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
            $insert_image_stmt->bindParam(':img_url_path', $upload_path, PDO::PARAM_STR);
            $insert_image_stmt->execute();
        }

        $allImages = $existingImages;

        // foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        //     $image_name = $_FILES['images']['name'][$key];
        //     $upload_path = '../uploads/' . $image_name;

        //     if (move_uploaded_file($tmp_name, $upload_path)) {
        //         $allImages[] = $upload_path;
        //         $insert_image_query = "INSERT INTO announcement_image (announcement_id, img_url_path) VALUES (:announcement_id, :img_url_path)";
        //         $insert_image_stmt = $conn->prepare($insert_image_query);
        //         $insert_image_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
        //         $insert_image_stmt->bindParam(':img_url_path', $upload_path, PDO::PARAM_STR);
        //         $insert_image_stmt->execute();
        //     } else {
        //         $response = array('status' => 'error', 'message' => 'Failed to move uploaded file.');
        //         header('Content-Type: application/json');
        //         echo json_encode($response);
        //         exit();
        //     }
        // }

        $response = array('status' => 'success', 'message' => 'Announcement updated successfully with new images');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $response = array('status' => 'success', 'message' => 'Announcement updated successfully without new images');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
