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

// Get booking counts for this week and last week using reservation_date
$sql = "
    SELECT 
        SUM(CASE 
            WHEN YEARWEEK(reservation_date, 1) = YEARWEEK(CURDATE(), 1) THEN 1 
            ELSE 0 
        END) AS this_week,
        SUM(CASE 
            WHEN YEARWEEK(reservation_date, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1) THEN 1 
            ELSE 0 
        END) AS last_week
    FROM booking
";

$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $this_week = (int)$row['this_week'];
    $last_week = (int)$row['last_week'];

    if ($last_week === 0) {
        $change = $this_week > 0 ? 100 : 0;  // Avoid division by zero
    } else {
        $change = (($this_week - $last_week) / $last_week) * 100;
    }

    echo json_encode([
        "this_week" => $this_week,
        "last_week" => $last_week,
        "percent_change" => round($change, 2)
    ]);
} else {
    echo json_encode(["this_week" => 0, "last_week" => 0, "percent_change" => 0]);
}

$conn->close();
?>
