<?php
    session_name("admin_session");
    session_start();
    error_reporting(E_ALL);
    require_once("../connection.php");
    if (!isset($_SESSION['admin_id'])) {
        header("location: ../guest_side/login.php");
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "trinitas";
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM feedback";
    $result = mysqli_query($connection, $query);

    if (isset($_POST['applyFilter'])) {
        $filterRating = $_POST['filterRating'];
    
        // Modify your SQL query for filtering process
        $query = "SELECT * FROM feedback WHERE 1 ";
    
        if ($filterRating !== 'all') {
            $query .= "AND rating = '$filterRating' ";
        }
    
        $result = mysqli_query($connection, $query);
    } else {
        // If no filter is applied, retrieve all feedback
        $query = "SELECT * FROM feedback";
        $result = mysqli_query($connection, $query);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Feedback</title>

</head>

<body>
   <?php 
        include("./admin_sidebar.php");
    ?>

    <!------------------------------------------------- START OF REVIEWS AND RATINGS--------------------------------------------------->
    
        
    <section class="reviews">
        <div class="reviews-container">
            <div class="col-md-8 offset-md-2">
                <div class="user_reviews">
                    <h1>Reviews and Ratings</h1>
                        <form class="filter-container" id="filterForm" method="post">
                            <label for="filterRating">Filter by Rating:</label>
                            <select class = "filter_option" name="filterRating" id="filterRating">
                                <option class="filter_value" value="all">All Star Ratings</option>
                                <option class="filter_value" value="5">5 Stars</option>
                                <option class="filter_value" value="4">4 Stars</option>
                                <option class="filter_value" value="3">3 Stars</option>
                                <option class="filter_value" value="2">2 Stars</option>
                                <option class="filter_value" value="1">1 Star</option>
                            </select>
                            <button class="btn btn-search search-button" type="submit" name="applyFilter">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                </div>
                <?php
                // Loop through the fetched feedbacks and generate review cards
                while ($row = mysqli_fetch_assoc($result)){
                        $feedback_id = $row['feedback_id'];
                        $user_id = $row['user_id'];
                        $name = $row['name'];
                        $feedback_message = $row['feedback_message'];
                        $rating = $row['rating'];
                        $anonymous = $row['anonymous'];
                        $timestamp = $row['timestamp'];

                        //Modify the timestap format
                        $formattedTimestamp = date("M j, Y h:i A", strtotime($timestamp));
                    ?> 
        <!------------------------------------------------- REVIEW CARDS --------------------------------------------------->

        <div class="review-card" data-review-id="<?php echo $reviewId; ?>">
                    <div class="user-profile">
                        <div class="posted">
                            <div class="profile-pic">
                                <img src="../images/user.png" width="45px" height="45px" alt="" srcset="">
                            </div>
                            <div class="profile-details">
                                <h5><?php echo $anonymous == 1 ? substr($name, 0, 1) . str_repeat("*", strlen($name) - 1) : $name; ?></h5>
                                <p><?php echo $formattedTimestamp; ?></p>
                            </div>
                        </div>
                        <div class="star-rating">
                            <span class="material-symbols-rounded">
                                <?php
                                // Fetch the star ratings from the database
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        } else {
                                            echo '<i class="fa-regular fa-star"></i>';
                                        }
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="review-description">
                        <p><?php echo $feedback_message; ?></p>
                    </div>
                    <hr>
                    <div class="review-actions col-md-12 d-grid gap-0 d-md-flex justify-content-md-center">
                        <div class="reply">
                            <button class="btn btn-reply reply-button" name="reply" type="reply" data-feedback-id="<?php echo $feedback_id; ?>">
                                <i class="fa-solid fa-reply"></i>Reply
                            </button>
                            <!-- Reply Section but still not finished-->
                            <div class="reply-section" id="reply_section_<?php echo $feedback_id; ?>">
                                <div class="reply-field">
                                    <textarea name="reply_text" id="reply_text_<?php echo $feedback_id; ?>"
                                        placeholder="Write your reply here..."></textarea>
                                    <button class="btn-send-reply send-reply-button" data-feedback-id="<?php echo $feedback_id; ?>">Send</button>
                                </div>
                            </div>
                            <div class="reply-container" id="reply_container_<?php echo $feedback_id; ?>"></div>
                        </div>
                        <!-- <button class="btn btn-share-feedback" type="button">Share</button> -->
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="reach-bottom-text">
                    <p>You have reached the bottom of the page!</p>
                </div>
            </div>
        </div>
    </section>
 <!------------------------------------------------- END OF REVIEWS AND RATINGS --------------------------------------------------->

</body>

<script src="./js/users.js"></script>
<script src="./js/admin-chat.js"></script>
<script src="./js/search.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="./js/sidebar-animation.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const replyButtons = document.querySelectorAll(".reply-button");
        replyButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                const feedbackId = button.getAttribute("data-feedback-id");
                const replySection = document.getElementById(`reply_section_${feedbackId}`);
                const replyContainer = document.getElementById(`reply_container_${feedbackId}`);

                if (replySection.style.display === "none" || replySection.style.display === "") {
                    replySection.style.display = "block";
                    button.style.display = "none";
                } else {
                    replySection.style.display = "none";
                }
            });
        });

        const sendButtons = document.querySelectorAll(".send-reply-button");
        sendButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                const feedbackId = button.getAttribute("data-feedback-id");
                const replyText = document.querySelector(`#reply_text_${feedbackId}`).value;

                // Create a new div element to display the reply
                const replyDiv = document.createElement("div");
                replyDiv.className = "reply-content";
                replyDiv.innerHTML = `<strong>Your Reply:</strong>  ${replyText}`;

                const replyContainer = document.getElementById(`reply_container_${feedbackId}`);
                replyContainer.appendChild(replyDiv);

                document.querySelector(`#reply_text_${feedbackId}`).value = "";

                const replySection = document.getElementById(`reply_section_${feedbackId}`);
                replySection.style.display = "none";

                event.preventDefault();
            });
        });
    });
</script>
</html>