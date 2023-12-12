<?php
require_once("../connection.php");
require_once("fetch_packages.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];
$sql = "SELECT * FROM packages WHERE package_id = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$package = $row['name'];
$price = $row['price'];
$type = $row['type'];
if ($type == 'reception') {
    $table = 'reception_reservation_record';
}
if ($type == 'recollection') {
    $table = 'recollection_reservation_record';
}
if ($type == 'retreat') {
    $table = 'retreat_reservation_record';
}
if ($type == 'seminar') {
    $table = 'seminar_reservation_record';
}
if ($type == 'training') {
    $table = 'training_reservation_record';
}
$letters = '';
$numbers = '';
foreach (range('A', 'Z') as $char) {
    $letters .= $char;
}
for ($i = 0; $i < 9; $i++) {
    $numbers .= $i;
}
$transact = substr(str_shuffle($letters), 0, 5) . substr(str_shuffle($numbers), 0, 5);

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact = $_POST['contact_no'];
    $guest = $_POST['guest_count'];
    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];

    $current_timestamp = date('Y-m-d H:i:s', strtotime('now Asia/Manila'));

    $sql = "INSERT INTO `$table` (
                    `user_id`,
                    `first_name`,
                    `last_name`,
                    `contact_no`,
                    `guest`,
                    `check_in`,
                    `check_out`,
                    `package`,
                    `type`,
                    `price`,
                    `transaction_num`,
                    `timestamp`
                ) VALUES (
                    '$user_id',
                    '$first_name',
                    '$last_name',
                    '$contact',
                    '$guest',
                    '$datefrom',
                    '$dateto',
                    '$package',
                    '$type',
                    '$price',
                    '$transact',
                    '$current_timestamp'
                )";

    $conn->query($sql) or die($conn->error);

    header('Location: select_meal.php?transact=' . $transact . '&type=' . $type);
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- CASA MARIA RETREAT PACKAGES MODAL -->

    <section class=" mx-3 my-3">
        <div class="mx-5 my-5 row">
            <div class="container col-md-6 mt-3 mb-5">
                <div class="card">
                    <div class="card-body">
                            <form method="post" class="reservation-form mx-3 my-3">
                                <p class="reservation-title">Reservation Form</p>
                                <p class="message">Input details about your reservation</p>
                                <p class="service-name">You have selected <?php echo $package; ?> with a price of ₱<?php echo $price; ?>.</p>
                                <div class="reserve-flex">
                                    <?php

                                    $sql = "SELECT *
                    FROM users WHERE user_id = '$user_id'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                    ?>
                                    <label>
                                        <input required="" placeholder="" type="text" class="input" name="first_name" value="<?php echo $row['first_name']; ?>">
                                        <span>Firstname</span>
                                    </label>

                                    <label>
                                        <input required="" placeholder="" type="text" class="input" name="last_name" value="<?php echo $row['last_name']; ?>">
                                        <span>Lastname</span>
                                    </label>
                                </div>
                                <div class="reserve-flex">
                                    <label>
                                        <input required="" placeholder="" type="text" class="input" name="contact_no">
                                        <span>Contact Number</span>
                                    </label>
                                    <label>

                                        <?php if ($package == 'Casa Maria Retreat Package') { ?>
                                            <input type="number" min="1" value="" required class="input" name="guest_count" max="7">
                                            <span>Guest Count</span>
                                        <?php } elseif ($package == 'Lunduyan Retreat Package') { ?>
                                            <input type="number" min="1" value="" required class="input" name="guest_count" max="50">
                                            <span>Guest Count</span>
                                        <?php } elseif ($package == 'Venue-Only Package' or $package == 'Catering Package') { ?>
                                            <input type="number" min="1" value="" required class="input" name="guest_count" max="100">
                                            <span>Guest Count</span>
                                        <?php } else { ?>
                                            <input type="number" min="1" value="" required class="input" name="guest_count" max="75">
                                            <span>Guest Count</span>
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="reserve-flex">
                                    <label class="select-date">
                                        <input required="" placeholder="Check In" name="date_from" type="text" class="input" readonly style="cursor: pointer" id="check_in_date">
                                        <div class="sched-buttons" id="calendar-icon-in">
                                            <!-- This icon -->
                                            <i class="fa-solid fa-calendar-days calendar-icon" title="toggle" data-toggle="calendar-in"></i>
                                        </div>
                                    </label>
                                    <label class="select-date">
                                        <input required="" placeholder="Check Out" name="date_to" type="text" class="input" readonly style="cursor: pointer" id="check_out_date">
                                        <div class="sched-buttons" id="calendar-icon-out">
                                            <!-- This is the last date -->
                                            <i class="fa-solid fa-calendar-days calendar-icon" title="toggle" data-toggle="check_out"></i>
                                        </div>
                                    </label>
                                </div>
                                <br>
                                <input type="hidden" name="transact" value="<?php echo $transact; ?>">
                                <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
                                <a href="select_package.php" class="btn btn-warning" role="button">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/package_modal.js"></script>
    <script src="./js/checkINcheckOut.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>