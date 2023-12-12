<?php
require_once("../connection.php");
require_once("fetch_packages.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$user_id = $_SESSION['user_id'];


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <link rel="stylesheet" href="./css/reservation-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Reservation</title>
</head>
<style type="text/css">
    @import url('http://getbootstrap.com/dist/css/bootstrap.css');
    @media (min-width: 768px) {
        .row {
            position: relative;
        }

        /* #read-more {
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .col-sm-7 {
            position: absolute;
            width: 100%;
            height: 100%;
        } */
    }
</style>

<body>
    <?php
    include("guest_navbar.php");
    include("notification-bar.php");
    include("logout_modal.php");
    ?>
    <br><br>
    <div class="main-reservation">
        <p class="reservation-title">Select Package</p>
        <div class="reservation-section-part">
            <?php $sql = "SELECT *
        FROM packages";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $i = 1; ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="container-packages">
                    <div class="card">
                        <div class="row ">
                            <div class="card-container">
                                <div class="package-carousel">
                                    <div id="carouselExampleCaptions<?php echo $i; ?>" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" data-bs-interval="2000">
                                                <img src="../images/IMG20230907152629.jpg" class="carousel-image-pkg">
                                            </div>
                                            <?php
                                            $Images = getImagesByPackageId($i);
                                            foreach ($Images as $image) {
                                                echo '<div class="carousel-item" data-bs-interval="2000">
                                            <img src="../' . $image['image_path'] . '"" class="carousel-image-pkg">
                                            </div>';
                                                //echo $image['image_path'];
                                            }
                                            ?>

                                            <div class="carousel-item" data-bs-interval="2000">
                                                <img src="../images/IMG20230907153544.jpg" class="carousel-image-pkg">
                                            </div>
                                            <div class="carousel-item" data-bs-interval="2000">
                                                <img src="../images/img17.jpg" class="carousel-image-pkg">
                                            </div>
                                            <div class="carousel-item" data-bs-interval="2000">
                                                <img src="../images/img3.jpg" class="carousel-image-pkg">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions<?php echo $i; ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions<?php echo $i; ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                        <span class="price-package"><?php echo '₱ ' . number_format($row['price'], 2); ?></span>
                                    </div>
                                   
                                    <h4 class="package-title text-center">
                                        <?php echo $row['name']; ?><br>
                                    </h4>
                                </div>
                                <input type="hidden" name="package" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                            </div>
                            <div class="card-block">
                                <div class="about-package">
                                    <h5 class="this-content-title">Ammenities</h5>
                                    <ul class="package-ammenities">
                                        <?php
                                        $casaAmenities = getAmenitiesByPackageId($i);
                                        foreach ($casaAmenities as $amenity) {
                                            echo '<li class="ammenity"><i class="' . $amenity['amenity_icon'] . '"></i><p>' . $amenity['amenity_name'] . '</p></li>';
                                        }
                                        ?>
                                    </ul>
                                    <a href="select_package2.php?id=<?php echo $row['package_id']; ?>" class="btn btn-primary select-button" role="button">Select</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const amenitiesLists = document.querySelectorAll('.package-ammenities');

        amenitiesLists.forEach((amenitiesList) => {
            let isDraggingAmenities = false;
            let startXAmenities;
            let scrollLeftAmenities;

            amenitiesList.addEventListener("mousedown", startDraggingAmenities);
            amenitiesList.addEventListener("touchstart", startDraggingAmenities);

            amenitiesList.addEventListener("mouseup", stopDraggingAmenities);
            amenitiesList.addEventListener("mouseleave", stopDraggingAmenities);
            amenitiesList.addEventListener("touchend", stopDraggingAmenities);

            amenitiesList.addEventListener("mousemove", moveScrollAmenities);
            amenitiesList.addEventListener("touchmove", moveScrollAmenities);

            function startDraggingAmenities(e) {
                isDraggingAmenities = true;
                startXAmenities = e.clientX || e.touches[0].clientX;
                scrollLeftAmenities = amenitiesList.scrollLeft;
            }

            function stopDraggingAmenities() {
                isDraggingAmenities = false;
            }

            function moveScrollAmenities(e) {
                if (!isDraggingAmenities) return;
                e.preventDefault();
                const x = e.clientX || e.touches[0].clientX;
                const walk = (x - startXAmenities) * 2;
                amenitiesList.scrollLeft = scrollLeftAmenities - walk;
            }
        });
    </script>
    <script src="./js/populateNotification.js"></script>
    <script src="./js/notification.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>