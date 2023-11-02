<?php
session_name("user_session");
session_start();

$user_id = 1;
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}

$feedbackText = $rating = "";
$currentTimestamp = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $feedbackText = $_POST['feedback-text'];

    if (isset($_POST['selectedRating'])) {
        $rating = $_POST['selectedRating'];
    } else {
        $error = "Please select a rating.";
    }
   
if (empty($feedbackText) || empty($rating)) {
        $error = "Please input your rating and feedback";
    } else {
        try {
            $host = 'localhost';
            $dbname = 'trinitas';
            $username = 'root';
            $password = '';
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userFirstName = $user['first_name'];
            $userLastName = $user['last_name'];
            $userName = $userFirstName . ' ' . $userLastName;

            $isAnonymous = isset($_POST['anonymous']) ? 1 : 0; 

            $insertStmt = $pdo->prepare("INSERT INTO feedback (user_id, name, feedback_message, rating, anonymous, timestamp) VALUES (:user_id, :name, :feedback_message, :rating, :anonymous, :timestamp)");
            $insertStmt->bindParam(':user_id', $_SESSION['user_id']);
            $insertStmt->bindParam(':name', $userName);
            $insertStmt->bindParam(':feedback_message', $feedbackText);
            $insertStmt->bindParam(':rating', $rating);
            $insertStmt->bindParam(':anonymous', $isAnonymous);
            $insertStmt->bindParam(':timestamp', $currentTimestamp); 
            
            if ($insertStmt->execute()) {
                $feedbackSubmitted = true; 
                header("location: guest_dashboard.php");
                echo '<script>var feedbackSubmitted = true;</script>';
                exit;
            } else {
                echo "Feedback submission failed. Please try again.";
            }            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">

    <title>Ratings</title>
</head>

<body>
    <?php
    include("sidebar.php");
    require("logout_modal.php");
    ?>

    <!-- GUEST FEEDBACK STARTS HERE -->
    <section class="send-feedback">
        <div class="feedback-container">
            <div class="feedback-header">
                <h5 class="feedback-title text-center">
                    Give us a feedback
                </h5>
                <span class="mb-3">
                    What do you think of our service?
                </span>
            </div>
            <!-- Thank you message (initially hidden) still not working -->
            <!-- <div class="thank-you-message" style="display: none;">
                <p>Thank you for your feedback!</p>
            </div> -->

            <div class="feedback-body">
                <div class="ratings">
                    <form id="feedbackForm" action="feedback.php" method="post">
                        <div class="rating">
                            <input type="radio" id="star5" name="selectedRating" value="5">
                            <label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="selectedRating" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="selectedRating" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="selectedRating" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="selectedRating" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                        <div class="feedback-text-box">
                            <textarea name="feedback-text" cols="20" rows="5" placeholder="Write your feedback here..."></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <label class="switch">
                                <input type="checkbox" id="anonymous-switch" name="anonymous">
                                <span class="slider"></span>
                            </label>
                            Rate Anonymously
                        </div>
                        
                        <?php if (isset($error)) : ?>
                        <!-- Error message display -->
                            <div class="alert alert-danger" style="color: red; display: flex-start; align-items: justified; font-weight: normal; padding: 10px; ">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-send-feedback" name="submit" type="submit">Submit</button>
                            <button class="btn btn-cancel-feedback" type="button" onclick="cancelFeedback()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./js/notification.js"></script>

<script>
    function cancelFeedback() {
        if (confirm("Are you sure you want to cancel the feedback submission?")) {
            window.location.href = "guest_dashboard.php";
        }
    }

    let guestSidebar = document.querySelector(".guest-sidebar");
    let closeBtn = document.querySelector("#guestMenu");

    closeBtn.addEventListener("click", () => {
        guestSidebar.classList.toggle("open");
        menuBtnchange();
    });

    const stars = document.querySelectorAll('.rating input[type="radio"]');

    stars.forEach((star) => {
        star.addEventListener('change', () => {
            const rating = star.value;

            stars.forEach((s) => {
                if (s.value <= rating) {
                    s.parentNode.classList.add('selected');
                } else {
                    s.parentNode.classList.remove('selected');
                }
            });
        });
    });

    $(document).ready(function () {
        $('#anonymous-switch').bootstrapSwitch();
    });

    //<?php if (isset($feedbackSubmitted) && $feedbackSubmitted) : ?>
        // Show the thank you message
    //     var thankYouMessage = document.querySelector('.thank-you-message');
    //     if (thankYouMessage) {
    //         thankYouMessage.style.display = 'block';
    //     }
    // <?php endif; ?>
</script>

</html>