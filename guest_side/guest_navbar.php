<div class="first-navbar">
    <a href="index.php" class="logo" style="text-decoration: none;">
        <img src="../images/logo_trinitas.png">
        <h1>Trinitas</h1>
    </a>
    <input type="checkbox" id="nav-check" hidden>
    <div class="navbar-links" id="menu-links">
        <ul class="default">
            <li><i class="fa-solid fa-house fa-con"></i><a class="navigation-link" href="index.php">Home</a></li>
            <li><i class="fa-solid fa-newspaper fa-con"></i><a class="navigation-link" href="discover.php">Discover</a></li>
            <li><i class="fa-solid fa-bullhorn fa-con"></i><a class="navigation-link" href="announcements.php">Announcements</a></li>
            <li><i class="fa-solid fa-address-card fa-con"></i><a class="navigation-link" href="aboutPage.php">About</a></li>
            <li class="msg-nav">
                <span class="count-color navbar-side"></span>
                <a class="navigation-link-message-part" href="messages.php"><i class="fa-solid fa-message message-con"></i></a>
            </li>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li><i class="fa-solid fa-right-to-bracket fa-con"></i><a class="user-buttons" href="login.php">Log in</a>
                </li>
                <li><i class="fa-solid fa-user-plus fa-con"></i><a class="user-buttons" href="signup.php">Sign up</a></li>
            <?php } else { ?>
                <li class="user-dropdown dropdown">
                    <div class="profile-select" data-bs-toggle="dropdown">
                        <img src="../images/guest.png" class="user-pfp" for="guest-link">
                        <a href="#" style="display: none;" id="guest-link">Guest</a>
                    </div>
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