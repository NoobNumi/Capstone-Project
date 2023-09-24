<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="admin-sidebar">
    <div class="admin-logo-details">
        <a href="admin_home.php" class="logo" style="text-decoration: none;">
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
        <li <?php echo ($currentPage === 'admin_home.php') ? 'class="active"' : ''; ?>>
            <a href="admin_home.php?admin_id=<?php echo $_SESSION['admin_id']; ?>">
                <i class="fa-regular fa-compass"></i>
                <span class="links-names" style="margin-left: -3px;">Dashboard</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'admin_messages.php') ? 'class="active"' : ''; ?>>
            <a href="admin_messages.php?admin_id=<?php echo $_SESSION['admin_id']; ?>">
                <i class="fa-regular fa-message"></i>
                <span class="count-color"> </span>
                <span class="links-names">Messages</span>
                <span class="notif-count">10</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'calendar.php') ? 'class="active"' : ''; ?>>
            <a href="calendar.php?admin_id=<?php echo $_SESSION['admin_id']; ?>">
                <i class="fa-regular fa-calendar"></i>
                <span class="links-names" style="margin-left: 3px">Calendar</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'feedback.html') ? 'class="active"' : ''; ?>>
            <a href="#">
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