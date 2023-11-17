<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    try {
        $host = 'localhost';
        $dbname = 'trinitas';
        $username = 'root';
        $password = '';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userFirstName = $user['first_name'];
        $userLastName = $user['last_name'];
        $userName = $userFirstName . ' ' . $userLastName; 
        $userEmail = $user['email'];
        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
        }
?>
<div class="guest-sidebar">
    <div class="logo-details">
        <a href="../index.php" class="logo" style="text-decoration: none;">
            <img class="logo-img" src="../images/logo_trinitas.png">
            <h1 class="logo-name">Trinitas</h1>
        </a>
        <span class="material-symbols-outlined menu" id="guestMenu">
            menu
        </span>
    </div>
    <ul class="guest-navbar">
        <p class="menu-name">Menu</p>
        <li <?php echo ($currentPage === 'guest_dashboard.php') ? 'class="active"' : ''; ?>>
            <a href="guest_dashboard.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                <i class="fa-regular fa-user"></i>
                <span class="links-names">Profile</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'messages.php') ? 'class="active"' : ''; ?>>
            <a href="messages.php?user_id=<?php echo $_SESSION['user_id']; ?>">
                <i class="fa-regular fa-message"></i>
                <span class="count-color count-color-hidden"></span>
                <span class="links-names">Messages</span>
            </a>
        </li>
        <li <?php echo ($currentPage === 'feedback.php') ? 'class="active"' : ''; ?>>
            <a href="feedback.php">
                <i class="fa-regular fa-comments"></i>
                <span class="links-names">Feedback</span>
            </a>
        </li>
        <li class="guest-profile">
            <div class="guest-profile-details">
                <img src="<?php echo $user['profile_picture'];?>">
                <span class="guest-name">
                    <?php echo $userFirstName; ?>
                </span>
            </div>
            <span class="material-symbols-outlined logout" id="logout_click">
                logout
            </span>
        </li>
    </ul>
</div>