<?php 
    include "../connection.php"; 
    include("reservation_category.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.css" integrity="sha512-s6khMl5GDS1HbQ5/SwL1wzMayPwHXPjKoBN5kHUTDqKEPkkGyEZWKyH2lQ3YO2q3dxueG3rE0NHjRawMHd2b6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Discover</title>
</head>

<body>
    <?php
    include "guest_navbar.php";
    include "logout_modal.php";
    ?>

    <section class="discover-part">
        <div class="discover-header">
            <div class="text-n-titles">
                <img src="/images/logo-name.png" alt="" class="brand">
                <h2 class="discover-title">Discover More</h2>
                <p class="discover-msg">
                    Know more about what<span class="brand-name inside">Trinitas'</span> offers
                </p>
                <div class="button-discover">
                    <a onclick="show_reserve_modal()" class="btn-discover reserve">Reserve Now</a>
                    <a href="aboutPage.php" class="btn-discover learn">Learn more</a>
                </div>
            </div>
            <div class="side-bg">
                <img src="/images/discover-photo.png" alt="" srcset="">
            </div>
        </div>
        <div class="showcase">
            <span class="showcase-title">Showcase</span>
            <p class="photo-dption">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, natus laboriosam. Possimus totam eligendi cupiditate tempore, expedita quibusdam nobis sit labore exercitationem facere atque, rem dignissimos! Rerum beatae repellat aspernatur?
            </p>
            <span class="souvenir-items-name">Souvenir Items<i class="fa-solid fa-bag-shopping"></i></span>

            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod1.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Birth Stones</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod4.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Rosaries</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod5.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Rosary Bracelets</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod10.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Books</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod11.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Bags</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="/images/prod8.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Umbrellas</h2>
                                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>


    <!------------------ FOOTER LINKS  ------------->
    <?php include "guest_footer.php"; ?>

    <!------------- BOOTSTRAP SCRIPT CDN LINK --------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>


    <!-- SWIPER JS LINK -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js" integrity="sha512-QwpsxtdZRih55GaU/Ce2Baqoy2tEv9GltjAG8yuTy2k9lHqK7VHHp3wWWe+yITYKZlsT3AaCj49ZxMYPp46iJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/swiper.js"></script>

</body>

</html>