<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="admin-sidebar">
    <div class="admin-logo-details">
        <a href="admin_home.php" class="logo" style="text-decoration: none;">
            <img class="logo-img" src="../images/logo_trinitas.png">
            <div>
                <h1 class="logo-name">Trinitas</h1>
                <?php
                if (isset($_SESSION['admin_id'])) {
                    echo '<span class="admin-name">ADMIN</span>';
                } elseif (isset($_SESSION['asst_id'])) {
                    echo '<span class="admin-name" style="letter-spacing: 3px;">ASSISTANT</span>';
                } else {
                    echo '<span class="admin-name">UNKNOWN_ROLE</span>';
                }
                ?>

            </div>
        </a>
        <span class="material-symbols-outlined menu" id="guestMenu">
            menu
        </span>
    </div>
    <ul class="admin-navbar">
        <p class="menu-name">Menu</p>
        <li <?php echo ($currentPage === 'admin_home.php') ? 'class="active"' : ''; ?>>
            <a href="admin_home.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>" class="nav-link">
                <i class="fa-regular fa-compass"></i>
                <span class="links-names" style="margin-left: -3px;">Dashboard</span>
            </a>
        </li>
        <?php if (isset($_SESSION['admin_id'])) : ?>
            <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
                <a href="admin_messages.php?admin_id=<?php echo $_SESSION['admin_id']; ?>" class="nav-link">
                    <i class="fa-regular fa-message"></i>
                    <span class="count-color"> </span>
                    <span class="links-names">Messages</span>
                    <span class="notif-count" id="unread-count"></span>
                </a>
            </li>
        <?php endif; ?>
        <li class="down-item dropdown post-downlist">
            <a class="down-link" href="#">
                <i class="fa-regular fa-pen-to-square"></i>
                <span class="links-names" style="margin-left: 3px">Post</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul class="downlist-menu">
                <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
                    <a href="#">
                        <i class="fa-solid fa-book"></i>
                        <span class="links-names">Reservations</span>
                    </a>
                </li>
                <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
                    <a href="post-meals.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>">
                        <i class="fa-solid fa-utensils"></i>
                        <span class="links-names">Meals</span>
                    </a>
                </li>
                <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
                    <a href="post-discover.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="links-names">Discover</span>
                    </a>
                </li>
                <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
                    <a href="post-announcements.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span class="links-names">Announcements</span>
                    </a>
                </li>
            </ul>
        </li>
        <li <?php echo ($currentPage === 'calendar.php') ? 'class="active"' : ''; ?>>
            <a href="calendar.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>">
                <i class="fa-regular fa-calendar"></i>
                <span class="links-names" style="margin-left: 3px">Calendar</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'ratings.php') ? 'class="active"' : ''; ?>>
            <a href="ratings.php?<?php echo isset($_SESSION['admin_id']) ? 'admin_id=' . $_SESSION['admin_id'] : 'asst_id=' . $_SESSION['asst_id']; ?>">
                <i class="fa-regular fa-comments"></i>
                <span class="links-names" style="margin-left: -4px;">Feedback</span>
            </a>
        </li>
        <li class="admin-profile">
            <?php if (isset($_SESSION['admin_id'])) : ?>
                <div class="admin-profile-details">
                    <img src="../images/nun.png">
                    <span class="guest-name">
                        Admin
                    </span>
                </div>
            <?php elseif (isset($_SESSION['asst_id'])) : ?>
                <div class="admin-profile-details">
                    <img src="../images/assist_nun.png">
                    <span class="guest-name">
                        Assistant
                    </span>
                </div>
            <?php endif; ?>
            <span class="material-symbols-outlined logout" id="logout_click">
                logout
            </span>
        </li>
    </ul>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdown = document.querySelector(".post-downlist");
        var menu = document.querySelector(".downlist-menu");

        dropdown.addEventListener("mouseenter", function() {
            menu.style.maxHeight = "400px";
        });

        dropdown.addEventListener("mouseleave", function() {
            menu.style.maxHeight = "0";
        });
    });
</script>