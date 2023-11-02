<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<body>
  <section class="meal-view-modal" id="mealModal">
    <div class="meal-view-container">
      <div class="meal-view-header">
        <span class="edit-details">
          Edit Details
        </span>
        <i class="fa-solid fa-xmark close-button-details"></i>
      </div>
      <div class="meal-view-content">
        <div class="meal-view-center">
          <img id="mealImage" src="" alt="" srcset="">
          <div class="change-photo" onclick="document.getElementById('imageInput').click();">
            <input type="file" id="imageInput" accept="image/*" style="display: none">
            <i class="fa-solid fa-camera"></i>
          </div>
        </div>
      </div>
      <form action="update_meal.php" method="post" class="edit-meal-details update-meal-form" enctype="multipart/form-data">
        <div class="input-details-view">
          <input type="hidden" name="meal_id" value="">
          <input type="text" name="meal_name" placeholder="Enter food name..">
          <select name="category_id" id="">
            <!-- Categories will be populated dynamically from the database -->
          </select>
          <input type="hidden" name="meal_image">
        </div>
        <div class="option-buttons">
          <button class="del-btn" data-meal-id="">Delete</button>
          <button class="save-btn" type="submit">Save</button>
        </div>
      </form>
    </div>
  </section>
  <script>
    const imageInput = document.getElementById('imageInput');
    const mealImage = document.getElementById('mealImage');
    const hiddenImageInput = document.querySelector('input[name="meal_image"]');

    imageInput.addEventListener('change', function() {
      const file = imageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          mealImage.src = e.target.result;

          hiddenImageInput.value = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>