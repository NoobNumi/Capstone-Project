<?php
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve the user's profile picture path from the database
    $user_id = $_SESSION['user_id'];
    $sql = $conn->prepare("SELECT profile_picture FROM users WHERE user_id = :user_id");
    $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_profile_picture'] = $row['profile_picture'];
    }
}

?>

<div class="first-navbar">
    <a href="../index.php" class="logo" style="text-decoration: none;">
        <img src="../images/logo_trinitas.png">
        <h1>Trinitas</h1>
    </a>
    <input type="checkbox" id="nav-check" hidden>
    <div class="navbar-links" id="menu-links">
        <ul class="default">
            <li><i class="fa-solid fa-house fa-con"></i><a class="navigation-link" href="../index.php">Home</a></li>
            <li><i class="fa-solid fa-newspaper fa-con"></i><a class="navigation-link" href="../guest_side/discover.php">Discover</a></li>
            <li><i class="fa-solid fa-bullhorn fa-con"></i><a class="navigation-link" href="../guest_side/announcements.php">Announcements</a></li>
            <li><i class="fa-solid fa-address-card fa-con"></i><a class="navigation-link" href="../guest_side/aboutPage.php">About</a></li>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li><i class="fa-solid fa-right-to-bracket fa-con"></i><a class="user-buttons" href="../guest_side/login.php">Log in</a>
                </li>
                <li><i class="fa-solid fa-user-plus fa-con"></i><a class="user-buttons" href="../guest_side/signup.php">Sign up</a></li>
            <?php } else { ?>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="notif-nav">';
                    echo '<span class="notif-count-color navbar-side"></span>';
                    echo '<a class="navigation-link-message-part" href="#"><i class="fa-solid fa-bell notif-con"></i></a>';
                    echo '</li>';
                    echo '<li class="msg-nav">';
                    echo '<span class="count-color navbar-side"></span>';
                    echo '<a class="navigation-link-message-part" href="../guest_side/messages.php"><i class="fa-solid fa-message message-con"></i></a>';
                    echo '</li>';
                    $profile_picture = isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : 'default_profile_picture.jpg';
                    echo '<div class="profile-select" data-bs-toggle="dropdown">';
                    echo '<img src="../guest_side/' . $profile_picture . '" class="user-profile-picture">';
                    echo '<a href="#" style="display: none;" id="guest-link">Guest</a>';
                    echo '</div>';
                } else {
                    echo 'User is not logged in.';
                }
                ?>

                <div class="dropdown-menu">
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $sql = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
                    $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $sql->execute();
                    if ($sql->rowCount() > 0) {
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <a class="dropdown-item dropdown-link-name" href="guest_dashboard.php?user_id=<?php echo $_SESSION['user_id']; ?>"><i class="fa-solid fa-circle-user"></i> Profile</a>
                    <a class="dropdown-item dropdown-link-name" id="logout_click"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <label for="nav-check" class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </label>
</div>

<script>
    const navCheck = document.getElementById("nav-check");
    const profileSelect = document.querySelector(".profile-select");

    function handleProfileSelectVisibility() {
        if (window.innerWidth <= 1064) {
            if (navCheck.checked) {
                profileSelect.style.visibility = "visible";
            } else {
                profileSelect.style.visibility = "hidden";
            }
        } else {
            profileSelect.style.visibility = "visible";
        }
    }
    navCheck.addEventListener("change", handleProfileSelectVisibility);

    window.addEventListener("resize", handleProfileSelectVisibility);

    handleProfileSelectVisibility();

    document.addEventListener("DOMContentLoaded", function() {
        const profileImage = document.getElementById("profile-image");
        const dropdownContent = document.querySelector(".dropdown-content");

        profileImage.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdownContent.classList.toggle("show-dropdown");
        });

        window.addEventListener("click", function() {
            dropdownContent.classList.remove("show-dropdown");
        });
    });
</script>