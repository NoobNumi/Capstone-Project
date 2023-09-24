<?php
session_name("user_session");
session_start();

$admin_id = 1;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">

    <title>Messages</title>
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
            <li>
                <a href="guest_dashboard.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                    <i class="fa-regular fa-user"></i>
                    <span class="links-names">Profile</span>
                </a>
            </li>
            <li class="active">
                <a href="messages.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                    <i class="fa-regular fa-message"></i>
                    <span class="links-names">Messages</span>
                </a>
            </li>
            <li>
                <a href="feedback.html">
                    <i class="fa-regular fa-comments"></i>
                    <span class="links-names">Feedback</span>
                </a>
            </li>
            <li class="guest-profile">
                <div class="guest-profile-details">
                    <img src="../images/guest.png">
                    <span class="guest-name">
                        Guest
                    </span>
                </div>
                <span class="material-symbols-outlined logout" id="logout_click">
                    logout
                </span>
            </li>
        </ul>
    </div>
    <?php require("logout_modal.php"); ?>
    <!-- MESSAGES STARTS HERE -->
    <section class="messages">
        <div class="message-container">
            <div class="message-title-container">
                <h5 class="message-title text-center mb-4">
                    Get in touch with us!
                </h5>
            </div>
            <hr>
            <div class="chat-box" id="chat-box">
                <!-- MESSAGES ARE FETCHED HERE BY AJAX AND `handle_messages.php` -->
            </div>

            <form action="handle_messages.php" class="typing-area" method="POST" autocomplete="off" enctype="multipart/form-data">
                <input type="text" name="receiver_id" id="receiver_id" class="receiver_id" value="<?php echo $admin_id; ?>" hidden>
                <input type="text" name="sender_id" class="sender_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                <div class="preview-img">
                    <label for="file-add">
                        <span class="material-symbols-outlined add-file">
                            add_photo_alternate
                        </span>
                    </label>
                    <input type="file" id="file-add" name="additional_images[]" accept=".png, .jpg, .jpeg, .gif, .webp" multiple>
                </div>
                <div class="image-set">
                    <img id="image-preview" src="#" alt="Selected Image Preview" style="display: none; max-width: 100%;">
                </div>

                <div class="sending-msg">
                    <div class="select-img">
                        <label for="file-input">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <input type="file" id="file-input" name="image" accept=".png, .jpg, .jpeg, .gif, .webp">
                    </div>
                    <input type="text" class="input-field" name="message" placeholder="Type message here...">
                    <button type="submit" name="submit" class="send"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
        <div id="imageModal" class="image-modal">
            <div class="image-buttons">
                <a id="downloadButton" href="#" download><i class="fa-solid fa-file-arrow-down"></i></a>
                <span class="button-close">&times;</span>
            </div>
            <img id="modalImage" class="image-modal-content" src="" alt="Selected Image">
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="./js/send_msg.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script>
    let guestSidebar = document.querySelector(".guest-sidebar");
    let closeBtn = document.querySelector("#guestMenu");

    closeBtn.addEventListener("click", () => {
        guestSidebar.classList.toggle("open");
        menuBtnchange();
    })
</script>
</body>



</html>