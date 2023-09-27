<?php
session_name("user_session");
session_start();
require_once("../connection.php");
$already_filed = 0;
$success = 0;

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $street_add = $_POST['street_add'];
    $city_municipality = $_POST['city_municipality'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];
    $contact_no = $_POST['contact_no'];
    $appoint_sched_date = $_POST['appoint_sched_date'];
    $appoint_sched_time = $_POST['appoint_sched_time'];
    $appoint_description = $_POST['appoint_description'];

    $query = $conn->prepare("SELECT * FROM `appoinment_record` WHERE `first_name` = ? AND `last_name` = ?");
    $query->bindValue(1, $first_name);
    $query->bindValue(2, $last_name);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        $already_filed = 1;
    } else {
        $query = "INSERT INTO appoinment_record (user_id, first_name, last_name, street_add, city_municipality, province, postal_code, contact_no, appoint_sched_date, appoint_sched_time, appoint_description) VALUES (:user_id, :first_name, :last_name, :street_add, :city_municipality, :province, :postal_code, :contact_no, :appoint_sched_date, :appoint_sched_time, :appoint_description)";
        $run_query = $conn->prepare($query);

        $data = [
            ':user_id' => $user_id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':street_add' => $street_add,
            ':city_municipality' => $city_municipality,
            ':province' => $province,
            ':postal_code' => $postal_code,
            ':contact_no' => $contact_no,
            ':appoint_sched_date' => $appoint_sched_date,
            ':appoint_sched_time' => $appoint_sched_time,
            ':appoint_description' => $appoint_description
        ];

        $query_execute = $run_query->execute($data);
        if ($query_execute) {
            $success = 1;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <title>Appointment</title>
</head>

<body>
    <!-- sweet alert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if ($already_filed) {
        echo '<div class="alert alert-danger" style="text-align:center; font-size: 1.2rem;">
            <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px";></i>You already filed an appointment!</strong>
            </div>';
    }
    if ($success) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Appointment successful',
                showConfirmButton: false,
                timer: 2500
            })
            Swal.fire({
                icon: 'success',
                title: 'Appointment successful',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    <?php } ?>
    <?php
    include("guest_navbar.php");
    ?>

    <!--APPOINTMENT FORM STARTS-->
    <section class="main-appointment">
        <div class="appointment-container">
            <form action="" method="POST" class="appointment-form">
                <p class="appointment-title">Appointment Form</p>
                <p class="message">Input details about your appointment</p>
                <div class="appoint-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="first_name">
                        <span>Firstname</span>
                    </label>

                    <label>
                        <input required="" placeholder="" type="text" class="input" name="last_name">
                        <span>Lastname</span>
                    </label>
                </div>
                <div class="appoint-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="street_add">
                        <span>Street</span>
                    </label>
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="city_municipality">
                        <span>Municipality</span>
                    </label>

                </div>
                <div class="appoint-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="province">
                        <span>Province</span>
                    </label>

                    <label>
                        <input required="" placeholder="" type="text" class="input" name="postal_code">
                        <span>Postal Code</span>
                    </label>

                </div>
                <div class="appoint-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="contact_no">
                        <span>Contact Number</span>
                    </label>
                    <label class="select-date">
                        <input required="" placeholder="Schedule" id="schedule-input" type="text" class="input" readonly style="cursor: auto;">
                        <input required="" type="hidden" id="appoint_sched_date" name="appoint_sched_date">
                        <input required="" type="hidden" id="appoint_sched_time" name="appoint_sched_time">
                        <div class="sched-buttons" id="calendar-icon">
                            <span class="material-symbols-rounded calendar-icon" title="toggle" data-toggle>
                                calendar_month
                            </span>
                        </div>
                    </label>
                </div>
                <div class="appoint-info">
                    <label>
                        <textarea name="appoint_description" placeholder="Input purpose of appointment here..." cols="30" rows="5" class="app-description"></textarea>
                    </label>
                </div>
                <?php
                $select_query = 'SELECT * FROM `users` WHERE user_id = :user_id';
                $stmt = $conn->prepare($select_query);
                $stmt->bindParam(':user_id', $_SESSION['user_id']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                ?>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <?php
                }
                ?>
                <button class="btn-login-signup" type="submit" name="submit" style="height: 50px; cursor:pointer;">Make an Appointment</button>
            </form>
        </div>
        <?php include("date_time_selector.php"); ?>
        <?php include("logout_modal.php"); ?>
    </section>
    <?php include("guest_footer.php"); ?>
    <script>
        let selectedDate = null;
        let selectedTime = null;
    </script>
    <script src="./js/date-time-selector-modal.js"></script>
    <script src="./js/insert_date_time.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>