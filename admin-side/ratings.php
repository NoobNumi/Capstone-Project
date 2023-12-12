<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

date_default_timezone_set('Asia/Manila');
session_name("admin_session");
session_start();
if (isset($_SESSION['admin_id'])) {
    require_once("../connection.php");
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require_once("../connection.php");
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
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

// Calculate total reviews count
$totalReviewsQuery = "SELECT COUNT(*) AS totalReviews FROM feedback";
$totalReviewsStmt = $conn->query($totalReviewsQuery);
$totalReviewsData = $totalReviewsStmt->fetch(PDO::FETCH_ASSOC);
$totalReviews = $totalReviewsData['totalReviews'];

$query = "SELECT AVG(rating) AS averageRating, rating, COUNT(rating) AS count
            FROM feedback
            GROUP BY rating";
$stmt = $conn->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$averageRating = count($data) > 0 ? array_sum(array_map(function ($row) {
    return (float)$row['rating'] * $row['count'];
}, $data)) / $totalReviews : 0;

$ratings = [];
foreach ($data as $row) {
    $ratings[$row['rating']] = $row['count'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Feedback</title>

</head>


<body style="overflow-x: hidden;">
    <!------------------------------------------------- START OF RATINGS OVERVIEW --------------------------------------------------->
    <section class="ratings-overview">
        <?php include("./admin_sidebar.php"); ?>
        <div class="ratings-container">
            <div class="col-md-8 offset-md-2">
                <div class="rating-overview">
                    <h2>Ratings Overview</h2>
                    <div id="average-rating"><?php echo round($averageRating, 1); ?>
                        <span class="material-symbols-rounded">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $averageRating) {
                                    echo '<i class="fa-solid fa-star"></i>';
                                } else {
                                    echo '<i class="fa-regular fa-star"></i>';
                                }
                            }
                            ?>
                        </span>
                        <div id="total-reviews"><?php echo $totalReviews; ?> reviews</div>
                    </div>
                    <div id="rating-breakdown">
                        <?php
                        for ($i = 5; $i >= 1; $i--) {
                            $width = ($ratings[$i] ?? 0) / $totalReviews * 100;
                            echo '<div class="rating-row">';
                            echo '<span class="stars">' . $i . '    ' . '<i class="fa-solid fa-star"></i>' . '</span>';
                            echo '<div class="bar"><div style="width:' . $width . '%"></div></div>';
                            echo '<span class="count">' . ($ratings[$i] ?? 0) . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!------------------------------------------------- START OF USER REVIEWS --------------------------------------------------->
    <section class="user-reviews">
        <div class="reviews-container">
            <div class="col-md-8 offset-md-2">
                <div class="user_reviews">
                    <h1>Customer Reviews</h1>
                    <form class="filter-container" id="filterForm" method="post">
                        <label for="filterRating">Filter by Rating:</label>
                        <select class="filter_option" name="filterRating" id="filterRating">
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
                ?>
                    <div class="review-card" data-review-id="<?php echo $reviewId; ?>">
                        <div class="user-profile">
                            <div class="posted">
                                <div class="posted">
                                    <div class="profile-pic">
                                        <?php if ($anonymous == 0) { ?>
                                            <img src="../guest_side/<?php echo $profile_picture; ?>" width="45px" height="45px" alt="" style="border-radius: 50%;">
                                        <?php } else { ?>
                                            <img src="../images/user.png" width="45px" height="45px" alt="" style="border-radius: 50%;">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="profile-details">
                                    <h5><?php echo $anonymous == 1 ? substr($name, 0, 1) . str_repeat("*", strlen($name) - 1) : $name; ?></h5>
                                    <p><?php echo $formattedTimestamp; ?></p>
                                </div>
                            </div>
                            <div class="star-rating">
                                <span class="material-symbols-rounded">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        } else {
                                            echo '<i class="fa-regular fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </span>
                                <span class="vertical-line"></span>
                                <?php
                                echo '<i class="fa-regular fa-trash-can delete-review" data-review-id="' . $feedback_id . '"></i>';
                                ?>
                            </div>

                        </div>
                        <div class="review-description">
                            <p><?php echo $feedback_message; ?></p>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-review')) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const reviewId = event.target.getAttribute('data-review-id');

                            $.ajax({
                                type: 'POST',
                                url: 'ratings_delete.php',
                                data: {
                                    reviewId: reviewId
                                },
                                dataType: 'json',
                                success: function(data) {
                                    console.log("Delete Success:", data);


                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'Review deleted successfully!',
                                            onClose: () => {
                                                window.location.href = "ratings.php";
                                            }
                                        });
                                    } else {
                                        console.error("Error deleting item:", data.message);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'An error occurred while deleting. Please try again.'
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error deleting item:", status, error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'An error occurred while deleting. Please try again.'
                                    });
                                },
                                complete: function(xhr, status) {
                                    console.log("Complete:", status);
                                }
                            });
                        }
                    });
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const totalReviews = <?php echo json_encode($totalReviews); ?>;
            const ratings = <?php echo json_encode($ratings); ?>;

            // Calculate the average rating
            const totalRating = ratings.reduce((acc, value, index) => acc + value * index, 0);
            const totalStars = ratings.reduce((acc, value) => acc + value, 0);

            const averageRating = totalStars === 0 ? 0 : totalRating / totalStars;
            const roundedAverageRating = Math.floor(averageRating);
            const decimalPart = averageRating - roundedAverageRating;

            let averageRatingHtml = '';
            for (let i = 0; i < roundedAverageRating; i++) {
                averageRatingHtml += '<i class="fa-solid fa-star"></i>';
            }

            // Check if there is a decimal part to add a half-star
            if (decimalPart >= 0.5) {
                averageRatingHtml += '<i class="fa-solid fa-star-half"></i>';
            }

            document.getElementById('average-rating').innerHTML = averageRatingHtml;
            document.getElementById('total-reviews').textContent = totalReviews + ' reviews';

            const ratingBreakdownContainer = document.getElementById('rating-breakdown');
            ratingBreakdownContainer.innerHTML = '';

            for (let i = 5; i >= 1; i--) {
                const row = document.createElement('div');
                row.className = 'rating-row';
                row.innerHTML = `
                        <span class="stars">${'<i class="fa-solid fa-star"></i>'.repeat(i)}</span>
                        <div class="bar"><div style="width:${(ratings[i] || 0) / totalReviews * 100}%"></div></div>
                        <span class="count">${ratings[i] || 0}</span>`;
                ratingBreakdownContainer.appendChild(row);
            }
        });
    </script>
</body>

</html>