<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_content = $_POST["post_content"];

    try {
        $sql = "INSERT INTO announcements (post_content) VALUES (:post_content)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post_content', $post_content);
        $stmt->execute();
        $announcement_id = $conn->lastInsertId();

        $imagePaths = array();

        if (!empty($_FILES["images"]["name"][0])) {
            for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
                $image_path = "../uploads/" . $_FILES["images"]["name"][$i];
                move_uploaded_file($_FILES["images"]["tmp_name"][$i], $image_path);
                $imagePaths[] = $image_path;

                $sql = "INSERT INTO announcement_image (announcement_id, img_url_path) VALUES (:announcement_id, :img_url_path)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':announcement_id', $announcement_id);
                $stmt->bindParam(':img_url_path', $image_path);
                $stmt->execute();
            }

            if (!empty($imagePaths)) {
                echo '<script>
                    Swal.fire("Success", "Announcement added successfully", "success").then(function() {
                        window.location = "post-announcements.php";
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire("Success", "Announcement added successfully", "success").then(function() {
                        window.location = "post-announcements.php";
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire("Success", "Announcement added successfully", "success").then(function() {
                    window location = "post-announcements.php";
                });
            </script>';
        }
    } catch (PDOException $e) {
        echo '<script>
            Swal.fire("Error", "Database error: ' . $e->getMessage() . '", "error");
        </script>';
    }
}

?>


<body>
    <section class="create-post">
        <div class="create-post-modal">
            <header>
                <span class="create-title">Create Post</span>
                <i class="fa-solid fa-xmark close-create-post"></i>
            </header>
            <form id="myForm" class="create-post-form" method="post">
                <div class="profile-pic">
                    <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    <span class="poster-name">Admin</span>
                </div>
                <textarea name="post_content" id="" cols="30" rows="5" placeholder="Post an update..."></textarea>
                <div class="post-photos">
                    <div class="photo-display-all">
                        <!-- images are displayed here and are stored in the announcement_image table -->
                    </div>
                    <div class="add-photos" id="addPhotos">
                        <i class="fa-solid fa-image"></i>
                        <span>Add photos</span>
                        <input type="file" name="images[]" id="fileInput" accept="image/*" multiple style="display: none">
                    </div>
                </div>
                <div class="create-post-button">
                    <input type="hidden" name="announcement_id" id="announcement_id" value="">
                    <button type="submit" class="btn-view">Post</button>
                </div>
            </form>
        </div>
    </section>
    <script src="./js/create-announce.js"></script>
</body>