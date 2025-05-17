<?php
$host = 'localhost';
$db   = 'sapphire_hotel';   // Replace with your real DB name if different
$user = 'root';
$pass = '';                 // No password if you're using default XAMPP setup


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("UPDATE user SET name=?, email=?, password=? WHERE user_id=?");
    $stmt->bind_param("sssi", $name, $email, $password, $id);
    $stmt->execute();
}

header("Location: tables.php"); // Optional: redirect or use AJAX instead
?>
