<body>
    <!-- CASA MARIA RETREAT PACKAGES MODAL -->
    <div class="view-package-section" id="casaPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    CASA MARIA RETREAT PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="casaCloseBtn"></i>
            </div>

            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $casaAmenities = getAmenitiesByPackageId(1); 
                            foreach ($casaAmenities as $amenity) {
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

    <!-- LUNDUYAN RETREAT PACKAGE MODAL-->
    <div class="view-package-section" id="lunduyanPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    LUNDUYAN RETREAT PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="lunduyanCloseBtn"></i>
            </div>
            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">
                            What This Package Offers?
                        </h5>
                        <ul class="package-ammenities" id="lunduyanAmenities">
                            <?php
                            $lunduyanAmenities = getAmenitiesByPackageId(2);
                            foreach ($lunduyanAmenities as $amenity) {
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
            <div class="button-reserve">
                <a href="#" class="venue-reserve-btn">View Meal Choices</a>
            </div>
        </div>
    </div>

    <!-- RECOLLECTION PACKAGE MODAL -->
    <div class="view-package-section" id="recollectionPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    RECOLLECTION PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="recollectionCloseBtn"></i>
            </div>

            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $recollectionAmenities = getAmenitiesByPackageId(3); 
                            foreach ($recollectionAmenities as $amenity) {
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
    
    
    <!-- RECEPTION CATERING PACKAGE MODAL -->
    <div class="view-package-section" id="cateringPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    CATERING PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="cateringCloseBtn"></i>
            </div>
            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $cateringAmenities = getAmenitiesByPackageId(4); 
                            foreach ($cateringAmenities as $amenity) {
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


    <!-- RECEPTION VENUE-ONLY PACKAGE -->
    <div class="view-package-section" id="venuePackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    VENUE-ONLY PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="venueCloseBtn"></i>
            </div>
            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">
                            What This Package Offers?
                        </h5>
                        <ul class="package-ammenities" id="venueAmenities">
                            <?php
                            $venueAmenities = getAmenitiesByPackageId(5);
                            foreach ($venueAmenities as $amenity) {
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
            <div class="button-reserve">
                <a href="#" class="venue-reserve-btn">Reserve Now</a>
            </div>
        </div>
    </div>
    

    <!-- SEMINAR PACKAGE MODAL -->
    <div class="view-package-section" id="seminarPackageModal">
        <div class="view-package-modal">
            <div class="header-modal-package">
                <h4 class="package-title">
                    SEMINAR PACKAGE
                </h4>
                <i class="fa-solid fa-xmark" id="seminarCloseBtn"></i>
            </div>

            <div class="view-package-modal-content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $seminarAmenities = getAmenitiesByPackageId(7); 
                            foreach ($seminarAmenities as $amenity) {
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


    <!-- TRAINING PACKAGE MODAL -->
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