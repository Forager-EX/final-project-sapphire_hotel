<?php
$host = 'localhost';
$db = 'sapphire_hotel';
$user = 'root';
$pass = ''; // adjust if your MySQL has a password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Get current and last month values
$currentMonth = date('m');
$lastMonth = date('m', strtotime('-1 month'));
$year = date('Y');

// Total sales this month
$thisMonthSql = "SELECT SUM(total_price) AS total FROM booking 
                 WHERE MONTH(reservation_date) = $currentMonth AND YEAR(reservation_date) = $year";
$thisMonthResult = $conn->query($thisMonthSql);
$thisMonthSales = $thisMonthResult->fetch_assoc()['total'] ?? 0;

// Total sales last month
$lastMonthSql = "SELECT SUM(total_price) AS total FROM booking 
                 WHERE MONTH(reservation_date) = $lastMonth AND YEAR(reservation_date) = $year";
$lastMonthResult = $conn->query($lastMonthSql);
$lastMonthSales = $lastMonthResult->fetch_assoc()['total'] ?? 0;

// Calculate percent change
if ($lastMonthSales == 0) {
    $percentChange = $thisMonthSales == 0 ? 0 : 100;
} else {
    $percentChange = (($thisMonthSales - $lastMonthSales) / $lastMonthSales) * 100;
}

echo json_encode([
    'percent_change' => round($percentChange, 2),
    'this_month_sales' => $thisMonthSales,
    'last_month_sales' => $lastMonthSales
]);
?>
