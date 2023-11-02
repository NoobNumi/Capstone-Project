<body>
    <div class="view-package-section" id="trainingPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    TRAINING PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="trainingCloseBtn"></i>
            </div>

            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $trainingAmenities = getAmenitiesByPackageId(3); 
                            foreach ($trainingAmenities as $amenity) {
                                echo '<li class="ammenity"><i class="' . $amenity['amenity_icon'] . '"></i><p>' . $amenity['amenity_name'] . '</p></li>';
                            }
                            ?>
                        </ul>
                    </div>
                   
                    <div class="package-carousel">
                        <div class="package-carousel-container">
                            <div class="package-carousel-slides images">
                                <img src="../images/IMG20230907152629.jpg" class="carousel-image-pkg">
                                <img src="../images/IMG20230907153519.jpg" class="carousel-image-pkg">
                                <img src="../images/IMG20230907153544.jpg" class="carousel-image-pkg">
                                <img src="../images/img17.jpg" class="carousel-image-pkg">
                                <img src="../images/img3.jpg" class="carousel-image-pkg">
                            </div>
                            <button class="carousel-button-img prev-btn"><i class="fa-solid fa-caret-left"></i></button>
                            <button class="carousel-button-img next-btn"><i
                                    class="fa-solid fa-caret-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-meal">
                <a href="#" class="view-meal-btn">View Meal Choices</a>
            </div>
        </div>
    </div>
    <script src="./js/package_modal.js"></script>
</body>