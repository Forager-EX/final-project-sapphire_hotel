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

// SQL query to count total number of users
$sql = "SELECT COUNT(user_id) AS user_count FROM user";  // Assuming 'user' is your table name
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode(["user_count" => $row['user_count']]);
} else {
    echo json_encode(["user_count" => 0]);
}

$conn->close();
?>
