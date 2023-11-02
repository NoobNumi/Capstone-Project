<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../connection.php');
require('../PHPMailer-master/src/Exception.php');
require('../PHPMailer-master/src/PHPMailer.php');
require('../PHPMailer-master/src/SMTP.php');
require('../fpdf186/fpdf.php');

if (isset($_GET['reservation_id']) && isset($_GET['reservation_type'])) {
    $reservationId = $_GET['reservation_id'];
    $reservationType = $_GET['reservation_type'];

    $tableMapping = [
        'reception' => 'reception_reservation_record',
        'recollection' => 'recollection_reservation_record',
        'retreat' => 'retreat_reservation_record',
        'seminar' => 'seminar_reservation_record',
        'training' => 'training_reservation_record',
    ];

    if (array_key_exists($reservationType, $tableMapping)) {
        $tableName = $tableMapping[$reservationType];

        $sql = "SELECT rr.*, u.email
            FROM $tableName AS rr
            INNER JOIN users AS u ON rr.user_id = u.user_id
            WHERE rr.{$reservationType}_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $reservationId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            $street_add = $result['street_add'];
            $city_municipality = $result['city_municipality'];
            $province = $result['province'];
            $email = $result['email'];
            $contact_no = $result['contact_no'];
            $guest_count = $result['guest_count'];
            $check_in = $result['check_in'];
            $check_out = $result['check_out'];
            $price = $result['price'];
            $payment_method = $result['payment_method'];
            $status = $result['status'];


            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);
            $pdf->Image('../images/trinitas_original_logo.jpg', 10, 10, 30);
            $pdf->Cell(0, 10, 'Trinitas Home for Contemplation', 0, 1, 'C');
            $pdf->Cell(0, 10, '+63912345678', 0, 1, 'C');
            $pdf->Cell(0, 10, 'trinitas-homeofcontemplation.com.ph', 0, 1, 'C');
            $pdf->Cell(0, 10, 'FB page: https://tinyurl.com/krfvw4rp', 0, 1, 'C');
            $pdf->Ln(20);


            $fullAddress = $street_add . ', ' . $city_municipality . ', ' . $province;
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Reservation Slip', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Reservation ID:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $reservationId, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Date: _________________', 0, 1);
            $pdf->Cell(0, 10, 'Time: _________________', 0, 1);
            $pdf->Ln(10);
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Name(s):', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $first_name . ' ' . $last_name, 0);

            $pdf->SetX(-90);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(25, 10, 'Email:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $email, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Address: ', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $fullAddress, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Contact no:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $contact_no, 0);

            $pdf->SetX(-90);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Type of Service:');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $reservationType, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Guest/s:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $guest_count, 0);

            $pdf->SetX(-90);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(70, 10, 'Type of Package: ', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Check in:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $check_in, 0);

            $pdf->SetX(-90);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Check out:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $check_out, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Total Amount:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, 'PHP '. number_format($price, 2), 0);

            $pdf->SetX(-90);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(45, 10, 'Payment Method:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $payment_method, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(35, 10, 'Status:', 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(70, 10, $status, 0, 1);

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 20, 'Please present this slip to staff of Trinitas Home for Contemplation. See you there!', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->Cell(80, 10, 'Approved by:___________________', 0, 0, 'L');
            $pdf->Cell(0, 10, 'Date Approved: __________________', 0, 1, 'R');
            $pdf->Cell(0, 10, "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t" . 'Signature', 0, 1);

            $pdfFilename = 'Trinitas_Reservation_Details_' . $reservationId . '.pdf';
            $pdfPath = __DIR__ . '/' . $pdfFilename;
            $pdf->Output($pdfPath, 'F');


            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'trinitashomeforcontemplation@gmail.com';
                $mail->Password = 'yimr typj orca unes';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('trinitashomeforcontemplation@gmail.com', 'Trinitas Home For Contemplation');
                $mail->addAddress($email, $first_name);

                $mail->addAttachment($pdfPath, $pdfFilename);

                $mail->Subject = 'Reservation Confirmation';
                $mail->isHTML(true);
                $mail->Body = '<p>Dear ' .  $first_name . ',</p><p>Your reservation has been confirmed for the following details:</p><p>Check In: ' . $check_in . '</p><p>Check Out: ' . $check_out . '</p><p>Payment Method: ' . $payment_method . '</p><p>See attached for reservation details.</p><p>See you soon!</p>';

                $mail->send();
                echo 'Email sent!';
            } catch (Exception $e) {
                error_log($errorInfo, 3, 'email_errors.log');
                echo 'Email sending failed: ', $mail->ErrorInfo;
            }

            unlink($pdfPath);
        } else {
            echo "No data found for the reservation ID.";
        }
    } else {
        echo "Missing 'reservation_id' in the GET request.";
    }
}

?>

<script>
    setTimeout(function () {
        window.close();
    }, 1000); 
</script>
