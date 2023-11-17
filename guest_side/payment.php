<?php
require_once("../connection.php");
require_once("fetch_packages.php");
//session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
$transact = $_GET['transact'];
$user_id = $_SESSION['user_id'];
$sql = "UPDATE reservation SET status = 1 WHERE transaction_num = '$transact'";
  $conn->query($sql) or die($conn->error);
echo 'sent';
$sql = "SELECT * FROM reservation WHERE transaction_num = '$transact'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>