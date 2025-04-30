<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// DB connection
$dsn = 'mysql:host=localhost;dbname=sapphire_hotel';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get form input
$login = $_POST['Username or Email'] ?? '';
$password = $_POST['Password'] ?? '';

// Query (check against name or email)
$sql = "SELECT * FROM user WHERE name = :Username OR Email = :username LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $login);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['name'];
    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>alert('Invalid username or password'); window.location.href = 'login.php';</script>";
    exit;
}
?>
