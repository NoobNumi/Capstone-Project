<?php
date_default_timezone_set('Asia/Manila');
$type = isset($_GET['data-type']) ? $_GET['data-type'] : 'all';

$query = "SELECT 
    'reservation' AS type, 
    reception_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM reception_reservation_record
UNION
SELECT 
    'reservation' AS type, 
    recollection_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM recollection_reservation_record
UNION
SELECT 
    'reservation' AS type, 
    retreat_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM retreat_reservation_record
UNION
SELECT 
    'reservation' AS type, 
    seminar_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM seminar_reservation_record
UNION
SELECT 
    'reservation' AS type, 
    training_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM training_reservation_record
UNION
SELECT 
    'appointment' AS type, 
    appoint_id AS id, 
    user_id, 
    first_name, 
    last_name, 
    timestamp AS timestamp
FROM appointment_record
ORDER BY timestamp DESC";

$statement = $conn->prepare($query);
$statement->execute();
$notifications = $statement->fetchAll(PDO::FETCH_ASSOC);

$today = strtotime('today');
$yesterday = strtotime('yesterday');

function getTimePeriod($timestamp, $today, $yesterday) {
    if ($timestamp >= $today) {
        return 'Today';
    } elseif ($timestamp >= $yesterday) {
        return 'Yesterday';
    } else {
        return date("M j, Y", $timestamp);
    }
}

$groupedNotifications = [];

foreach ($notifications as $notification) {
    $timestamp = strtotime($notification['timestamp']);
    $timePeriod = getTimePeriod($timestamp, $today, $yesterday);

    $groupedNotifications[$timePeriod][] = $notification;
}
?>


<body>
    <section class="notification-open">
        <span class="notif-number"><?php echo count($notifications); ?></span>
        <button class="notif-bar-btn">
            <i class="fa-solid fa-bell"></i>
        </button>
        <div class="notif-bar">
            <div class="notif-bar-header">
                <h3>Notifications</h3>
                <span>Mark all as read</span>
            </div>
            <div class="notif-types">
                <span class="notif-name active" data-type="all">All</span>
                <span class="notif-name" data-type="reservations">Reservations</span>
                <span class="notif-name" data-type="appointments">Appointments</span>
                <div class="notif-name" data-type="posts">Posts</div>
                <div class="notif-name-slider" role="presentation"></div>
            </div>
            <div class="notif-tags">
                <ul class="notification-list">
                    <?php
                    usort($notifications, function ($a, $b) {
                        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
                    });

                    $previousTimePeriod = '';
                    $timePeriodDisplayed = false;

                    foreach ($notifications as $notification) {
                        $timestamp = strtotime($notification['timestamp']);
                        $formattedTimestamp = date("g:i A", $timestamp);
                        $timePeriod = getTimePeriod($timestamp, $today, $yesterday);

                        $notificationsForTimePeriod = array_filter($notifications, function ($notif) use ($timePeriod, $today, $yesterday) {
                            return getTimePeriod(strtotime($notif['timestamp']), $today, $yesterday) === $timePeriod;
                        });

                        if (!empty($notificationsForTimePeriod)) {
                            if ($timePeriod !== $previousTimePeriod) {
                                if ($timePeriod === 'Today' || $timePeriod === 'Yesterday') {
                                    echo '<span class="time-period">' . $timePeriod . '</span>';
                                } else {
                                    echo '<span class="time-period">' . date("M j", $timestamp) . '</span>';
                                }
                                $timePeriodDisplayed = true;
                            }

                            $previousTimePeriod = $timePeriod;

                            $notifType = ($notification['type'] == 'appointment') ? 'appointments' : 'reservations';
                    ?>
                            <li class="notif-details" data-type="<?php echo $notifType; ?>">
                                <div class="notif-left-side">
                                    <img src="../images/guest.png">
                                    <p class="notif-about">
                                        <span class="notifier-name">
                                            <?php echo $notification['first_name'] . ' ' . $notification['last_name']; ?>
                                        </span>
                                        <?php
                                        if ($notification['type'] == 'appointment') {
                                            echo 'booked an Appointment';
                                        } else {
                                            echo 'booked a Reservation';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="notif-center">
                                    <span class="timestamp"><?php echo $formattedTimestamp; ?></span>
                                </div>
                                <span class="unread-dot"></span>
                            </li>
                    <?php
                        } else {
                            $timePeriodDisplayed = false;
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>