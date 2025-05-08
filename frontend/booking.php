<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "sapphire_hotel";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in. Please log in to proceed with booking.");
    }
    
    $user_id = intval($_SESSION['user_id']);  // Get the user ID from session

    // Validate form inputs
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : null;
    $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : null;
    $check_out = isset($_POST['check_out']) ? $_POST['check_out'] : null;
    $guest_num = isset($_POST['guest_num']) ? intval($_POST['guest_num']) : 0;
    $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : null;

    // Check if required fields are provided
    if (!$check_in || !$check_out || !$guest_num || !$room_type) {
        die("All fields are required. Please fill in all fields to proceed.");
    }

    // Check if the check-in date is before the check-out date
    if ($check_in >= $check_out) {
        die("Check-out date must be after check-in date.");
    }
    $status = 'Pending';
    $stmt = $conn->prepare("INSERT INTO booking (full_name, user_id, check_in, check_out, status, guest_num, room_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssis", $full_name, $user_id, $check_in, $check_out, $status, $guest_num, $room_type);
    

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Now - Sapphire Hotel</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/booking.css" />
  <link rel="stylesheet" href="css/room.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar__container">
      <a href="index.php" id="navbar__logo">
        <img src="img/sh icon.png" alt="Sapphire Hotel Logo" class="navbar__logo-img" />
        Sapphire Hotel
      </a>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item"><a href="index.php" class="navbar__links">Home</a></li>
        <li class="navbar__item"><a href="services.php" class="navbar__links">Services</a></li>
        <li class="navbar__item"><a href="rooms.php" class="navbar__links">Rooms</a></li>
        <li class="navbar__item"><a href="contact.php" class="navbar__links">Contact</a></li>
        <li class="navbar__item"><a href="profile.php" class="navbar__links">Profile</a></li>
        <li class="navbar__btn"><a href="login.php" class="button">Login/Sign-up</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="main-content-wrapper">
    <section id="booking" class="booking section">
      <div class="container">
        <h2>Book Your Stay</h2>
        <form id="bookingForm" method="POST" action="">
          <div class="row gy-4">
          <div class="col-lg-6">
            <label for="fullName" class="form-label">Full Name:</label>
            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Your Full Name" required />
          </div>
            <div class="col-lg-6">
              <label for="checkInDate" class="form-label">Check-In Date:</label>
              <input type="text" id="checkInDate" name="check_in" class="form-control" placeholder="Select Check-In Date" readonly required />
            </div>
            <div class="col-lg-6">
              <label for="checkOutDate" class="form-label">Check-Out Date:</label>
              <input type="text" id="checkOutDate" name="check_out" class="form-control" placeholder="Select Check-Out Date" readonly required />
            </div>
            <div class="col-lg-6">
              <label for="roomType" class="form-label">Room Type:</label>
              <select id="roomType" name="room_type" class="form-select" required>
                <option value="" disabled selected>Select Room Type</option>
                <option value="standard">Standard</option>
                <option value="deluxe">Deluxe</option>
                <option value="exclusive">Exclusive Suite</option>
              </select>
            </div>
            <div class="col-lg-6">
              <label for="numberOfGuests" class="form-label">Number of Guests:</label>
              <input type="number" id="numberOfGuests" name="guest_num" class="form-control" min="1" max="5" required />
            </div>
          </div>

          <!-- Booking Summary -->
          <div class="booking-summary mt-4">
            <h3>Booking Summary</h3>
            <div id="summaryRoomType" class="mt-2"></div>
            <div id="summaryGuests" class="mt-2"></div>
            <div id="summaryNights" class="mt-2"></div>
            <div id="summaryTotalAmount" class="mt-2"></div>
            <button type="submit" class="btn btn-primary mt-3" id="confirmButton">Confirm Booking</button>
          </div>
        </form>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>© 2025 Sapphire Hotel. All rights reserved.</p>
      <div class="social-links">
        <a href="#"><img src="img/facebook.png" alt="Facebook" /></a>
        <a href="#"><img src="img/twitter.png" alt="Twitter" /></a>
        <a href="#"><img src="img/instagram.png" alt="Instagram" /></a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#checkInDate", { dateFormat: "Y-m-d" });
    flatpickr("#checkOutDate", { dateFormat: "Y-m-d" });
  </script>
</body>
</html>
