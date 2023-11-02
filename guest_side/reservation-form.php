<!DOCTYPE html>
<html lang="en">

<head>
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
    <!-- RESERVATION FORM STARTS -->
    <section class="main-reservation">
        <div class="reservation-container">
            <form action="" method="post" class="reservation-form" ;l>
                <p class="reservation-title">Reservation Form</p>
                <p class="message">Input details about your reservation</p>
                <p class="service-name">Seminar</p>
                <div class="reserve-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="first_name">
                        <span>Firstname</span>
                    </label>

                    <label>
                        <input required="" placeholder="" type="text" class="input" name="last_name">
                        <span>Lastname</span>
                    </label>
                </div>
                <div class="reserve-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="contact_no">
                        <span>Contact Number</span>
                    </label>
                    <label>
                        <div class="guest-div">
                            <div class="input-guest">
                                <i class="fa-solid fa-minus guest-count-con" onclick="decrementValue()"></i>
                                <input type="text" id="guest_count" name="guest_count" readonly value="0">
                                <i class="fa-solid fa-plus guest-count-con" onclick="incrementValue()"></i>
                            </div>
                            <span class="for-guest">Guest Count</span>
                        </div>
                    </label>
                </div>
                <div class="reserve-flex">
                    <label class="select-date">
                        <input required="" placeholder="Check In" type="text" class="input" readonly style="cursor: pointer" id="check_in_date">
                        <div class="sched-buttons" id="calendar-icon-in">
                            <i class="fa-solid fa-calendar-days calendar-icon" title="toggle" data-toggle="calendar-in"></i>
                        </div>
                    </label>

                    <label class="select-date">
                        <input required="" placeholder="Check Out" type="text" class="input" readonly style="cursor: pointer" id="check_out_date">
                        <div class="sched-buttons" id="calendar-icon-out">
                            <i class="fa-solid fa-calendar-days calendar-icon" title="toggle" data-toggle="check_out"></i>
                        </div>
                    </label>
                </div>
                <div class="reserve-flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="contact_no">
                        <span>Meal</span>
                    </label>
                </div>
            </form>
        </div>
        <?php include "check-in-out.php"; ?>
    </section>
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

</html>