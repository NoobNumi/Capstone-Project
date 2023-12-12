<?php

session_name("user_session");
session_start();

require_once("../connection.php");
require "../fetch_counts_query.php";
require_once("serviceCategory_modal.php");

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "trinitas");
$test = array();
$count = 0;
$res = mysqli_query($link, "select * from chart");
while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["type"];
    $test[$count]["y"] = $row["count"];
    $count = $count + 1;
}

$filterCondition = "1";
$filterRating = null;

if (isset($_POST['applyFilter'])) {
    $filterRating = $_POST['filterRating'];

    if ($filterRating !== 'all') {
        $filterCondition = "rating = :filterRating";
    }
}

// Fetch feedback based on the filter condition
$query = "SELECT feedback.*, users.profile_picture 
          FROM feedback 
          LEFT JOIN users ON feedback.user_id = users.user_id 
          WHERE $filterCondition 
          ORDER BY feedback.timestamp DESC";
$stmt = $conn->prepare($query);

if ($filterRating !== null && $filterRating !== 'all') {
    $stmt->bindParam(':filterRating', $filterRating);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME CDN LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.ico">
    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- GOOGLE CDN LINK -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <!-- SWIPER CDN LINKS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- MAIN STYLE (GUEST-SIDE) -->
    <link rel="stylesheet" href="css/guest-style.css">
    <title>Home</title>
</head>
<script>
    window.onload = function() {
        var currentDate = new Date();
        var currentMonth = currentDate.toLocaleString('default', {
            month: 'long'
        });
        var currentYear = currentDate.getFullYear();

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Reservation for the month of " + currentMonth + " " + currentYear
            },
            axisY: {
                title: "Reservation"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## reservations",
                dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>

<body>
    <!------------------ NAVBAR LINK and LOGOUT MODAL----------------->
    <?php
    include("guest_navbar.php");
    include("notification-bar.php");
    include("logout_modal.php");
    ?>

    <script>
        const navCheck = document.getElementById("nav-check");
        const profileSelect = document.querySelector(".profile-select");

        function handleProfileSelectVisibility() {
            if (window.innerWidth <= 1064) {
                if (navCheck.checked) {
                    profileSelect.style.visibility = "visible";
                } else {
                    profileSelect.style.visibility = "hidden";
                }
            } else {
                profileSelect.style.visibility = "visible";
            }
        }
        navCheck.addEventListener("change", handleProfileSelectVisibility);

        window.addEventListener("resize", handleProfileSelectVisibility);

        handleProfileSelectVisibility();

        document.addEventListener("DOMContentLoaded", function() {
            const profileImage = document.getElementById("profile-image");
            const dropdownContent = document.querySelector(".dropdown-content");

            profileImage.addEventListener("click", function(event) {
                event.stopPropagation();
                dropdownContent.classList.toggle("show-dropdown");
            });

            window.addEventListener("click", function() {
                dropdownContent.classList.remove("show-dropdown");
            });
        });
    </script>
    <!------------------ MAIN CONTENT ----------------->
    <div class="main">
        <div class="service-content">
            <h1 class="home-title"> Psalm 77:6</h1>
            <p class="verse">“I said, “Let me remember my song in the night; <br> let me meditate in my heart.” <br>
                Then my
                spirit made a diligent search.”</p>
            <br>
            <div class="service-buttons">
                <a href="select_package.php" class="btn-services">Reserve Now</a>
                <a class="btn-services" type="button" href="appointment.php">Make an appointment</a>
            </div>
        </div>
    </div>
    <!-- Reviews section -->
    <!-- Reviews section -->
    <div class="content-below">
        <h1>Customer Reviews</h1>
        <p>What our customers say about Trinitas</p>
    </div>
    <div class="user-reviews">
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
                <?php
                $counter = 0;
                foreach ($result as $row) {
                    $feedback_id = $row['feedback_id'];
                    $user_id = $row['user_id'];
                    $name = $row['name'];
                    $feedback_message = $row['feedback_message'];
                    $rating = $row['rating'];
                    $anonymous = $row['anonymous'];
                    $timestamp = $row['timestamp'];
                    $profile_picture = $row['profile_picture'];

                    $formattedTimestamp = date("M j, Y h:i A", strtotime($timestamp));
                    echo '<div class="swiper-slide">';
                    echo '<div class="review-card" data-review-id="' . $feedback_id . '">';
                    echo '<div class="user-profile">';
                    echo '<div class="posted">';
                    echo '<div class="profile-pic">';
                    if ($anonymous == 0) {
                        echo '<img src="../guest_side/' . $profile_picture . '" width="35px" height="35px" alt="" style="border-radius: 50%;">';
                    } else {
                        echo '<img src="../images/user.png" width="35px" height="35px" alt="" style="border-radius: 50%;">';
                    }
                    echo '</div>';
                    echo '<div class="profile-details">';
                    echo '<h5>' . ($anonymous == 1 ? substr($name, 0, 1) . str_repeat("*", strlen($name) - 1) : $name) . '</h5>';
                    echo '<p>' . $formattedTimestamp . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="star-rating">';
                    echo '<span class="material-symbols-rounded">';
                    for ($i = 1; $i <= 5; $i++) {
                        echo ($i <= $rating) ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
                    }
                    echo '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="review-description">' . $feedback_message . '</p>';
                    echo '</div>';
                    echo '</div>';

                    $counter++;
                }
                ?>
            </div>
            <div class="swiper-pagination" style="display: none;"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <br />
        </div><br>
        <div class="row text-center">
            <div class="col">
                <div class="counter">
                    <i class="fa fa-users fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?php echo $userCount; ?>" data-speed="1500"></h2>
                    <p class="count-text ">Customer</p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <i class="fa fa-home fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?php echo $totalReservations; ?>" data-speed="1500"></h2>
                    <p class="count-text ">Reservations</p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <i class="fa fa-flag fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?php echo $appointmentCount; ?>" data-speed="1500"></h2>
                    <p class="count-text ">Appointments</p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <i class="fa fa-message fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?php echo $fbCount; ?>" data-speed="1500"></h2>
                    <p class="count-text ">Feedbacks</p>
                </div>
            </div>
        </div>
    </div><br>
    <div class="content-below">
        <div class="latest-announcements">
            <?php
            function formatTimestamp($timestamp)
            {
                return date('F j, Y', strtotime($timestamp));
            }

            try {
                $query = "SELECT a.announcement_id, a.post_content, a.timestamp, a.is_admin, MIN(i.announcement_id) as min_announcement_id, i.img_url_path
                        FROM announcements a
                        LEFT JOIN announcement_image i ON a.announcement_id = i.announcement_id
                        GROUP BY a.announcement_id
                        ORDER BY a.timestamp DESC";
                $stmt = $conn->query($query);

                if ($row = $stmt->fetch()) {
                    echo '<div class="latest-post" style="line-height: 3rem;">';
                    echo '<h1>';
                    echo 'Latest Announcements';
                    echo '<span class="material-symbols-rounded" id="home_icons">campaign</span>';
                    echo '</h1>';
                    echo '<a href="announcements.php">See all Announcements</a>';
                    echo '<img src="' . $row['img_url_path'] . '" class="image-latest-announce">';
                    echo '<p class="date-posted">' . formatTimestamp($row['timestamp']) . '</p>';
                    echo '<p class="post-content">' . implode(' ', array_slice(explode(' ', $row['post_content']), 0, 10)) . '...</p>';
                    echo '</div>';

                    echo '<div class="other-posts">';
                    echo '<ul class="other-announcements">';
                    $count = 0;
                    while ($row = $stmt->fetch()) {
                        if ($count < 4) {
                            echo '<li>';
                            echo '<img src="' . $row['img_url_path'] . '">';
                            echo '<div class="text-announce">';
                            echo '<p class="date-posted">' . formatTimestamp($row['timestamp']) . '</p>';
                            echo '<p class="post-content">' . implode(' ', array_slice(explode(' ', $row['post_content']), 0, 10)) . '...</p>';
                            echo '</div>';
                            echo '</li>';
                            $count++;
                        } else {
                            break;
                        }
                    }
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<p>No announcements found.</p>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>

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
            <img src="/Trinitas_Capstone_(FINAL)/images/main.jpg" class="image" alt="">
            <img src="/Trinitas_Capstone_(FINAL)/images/newImage.jpg" class="image" alt="">
            <img src="/Trinitas_Capstone_(FINAL)/images/img10.jpg" class="image" alt="">
            <img src="/Trinitas_Capstone_(FINAL)/images/img3.jpg" class="image" alt="">

        </div>
        <div class="popup-img">
            <span>&times;</span>
            <img src="images/main.jpg" alt="">
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
        <div class="charts">
            <div class="row">
                <div class="col-12">
                    <div class="graph-card">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!------------------- EMBEDDED MAP ---------------->
    <div class="content-below">
        <h1>Trinitas Map
            <span class="material-symbols-rounded" id="home_icons">
                map
            </span>
        </h1>
        <p>Located in Bonga, Bacacay, Albay</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3883.180983304116!2d123.75209207476742!3d13.276627987067506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1aba244e95adb%3A0x36f1747b0fa5984d!2sTrinitas%20Home%20for%20Contempation!5e0!3m2!1sen!2sph!4v1685781667578!5m2!1sen!2sph" width="100%" height="450" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!------------------ FOOTER LINKS  ------------->
    <?php include("guest_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 'auto',
            spaceBetween: 25,
            loop: true,
            centeredSlides: true,
            fadeEffect: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 1000, // Adjust the speed (in milliseconds) for slow motion
            direction: 'horizontal', // Set the sliding direction to left
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                950: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

    <!----------------- JQuery link ---------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>




    <script src="./js/populateNotification.js"></script>
    <!------------- BOOTSTRAP SCRIPT CDN LINK --------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


    <!------------- CHARTS CDN LINK --------------->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/data_visualization.js"></script>


    <!----------- PHOTO GALLERY SCRIPT LINK -------------->
    <script src="./js/photo_gallery.js"></script>


    <!----------- MESSAGE NOTIFICATION ------------->
    <script src="./js/notification.js"></script>

    <!----------- RESERVE NOW MODAL ------------->
    <script src="./js/services_photos.js"></script>

    <!----------- RESERVE NOW MODAL ------------->
    <script src="./js/services_photos.js"></script>
    <script src="./js/feedback_home.js"></script>
</body>

</html>