<?php
    require("../connection.php");
    session_name("user_session");
    session_start();

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    } else {
        $user_id = 0;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>Announcements</title>
</head>
<body>
   <?php 
        include("guest_navbar.php");
        include("logout_modal.php");
    ?>

    <!------------------------------------------------- START OF ANNOUNCEMENTS --------------------------------------------------->
    <section class="announcements">
        <div class="posts">
            <h1>Trinitas updates</h1>
            <span>Filter
                <span class="material-symbols-rounded">
                    tune
                </span>
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
    <!------------------------------------------------- END OF ANNOUNCEMENT PAGE --------------------------------------------------->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/announcements_functions.js"></script>

</body>

</html>