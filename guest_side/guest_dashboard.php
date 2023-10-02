<?php
    require("../connection.php");
    session_name("user_session");
    session_start();
    $user_id = 1;
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
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
<?php
        // guest-dashboard-sidebar
        include("sidebar.php");
        // logoutmodal
        require("logout_modal.php"); 
    ?>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./js/notification.js"></script>
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

    let countColorElement = document.querySelector(".count-color");
    console.log("Count Color Element:", countColorElement);

    let countColorStyle = window.getComputedStyle(countColorElement);
    console.log("Count Color Style:", countColorStyle);
</script>
</body>
</html>