<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$db = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in. Please log in to proceed with booking.");
    }

    $user_id = intval($_SESSION['user_id']);
    $full_name = $conn->real_escape_string($_POST['full_name'] ?? '');
    $check_in = $conn->real_escape_string($_POST['check_in'] ?? '');
    $check_out = $conn->real_escape_string($_POST['check_out'] ?? '');
    $guest_num = intval($_POST['guest_num'] ?? 0);
    $room_type = $conn->real_escape_string($_POST['room_type'] ?? '');
    $status = 'Confirmed';

    // Validation
    if (empty($check_in) || empty($check_out) || $guest_num <= 0 || empty($room_type)) {
        die("All fields are required.");
    }

    if ($check_in >= $check_out) {
        die("Check-out date must be after check-in date.");
    }

    // Calculate number of nights
    $date1 = new DateTime($check_in);
    $date2 = new DateTime($check_out);
    $interval = $date1->diff($date2);
    $numberOfNights = $interval->days;

    // Get room rate
    switch ($room_type) {
        case 'standard':
            $room_rate = 3000;
            break;
        case 'deluxe':
            $room_rate = 4000;
            break;
        case 'exclusive':
            $room_rate = 6000;
            break;
        default:
            $room_rate = 0;
    }

    // Calculate total price
    $total_price = $room_rate * $numberOfNights;

    // Insert into database
    $sql = "INSERT INTO booking (full_name, user_id, check_in, check_out, status, guest_num, room_type, room_rate, total_price)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$stmt->bind_param("sisssissi", $full_name, $user_id, $check_in, $check_out, $status, $guest_num, $room_type, $room_rate, $total_price)) {
        die("Bind failed: " . $stmt->error);
    }

    if ($stmt->execute()) {
        $booking_id = $conn->insert_id;
        $_SESSION['last_booking'] = [
            'id' => $booking_id,
            'full_name' => $full_name,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'guest_num' => $guest_num,
            'room_type' => $room_type,
            'room_rate' => $room_rate,
            'total_price' => $total_price,
            'status' => $status
            
        ];
        header("Location: booking_summary.php");
        exit();
    } else {
        die("Execute failed: " . $stmt->error);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Now - Sapphire Hotel</title>
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/booking.css" />
  <link rel="stylesheet" href="css/room.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar__container">
        <a href="welcome.php" id="navbar__logo">
          <img
            src="img/sh icon.png"
            alt="Sapphire Hotel Logo"
            class="navbar__logo-img"
          />
          Sapphire Hotel
        </a>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="welcome.php" class="navbar__links">Home</a>
          </li>
          <li class="navbar__item">
            <a href="services.php" class="navbar__links">Services</a>
          </li>
          <li class="navbar__item">
            <a href="rooms.php" class="navbar__links">Rooms</a>
          </li>
          <li class="navbar__item">
            <a href="contact.php" class="navbar__links">Contact</a>
          </li>
          <li class="navbar__item">
            <a href="profile.php" class="navbar__links">Profile</a>
          </li>
          <li class="navbar__btn">
            <a href="logout.php" class="button">Log out</a>
          </li>
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
              <input type="number" id="numberOfGuests" name="guest_num" class="form-control" min="1" required />
              <small id="guestLimitNote" class="form-text text-muted"></small>
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
  <script>document.addEventListener('DOMContentLoaded', function () {
    const roomType = document.getElementById('roomType');
    const guestInput = document.getElementById('numberOfGuests');
    const guestLimitNote = document.getElementById('guestLimitNote');

    const guestLimits = {
      standard: 1,
      deluxe: 2,
      exclusive: 4
    };

    roomType.addEventListener('change', function () {
      const selected = roomType.value;

      if (guestLimits[selected]) {
        guestInput.max = guestLimits[selected];
        guestInput.value = Math.min(guestInput.value || 1, guestLimits[selected]);
        guestLimitNote.textContent = `Maximum allowed guests for ${selected.charAt(0).toUpperCase() + selected.slice(1)} room: ${guestLimits[selected]}`;
      } else {
        guestInput.max = 5;
        guestLimitNote.textContent = '';
      }
    });
  });
</script>
</body>
</html>