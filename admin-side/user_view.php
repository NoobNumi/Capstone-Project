<?php
session_name("admin_session");
session_start();
if (isset($_SESSION['admin_id'])) {
    require_once("../connection.php");
} else {
    header("location: ../guest_side/login.php");
    exit;
}

$sql = "SELECT users.user_id, users.first_name, users.last_name, users.email, users.profile_picture
        FROM users ORDER BY user_id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();

try {
    $sqlCount = "SELECT COUNT(*) AS totalusers FROM users";
    $resultCount = $conn->query($sqlCount);
    $row = $resultCount->fetch(PDO::FETCH_ASSOC);
    $totalusers = $row['totalusers'];
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Users Info</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include "./admin_sidebar.php";
    ?>

    <section class="post-users">
        <div class="admin-user-header">
            <div class="right-section">
                <h4 class="admin-title">Users</h4>
                <p class="total-indicator">There are <span class="total-num"><?php echo $totalusers ?></span> total user(s)</p>
            </div>
            <div class="search-center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search here...">
                </div>
            </div>
        </div>
        <div class="table-container">

            <table class="user-table">
                <tr>
                    <th>User ID</th>
                    <th>Profile Picture</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <form method="post">
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr class="searchable-card">
                    <td>' . sprintf("%03d", $row['user_id']) . '</td>
                    <td> <img src="../guest_side/' . $row['profile_picture'] . '" class="user-pfp"> </td>
                    <td>' . $row['first_name'] . '</td>
                    <td>' . $row['last_name'] . '</td>
                    <td>' . $row['email'] . '</td>
                </tr>';
                    }
                    ?>
                </form>
            </table>

        </div>
        <div class="no-users-message" style="
                display: none;
                width: inherit;
                text-align: center;
                padding: 10px 14px;
                background: none;">
            No users found
        </div>
    </section>

    <?php require("logout_modal.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/filtering_users.js"></script>
    <script src="./js/user.js"></script>

</body>