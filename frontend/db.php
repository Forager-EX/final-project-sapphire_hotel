<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sapphire_hotel';

// Create a new connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
