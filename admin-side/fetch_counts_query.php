<?php

//Total user count query
$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery);
$userCount = $userCountResult->fetch(PDO::FETCH_ASSOC)['user_count'];


//total appointment query
$appointmentCountQuery = "SELECT COUNT(*) AS appointment_count FROM appointment_record";
$appointmentCountResult = $conn->query($appointmentCountQuery);
$appointmentCount = $appointmentCountResult->fetch(PDO::FETCH_ASSOC)['appointment_count'];


//total unconfirmed appointments account
$pendingAppointmentsQuery = "SELECT COUNT(*) AS pending_appointments_count FROM appointment_record WHERE appoint_status = 'pending'";
$pendingAppointmentsResult = $conn->query($pendingAppointmentsQuery);
$pendingAppointmentsCount = $pendingAppointmentsResult->fetch(PDO::FETCH_ASSOC)['pending_appointments_count'];



?>