<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sapphire_hotel";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = $_GET['id'] ?? null;

if (!$booking_id || !is_numeric($booking_id)) {
    die("Invalid booking ID.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $full_name = trim($_POST['full_name']);
    $check_in = date('Y-m-d', strtotime($_POST['check_in']));
    $check_out = date('Y-m-d', strtotime($_POST['check_out']));
    $room_type = trim($_POST['room_type']);
    $total_price = floatval($_POST['total_price']);

    // Update booking
    $stmt = $conn->prepare("UPDATE booking SET full_name=?, check_in=?, check_out=?, room_type=?, total_price=? WHERE booking_id=?");
    $stmt->bind_param("ssssdi", $full_name, $check_in, $check_out, $room_type, $total_price, $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: bookings.php"); // Redirect to bookings page
        exit();
    } else {
        die("Update failed: " . $stmt->error);
    }
}

// Fetch existing booking data
$stmt = $conn->prepare("SELECT * FROM booking WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();

if (!$booking) {
    $conn->close();
    die("Booking not found.");
}

// Close connection (optional here, as script continues to render the form)
$conn->close();
?>
