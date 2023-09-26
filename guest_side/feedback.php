<?php
    session_name("user_session");
    session_start();

    $user_id = 1;
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit;
    }

    $feedbackText = $rating = ""; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $feedbackText = $_POST['feedback-text'];
        $rating = $_POST['selectedRating'];

        if (empty($feedbackText) || empty($rating)) {
            $error = "Please fill out both the feedback and rating fields.";
        } else {
            try {
                $host = 'localhost';
                $dbname = 'trinitas';
                $username = 'root';
                $password = '';
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Fetch the username from the database
                $stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $_SESSION['user_id']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $userFirstName = $user['first_name'];
                $userLastName = $user['last_name'];
                $userName = $userFirstName . ' ' . $userLastName;

                // Insert the feedback into the database
                $insertStmt = $pdo->prepare("INSERT INTO feedback (user_id, name, feedback_message, rating) VALUES (:user_id, :name, :feedback_message, :rating)");
                $insertStmt->bindParam(':user_id', $_SESSION['user_id']);
                $insertStmt->bindParam(':name', $userName);
                $insertStmt->bindParam(':feedback_message', $feedbackText);
                $insertStmt->bindParam(':rating', $rating);

                if ($insertStmt->execute()) {
                    header("location: guest_dashboard.php");
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="./css/guest-style.css">

        <title>Dashboard</title>
    </head>
    <body>
        <!-- guest-dashboard-sidebar -->
        <div class="guest-sidebar">
            <div class="logo-details">
                <a href="index.php" class="logo" style="text-decoration: none;">
                    <img class="logo-img" src="..   /images/logo_trinitas.png">
                    <h1 class="logo-name">Trinitas</h1>
                </a>
                <span class="material-symbols-outlined menu" id="guestMenu">
                    menu
                </span>
            </div>
            <ul class="guest-navbar">
                <p class="menu-name">Menu</p>
                <li>
                    <a href="guest_dashboard.php">
                        <i class="fa-regular fa-user"></i>
                        <span class="links-names">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <i class="fa-regular fa-message"></i>
                        <span class="links-names">Messages</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fa-regular fa-comments"></i>
                        <span class="links-names">Feedback</span>
                    </a>
                </li>
                <li class="guest-profile">
                    <div class="guest-profile-details">
                        <img src="../images/guest.png">
                        <span class="guest-name">
                            <?php echo $userName; ?>
                        </span>
                    </div>
                    <span class="material-symbols-outlined logout">
                        logout
                    </span>
                </li>
            </ul>
        </div>

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
                <div class="feedback-body">
                    <div class="ratings">
                        <form id="feedbackForm" action="feedback.php" method="post">
                        <ul class="row ratings">
                            <li class="col-md" onclick="selectRating(this, 'Terrible')">
                                <i class="fa-regular fa-face-sad-cry rating-icon"></i>
                                <p>Terrible</p>
                            </li>
                                <li class="col-md" onclick="selectRating(this, 'Bad')">
                                    <i class="fa-regular fa-face-sad-tear rating-icon"></i>
                                    <p>Bad</p>
                                </li>
                                <li class="col-md" onclick="selectRating(this, 'Okay')">
                                    <i class="fa-regular fa-face-meh rating-icon"></i>
                                    <p>Okay</p>
                                </li>
                                <li class="col-md" onclick="selectRating(this, 'Good')">
                                    <i class="fa-regular fa-face-smile rating-icon"></i>
                                    <p>Good</p>
                                </li>
                                <li class="col-md" onclick="selectRating(this, 'Amazing')">
                                    <i class="fa-regular fa-face-laugh rating-icon"></i>
                                    <p>Amazing</p>
                                </li>
                            </ul>
                            <input type="hidden" id="selectedRating" name="selectedRating" value="">
                            <div class="feedback-text-box">
                                <textarea name="feedback-text" cols="20" rows="5" placeholder="Write a review here..."></textarea>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <?php if (isset($error)): ?>
                                    <!-- Error message display -->
                                    <div class="alert alert-danger">
                                        <i class="fa-solid fa-circle-exclamation" style="color: #fa0000;"></i>
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <button class="btn btn-send-feedback" name="submit" type="submit">Submit</button>
                                <button class="btn btn-cancel-feedback" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>                           
        </section>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>

    <script>
        let guestSidebar = document.querySelector(".guest-sidebar");
        let closeBtn = document.querySelector("#guestMenu");

        closeBtn.addEventListener("click", () => {
            guestSidebar.classList.toggle("open");
            menuBtnchange();
        })
   
        //Feedback
        function selectRating(li, rating) {
            const lis = document.querySelectorAll('.ratings li');
            lis.forEach((item) => {
                item.style.color = '';
                item.style.backgroundColor = '';
                const icon = item.querySelector('.rating-icon');
                if (icon) {
                    icon.style.color = '';
                }
                const text = item.querySelector('p');
                if (text) {
                    text.style.color = '';
                }
            });

            li.style.color = '#73C2FB';
            li.style.backgroundColor = '#73C2FB';
            const icon = li.querySelector('.rating-icon');
            if (icon) {
                icon.style.color = 'white';
            }
            const text = li.querySelector('p');
            if (text) {
                text.style.color = 'white';
            }

            document.getElementById('selectedRating').value = rating;
        }
    </script>



</html>