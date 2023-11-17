<?php
require_once("../connection.php");

if (isset($_POST['announcement_id'])) {
    $announcement_id = $_POST['announcement_id'];

    $post_query = "SELECT announcement_id, post_content FROM announcements WHERE announcement_id = :announcement_id";
    $post_stmt = $conn->prepare($post_query);
    $post_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
    $post_stmt->execute();
    $post_row = $post_stmt->fetch(PDO::FETCH_ASSOC);

    $image_query = "SELECT announce_img_id, img_url_path FROM announcement_image WHERE announcement_id = :announcement_id";
    $image_stmt = $conn->prepare($image_query);
    $image_stmt->bindParam(':announcement_id', $announcement_id, PDO::PARAM_INT);
    $image_stmt->execute();
    $images = $image_stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = array(
        'announcement_id' => $post_row['announcement_id'],
        'post_content' => $post_row['post_content'],
        'images' => $images
    );

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
