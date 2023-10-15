<?php
require_once("../connection.php");
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
    <title>Reception</title>
</head>

<body style="overflow-x: hidden;">
    <?php include("guest_navbar.php"); ?>

    <section class="reception-reserve reserve">
        <div class="res-header">
            <h4 class="reservation-name">Reception </h4>
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
                <img src="../images/img10.jpg">
            </div>
            <div class="images">
                <img src="../images/img25.jpg">
            </div>
            <div class="images">
                <img src="../images/img18.jpg">
            </div>
            <div class="images">
                <img src="../images/img17.jpg">
            </div>
            <div class="images">
                <img src="../images/img3.jpg">
            </div>
        </div>
        <div class="img-carousel">
            <div class="carousel-container">
                <div class="carousel-slides images">
                    <img src="../images/img10.jpg" class="carousel-image">
                    <img src="../images/img25.jpg" class="carousel-image">
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
                            <img src="/images/IMG20230907152614.jpg" alt="" class="package-image">
                            <div class="reserve-btn-section">
                                <button class="reserve-now">
                                <i class="fa-solid fa-book-open"></i>Book now
                                </button>
                            </div>

                        </div>
                        <div class="right-side-package">
                            <div class="package-title">
                                <div class="package-header">
                                    <h5>Lunduyan Retreat Package</h5>
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
</body>