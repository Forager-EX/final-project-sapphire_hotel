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

// Count users registered this week
$current_week_sql = "SELECT COUNT(*) AS count FROM user WHERE YEARWEEK(createdAt, 1) = YEARWEEK(CURDATE(), 1)";
$last_week_sql = "SELECT COUNT(*) AS count FROM user WHERE YEARWEEK(createdAt, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1)";

$current_result = $conn->query($current_week_sql);
$last_result = $conn->query($last_week_sql);

if ($current_result && $last_result) {
    $current_count = $current_result->fetch_assoc()['count'];
    $last_count = $last_result->fetch_assoc()['count'];

    if ($last_count == 0) {
        $percent_change = $current_count > 0 ? 100 : 0;
    } else {
        $percent_change = round((($current_count - $last_count) / $last_count) * 100);
    }

    echo json_encode(["percent_change" => $percent_change]);
} else {
    echo json_encode(["percent_change" => 0]);
}

$conn->close();
?>
