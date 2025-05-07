<?php
session_start();

// Connect to your database
$host = "localhost";
$dbname = "sapphire_hotel";   
$dbuser = "root";             
$dbpass = "";                 

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from the form
$input = $_POST['email'];  // This can be either the username or email
$password = $_POST['password'];  // Plain text password

// Prevent SQL injection
$input = $conn->real_escape_string($input);
$password = $conn->real_escape_string($password);

// Query to check if the input matches either username or email
$sql = "SELECT * FROM user WHERE email = '$input' OR name = '$input'";
$result = $conn->query($sql);

// Check if the user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify if the password matches
    if (password_verify($password, $user['password'])) {
        // Password is correct, start session
        $_SESSION['user_id'] = $user['user_id'];  // Store user_id in session
        $_SESSION['username'] = $user['name'];    // Store username in session
        header("Location: index.php"); // Redirect to index page
        exit();
    } else {
        // Password mismatch
        header("Location: login.php?error=wrongpassword");  
        exit();
    }
} else {
    // No user found with the given email or username
    header("Location: login.php?error=usernotfound");  
    exit();
}

$conn->close();
?>
