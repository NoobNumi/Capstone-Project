<?php
function fetchMeals($category)
{
    include("../connection.php");

    $query = "SELECT meal_name, meal_img_path FROM meals
              JOIN meal_sets ON meals.meal_id = meal_sets.meal_id
              JOIN meal_category ON meal_sets.mealCat_id = meal_category.mealCat_id
              WHERE meal_category.mealCat_name = :category";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':category', $category);
    $stmt->execute();

    $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $meals;
}

$selectedCategory = 'Breakfast';

if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
}

$selectedMeals = fetchMeals($selectedCategory);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>Meals</title>

</head>

<body>
    <section class="meal-section">
        <div class="meal-section-header">
            <div class="nav-toggle-choices">
                <span><a href="#" class="back-button" id="back-btn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </span>
                <span class="meal-type <?php if ($selectedCategory === 'Breakfast') echo 'selected'; ?>" onclick="window.location.href = window.location.pathname + '?category=Breakfast'">
                    Breakfast
                </span>
                <span class="meal-type <?php if ($selectedCategory === 'Lunch') echo 'selected'; ?>" onclick="window.location.href = window.location.pathname + '?category=Lunch'">
                    Lunch
                </span>
                <span class="meal-type <?php if ($selectedCategory === 'Dinner') echo 'selected'; ?>" onclick="window.location.href = window.location.pathname + '?category=Dinner'">
                    Dinner
                </span>
                <span class="meal-type <?php if ($selectedCategory === 'Dessert') echo 'selected'; ?>" onclick="window.location.href = window.location.pathname + '?category=Dessert'">
                    Dessert
                </span>
                <span class="meal-type <?php if ($selectedCategory === 'Drinks') echo 'selected'; ?>" onclick="window.location.href = window.location.pathname + '?category=Drinks'">
                    Drinks
                </span>

            </div>
        </div>
        <div class="meal-name">
            <div class="meal-type-name"><?php echo $selectedCategory; ?></div>
            <div class="meal-list">
                <?php foreach ($selectedMeals as $meal) : ?>
                    <div class="food-details">
                        <img src="<?php echo $meal['meal_img_path']; ?>">
                        <p class="food-name"><?php echo $meal['meal_name']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="check-out-btn">
            <a href="#" class="link-2-form">Reserve Now</a>
        </div>
    </section>
    <script src="./js/food.js"></script>

</body>

</html>