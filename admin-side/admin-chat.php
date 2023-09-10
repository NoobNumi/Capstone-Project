<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (!isset($_SESSION['admin_id'])) {
    header("location: admin_messages.php");
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM messages WHERE (sender_id = :admin_id AND receiver_id = :user_id) OR (sender_id = :user_id AND receiver_id = :admin_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':admin_id', $_SESSION['admin_id'], PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $chatMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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
            <a href="index.php" class="logo" style="text-decoration: none;">
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
                <a href="admin_home.php">
                    <i class="fa-regular fa-compass"></i>
                    <span class="links-names" style="margin-left: -4px;">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_messages.php">
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
    <section class="messages">
        <div class="message-container">
            <div class="messaging-guest-header">
                <div class="user-info-adminSide">
                    <a href="admin_messages.php">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <img src="../images/guest.png">
                    <span class="message-title">
                        Guest
                    </span>
                </div>
                <div class="chat-settings">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
            </div>
            <div class="chat-box">
            </div>

            <form action="" class="typing-area" method="POST" autocomplete="off" id="chat-box" >
                <input type="text" name="receiver_id" class="receiver_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="sender_id" class="sender_id" value="<?php echo $_SESSION['admin_id']; ?>" hidden>
                <div class="select-img">
                    <label for="file-input">
                        <i class="fa-solid fa-camera"></i>
                    </label>

                    <input type="file" id="file-input">
                </div>
                <input type="text" class="input-field" name="message" placeholder="Type message here...">
                <button type="submit" name="submit" class="send"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>

    </section>
</body>

<script src="./js/admin-chat.js"></script>
<script src="./js/userFetch.js"></script>
<script>
    let guestSidebar = document.querySelector(".admin-sidebar");
    let closeBtn = document.querySelector("#guestMenu");

    closeBtn.addEventListener("click", () => {
        guestSidebar.classList.toggle("open");
        menuBtnchange();
    })
</script>

</html>