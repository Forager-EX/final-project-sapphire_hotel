<?php
session_start();

// Redirect if no booking data
if (!isset($_SESSION['last_booking'])) {
    header("Location: booking.php");
    exit();
}

$booking = $_SESSION['last_booking'];

// Calculate number of nights
$check_in = new DateTime($booking['check_in']);
$check_out = new DateTime($booking['check_out']);
$nights = $check_in->diff($check_out)->days;

// Calculate price based on room type
$prices = [
    'standard' => 100,
    'deluxe' => 150,
    'exclusive' => 250
];

$room_price = $prices[$booking['room_type']] ?? 0;
$total_amount = $room_price * $nights;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Summary - Sapphire Hotel</title>
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/booking.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <!-- Navbar (same as booking.php) -->
  <nav class="navbar">
    <div class="navbar__container">
      <a href="welcome.php" id="navbar__logo">
        <img src="img/sh icon.png" alt="Sapphire Hotel Logo" class="navbar__logo-img" />
        Sapphire Hotel
      </a>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item"><a href="welcome.php" class="navbar__links">Home</a></li>
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
    <section class="booking-summary section">
      <div class="container">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Booking Confirmation</h2>
          </div>
          <div class="card-body">
            <div class="alert alert-success">
              <h4 class="alert-heading">Booking Successful!</h4>
              <p>Your reservation has been confirmed. Below are your booking details.</p>
            </div>

            <div class="row">
              <div class="col-md-6">
                <h4>Booking Information</h4>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <strong>Booking ID:</strong> <?= $booking['id'] ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Guest Name:</strong> <?= htmlspecialchars($booking['full_name']) ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Check-in Date:</strong> <?= date('F j, Y', strtotime($booking['check_in'])) ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Check-out Date:</strong> <?= date('F j, Y', strtotime($booking['check_out'])) ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Number of Nights:</strong> <?= $nights ?>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <h4>Room Information</h4>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <strong>Room Type:</strong> 
                    <?= ucwords(str_replace('_', ' ', $booking['room_type'])) ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Number of Guests:</strong> <?= $booking['guest_num'] ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Price per Night:</strong> ₱<?= $booking['room_rate'] ?>
                  </li>
                  <li class="list-group-item">
                    <strong>Total Amount:</strong> 
                    <span class="text-primary fw-bold">₱<?= number_format($booking['total_price'], 0) ?>
                  </li></span>
                  </li>
                  <li class="list-group-item">
                    <strong>Status:</strong> 
                    <span class="badge bg-<?= $booking['status'] === 'Pending' ? 'warning' : 'success' ?>">
                      <?= $booking['status'] ?>
                    </span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="mt-4">
              <h4>Next Steps</h4>
              <p>We've sent a confirmation email to your registered address. Please check your inbox.</p>
              <p>For any changes to your reservation, please contact our customer service.</p>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="rooms.php" class="btn btn-outline-primary">Book Another Room</a>
              <a href="welcome.php" class="btn btn-primary">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer (same as booking.php) -->
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
</body>
</html>