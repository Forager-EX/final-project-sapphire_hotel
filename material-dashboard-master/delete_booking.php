<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../admin_login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookingId = intval($_GET['id']);

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "sapphire_hotel";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM booking WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Booking deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting booking.";
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['message'] = "Invalid booking ID.";
}

header("Location: bookings.php");
exit();
?>