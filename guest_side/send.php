<?php
require_once("../connection.php");
//session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$transact = $_GET['transact'];
$type = $_GET['type'];
$user_id = $_SESSION['user_id'];
$sql = "UPDATE $table total = '$totalCost' WHERE transaction_num = '$transact'";
         $conn->query($sql) or die($conn->error);

           
      header('Location: guest_dashboard.php?success=Submitted successfully');

?>