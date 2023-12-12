<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <section class="discover-view-modal" id="discoverModal">
        <div class="discover-view-container">
            <div class="discover-view-header">
                <span class="edit-details">
                    Edit Details
                </span>
                <i class="fa-solid fa-xmark close-button-details" id="closeDiscoverBtn"></i>
            </div>
            <div class="discover-view-content">
                <div class="discover-view-center">
                    <img id="discoverImage" src="" alt="" srcset="">
                    <!-- <div class="change-photo" onclick="document.getElementById('imageInput').click();">
                        <input type="file" id="imageInput" accept="image/*" style="display: none">
                        <i class="fa-solid fa-camera"></i>
                    </div> -->
                    <div class="change-photo">
                        <label for="imageInput" style="cursor: pointer;">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <input type="file" id="imageInput" accept="image/*" style="display: none">
                    </div>

                </div>
            </div>

            <!-- Form for Services -->
            <form action="update-discover.php" method="post" enctype="multipart/form-data" class="edit-discover-details update-discover-form edit-service-details">
                <div class="input-details-view">
                    <input type="hidden" name="item_type" value="service">
                    <input type="hidden" name="service_id" value="">
                    <div class="input-flex">
                        <input type="text" name="service_name" placeholder="Enter service name..">
                    </div>
                    <textarea name="service_description" placeholder="Enter service description.."></textarea>
                    <input type="hidden" name="discover_image" value="">
                </div>
                <div class="option-buttons">
                    <button class="del-btn" onclick="deleteDiscover('service')">Delete</button>
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>

            <!-- Form for Souvenirs -->
            <form action="update-discover.php" method="post" enctype="multipart/form-data" class="edit-discover-details update-discover-form edit-souvenir-details">
                <div class="input-details-view">
                    <input type="hidden" name="item_type" value="souvenir">
                    <input type="hidden" name="item_id" value="">
                    <div class="input-flex">
                        <input type="text" name="item_name" placeholder="Enter souvenir name..">
                    </div>

                    <textarea name="souvenir_description" placeholder="Enter souvenir description.."></textarea>

                    <input type="hidden" name="discover_image" value="">
                </div>
                <div class="option-buttons">
                    <button class="del-btn" onclick="deleteDiscover('souvenir')">Delete</button>
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </section>
</body>