<?php
require("../connection.php");
session_name("user_session");
session_start();

date_default_timezone_set('Asia/Manila');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Announcements</title>
</head>

<body>

    <?php
    include("guest_navbar.php");
    include("notification-bar.php");
    include("logout_modal.php");
    ?>
    <!------------------------------------------------- START OF ANNOUNCEMENTS --------------------------------------------------->
    <section class="announcements">
        <div class="posts">
            <h1>Trinitas updates</h1>
        </div>
        <!------------------------------------------------- POSTS --------------------------------------------------->
        <?php
        try {
            $query = "SELECT a.announcement_id, a.post_content, a.timestamp, a.is_admin
            FROM announcements a ORDER BY a.timestamp DESC";
            $stmt = $conn->query($query);

            while ($row = $stmt->fetch()) {
                echo '<div class="post-card">';
                echo '<div class="profile-settings">';
                echo '<div class="posted">';
                echo '<div class="profile-pic">';
                if ($row['is_admin'] == 1) {
                    // Admin
                    echo '<img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">';
                    echo '</div>';
                    echo '<div class="profile-details">';
                    echo '<h5>Admin</h5>';
                } else {
                    // Assistant
                    echo '<img src="../images/assist_nun.png" width="50px" height="50px" alt="" srcset="">';
                    echo '</div>';
                    echo '<div class="profile-details">';
                    echo '<h5>Assistant</h5>';
                }
                $timestamp = strtotime($row['timestamp']);
                $current_time = time();
                $time_diff = $current_time - $timestamp;
                if ($time_diff < 3600) {
                    $time_ago = round($time_diff / 60) . 'm';
                } elseif ($time_diff < 86400) {
                    $time_ago = round($time_diff / 3600) . 'h';
                } elseif ($time_diff < 604800) {
                    $time_ago = date('M j', $timestamp);
                } else {
                    $time_ago = date('M j', $timestamp);
                }
                echo '<p>' . $time_ago . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<style>.btn-dropdown::after { display: none; }</style>';
                echo '<style>.btn-dropdown { background-color: transparent; color: #303030; border: none; outline: none; }</style>';
                echo '<style>.btn-dropdown:hover { background-color: transparent; color: #303030; }</style>';
                echo '<style>.btn-dropdown:focus { background-color: transparent; }</style>';
                echo '<div class="dropdown">';
                echo '<button class="btn btn-secondary btn-dropdown dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">';
                echo '<div class="settings-icon">';
                echo '</div>';
                echo '</button>';
                echo '</div>';
                echo '</div>';
                echo '<div class="post-description">';
                $post_content = $row['post_content'];
                if (str_word_count($post_content) > 50) {
                    $short_content = implode(' ', array_slice(explode(' ', $post_content), 0, 50));
                    echo '<p class="short-content">' . $short_content . '... <span class="read-more text-truncate"><br>See More</span></p>';
                    echo '<p class="full-content" style="display: none;">' . $post_content . ' <span class="read-less text-truncate"><br>See Less</span></p>';
                } else {
                    echo '<p>' . $post_content . '</p>';
                }
                echo '<br><br></div>';
                echo '<div class="image-grid">';
                $announcement_id = $row['announcement_id'];
                $image_query = "SELECT img_url_path FROM announcement_image WHERE announcement_id = $announcement_id";
                $image_stmt = $conn->query($image_query);
                $image_count = 0;

                while ($image_row = $image_stmt->fetch()) {
                    $image_id = 'image-' . $image_count;
                    echo '<div class="image-item" id="' . $image_id . '"';
                    if ($image_count > 3) {
                        echo ' style="display: none;"';
                    }

                    echo '>';
                    echo '<a href="' . $image_row['img_url_path'] . '" data-lightbox="gallery-' . $announcement_id . '">';
                    echo '<img src="' . $image_row['img_url_path'] . '" alt="Image ' . ($image_count + 1) . '">';
                    echo '</a>';

                    if ($image_count == 3) {
                        $remaining_photos = $image_stmt->rowCount() - 4;
                        echo '<div class="overlay">';
                        echo '<div class="more-photos">+' . $remaining_photos . '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    $image_count++;
                }

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <div class="reach-bottom-text">
            <p>You have reached the bottom of the page! Thank you for scrolling :></p>
        </div>

    </section>

    <!------------------------------------------------- END OF ANNOUNCEMENT PAGE --------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="./js/populateNotification.js"></script>
    <script>
        document.querySelectorAll('.read-more').forEach(item => {
            item.addEventListener('click', event => {
                event.target.parentNode.style.display = 'none';
                event.target.parentNode.nextElementSibling.style.display = 'block';
            })
        })

        document.querySelectorAll('.read-less').forEach(item => {
            item.addEventListener('click', event => {
                event.target.parentNode.style.display = 'none';
                event.target.parentNode.previousElementSibling.style.display = 'block';
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/announcements_functions.js"></script>

</body>

</html>