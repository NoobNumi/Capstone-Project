<?php
    require_once("../connection.php");
    session_name("user_session");
    session_start();
    include("reservation_category.php");
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
    <title>Home</title>
</head>
<body>
    <!------------------ NAVBAR LINK and LOGOUT MODAL----------------->
    <?php 
        include("guest_navbar.php");
        include("logout_modal.php");
    ?>

    <!------------------ MAIN CONTENT ----------------->
    <div class="main">
        <div class="service-content">
            <h1 class="home-title"> Psalm 77:6</h1>
            <p class="verse">“I said, “Let me remember my song in the night; <br> let me meditate in my heart.” <br>
                Then my
                spirit made a diligent search.”</p>
            <br>
            <div class="service-buttons">
                <a class="btn-services" type="button" onclick="show_reserve_modal()">Reserve now</a>
                <a class="btn-services" type="button" href="appointment.php">Make an appointment</a>
            </div>
        </div>
    </div>

    <!------------------- PHOTOS GALLERY ---------------->
    <div class="content-below">
        <h1>Our venues
            <span class="material-symbols-rounded" id="home_icons">
                cottage
            </span>
        </h1>
        <p>Feel free to see the venues in Trinitas</p>
        <div class="gallery">
            <img src="../images/main.jpg" class="image" alt="">
            <img src="../images/newImage.jpg" class="image" alt="">
            <img src="../images/img10.jpg" class="image" alt="">
            <img src="../images/img3.jpg" class="image" alt="">

        </div>
        <div class="popup-img">
            <span>&times;</span>
            <img src="../imgs/main.jpg" alt="">
        </div>
        <center><a class="btn-services" type="button" href="photos.html">See Photos ></a></center>
    </div>


    <!-------------------- DASHBOARD ------------------>
    <div class="content-below">
        <h1>Total of reservations
            <span class="material-symbols-rounded" id="home_icons">
                leaderboard
            </span>
        </h1>
        <p>Monitored per month</p>
        <canvas id="myChart"></canvas>
    </div>



    <!------------------- EMBEDDED MAP ---------------->
    <div class="content-below">
        <h1>Trinitas Map
            <span class="material-symbols-rounded" id="home_icons">
                map
            </span>
        </h1>
        <p>Located in Bonga, Bacacay, Albay</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3883.180983304116!2d123.75209207476742!3d13.276627987067506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1aba244e95adb%3A0x36f1747b0fa5984d!2sTrinitas%20Home%20for%20Contempation!5e0!3m2!1sen!2sph!4v1685781667578!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!------------------ FOOTER LINKS  ------------->
    <?php include("guest_footer.php");?>

    <!----------------- JQuery link ---------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!------------- BOOTSTRAP SCRIPT CDN LINK --------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    
    
    <!------------- CHARTS CDN LINK --------------->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/data_visualization.js"></script>


    <!----------- PHOTO GALLERY SCRIPT LINK -------------->
    <script src="./js/photo_gallery.js"></script>


    <!----------- MESSAGE NOTIFICATION ------------->
    <script src="./js/notification.js"></script>

</body>
</html>