<?php
session_start();

// Connect to your database
$host = "localhost";
$dbname = "sapphire_hotel";   // <-- change this
$dbuser = "root";             // <-- default in XAMPP
$dbpass = "";                 // <-- default empty in XAMPP

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from the form
$username = $_POST['username'];  // This will be the email
$password = $_POST['password'];  // Plain text password

// Prevent SQL injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Query to check if the email exists
$sql = "SELECT * FROM user WHERE email = '$username'";
$result = $conn->query($sql);

// Check if the user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Debug: Check if the hashed password matches
    if (password_verify($password, $user['password'])) {
        echo "Password matches!"; // Debug output

        // Password is correct, start session
        $_SESSION['user_id'] = $user['user_id'];  // Store user_id in session
        $_SESSION['username'] = $user['name'];    // Store username in session
        header("Location: index.php"); // Redirect to index
        exit();
    } else {
        echo "Password does not match!"; // Debug output
        exit();
    }
} else {
    echo "No user found!"; // Debug output
    // No user found with that email
    header("Location: login.php?error=wrongpassword");  // User not found
    exit();
}
?>
