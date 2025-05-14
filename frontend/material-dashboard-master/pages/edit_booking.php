<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = $_GET['id'] ?? null;

if (!$booking_id) {
    die("Invalid booking ID.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update logic
    $full_name = $_POST['full_name'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $room_type = $_POST['room_type'];
    $total_price = $_POST['total_price'];

    $stmt = $conn->prepare("UPDATE booking SET full_name=?, check_in=?, check_out=?, room_type=?, total_price=? WHERE booking_id=?");
    $stmt->bind_param("ssssdi", $full_name, $check_in, $check_out, $room_type, $total_price, $booking_id);
    $stmt->execute();

    header("Location:bookings.php"); // Replace with your bookings page filename
    exit();
}

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM booking WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Edit Booking</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($booking['full_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Check-In</label>
            <input type="date" name="check_in" class="form-control" value="<?= $booking['check_in'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Check-Out</label>
            <input type="date" name="check_out" class="form-control" value="<?= $booking['check_out'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Room Type</label>
            <input type="text" name="room_type" class="form-control" value="<?= htmlspecialchars($booking['room_type']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" value="<?= $booking['total_price'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update Booking</button>
        <a href="bookings.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
