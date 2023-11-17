<?php
session_name("admin_session");
session_start();
if (isset($_SESSION['admin_id'])) {
    require_once("../connection.php");
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require_once("../connection.php");
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
}

// FOR SERVICES TABLE
$sql = "SELECT services.service_id, services.service_name, services.service_description, services.img_path
            FROM services";

$stmt = $conn->prepare($sql);
$stmt->execute();


// FOR SOUVENIR ITEMS TABLE
$sql2 = "SELECT souvenir_items.item_id, souvenir_items.item_name, souvenir_items.souvenir_description, souvenir_items.souvenir_img_path
            FROM souvenir_items";

$stmt2 = $conn->prepare($sql2);
$stmt2->execute();

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
    <title>Post Discover</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include "./admin_sidebar.php";
    include "./discover-view.php";
    ?>

    <section class="post-discover">
        <div class="admin-discover-header">
            <div class="right-section">
                <h4 class="admin-title">Discover Page</h4>
            </div>
            <div class="center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search here...">
                </div>
            </div>
            <div class="left-section">
                <select name="selectedStatus" class="sorting-list">
                    <vscode-file: //vscode-app/c:/Users/admin/AppData/Local/Programs/Microsoft%20VS%20Code/resources/app/out/vs/code/electron-sandbox/workbench/workbench.htmloption value="">All</option>
                        <option value="Services">Services</option>
                        <option value="Souvenirs">Souvenirs</option>
                </select>
                <button class="add-btn">Add new</button>
            </div>
        </div>
        <div id="table-container-service" class="table-container">
            <table class="discover-table">
                <tr class="title-discover">
                    <th>Service ID</th>
                    <th>Service Name</th>
                    <th>Service Description</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr class="searchable-card">
                    <td>' . sprintf("%03d", $row['service_id']) . '</td>
                    <td>' . $row['service_name'] . '</td>
                    <td>' . $row['service_description'] . '</td>
                    <td>
                        <button class="view-btn" data-id="' . $row['service_id'] . '" data-type="service">View</button>
                    </td>
                </tr>';
                }
                ?>
            </table>
            <div class="no-services-message" style="
                display: none;
                width: inherit;
                text-align: center;
                padding: 10px 14px;
                background: #fff;">
                No services found
            </div>
        </div>
        <div id="table-container-souvenir" class="table-container">
            <table class="discover-table">
                <tr class="title-discover">
                    <th>Souvenir ID</th>
                    <th>Souvenir Name</th>
                    <th>Souvenir Description</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr class="searchable-card">
                    <td>' . sprintf("%03d", $row2['item_id']) . '</td>
                    <td>' . $row2['item_name'] . '</td>
                    <td>' . $row2['souvenir_description'] . '</td>
                    <td>
                        <button class="view-btn" data-id="' . $row2['item_id'] . '" data-type="souvenir">View</button>
                    </td>
                </tr>';
                }
                ?>
            </table>

            <div class="no-souvenir-message" style="
                display: none;
                width: inherit;
                text-align: center;
                padding: 10px 14px;
                background: #fff;">
                No souvenirs found
            </div>
        </div>
    </section>

    <?php require("logout_modal.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <!-- <script src="./js/filtering-meals.js"></script> -->
    <!-- <script src="./js/meal.js"></script> -->
</body>