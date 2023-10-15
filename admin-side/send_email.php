<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../connection.php');
require('../PHPMailer-master/src/Exception.php');
require('../PHPMailer-master/src/PHPMailer.php');
require('../PHPMailer-master/src/SMTP.php');
require('../fpdf186/fpdf.php');

if (isset($_GET['appoint_id'])) {
    $appointmentId = $_GET['appoint_id'];

    $sql = "SELECT ar.*, u.email
            FROM appointment_record AS ar
            INNER JOIN users AS u ON ar.user_id = u.user_id
            WHERE ar.appoint_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $appointmentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $first_name = $result['first_name'];
        $last_name = $result['last_name'];
        $email = $result['email'];
        $appointment_sched_date = $result['appoint_sched_date'];
        $appointment_sched_time = $result['appoint_sched_time'];
        $appoint_description = $result['appoint_description'];

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Image('../images/trinitas_original_logo.jpg', 10, 10, 30);
        $pdf->Cell(0, 10, 'Trinitas Home for Contemplation', 0, 1, 'C');
        $pdf->Cell(0, 10, '+63912345678', 0, 1, 'C');
        $pdf->Cell(0, 10, 'trinitas-homeofcontemplation.com.ph', 0, 1, 'C');
        $pdf->Cell(0, 10, 'FB page: https://tinyurl.com/krfvw4rp', 0, 1, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Appointment Slip', 0, 1, 'C');
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 10, 'Name:', 0);
        $pdf->Cell(0, 10, $first_name . ' ' . $last_name, 0, 1);
        $pdf->Cell(50, 10, 'Date:', 0);
        $pdf->Cell(0, 10, $appointment_sched_date, 0, 1);
        $pdf->Cell(50, 10, 'Time:', 0);
        $pdf->Cell(0, 10, $appointment_sched_time, 0, 1);
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Purpose of Appointment:', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(5);
        $pdf->MultiCell(0, 10, "\t\t\t\t\t\t\t\t\t" . $appoint_description, 0, 'L');
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 20, 'Please present this slip to staff of Trinitas Home for Contemplation. See you there!', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->Cell(80, 10, 'Approved by:___________________', 0, 0, 'L');
        $pdf->Cell(0, 10, 'Date Approved: __________________', 0, 1, 'R');
        $pdf->Cell(0, 10, "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t" . 'Signature', 0, 1);

        $pdfFilename = 'Trinitas_Appointment_Slip_' . $appointmentId . '.pdf';
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

            $mail->Subject = 'Appointment Confirmation';
            $mail->isHTML(true);
            $mail->Body = '<p>Dear '.  $first_name . ',</p><p>Your appointment has been confirmed and is scheduled on '.$appointment_sched_date.' at '. $appointment_sched_time .', right here at Trinitas Home For Contemplation that is located at Zone 5 - Trinitas Street, Upper Bonga, Bacacay, Albay. The attached file is the appointment slip that you need to present upon arrival. See you soon!</p>';

            $mail->send();
        } catch (Exception $e) {
            echo 'Email sending failed: ', $mail->ErrorInfo;
        }

        unlink($pdfPath);
    } else {
        echo "No data found for the appointment ID.";
    }
} else {
    echo "Missing 'appoint_id' in the GET request.";
}
