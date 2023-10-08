<!-- sweet alert -->
<link rel="stylesheet" href="./css/custom-sweetalert.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $selectedDates = explode(",", $_POST["selected_dates"]);

        foreach ($selectedDates as $date) {
            $formattedDate = date("F d, Y", strtotime($date));

            $time_slot = '4:00 PM';
            $availability_status = 'available';

            $stmt = $conn->prepare("INSERT INTO appointment_availability (date, time_slot, availability_status) VALUES (:date, :time_slot, :availability_status)");
            $stmt->bindParam(':date', $formattedDate);
            $stmt->bindParam(':time_slot', $time_slot);
            $stmt->bindParam(':availability_status', $availability_status);
            $stmt->execute();
        }

        echo '<script>
        $(document).ready(function () {
            Swal.fire({
                title: "Success!",
                text: "Dates have been successfully inserted!",
                icon: "success",
                showConfirmButton: false,
                timer: 2500,
                customClass: {
                    popup: "custom-sweetalert"
                }
            }).then(() => {
                window.location.href = "calendar.php";
            });
        });
      </script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>