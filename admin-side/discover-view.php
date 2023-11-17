<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                    <div class="change-photo" onclick="document.getElementById('imageInput').click();">
                        <input type="file" id="imageInput" accept="image/*" style="display: none">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
            </div>

            <!-- Form for Services -->
            <form action="update-discover.php" method="post" class="edit-discover-details update-discover-form edit-service-details" enctype="multipart/form-data">
                <div class="input-details-view">
                    <!-- Add this line -->
                    <input type="hidden" name="item_type" value="service">
                    <!-- Rest of the form for services -->

                    <input type="hidden" name="service_id" value="">
                    <div class="input-flex">
                        <input type="text" name="service_name" placeholder="Enter service name..">
                    </div>

                    <textarea name="service_description" placeholder="Enter service description.."></textarea>

                    <input type="hidden" name="discover_image" value="">
                </div>
                <div class="option-buttons">
                    <button class="del-btn" data-discover-id="">Delete</button>
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>

            <!-- Form for Souvenirs -->
            <form action="update-discover.php" method="post" class="edit-discover-details update-discover-form edit-souvenir-details" enctype="multipart/form-data">
                <div class="input-details-view">
                    <!-- Add this line -->
                    <input type="hidden" name="item_type" value="souvenir">
                    <!-- Rest of the form for souvenirs -->

                    <input type="hidden" name="item_id" value="">
                    <div class="input-flex">
                        <input type="text" name="item_name" placeholder="Enter souvenir name..">
                    </div>

                    <textarea name="souvenir_description" placeholder="Enter souvenir description.."></textarea>

                    <input type="hidden" name="discover_image" value="">
                </div>
                <div class="option-buttons">
                    <button class="del-btn" data-discover-id="">Delete</button>
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            const imageInput = document.getElementById('imageInput');
            const discoverImage = document.getElementById('discoverImage');
            const hiddenImageInput = document.querySelector('input[name="discover_image"]');
            const serviceForm = $('.edit-service-details');
            const souvenirForm = $('.edit-souvenir-details');

            imageInput.addEventListener('change', function() {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        discoverImage.src = e.target.result;
                        hiddenImageInput.value = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            })
            $("#closeDiscoverBtn").click(function() {
                $("#discoverModal").css("display", "none");
                $(document.body).css("overflow-y", "auto");
            });
            $(".view-btn").click(function() {
                console.log("Button clicked");
                const itemId = $(this).data("id");
                const itemType = $(this).data("type");
                console.log("Item ID:", itemId);
                console.log("Item Type:", itemType);

                $.ajax({
                    type: 'POST',
                    url: 'get_details.php',
                    data: {
                        fetch_details: true,
                        item_id: itemId,
                        item_type: itemType
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log("AJAX Request Successful - Data received:", data);

                        $("#discoverModal").css("display", "flex");
                        $("#discoverModal").css("position", "fixed");
                        $(document.body).css("overflow", "hidden");

                        if (itemType === "souvenir") {
                            console.log("Souvenir item clicked");
                            serviceForm.hide();
                            souvenirForm.show();

                            if (data.hasOwnProperty('error')) {
                                console.error("Error fetching souvenir details:", data.error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'An error occurred while fetching souvenir details. Please try again.'
                                });
                            } else {
                                $("#discoverModal .edit-details").text("Edit Souvenir Details");
                                $("#discoverModal input[name='item_id']").val(data['item_id']);
                                $("#discoverImage").attr("src", data['souvenir_img_path']);
                                $("#discoverModal input[name='item_name']").val(data['item_name']);
                                $("#discoverModal textarea[name='souvenir_description']").val(data['souvenir_description']);
                            }
                        } else if (itemType === "service") {
                            console.log("Service item clicked");
                            serviceForm.show();
                            souvenirForm.hide();

                            if (data.hasOwnProperty('error')) {
                                console.error("Error fetching service details:", data.error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'An error occurred while fetching service details. Please try again.'
                                });
                            } else {
                                $("#discoverModal .edit-details").text("Edit Service Details");
                                $("#discoverModal input[name='service_id']").val(data['service_id']);
                                $("#discoverImage").attr("src", data['img_path']);
                                $("#discoverModal input[name='service_name']").val(data['service_name']);
                                $("#discoverModal textarea[name='service_description']").val(data['service_description']);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching details:", status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while fetching item details. Please try again.'
                        });
                    }
                });
            });
        });
    </script>
</body>