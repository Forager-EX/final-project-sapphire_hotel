<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sapphire_hotel";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];  // Get the user ID from the URL

    // Correct the table and column name to match your user table
    $sql = "DELETE FROM user WHERE user_id = ?";  // Using user_id as the primary key
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);  // Bind the parameter as an integer

        if ($stmt->execute()) {
            // Redirect to the users list page after successful deletion
            header("Location: tables.php");
            exit();  // Make sure the script stops after the redirect
        } else {
            echo "Error deleting user.";
        }

        $stmt->close();
    } else {
        echo "Error preparing the query.";
    }
} else {
    echo "No user ID provided.";
}

$conn->close();
?>
