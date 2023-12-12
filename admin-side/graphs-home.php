<?php

require_once "../connection.php";
$timezone = new DateTimeZone('Asia/Manila');

// Get the current month
$currentMonth = date('F'); // Full month name
$year = date('Y');
$startDate = date("$year-$currentMonth-01");
$endDate = date("$year-$currentMonth-t");

// Update the sales table for the current month using PDO
$sql = "UPDATE sales SET amount = :subtotal WHERE month = :currentMonth";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':subtotal', $subtotal, PDO::PARAM_INT);
$stmt->bindParam(':currentMonth', $currentMonth, PDO::PARAM_STR);
$stmt->execute();

// Fetch distinct months from the sales table
$sqlDistinctMonths = "SELECT DISTINCT month FROM sales";
$stmtDistinctMonths = $conn->prepare($sqlDistinctMonths);
$stmtDistinctMonths->execute();
$distinctMonths = $stmtDistinctMonths->fetchAll(PDO::FETCH_COLUMN);

// Fetch data for the sales chart using PDO
$test = array();
foreach ($distinctMonths as $month) {
    // Fetch sales data for each month
    $sqlSalesData = "SELECT * FROM sales WHERE month = :month";
    $stmtSalesData = $conn->prepare($sqlSalesData);
    $stmtSalesData->bindParam(':month', $month, PDO::PARAM_STR);
    $stmtSalesData->execute();
    $row = $stmtSalesData->fetch(PDO::FETCH_ASSOC);

    // Add data to the $test array
    $test[] = array(
        "label" => $row["month"],
        "y" => $row["amount"]
    );
}

// Fetch data for the frequency chart using PDO
$test2 = array();
$sql2 = "SELECT * FROM chart";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$count2 = 0;
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $test2[] = array(
        "label" => $row2["type"],
        "y" => $row2["count"]
    );
}
?>
