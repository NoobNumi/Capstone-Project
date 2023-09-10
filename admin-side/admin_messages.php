<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
    exit;
}

try {
    $stmt = $conn->prepare("SELECT users.*, messages.message
                            FROM users
                            LEFT JOIN messages ON users.user_id = messages.sender_id
                            WHERE users.user_id = :user_id");
    $stmt->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
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
    <title>Messages</title>
</head>

<body>
    <div class="admin-sidebar">
        <div class="admin-logo-details">
            <a href="admin_home.phpadm?admin_id=<?php echo $_SESSION['admin_id']; ?>" class="logo" style="text-decoration: none;">
                <img class="logo-img" src="../images/logo_trinitas.png">
                <div>
                    <h1 class="logo-name">Trinitas</h1>
                    <span class="admin-name">ADMIN</span>
                </div>
            </a>
            <span class="material-symbols-outlined menu" id="guestMenu">
                menu
            </span>
        </div>
        <ul class="admin-navbar">
            <p class="menu-name">Menu</p>
            <li>
                <a href="admin_home.php?admin_id=<?php echo $_SESSION['admin_id']; ?>">
                    <i class="fa-regular fa-compass"></i>
                    <span class="links-names" style="margin-left: -4px;">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_messages.php?admin_id=<?php echo $_SESSION['admin_id']; ?>">
                    <i class="fa-regular fa-message"></i>
                    <span class="count-color"> </span>
                    <span class="links-names">Messages</span>
                    <span class="notif-count">10</span>
                </a>
            </li>
            <li>
                <a href="feedback.html">
                    <i class="fa-regular fa-comments"></i>
                    <span class="links-names" style="margin-left: -4px;">Feedback</span>
                </a>
            </li>
            <li class="admin-profile">
                <div class="admin-profile-details">
                    <img src="../images/nun.png">
                    <span class="guest-name">
                        Admin
                    </span>
                </div>
                <span class="material-symbols-outlined logout" id="logout_click">
                    logout
                </span>
            </li>
        </ul>
    </div>
    <?php require("logout_modal.php"); ?>
    <!-- ALL MESSAGES BEGINS HERE -->
    <section class="admin-messages">
        <div class="message-container">
            <h5 class="admin-msg-title">Chats</h5>
            <div class="search-main-container">
                <div class="admin-search-bar">
                    <input type="text" name="search" placeholder="Search here...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <ul class="chat-people">
                <?php foreach ($users as $user) : ?>
                    <li>
                        <a href="#" class="user-message-link" data-user-id="<?php echo $user['user_id']; ?>"></a>
                            <img src="../images/guest.png">
                            <div class="msg-allText">
                                <span class="guest-name">
                                    <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
                                </span>
                                <p class="msg">You:</p>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <!-- ALL MESSAGE ENDS HERE -->
</body>

<script src="./js/users.js"></script>
<script src="./js/chat.js"></script>
<script src="./js/search.js"></script>
<!-- <script src="./js/message_load.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script>
    let guestSidebar = document.querySelector(".admin-sidebar");
    let closeBtn = document.querySelector("#guestMenu");

    closeBtn.addEventListener("click", () => {
        guestSidebar.classList.toggle("open");
        menuBtnchange();
    })
</script>

</html>