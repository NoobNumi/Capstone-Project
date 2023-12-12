<!-- sweet alert -->
<link rel="stylesheet" href="./css/custom-sweetalert.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $selectedDates = explode(",", $_POST["selected_available_dates_reservation"]);

        foreach ($selectedDates as $date) {
            $formattedDate = date("F d, Y", strtotime($date));

            $stmt = $conn->prepare("INSERT INTO available_reservation_dates (available_date) VALUES (:date)");
            $stmt->bindParam(':date', $formattedDate);
            $stmt->execute();
        }

        echo '<script>
        $(document).ready(function () {
            Swal.fire({
                title: "Success!",
                text: "Available Reservation dates have been successfully added!",
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
