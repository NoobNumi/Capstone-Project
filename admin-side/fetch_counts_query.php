<?php

//Total user count query
$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery);
$userCount = $userCountResult->fetch(PDO::FETCH_ASSOC)['user_count'];


$totalReservations = 0;

// Reception reservation count
$receptionCountQuery = "SELECT COUNT(*) AS reception_count FROM reception_reservation_record";
$receptionCountResult = $conn->query($receptionCountQuery);
$receptionCount = $receptionCountResult->fetch(PDO::FETCH_ASSOC)['reception_count'];
$totalReservations += $receptionCount;

// Seminar reservation count
$seminarCountQuery = "SELECT COUNT(*) AS seminar_count FROM seminar_reservation_record";
$seminarCountResult = $conn->query($seminarCountQuery);
$seminarCount = $seminarCountResult->fetch(PDO::FETCH_ASSOC)['seminar_count'];
$totalReservations += $seminarCount;

// Recollection reservation count
$recollectionCountQuery = "SELECT COUNT(*) AS recollection_count FROM recollection_reservation_record";
$recollectionCountResult = $conn->query($recollectionCountQuery);
$recollectionCount = $recollectionCountResult->fetch(PDO::FETCH_ASSOC)['recollection_count'];
$totalReservations += $recollectionCount;

// Retreat reservation count
$retreatCountQuery = "SELECT COUNT(*) AS retreat_count FROM retreat_reservation_record";
$retreatCountResult = $conn->query($retreatCountQuery);
$retreatCount = $retreatCountResult->fetch(PDO::FETCH_ASSOC)['retreat_count'];
$totalReservations += $retreatCount;

// Training reservation count
$trainingCountQuery = "SELECT COUNT(*) AS training_count FROM training_reservation_record";
$trainingCountResult = $conn->query($trainingCountQuery);
$trainingCount = $trainingCountResult->fetch(PDO::FETCH_ASSOC)['training_count'];
$totalReservations += $trainingCount;



$totalPendingReservations = 0;

// Pending reception reservations
$pendingReceptionQuery = "SELECT COUNT(*) AS pending_reception_count FROM reception_reservation_record WHERE status = 'pending'";
$pendingReceptionResult = $conn->query($pendingReceptionQuery);
$pendingReceptionCount = $pendingReceptionResult->fetch(PDO::FETCH_ASSOC)['pending_reception_count'];
$totalPendingReservations += $pendingReceptionCount;

// Pending seminar reservations
$pendingSeminarQuery = "SELECT COUNT(*) AS pending_seminar_count FROM seminar_reservation_record WHERE status = 'pending'";
$pendingSeminarResult = $conn->query($pendingSeminarQuery);
$pendingSeminarCount = $pendingSeminarResult->fetch(PDO::FETCH_ASSOC)['pending_seminar_count'];
$totalPendingReservations += $pendingSeminarCount;

// Pending recollection reservations
$pendingRecollectionQuery = "SELECT COUNT(*) AS pending_recollection_count FROM recollection_reservation_record WHERE status = 'pending'";
$pendingRecollectionResult = $conn->query($pendingRecollectionQuery);
$pendingRecollectionCount = $pendingRecollectionResult->fetch(PDO::FETCH_ASSOC)['pending_recollection_count'];
$totalPendingReservations += $pendingRecollectionCount;

// Pending retreat reservations
$pendingRetreatQuery = "SELECT COUNT(*) AS pending_retreat_count FROM retreat_reservation_record WHERE status = 'pending'";
$pendingRetreatResult = $conn->query($pendingRetreatQuery);
$pendingRetreatCount = $pendingRetreatResult->fetch(PDO::FETCH_ASSOC)['pending_retreat_count'];
$totalPendingReservations += $pendingRetreatCount;

// Pending training reservations
$pendingTrainingQuery = "SELECT COUNT(*) AS pending_training_count FROM training_reservation_record WHERE status = 'pending'";
$pendingTrainingResult = $conn->query($pendingTrainingQuery);
$pendingTrainingCount = $pendingTrainingResult->fetch(PDO::FETCH_ASSOC)['pending_training_count'];
$totalPendingReservations += $pendingTrainingCount;

//total appointment query
$appointmentCountQuery = "SELECT COUNT(*) AS appointment_count FROM appointment_record";
$appointmentCountResult = $conn->query($appointmentCountQuery);
$appointmentCount = $appointmentCountResult->fetch(PDO::FETCH_ASSOC)['appointment_count'];


//total unconfirmed appointments account
$pendingAppointmentsQuery = "SELECT COUNT(*) AS pending_appointments_count FROM appointment_record WHERE appoint_status = 'pending'";
$pendingAppointmentsResult = $conn->query($pendingAppointmentsQuery);
$pendingAppointmentsCount = $pendingAppointmentsResult->fetch(PDO::FETCH_ASSOC)['pending_appointments_count'];
