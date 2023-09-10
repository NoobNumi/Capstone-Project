<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <title>Appointment</title>
</head>
<body>
    <?php include("guest_navbar.php");?>

    <!--APPOINTMENT FORM STARTS-->
    <section class="main-appointment">
        <div class="appointment-container">
            <form action="" method="post" class="appointment-form">
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
                        <input required="" placeholder="Schedule" id="schedule-input" type="text"
                            class="input flatpickr" readonly style="cursor: auto;" name="appoint-sched">
                        <div class="sched-buttons">
                            <span class="material-symbols-rounded calendar" title="toggle" id="calendar-icon"
                                data-toggle>
                                calendar_month
                            </span>
                        </div>
                    </label>
                </div>
                <div class="appoint-info">
                    <label>
                        <textarea name="appoint_description" placeholder="Input purpose of appointment here..."
                            cols="30" rows="5" class="app-description"></textarea>
                    </label>
                </div>
                <button class=" btn-login-signup" style="height: 50px; cursor:pointer;">Make an Appointment</button>
            </form>

        </div>
    </section>

    <?php include("guest_footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="./js/flatpicker_calendar.js"></script>

</body>

</html>