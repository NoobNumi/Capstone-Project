<?php
require_once("../connection.php");
require_once("fetch_packages.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$user_id = $_SESSION['user_id'];

    
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
 
    <div class="mx-5 my-5 row">
         <p class="reservation-title">Select Package</p>
         <?php $sql = "SELECT *
        FROM packages";

$stmt = $conn->prepare($sql);
$stmt->execute(); ?>
<?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="container col-md-4 mt-3 mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="package-title text-center">
                    <?php echo $row['name']; ?>
                </h4>
                   <p>Amount:  <?php echo '₱'.$row['price']; ?></p>
                   <input type="hidden" name="package" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">                
            </div>

            <div class="content">
                <div class="first-part">
                    <div class="about-package">
                        <h5 class="this-content-title">What This Package Offers?</h5>
                        <ul class="package-ammenities">
                            <?php
                            $casaAmenities = getAmenitiesByPackageId(1); 
                            foreach ($casaAmenities as $amenity) {
                                echo '<li class="ammenity"><i class="' . $amenity['amenity_icon'] . '"></i><p>' . $amenity['amenity_name'] . '</p></li>';
                            }
                            ?>
                        </ul>
                    </div>
                   
                    <div class="package-carousel">
                        <div class="package-carousel-container">
                            <div class="package-carousel-slides images">
                                <img src="../images/IMG20230907152629.jpg" class="carousel-image-pkg">
                                <img src="../images/IMG20230907153519.jpg" class="carousel-image-pkg">
                                <img src="../images/IMG20230907153544.jpg" class="carousel-image-pkg">
                                <img src="../images/img17.jpg" class="carousel-image-pkg">
                                <img src="../images/img3.jpg" class="carousel-image-pkg">
                            </div>
                            <button class="carousel-button-img prev-btn"><i class="fa-solid fa-caret-left"></i></button>
                            <button class="carousel-button-img next-btn"><i
                                    class="fa-solid fa-caret-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mx-3 my-3" align="right">
             
                <a href="select_package2.php?id=<?php echo $row['package_id']; ?>" class="btn btn-primary" role="button">Select</a>
            </div>
        </div>

  </div>
               <?php
            }
            ?>
 
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