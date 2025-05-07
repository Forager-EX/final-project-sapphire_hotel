<?php
// booking.php
$host = "localhost";
$db = "sapphire_hotel";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $status = $_POST['status']; // assuming this is room type

    $sql = "INSERT INTO booking (user_id, check_in, check_out, status)
            VALUES ('$user_id', '$check_in', '$check_out', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking successful!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
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
  <nav class="navbar">
    <div class="navbar__container">
      <a href="index.php" id="navbar__logo">
        <img src="img/sh icon.png" alt="Sapphire Hotel Logo" class="navbar__logo-img" />
        Sapphire Hotel
      </a>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item"><a href="index.php" class="navbar__links">Home</a></li>
        <li class="navbar__item"><a href="services.html" class="navbar__links">Services</a></li>
        <li class="navbar__item"><a href="rooms.html" class="navbar__links">Rooms</a></li>
        <li class="navbar__item"><a href="contact.html" class="navbar__links">Contact</a></li>
        <li class="navbar__item"><a href="profile.html" class="navbar__links">Profile</a></li>
        <li class="navbar__btn"><a href="login.html" class="button">Login/Sign-up</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content-wrapper">
    <section id="booking" class="booking section">
      <div class="container">
        <h2>Book Your Stay</h2>
        <form id="bookingForm" method="POST" action="">
          <div class="row gy-4">
            <div class="col-lg-6">
              <label for="checkInDate" class="form-label">Check-In Date:</label>
              <input type="text" id="checkInDate" name="check_in" class="form-control" required readonly />
            </div>
            <div class="col-lg-6">
              <label for="checkOutDate" class="form-label">Check-Out Date:</label>
              <input type="text" id="checkOutDate" name="check_out" class="form-control" required readonly />
            </div>
            <div class="col-lg-6">
              <label for="roomType" class="form-label">Room Type:</label>
              <select id="roomType" name="status" class="form-select" required>
                <option value="" disabled selected>Select Room Type</option>
                <option value="standard">Standard</option>
                <option value="deluxe">Deluxe</option>
                <option value="exclusive">Exclusive Suite</option>
              </select>
            </div>
            <div class="col-lg-6">
              <label for="user_id" class="form-label">Full Name:</label>
              <input type="number" id="user_id" name="user_id" class="form-control" min="1" required />
            </div>
          </div>

          <div class="booking-summary mt-4">
            <h3>Booking Summary</h3>
            <div id="summaryRoomType" class="mt-2"></div>
            <div id="summaryGuests" class="mt-2"></div>
            <div id="summaryNights" class="mt-2"></div>
            <div id="summaryTotalAmount" class="mt-2"></div>
            <button type="submit" class="btn btn-primary mt-3" id="confirmButton">
              Confirm Booking
            </button>
          </div>
        </form>
      </div>
    </section>
  </div>

  <div id="paymentOverlay" class="overlay d-none">
    <div class="payment-modal">
      <span class="close-btn">&times;</span>
      <h2>Complete Your Payment</h2>
      <form id="paymentForm">
        <div class="form-group">
          <label for="cardNumber">Card Number</label>
          <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" required />
        </div>
        <div class="form-group">
          <label for="cardName">Name on Card</label>
          <input type="text" id="cardName" placeholder="John Doe" required />
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="expiryDate">Expiry Date</label>
            <input type="text" id="expiryDate" placeholder="MM/YY" required />
          </div>
          <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" placeholder="123" required />
          </div>
        </div>
        <div id="paymentAmount" class="mb-3"></div>
        <button type="submit" class="btn btn-primary pay-now-btn">Pay Now</button>
      </form>
    </div>
  </div>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#checkInDate", { minDate: "today" });
    flatpickr("#checkOutDate", { minDate: new Date().fp_incr(1) });
  </script>
  <script src="js/booking.js"></script>
</body>
</html>
