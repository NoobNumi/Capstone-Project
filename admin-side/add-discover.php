<?php
require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_name']) && isset($_POST['item_type'])) {
        $item_name = $_POST['item_name'];
        $itemType = $_POST['item_type'];

        $uploadsDirectory = '../uploads/';

        if (isset($_FILES['item_image'])) {
            $imageFile = $_FILES['item_image'];

            if ($imageFile['error'] === UPLOAD_ERR_OK) {
                $imageTmpName = $imageFile['tmp_name'];

                $uniqueFilename = uniqid() . '_' . $imageFile['name'];

                $imagePath = $uploadsDirectory . $uniqueFilename;

                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    try {
                        if ($itemType === 'service') {
                            $insertItemQuery = "INSERT INTO services (service_name, service_description, img_path) VALUES (:item_name, :item_description, :img_path)";
                        } elseif ($itemType === 'souvenir') {
                            $insertItemQuery = "INSERT INTO souvenir_items (item_name, souvenir_description, souvenir_img_path) VALUES (:item_name, :item_description, :img_path)";

                        } else {
                            throw new Exception('Invalid item type');
                        }

                        $stmt = $conn->prepare($insertItemQuery);
                        $stmt->bindParam(':item_name', $item_name);
                        $stmt->bindParam(':item_description', $_POST['item_description']);
                        $stmt->bindParam(':img_path', $imagePath);
                        $stmt->execute();

                        $item_id = $conn->lastInsertId();

                        echo '<script>
                            Swal.fire("Item added successfully!", "", "success").then(() => {
                                // Close the alert and then redirect to the same page or another page
                                Swal.close();
                                window.location.href = "post-discover.php";
                            });
                        </script>';
                    } catch (PDOException $e) {
                        echo '<script>
                            Swal.fire("Database error: ' . $e->getMessage() . '", "", "error");
                        </script>';
                    }
                } else {
                    echo '<script>
                        Swal.fire("Failed to move the uploaded image.", "", "error");
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire("Image upload error: ' . $imageFile['error'] . '", "", "error");
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire("Image not provided.", "", "error");
            </script>';
        }
    } else {
        echo '<script>
            Swal.fire("Form fields are not set or empty.", "", "error");
        </script>';
    }
}
?>

<body style="overflow-x: hidden;">
    <section class="add-discover-section" id="addModal">
        <div class="add-discover-modal">
            <div class="add-discover-header">
                <span class="edit-details">
                    Add Details
                </span>
                <i class="fa-solid fa-xmark close-button-details" id="closeAddModal" class="close-btn" onclick="closeAddModal()"></i>
            </div>
            <div class="add-discover-content">
                <div class="add-discover-center">
                    <img id="discoverAddImage" src="" alt="Select Photo" srcset="" style="display: none;">
                </div>
            </div>
            <form action="" method="post" class="add-discover-details" enctype="multipart/form-data">
                <label for="discoverAddImage" class="add-discover-image">
                    <i class="fa-solid fa-camera"></i>Select photo
                </label>
                <input type="file" id="hiddenImageAdd" name="item_image" style="display: none" accept="image/*">
                <div class="input-details-view">
                    <input type="hidden" name="item_id" value="">
                    <div class="input-group">
                        <input type="text" name="item_name" id="item_name" placeholder="Enter item name..">
                        <select name="item_type">
                            <option value="service">Service</option>
                            <option value="souvenir">Souvenir</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <textarea name="item_description" id="item_description" placeholder="Enter item description.."></textarea>
                    </div>
                </div>
                <button class="add-button" type="submit">Add Item</button>
            </form>

        </div>
    </section>
    <script>
        const imageAdd = document.getElementById('hiddenImageAdd');
        const discoverAddImage = document.getElementById('discoverAddImage');
        const hiddenImageAdd = document.getElementById('item_img_path');

        const label = document.querySelector('.add-discover-image');
        label.addEventListener('click', function() {
            imageAdd.click();
        });

        imageAdd.addEventListener('change', function() {
            if (imageAdd.files && imageAdd.files[0]) {
                const file = imageAdd.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    discoverAddImage.src = e.target.result;
                    discoverAddImage.style.display = 'block';
                    hiddenImageAdd.value = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
        document.getElementById('close_addModal').addEventListener('click', closeAddModal);
    </script>
</body>
</html>