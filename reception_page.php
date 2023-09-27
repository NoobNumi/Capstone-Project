<?php
require_once("../connection.php");
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
<style>
    .reserve {
        width: 100%;
        margin: auto 15px;
        overflow-x: hidden;
    }

    .res-header {
        margin-top: 40px;
        text-align: start;
        justify-content: space-between;
        align-items: center;
        display: flex;
        padding: 0 100px 0 100px;
    }

    .rating-container {
        display: flex;
        align-items: center;
        justify-content: start;
        padding: 0 100px 0 79px;
    }

    .reservation-name {
        position: relative;
    }

    .img-grid {
        display: grid;
        grid-gap: .5em;
        grid-template-areas:
            "photoOne photoTwo photoThree"
            "photoOne photFour photoFive";
        grid-template-columns: 1fr 20% 20%;
        padding: 20px 100px 20px 100px;
    }

    .images img {
        border-radius: 10px;
        height: 100%;
        width: 100%;
        object-fit: cover;
        object-position: center;
        cursor: pointer;
    }

    .img-grid>.images:first-child {
        grid-area: photoOne;
        height: 450px;
    }

    .service-des-container .logo-type-name {
        margin-bottom: 0;
    }

    .icon-tools {
        display: flex;
        gap: 10px;
    }

    .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
        text-align: center;
    }

    .image-modal .modal-content {
        max-width: 80%;
        max-height: 80%;
        margin: auto;
        display: block;
        margin-top: 10%;
    }

    .image-modal .close {
        position: absolute;
        top: 10px;
        right: 10px;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }



    .share-tool-res {
        cursor: pointer;
    }

    .package-title {
        padding: 20px 100px 0 100px;
    }

    .packages {
        position: relative;
        width: 100%;
        max-width: 800px;
        overflow: hidden;
        padding: 0 100px 0 100px;
    }

    .carousel-main {
        min-height: 50vh;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 100px 20px 100px;
    }

    .card-carousel {
        border-radius: 10px;
        background-color: #ffff;
        padding: 20px;
    }

    .card-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 14px;
    }

    .slide-container {
        flex-direction: column;
        position: relative;
        display: flex;

    }

    .buttons-carousel {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .buttons-carousel .btn-carousel i {
        font-size: 30px;
        margin: 10px;
        cursor: pointer;
        color: #235789;
    }
</style>

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
        <div class="image-modal" id="imageModal">
            <span class="close" id="closeModal">&times;</span>
            <img class="modal-content" id="modalImage">
        </div>
        <h5 class="package-title">Packages to choose from</h5>
        <div class="carousel-main">
            <div class="slide-container">
                <div class="slide-content">
                    <div class="card-wrapper">
                        <div class="card-carousel">
                            <div class="card-content">
                                <h4 class="package-name">Package1</h4>
                                <span class="offers">
                                    this are the amenities
                                </span>
                            </div>
                        </div>
                        <div class="card-carousel">
                            <div class="card-content">
                                <h4 class="package-name">Package1</h4>
                                <span class="offers">
                                    this are the amenities
                                </span>
                            </div>
                        </div>
                        <div class="card-carousel">
                            <div class="card-content">
                                <h4 class="package-name">Package1</h4>
                                <span class="offers">
                                    this are the amenities
                                </span>
                            </div>
                        </div>
                        <div class="card-carousel">
                            <div class="card-content">
                                <h4 class="package-name">Package1</h4>
                                <span class="offers">
                                    this are the amenities
                                </span>
                            </div>
                        </div>
                        <div class="card-carousel">
                            <div class="card-content">
                                <h4 class="package-name">Package1</h4>
                                <span class="offers">
                                    this are the amenities
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons-carousel">
                    <div class="btn-carousel back">
                        <i class="fa-solid fa-caret-left"></i>
                    </div>
                    <div class="btn-carousel next">
                        <i class="fa-solid fa-caret-right"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include("guest_footer.php"); ?>
    <script src="./js/services_photos.js"></script>
    <script>
        const carousel = document.querySelector(".package-carousel");
        const prevButton = document.getElementById("prev");
        const nextButton = document.getElementById("next");

        let currentIndex = 0;
        const cardWidth = document.querySelector(".card").offsetWidth;

        function updateCarousel() {
            carousel.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }

        function goToPrevCard() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        }

        function goToNextCard() {
            if (currentIndex < carousel.children.length - 1) {
                currentIndex++;
                updateCarousel();
            }
        }

        prevButton.addEventListener("click", goToPrevCard);
        nextButton.addEventListener("click", goToNextCard);
    </script>
</body>