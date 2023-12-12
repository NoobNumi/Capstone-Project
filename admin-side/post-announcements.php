<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
    $userType = 'admin';
    $userId = $_SESSION['admin_id'];
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        $userType = 'assistant';
        $userId = $_SESSION['asst_id'];
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
}

function getUserImage($userType)
{
    if ($userType === 'admin') {
        return '../images/nun.png';
    } else if ($userType === 'assistant') {
        return '../images/assist_nun.png';
    } else {
        return '';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Announcements</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include "./admin_sidebar.php";
    include "./notification-bar.php";
    include "./create-announcement.php";
    include "./edit-announcement.php";
    ?>
    <!------------------------------------------------- START OF ANNOUNCEMENTS --------------------------------------------------->
    <section class="announcements">
        <div class="post-container">
            <div class="profile-pic">
                <?php
                $profileImage = getUserImage($userType);
                ?>
                <img src="<?php echo $profileImage; ?>" width="50px" height="50px" alt="" srcset="">
            </div>
            <div class="dummy-input">
                <input type="text" placeholder="Post an update...">
            </div>
        </div>

        <div class="posts">
            <h1>Trinitas updates</h1>
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle transparent-dropdown" href="#" role="button" id="announcementDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-rounded">tune</span>
                </a>

                <ul class="dropdown-menu transparent-dropdown-menu" aria-labelledby="announcementDropdownButton">
                    <li><a class="dropdown-item sort" href="?order=latest">Latest</a></li>
                    <li><a class="dropdown-item sort" href="?order=oldest">Oldest</a></li>
                </ul>
            </div>
        </div>
        <!------------------------------------------------- POSTS --------------------------------------------------->
        <?php
        try {
            $order = isset($_GET['order']) ? $_GET['order'] : 'latest';
            $query = "SELECT a.announcement_id, a.post_content, a.timestamp, a.is_admin
            FROM announcements a";

            if ($order == 'latest') {
                $query .= " ORDER BY a.timestamp DESC";
            } elseif ($order == 'oldest') {
                $query .= " ORDER BY a.timestamp ASC";
            }
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
                echo '<span class="material-symbols-rounded">more_horiz</span>';
                echo '</div>';
                echo '</button>';
                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                echo '<li><a class="dropdown-item edit" href="#" data-toggle="modal" data-target="#editModal" data-announcement-id="' . $row['announcement_id'] . '">Edit</a></li>';
                echo '<li><a class="dropdown-item delete" href="#" data-announcement-id="' . $row['announcement_id'] . '">Delete</a></li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '<div class="post-description">';
                echo '<p>' . $row['post_content'] . '</p>';
                echo '</div>';
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
    <?php
    require("logout_modal.php");
    include "./share-post-modal.php";
    ?>
    <!------------------------------------------------- END OF ANNOUNCEMENT PAGE    --------------------------------------------------->
    <script src="./js/announce.js"></script>
    <script src="./js/notification-bar.js"></script>
    <script src="./js/users.js"></script>
    <script src="./js/admin-chat.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>

</html>