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

// Query to count total bookings
$sql = "SELECT COUNT(*) AS total_bookings FROM booking";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode(["total_bookings" => $row['total_bookings']]);
} else {
    echo json_encode(["total_bookings" => 0]);
}

$conn->close();
?>
