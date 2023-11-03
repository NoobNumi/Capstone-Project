<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['meal_name']) && isset($_POST['category_add_id'])) {
        $meal_name = $_POST['meal_name'];
        $category_id = $_POST['category_add_id'];

        $uploadsDirectory = '../uploads/';

        if (isset($_FILES['meal_image'])) {
            $imageFile = $_FILES['meal_image'];

            if ($imageFile['error'] === UPLOAD_ERR_OK) {
                $imageTmpName = $imageFile['tmp_name'];

                $uniqueFilename = uniqid() . '_' . $imageFile['name'];

                $imagePath = $uploadsDirectory . $uniqueFilename;

                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    try {
                        $insertMealQuery = "INSERT INTO meals (meal_name, meal_img_path) VALUES (:meal_name, :meal_img_path)";
                        $mealstmt = $conn->prepare($insertMealQuery);
                        $mealstmt->bindParam(':meal_name', $meal_name);
                        $mealstmt->bindParam(':meal_img_path', $imagePath);
                        $mealstmt->execute();

                        $meal_id = $conn->lastInsertId();

                        $insertMealSetQuery = "INSERT INTO meal_sets (meal_id, mealCat_id) VALUES (:meal_id, :mealCat_id)";
                        $mealstmt = $conn->prepare($insertMealSetQuery);
                        $mealstmt->bindParam(':meal_id', $meal_id);
                        $mealstmt->bindParam(':mealCat_id', $category_id);
                        $mealstmt->execute();

                        echo '<script>
                            Swal.fire("Meal added successfully!", "", "success").then(() => {
                                // Close the alert and then redirect to the same page or another page
                                Swal.close();
                                window.location.href = "post-meals.php";
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
    <section class="add-meal-section">
        <div class="add-meal-modal">
            <div class="add-meal-header">
                <span class="edit-details">
                    Add Details
                </span>
                <i class="fa-solid fa-xmark close-button-details" id="close_addButton"></i>
            </div>
            <div class="add-meal-content">
                <div class="add-meal-center">
                    <img id="mealAddImage" src="" alt="Select Photo" srcset="" style="display: none;">
                </div>
            </div>
            <form action="" method="post" class="add-meal-details" enctype="multipart/form-data">
                <label for="mealAddImage" class="add-meal-image">
                    <i class="fa-solid fa-camera"></i>Select photo
                </label>
                <input type="file" id="hiddenImageAdd" name="meal_image" style="display: none" accept="image/*">
                <div class="input-details-view">
                    <input type="hidden" name="meal_id" value="">
                    <input type="text" name="meal_name" placeholder="Enter food name..">
                    <select name="category_add_id" id="">
                        <!-- The categories inside the meal_categories should be fetched here -->
                    </select>
                    <input type="hidden" name="meal_img_path" class="meal_image" id="meal_img_path">
                </div>
                <button class="add-button" type="submit">Add Meal</button>
            </form>
        </div>

    </section>
    <script>
        const imageAdd = document.getElementById('hiddenImageAdd');
        const mealAddImage = document.getElementById('mealAddImage');
        const hiddenImageAdd = document.getElementById('meal_img_path');

        const label = document.querySelector('.add-meal-image');
        label.addEventListener('click', function() {
            imageAdd.click();
        });

        imageAdd.addEventListener('change', function() {
            if (imageAdd.files && imageAdd.files[0]) {
                const file = imageAdd.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    mealAddImage.src = e.target.result;
                    mealAddImage.style.display = 'block';
                    hiddenImageAdd.value = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>