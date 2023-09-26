<?php
    require("../connection.php");
    session_name("user_session");
    session_start();
    $user_id = 1;
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
    }
    
    try {

        $host = 'localhost';
        $dbname = 'trinitas';
        $username = 'root';
        $password = '';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

        $stmt = $pdo->prepare("SELECT first_name, last_name, email FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userFirstName = $user['first_name'];
        $userLastName = $user['last_name'];
        $userEmail = $user['email'];
        $userName = $userFirstName . ' ' . $userLastName;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
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
                <img class="logo-img" src="../images/logo_trinitas.png">
                <h1 class="logo-name">Trinitas</h1>
            </a>
            <span class="material-symbols-outlined menu" id="guestMenu">
                menu
            </span>
        </div>
        <ul class="guest-navbar">
            <p class="menu-name">Menu</p>
            <li class="active">
                <a href="guest_dashboard.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                    <i class="fa-regular fa-user"></i>
                    <span class="links-names">Profile</span>
                </a>
            </li>
            <li>
                <?php 

                ?>
                <a href="messages.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                    <i class="fa-regular fa-message"></i>
                    <span class="links-names">Messages</span>
                </a>
            </li>
            <li>
                <a href="feedback.php?user_id=<?php echo $_SESSION['user_id']; ?>">
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
                <span class="material-symbols-outlined logout" id="logout_click">
                    logout
                </span>
            </li>
        </ul>
    </div>
    <?php require("logout_modal.php"); ?>

    <!-- GUEST DASHBOARD STARTS HERE -->
    <section class="reservation-section">
        <div class="dash-content">
            <div class="profile-header">
                <img src="../images/guest.png" class="profile-photo">
                <div class="guest-name-email">
                    <span class="g-name">
                        <?php echo $userName; ?>
                    </span>
                    <span class="g-email">
                        <?php echo $userEmail; ?>
                    </span>
                </div>
            </div>
            <div class="semi-navigation col">
                <ul>
                    <li class="navigation-btn">
                        <a href="index.php">
                            <i class="fa-solid fa-house">
                                <span class="tooltip-text">
                                    HOME
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="discover.php">
                            <i class="fa-solid fa-compass">
                                <span class="tooltip-text">
                                    DISCOVER
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="announcements.php">
                            <i class="fa-solid fa-bullhorn">
                                <span class="tooltip-text">
                                    ANNOUNCEMENTS
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="aboutPage.php">
                            <i class="fa-solid fa-circle-info">
                                <span class="tooltip-text">
                                    ABOUT US
                                </span>
                            </i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="reserve-appoint">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="reserve-tab" data-bs-toggle="tab"
                        data-bs-target="#reserve-tab-pane" type="button" role="tab" aria-controls="reserve-tab-pane"
                        aria-selected="true">Reservations</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="appoint-tab" data-bs-toggle="tab" data-bs-target="#appoint-tab-pane"
                        type="button" role="tab" aria-controls="appoint-tab-pane"
                        aria-selected="true">Appointments</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="reserve-tab-pane" role="tabpanel"
                    aria-labelledby="reserve-tab" tabindex="0">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Recollection</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo pending">
                                                <i class="fa-solid fa-clock"></i>
                                                Pending
                                            </span>
                                        </div>

                                    </div>
                                    <ul>
                                        <li>Check-in-date <p>11-21-2023</p>
                                        </li>
                                        <li>Check-out-date <p>11-30-2023</p>
                                        </li>
                                        <li>Total Amount <p>₱2000.00</p>
                                        </li>
                                    </ul>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a href="#" class="btn btn-update w-100">Update</a>
                                        <a href="#" class="btn btn-cancel w-100">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Training</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo cancelled">
                                                <i class="fa-solid fa-ban"></i>
                                                Cancelled
                                            </span>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>Check-in-date <p>11-21-2023</p>
                                        </li>
                                        <li>Check-out-date <p>11-30-2023</p>
                                        </li>
                                        <li>Total Amount <p>₱8000.00</p>
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-update w-100">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Retreat</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo completed">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Completed
                                            </span>
                                        </div>

                                    </div>
                                    <ul>
                                        <li>Check-in-date <p>11-21-2023</p>
                                        </li>
                                        <li>Check-in-date <p>11-30-2023</p>
                                        </li>
                                        <li>Total Amount <p>₱23000.00</p>
                                        </li>
                                    </ul>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a href="#" class="btn btn-update w-100">Update</a>
                                        <a href="#" class="btn btn-cancel w-100">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="appoint-tab-pane" role="tabpanel" aria-labelledby="appoint-tab"
                    tabindex="0">
                    <!-- <p style="color: #9fa1a3; text-align: center; display: flex; align-items: center;">You have no appointments created
                            
                        </p>
                        <i class="fa-solid fa-face-grin-beam-sweat"></i> -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Recollection</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo pending">
                                                <i class="fa-solid fa-clock"></i>
                                                Pending
                                            </span>
                                        </div>

                                    </div>
                                    <ul>
                                        <li>Appointment Date <p>11-21-2023</p>
                                        </li>
                                        <li>Agenda <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam odit
                                                aliquam voluptas accusamus, repudiandae ad omnis nihil assumenda quam
                                                aperiam? Repellat, vel hic placeat dolor cumque consectetur perferendis
                                                obcaecati? Consequuntur.</p>
                                        </li>
                                    </ul>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a href="#" class="btn btn-update w-100">Update</a>
                                        <a href="#" class="btn btn-cancel w-100">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Training</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo cancelled">
                                                <i class="fa-solid fa-ban"></i>
                                                Cancelled
                                            </span>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>Appointment Date <p>11-21-2023</p>
                                        </li>
                                        <li>Agenda <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam odit
                                                aliquam voluptas accusamus, repudiandae ad omnis nihil assumenda quam
                                                aperiam? Repellat, vel hic placeat dolor cumque consectetur perferendis
                                                obcaecati? Consequuntur.</p>
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-update w-100">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Retreat</p>
                                        </div>
                                        <div class="right-side">
                                            <span class="status-logo completed">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Completed
                                            </span>
                                        </div>

                                    </div>
                                    <ul>
                                        <li>Appointment Date <p>11-21-2023</p>
                                        </li>
                                        <li>Agenda <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam odit
                                                aliquam voluptas accusamus, repudiandae ad omnis nihil assumenda quam
                                                aperiam? Repellat, vel hic placeat dolor cumque consectetur perferendis
                                                obcaecati? Consequuntur.</p>
                                        </li>
                                    </ul>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a href="#" class="btn btn-update w-100">Update</a>
                                        <a href="#" class="btn btn-cancel w-100">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="./js/chat.js"></script>
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
</script>

</html>