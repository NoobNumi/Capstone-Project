<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
    require "fetch_counts_query.php";
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require "fetch_counts_query.php";
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Announcements</title>
</head>

<body>
    <?php 
        include "./admin_sidebar.php"; 
        include "./notification-bar.php";
        include "./create-announcement.php"
    ?>
    <!------------------------------------------------- START OF ANNOUNCEMENTS --------------------------------------------------->
    <section class="announcements">
        <div class="post-container">
            <div class="profile-pic">
                <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
            </div>
            <div class="dummy-input">
                <input type="text" placeholder="Post an update...">
            </div>
        </div>
        <div class="posts">
            <h1>Trinitas updates</h1>
            <span>
                <span class="material-symbols-rounded">
                    tune
                </span>
        </div>


        <!------------------------------------------------- POST CARD 1 --------------------------------------------------->

        <div class="post-card">
            <div class="profile-settings">
                <div class="posted">
                    <div class="profile-pic">
                        <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    </div>
                    <div class="profile-details">
                        <h5>Admin</h5>
                        <p>15h</p>
                    </div>
                </div>
                <div class="settings-icon">
                    <span class="material-symbols-rounded">
                        more_horiz
                    </span>
                </div>
            </div>
            <div class="post-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, cum consequuntur quod laudantium
                    ipsa eligendi iure, magnam illo, vitae ea dolore. Quae magni maxime aperiam a quaerat sed, nihil
                    commodi.</p>
            </div>
            <div class="post-img">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
            </div>

            <hr>

            <div class="post-actions">
                <div class="post-react">
                    <span class="material-symbols-rounded" id="like_react">
                        favorite
                    </span>
                    <p>Like</p>
                </div>
                <div class="post-comment">
                    <span class="material-symbols-rounded">
                        comment
                    </span>
                    <p>Comment</p>
                </div>
                <div class="post-share" id="share_btn">
                    <span class="material-symbols-rounded">
                        share_windows
                    </span>
                    <p>Share</p>
                </div>
            </div>


            <hr class="comment-line">


            <div class="comment-details">
                <img src="../images/guest.png">
                <div class="comment-field">
                    <textarea name="" id="" placeholder="Write a comment.."></textarea>
                    <span class="material-symbols-rounded send_comment" id="home_icons">
                        send
                    </span>
                </div>
            </div>
        </div>


        <!------------------------------------------------- POST CARD 2 --------------------------------------------------->

        <div class="post-card">
            <div class="profile-settings">
                <div class="posted">
                    <div class="profile-pic">
                        <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    </div>
                    <div class="profile-details">
                        <h5>Admin</h5>
                        <p>15h</p>
                    </div>
                </div>
                <div class="settings-icon">
                    <span class="material-symbols-rounded">
                        more_horiz
                    </span>
                </div>
            </div>
            <div class="post-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, cum consequuntur quod laudantium
                    ipsa eligendi iure, magnam illo, vitae ea dolore. Quae magni maxime aperiam a quaerat sed, nihil
                    commodi.</p>
            </div>
            <div class="post-img">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
            </div>

            <hr>

            <div class="post-actions">
                <div class="post-react">
                    <span class="material-symbols-rounded" id="like_react">
                        favorite
                    </span>
                    <p>Like</p>
                </div>
                <div class="post-comment">
                    <span class="material-symbols-rounded">
                        comment
                    </span>
                    <p>Comment</p>
                </div>
                <div class="post-share" id="share_btn">
                    <span class="material-symbols-rounded">
                        share_windows
                    </span>
                    <p>Share</p>
                </div>
            </div>

            <hr class="comment-line">


            <div class="comment-details">
                <img src="../images/guest.png">
                <div class="comment-field">
                    <textarea name="" id="" placeholder="Write a comment.."></textarea>
                    <span class="material-symbols-rounded send_comment" id="home_icons">
                        send
                    </span>
                </div>
            </div>
        </div>

        <!----------------------------------------------- POST CARD 3 ---------------------------------------------------------->


        <div class="post-card">
            <div class="profile-settings">
                <div class="posted">
                    <div class="profile-pic">
                        <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    </div>
                    <div class="profile-details">
                        <h5>Admin</h5>
                        <p>15h</p>
                    </div>
                </div>
                <div class="settings-icon">
                    <span class="material-symbols-rounded">
                        more_horiz
                    </span>
                </div>
            </div>
            <div class="post-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, cum consequuntur quod laudantium
                    ipsa eligendi iure, magnam illo, vitae ea dolore. Quae magni maxime aperiam a quaerat sed, nihil
                    commodi.</p>
            </div>
            <div class="post-img">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
                <img src="../images/bgImage.png" width="100px" height="100px" alt="" class="post">
            </div>


            <hr>

            <div class="post-actions">
                <div class="post-react">
                    <span class="material-symbols-rounded" id="like_react">
                        favorite
                    </span>
                    <p>Like</p>
                </div>
                <div class="post-comment">
                    <span class="material-symbols-rounded">
                        comment
                    </span>
                    <p>Comment</p>
                </div>
                <div class="post-share" id="share_btn">
                    <span class="material-symbols-rounded">
                        share_windows
                    </span>
                    <p>Share</p>
                </div>
            </div>


            <hr class="comment-line">


            <div class="comment-details">
                <img src="../images/guest.png">
                <div class="comment-field">
                    <textarea name="" id="" placeholder="Write a comment.."></textarea>
                    <span class="material-symbols-rounded send_comment" id="home_icons">
                        send
                    </span>
                </div>
            </div>
        </div>

        <div class="reach-bottom-text">
            <p>You have reached the bottom of the page! Thank you for scrolling :></p>
        </div>

    </section>

    <div class="share-post-modal" id="share_post_options">
        <div class="share-modal-main">
            <div class="share-button-container">
                <div class="share-actions-top">
                    <h4>Share this post: </h4>
                    <p class="close">&times;</p>
                </div>

                <ul>
                    <li class="social-media-share">
                        <a href="http://"><i class="fa-brands fa-facebook"></i></a>
                        <a href="http://"><i class="fa-brands fa-twitter"></i></a>
                        <a href="http://"><i class="fa-brands fa-instagram"></i></a>
                        <a href="http://"><i class="fa-brands fa-tiktok"></i></a>
                    </li>
                    <div class="separator">
                        <hr class="line">
                        <p>OR</p>
                        <hr class="line">
                    </div>

                    <li class="copy-clipboard">
                        <span class="material-symbols-rounded">
                            content_copy
                        </span>
                        <p>Copy link to clipboard</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php include"./logout.php  ";?>
    <!------------------------------------------------- END OF ANNOUNCEMENT PAGE    --------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/notification-bar.js"></script>
    <script src="./js/users.js"></script>
    <script src="./js/admin-chat.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/announcements_functions.js"></script>
    <script src="./js/announce.js"></script>

</body>

</html>