<?php
require_once("connection.php");
function getServiceDescriptions($serviceId) {
    $conn = new mysqli("localhost", "root", "", "trinitas");

    $query = "SELECT s.service_id, s.service_name, cd.description AS category_description, s.price_range, s.img_path
              FROM services s
              INNER JOIN service_descriptions sd ON s.service_id = sd.service_id
              INNER JOIN category_descriptions cd ON sd.description_id = cd.description_id
              WHERE s.service_id = $serviceId";

    $result = $conn->query($query);

    $services = array();
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }

    $conn->close();

    return $services;
}


$serviceIds = [1, 2, 3, 4, 5];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    .service-des-main .price_range{
    margin-left: 8px;
    color: red;
    font-weight: 500;
    font-size: 20px;
}
</style>
<body>

    <!--SERVICES CARD CONTAINERS BEGIN HERE-->

    <section class="reservation-modals" id="reserveModal">
        <div class="services-container">
        <div class="services-container">
        <span class="material-symbols-rounded reserve-close" id="closeReserveModal" onclick="closeReModal()">
                close
            </span>
            <?php foreach ($serviceIds as $serviceId) {
                $serviceDescriptions = getServiceDescriptions($serviceId);
                if (!empty($serviceDescriptions)) {
                    $firstDescription = $serviceDescriptions[0];
                ?>

                <a href="../guest_side/<?php echo $firstDescription['service_name'] . '_page.php'; ?>" class="reserve-link-2-form">
                    <div class="reservation <?php echo $firstDescription['service_name']; ?>">
                        <img src="<?php echo $firstDescription['img_path']; ?>" class="card-image">
                        <h3 class="service-card-title"><?php echo $firstDescription['service_name']; ?></h3>
                        <ul class="service-des-main">
                            <li class="service-des-container">
                                <p class="des"><?php echo '<p class="price_range">₱ ' .  $firstDescription['price_range']; ?></p>
                            </li>
                            <li class="service-des-container">
                                <p class="logo-type-name">Per-person Pricing</p>
                            </li>
                            <?php
                            for ($i = 1; $i < count($serviceDescriptions); $i++) {
                                $description = $serviceDescriptions[$i];
                            ?>
                            <li class="service-des-container">
                                <?php if (!empty($description['description_icon'])) { ?>
                                    <span class="material-symbols-rounded logo-type">
                                        <?php echo '<li class="description"><i class="' .$description['description_icon']; ?>
                                    </span>
                                <?php } ?>
                                <p class="logo-type-name"><?php echo $description['category_description']; ?></p>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </a>
                <?php
                }
            }
            ?>
            <!-- <a href="../guest_side/retreat_page.php" class="reserve-link-2-form">
                <div class="reservation retreat">
                    <img src="../images/Seminar+Retreat.png" class="card-image">
                    <h3 class="service-card-title">Retreat</h3>
                    <ul class="service-des-main">
                    <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">800.00 - 1200.00<span class="amenity">Price Range</span></p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                person
                            </span>
                            <p class="logo-type-name">Per-person Pricing</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                cottage
                            </span>
                            <p class="logo-type-name">Shared Guest Rooms</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">Meal-inclusive Services <span class="amenity">(Optional)</span></p>
                        </li>
                    </ul>
                </div>
            </a> -->

    </section>
    <!--SERVICES CARD CONTAINER ENDS HERE-->

</body>

<script>
    
function closeReModal() {
    var reservemodal = document.getElementById('reserveModal');
        reservemodal.style.display = 'none';
        document.body.style.overflow = 'auto';
}

function show_reserve_modal() {
    var reservemodal = document.getElementById('reserveModal');
        reservemodal.style.display = 'block';
        if (window.innerWidth < 650) {
            document.body.style.overflow = 'hidden';
            document.querySelector('.services-container').style.overflow = 'none';
        } else {
            document.body.style.overflow = 'hidden';
        }
}
</script>


</html>