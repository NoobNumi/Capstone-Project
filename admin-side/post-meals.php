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

$sql = "SELECT meals.meal_id, meals.meal_name, meal_category.mealCat_name
        FROM meals
        JOIN meal_sets ON meals.meal_id = meal_sets.meal_id
        JOIN meal_category ON meal_sets.mealCat_id = meal_category.mealCat_id";

$stmt = $conn->prepare($sql);
$stmt->execute();

try {
    $sqlCount = "SELECT COUNT(*) AS totalMeals FROM meals";
    $resultCount = $conn->query($sqlCount);
    $row = $resultCount->fetch(PDO::FETCH_ASSOC);
    $totalMeals = $row['totalMeals'];
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}


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
    <title>Post Meals</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include "./admin_sidebar.php";
    include "./meal-view.php";
    ?>

    <section class="post-meals">
        <div class="admin-meal-header">
            <div class="right-section">
                <h4 class="admin-title">Meals</h4>
                <p class="total-indicator">There are <span class="total-num"><?php echo $totalMeals ?></span> total meal(s)</p>
            </div>
            <div class="center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search here...">
                </div>
            </div>
            <div class="left-section">
                <select name="selectedStatus" class="sorting-list">
                    <option value="">All</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Dessert">Dessert</option>
                </select>
                <button class="add-btn">Add new</button>
            </div>
        </div>
        <table class="meal-table">
            <tr>
                <th>Meal ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr class="searchable-card">
                    <td>' . sprintf("%03d", $row['meal_id']) . '</td>
                    <td>' . $row['meal_name'] . '</td>
                    <td>' . $row['mealCat_name'] . '</td>
                    <td>
                        <button class="view-btn" data-meal-id="' . $row['meal_id'] . '">View</button>
                    </td>
                </tr>';
            }
            ?>
        </table>
        <div class="no-meals-message" style="
                display: none;
                width: inherit;
                text-align: center;
                padding: 10px 14px;
                background: #fff;">
            No meals found
        </div>
    </section>

    <?php require("logout_modal.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/filtering-meals.js"></script>
    <script src="./js/meal.js"></script>
</body>