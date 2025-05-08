<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$password = "";
$db = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $userData = $result->fetch_assoc();
} else {
    die("User not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2>Welcome, <?= htmlspecialchars($userData['name']) ?>!</h2>
    <div class="card p-4 mt-3">
      <p><strong>Full Name:</strong> <?= htmlspecialchars($userData['name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></p>
    </div>
  </div>
</body>
</html>
