<?php 
    session_name("admin_session");
    session_start();
    require_once("../connection.php");
    if (!isset($_SESSION['admin_id'])) {
        header("location: admin_login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Appointments</title>
</head>

<body style="overflow-x: hidden;">
    <?php include("./admin_sidebar.php");?>
    <section class="appointments-list">
        <div class="admin-appoint-header">
            <div class="right-section">
                <h4 class="admin-title">Appointments</h4>
                <p class="total-indicator">You have<span class="total-num">10</span>total appointment(s)</p>
            </div>
            <div class="center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search here...">
                </div>
            </div>
            <div class="left-section">
                <p class="sorting-list">Newest First</p>
                <i class="fa-solid fa-angle-down"></i>
            </div>
        </div>
        <div class="notification-list">
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status confirmed"><i class="fa-solid fa-check"></i>Confirmed</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 20, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status cancelled"><i class="fa-solid fa-ban"></i>Cancelled</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status confirmed"><i class="fa-solid fa-check"></i>Confirmed</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 20, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status cancelled"><i class="fa-solid fa-ban"></i>Cancelled</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status pending"><i class="fa-solid fa-hourglass-start"></i>Pending</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="notification-card">
                <div class="first-section">
                    <img src="/images/guest.png">
                    <div class="guest-details-admin">
                        <span class="guest">User Name</span>
                        <span class="status cancelled"><i class="fa-solid fa-ban"></i>Cancelled</span>
                    </div>
                </div>
                <div class="second-section">
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>
                        <div class="date">September 25, 2023</div>
                    </div>
                    <div class="appoint-details">
                        <div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>
                        <div class="date">9:00 AM</div>
                    </div>
                </div>
                <div class="third-section">
                    <div class="notif-button">
                        <a href="#" class="btn-view">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/sidebar-animation.js"></script>
    <script>
        const appointmentList = document.querySelector('.appointments-list');
        appointmentList.scrollTop = 0;

        function scrollToBottom() {
            appointmentList.scrollTop = appointmentList.scrollHeight;
        }

        window.addEventListener('load', scrollToBottom);
    </script>
</body>

</html>