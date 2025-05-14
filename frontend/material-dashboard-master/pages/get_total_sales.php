<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Only count bookings with a positive total_price
$sql = "SELECT SUM(total_price) AS total_sales FROM booking WHERE total_price > 0";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $formatted = number_format($row['total_sales']); // Format with commas
    echo json_encode(["total_sales" => $formatted]);
} else {
    echo json_encode(["total_sales" => "0"]);
}

$conn->close();
?>
