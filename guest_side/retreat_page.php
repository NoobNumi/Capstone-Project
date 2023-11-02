<?php
    require_once("../connection.php");
    require_once("fetch_packages.php");
    session_name("user_session");
    session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME CDN LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- GOOGLE CDN LINK -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- MAIN STYLE (GUEST-SIDE) -->
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>Retreat</title>
</head>

<body style="overflow-x: hidden;">
    <?php
        include("packages_modal.php");
        include("guest_navbar.php");
        ?>
    <section class="retreat-reserve reserve">
        <div class="res-header">
            <h4 class="reservation-name">Retreat</h4>
            <div class="icon-tools">
                <div class="share-tool-res">
                    <i class="fa-solid fa-share-from-square"></i>
                    <span>Share</span>
                </div>
                <div class="share-tool-res">
                    <i class="fa-regular fa-bookmark"></i>
                    <span>Save</span>
                </div>
            </div>
        </div>
        <ul class="rating-container">
            <li class="service-des-container ratings">
                <span class="material-symbols-rounded star-filled">star</span>
                <span class="material-symbols-rounded star-filled">star</span>
                <span class="material-symbols-rounded star-filled">star</span>
                <span class="material-symbols-rounded star-filled">star</span>
                <span class="material-symbols-rounded">star_half</span>
                <p class="logo-type-name">4.9</p>
            </li>
        </ul>
        <div class="img-grid" id="photoArray">
            <div class="images">
                <img src="../images/IMG20230907152629.jpg">
            </div>
            <div class="images">
                <img src="../images/img19.jpg">
            </div>
            <div class="images">
                <img src="../images/IMG20230907154348.jpg">
            </div>
            <div class="images">
                <img src="../images/IMG20230907155120.jpg">
            </div>
            <div class="images">
                <img src="../images/IMG20230907155134.jpg">
            </div>
        </div>
        <div class="img-carousel">
            <div class="carousel-container">
                <div class="carousel-slides images">
                    <img src="../images/img19.jpg" class="carousel-image">
                    <img src="../images/img10.jpg" class="carousel-image">
                    <img src="../images/img18.jpg" class="carousel-image">
                    <img src="../images/img17.jpg" class="carousel-image">
                    <img src="../images/img3.jpg" class="carousel-image">
                </div>
                <button class="carousel-button prev-button"><i class="fa-solid fa-caret-left"></i></button>
                <button class="carousel-button next-button"><i class="fa-solid fa-caret-right"></i></button>
            </div>
        </div>

        <div class="image-modal" id="imageModal">
            <span class="close" id="closeModal">&times;</span>
            <img class="modal-content" id="modalImage">
        </div>
        <div class="customer-choice">
            <div class="packages">
                <h5 class="package-title">Packages to choose from</h5>
                <div class="package-list">
                    <div class="card-package">
                        <div class="left-side-package">
                            <img src="/images/casaMariaPackage.png" alt="" class="package-image" style="border-radius: 25px;">
                        </div>
                        <div class="right-side-package">
                            <div class="package-title">
                                <div class="package-header">
                                    <h5>CASA MARIA RETREAT PACKAGE</h5>
                                </div>
                            </div>
                            <div class="ammenity-info">
                                <?php
                                    $casaMariaPackage = getPackageDetails('Casa Maria Retreat Package');
                                    if ($casaMariaPackage) {
                                        echo '<p class="price">₱' . number_format($casaMariaPackage['price'], 2) . ' Per Head</p>';
                                        echo '<p class="package-description">' . $casaMariaPackage['description'] . '</p>';
                                    }
                                ?>
                            </div>
                            <div class="desktop-view-button">
                                <a href="#" class="button-view-details" id="openCasaButton">Views Package Details</a>
                            </div>
                            <div class="responsive-package-buttons">
                                <a href="#" class="button-view-details" id="openCasaButton">Views Package Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-package">
                        <div class="left-side-package">
                            <img src="../images/lunduyanPackage.png" alt="" class="package-image" style="border-radius: 25px;">
                        </div>
                        <div class="right-side-package">
                            <div class="package-title">
                                <div class="package-header">
                                    <h5>LUNDUYAN RETREAT PACKAGE</h5>
                                </div>
                            </div>
                            <div class="ammenity-info">
                                <?php
                                    $lunduyanPackage = getPackageDetails('Lunduyan Retreat Package');
                                    if ($lunduyanPackage) {
                                        echo '<p class="price">₱' . number_format($lunduyanPackage['price'], 2) . ' Per Head</p>';
                                        echo '<p class="package-description">' . $lunduyanPackage['description'] . '</p>';
                                    }
                                ?>
                            </div>
                            <div class="desktop-view-button">
                                <a href="#" class="button-view-details" id="openLunduyanButton">View Package Details</a>
                            </div>
                            <div class="responsive-package-buttons">
                                    <a href="#" class="button-view-details" id="openLunduyanButton">View Package Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("guest_footer.php"); ?>
    <script src="./js/services_photos.js"></script>
    <script src="./js/package_modal.js"></script>
</body>