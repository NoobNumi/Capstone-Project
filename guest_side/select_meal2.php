<?php
require_once("../connection.php");
require_once("fetch_packages.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$transact = $_GET['transact'];
$type = $_GET['type'];
$user_id = $_SESSION['user_id'];
if($type == 'reception'){
    $table = 'reception_reservation_record';
}if($type == 'recollection'){
    $table = 'recollection_reservation_record';
}if($type == 'retreat'){
    $table = 'retreat_reservation_record';
}if($type == 'seminar'){
    $table = 'seminar_reservation_record';
}if($type == 'training'){
    $table = 'training_reservation_record';
}

if (isset($_POST['submit'])) {
  $lunch = $_POST['lunch'];

  $sql = "UPDATE $table SET lunch ='$lunch' WHERE transaction_num = '$transact'";
  $conn->query($sql) or die($conn->error);

  header('Location: select_meal3.php?transact='.$transact.'&type='.$type);

}
$sql = "SELECT * FROM $table WHERE transaction_num = '$transact'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$package = $row['package'];
$except1 = $row['breakfast'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME CDN LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- GOOGLE CDN LINK -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- MAIN STYLE (GUEST-SIDE) -->
    <link rel="stylesheet" href="./css/guest-style.css">
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <link rel="stylesheet" href="./css/reservation-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Reservation</title>
</head>
<body>
    <!-- CASA MARIA RETREAT PACKAGES MODAL -->
 <div class="row">
    <div class="col-md-3 "><br><br><br>
         
              <div class="card mx-5 my-5"> 

            <div class="card-body">
        <div class="">
          
                <p class="reservation-title">Reservation Form</p>
                 <p class="text-center">Transaction Number <?php echo $transact; ?></p>
                 <p class="text-center"><?php echo $row['full_name_org']?></p>
                 <hr>
                <p class="service-name"><?php echo $row['package']; ?> meals:</p>
                <div class="">
                     <?php
                      $sql = "SELECT *
                    FROM $table WHERE transaction_num = '$transact'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                      if($package == 'Catering Package'){
                     
                      ?>
                   <p>Dish 1: <?php echo $row['breakfast']; ?></p>
                   <p>Dish 2: <?php echo $row['lunch']; ?></p>

                  <?php } else{ ?>
                      <p>Breakfast: <?php echo $row['breakfast']; ?></p>
                      <p>Lunch: <?php echo $row['lunch']; ?></p>
                  <?php } ?>
                </div>
              
        </div>
    </div>
</div>  
    </div>
       <div class="col-md-9">  
      
                <div class="mx-5 my-5 row">
              <?php if($package == 'Catering Package'){ ?>
                 <p class="reservation-title">Select Dish 2</p>
         <?php $sql = "SELECT *
        FROM meals WHERE type != 'dessert' AND type != 'drinks' AND meal_name != '$except1' AND type != 'breakfast'";

$stmt = $conn->prepare($sql);
$stmt->execute(); ?>

<?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="container col-md-4 mt-3 mb-5">
        <form method="post">
      
        <div class="card">
            <div class="card-body">
              <div class="food-details">
                        <img src="<?php echo $row['meal_img_path']; ?>">
                        <p class="food-name"><?php echo $row['meal_name']; ?></p>
                    </div>     
            </div>

            <div class=" mx-3 my-3" align="right">
             <input type="hidden" name="lunch" value="<?php echo $row['meal_name']; ?>">
                <button type="submit" name="submit" class="btn btn-primary">Select</button>
            </div>
        </div>

  
</form>
           </div>     
           <?php
            }
            ?>
             <?php } else { ?>


         <p class="reservation-title">Select Lunch</p>
         <?php $sql = "SELECT *
        FROM meals WHERE type = 'ld'";

$stmt = $conn->prepare($sql);
$stmt->execute(); ?>

<?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="container col-md-4 mt-3 mb-5">
        <form method="post">
      
        <div class="card">
            <div class="card-body">
              <div class="food-details">
                        <img src="<?php echo $row['meal_img_path']; ?>">
                        <p class="food-name"><?php echo $row['meal_name']; ?></p>
                    </div>     
            </div>

            <div class=" mx-3 my-3" align="right">
             <input type="hidden" name="lunch" value="<?php echo $row['meal_name']; ?>">
                <button type="submit" name="submit" class="btn btn-primary">Select</button>
            </div>
        </div>

  
</form>
           </div>     
           <?php
            }
        }
            ?>

</div>

    </div>

 </div>
 
   

    <script src="./js/package_modal.js"></script>
    <script src="./js/date-time-selector-modal.js"></script>
    <script>
        function incrementValue() {
            const inputElement = document.getElementById("guest_count");
            let value = parseInt(inputElement.value, 10);
            value = isNaN(value) ? 0 : value;
            inputElement.value = value + 1;
        }

        function decrementValue() {
            const inputElement = document.getElementById("guest_count");
            let value = parseInt(inputElement.value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 0) {
                inputElement.value = value - 1;
            }
        }

    </script>

</body>