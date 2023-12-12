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
    $contact_no = $_POST['contact_no'];
    $appoint_sched_date = $_POST['appoint_sched_date'];
    $appoint_description = $_POST['appoint_description'];

    $appoint_sched_time = "4:00 PM";
    $appoint_status = "pending";

    date_default_timezone_set('Asia/Manila');

    $currentTimestamp = date("Y-m-d H:i:s");

    $query = $conn->prepare("SELECT * FROM `appointment_record` WHERE `first_name` = ? AND `last_name` = ?");
    $query->bindValue(1, $first_name);
    $query->bindValue(2, $last_name);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    $query = "INSERT INTO appointment_record (user_id, first_name, last_name, contact_no, appoint_sched_date, appoint_sched_time, appoint_description, appoint_status, timestamp, is_read, is_read_user) VALUES (:user_id, :first_name, :last_name, :contact_no, :appoint_sched_date, :appoint_sched_time, :appoint_description, :appoint_status, :timestamp, 0, 0)";
    $run_query = $conn->prepare($query);

    $data = [
        ':user_id' => $user_id,
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':contact_no' => $contact_no,
        ':appoint_sched_date' => $appoint_sched_date,
        ':appoint_sched_time' => $appoint_sched_time,
        ':appoint_description' => $appoint_description,
        ':appoint_status' => $appoint_status,
        ':timestamp' => $currentTimestamp
    ];

    $query_execute = $run_query->execute($data);
    if ($query_execute) {
        $success = 1;
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
    include("notification-bar.php");
    ?>
    <!--APPOINTMENT FORM STARTS-->
    <section class="main-appointment">
        <div class="appointment-container">
            <form action="" method="POST" class="appointment-form">
                <p class="appointment-title">Appointment Form</p>
                <p class="message">Input details about your appointment</p>
                <div class="appoint-flex">
                    <?php
                        $select_query = 'SELECT * FROM `users` WHERE user_id = :user_id';
                        $stmt = $conn->prepare($select_query);
                        $stmt->bindParam(':user_id', $_SESSION['user_id']);
                        $stmt->execute();
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($stmt->rowCount() > 0) {
                            $first_name = $user['first_name'];
                            $last_name = $user['last_name'];
                    ?>
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="first_name" value="<?php echo $first_name; ?>">
                            <span>Firstname</span>
                        </label>
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="last_name" value="<?php echo $last_name; ?>">
                            <span>Lastname</span>
                        </label>
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
                        <textarea name="appoint_description" placeholder="Input purpose of appointment here..." cols="30" rows="5" class="app-description" oninput="limitTextarea(this, 300)"></textarea>
                    </label>
                </div>
                <p id="char-count">Characters: 0 / 300</p>
            <?php
                    }
            ?>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <button class="btn-login-signup" type="submit" name="submit" style="height: 50px; cursor:pointer;">Make an Appointment</button>
            </form>
        </div>
        <?php include("date_time_selector.php"); ?>
        <?php include("logout_modal.php"); ?>
    </section>
    <?php include("guest_footer.php"); ?>
    <script>
        function limitTextarea(textarea, maxChars) {
            const text = textarea.value;
            const currentCharCount = text.length;

            if (currentCharCount > maxChars) {
                textarea.value = text.slice(0, maxChars);
            }

            document.getElementById('char-count').textContent = `Characters: ${Math.min(currentCharCount, maxChars)} / ${maxChars}`;
        }
    </script>
    <script>
        let selectedDate = null;
        let selectedTime = null;
    </script>
    <script src="./js/date-time-selector-modal.js"></script>
    <script src="./js/insert_date_time.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="./js/populateNotification.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>