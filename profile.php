<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$password = "";
$db = "sapphire_hotel";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT name, email FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $userData = $result->fetch_assoc();
} else {
    die("User not found.");
}
$stmt->close();

// Fetch bookings (if you have this functionality)
$booking = [];
$booking_stmt = $conn->prepare("SELECT * FROM booking WHERE user_id = ? ORDER BY check_in DESC LIMIT 3");
if ($booking_stmt) {
    $booking_stmt->bind_param("i", $user_id);
    $booking_stmt->execute();
    $booking_result = $booking_stmt->get_result();
    $booking = $booking_result->fetch_all(MYSQLI_ASSOC);
    $booking_stmt->close();
}

// Fetch notifications
$notifications = [];
$notification_stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
if ($notification_stmt) {
    $notification_stmt->bind_param("i", $user_id);
    $notification_stmt->execute();
    $notification_result = $notification_stmt->get_result();
    $notifications = $notification_result->fetch_all(MYSQLI_ASSOC);
    $notification_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - Sapphire Hotel</title>

  <!-- Favicon (small icon in the browser tab) -->
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
  <!-- Optional high-res version for Retina / pinned tabs -->
  <link rel="icon" type="image/png" sizes="192x192" href="images/favicon-192.png" />
  <!-- Optional iOS home-screen icon -->
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />

  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/contact.css" />
  <style>
    :root {
      --primary-color: #0d47a1;
      --secondary-color: #f5f9fc;
      --accent-color: #ef5350;
      --text-color: #333;
      --light-text: #6c757d;
    }
    
    body {
      background-color: var(--secondary-color);
      color: var(--text-color);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .profile-container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 15px;
    }
    
    .profile-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    
    .profile-card {
      display: flex;
      flex-direction: column;
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }
    .profile-banner {
     position: relative;
     height: 150px; /* or whatever height you need */
     width: 1,000px;
   background-color:rgb(27, 27, 115); /* optional background */
    }

    .profile-avatar {
     position: absolute;
    top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 4rem; /* adjust icon size */
      color: #333; /* optional color */
    }

  
    
    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 4px solid white;
      background: white;
      position: absolute;
      bottom: -60px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .profile-avatar i {
      font-size: 3.5rem;
      color: var(--primary-color);
    }
    
    .profile-content {
      color: #333; /* sets the text color */
       background-color:rgb(27, 27, 115); /* optional background */
       border-radius: 0.75rem; /* optional rounded corners */
      padding: 80px 30px 30px;
      text-align: center;
    }
    
    .profile-name {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: white; /* changed to white */
    }

    .profile-email {
      color: white; /* changed to white */
      margin-bottom: 1.5rem;
      font-size: 1rem;
    }

    
    .profile-details {
      display: flex;
      justify-content: center;
      gap: 2rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }
    
    .detail-card {
      background: var(--secondary-color);
      padding: 1.5rem;
      border-radius: 8px;
      min-width: 200px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .detail-card h5 {
      color: var(--light-text);
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }
    
    .detail-card p {
      font-size: 1.2rem;
      font-weight: 600;
      margin: 0;
      color: var(--primary-color);
    }
    
    .section-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin: 2rem 0 1rem;
      text-align: left;
      padding-left: 15px;
      color: var(--primary-color);
    }
    
    .booking-card {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      border-left: 4px solid var(--primary-color);
      transition: transform 0.3s ease;
    }
    
    .booking-card:hover {
      transform: translateY(-3px);
    }
    
    .booking-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .booking-title {
      font-weight: 600;
      font-size: 1.1rem;
      color: var(--text-color);
    }
    
    .booking-status {
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }
    
    .status-confirmed {
      background-color: #e8f5e9;
      color: #2e7d32;
    }
    
    .booking-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1rem;
      margin-top: 1rem;
    }
    
    .booking-detail {
      font-size: 0.9rem;
    }
    
    .booking-detail strong {
      display: block;
      color: var(--light-text);
      font-weight: 500;
      margin-bottom: 0.3rem;
    }
    
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 2rem;
      flex-wrap: wrap;
    }
    
    .btn-edit {
      background-color: white;
      color: var(--primary-color);
      border: 1px solid var(--primary-color);
      padding: 0.6rem 1.5rem;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-edit:hover {
      background-color: var(--primary-color);
      color: white;
    }
    
    .btn-logout {
      background-color: var(--accent-color);
      color: white;
      border: none;
      padding: 0.6rem 1.5rem;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
      background-color: #d32f2f;
      color: white;
    }
    
    .no-bookingS {
      text-align: center;
      padding: 2rem;
      color: var(--light-text);
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .no-bookingS i {
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #cfd8dc;
      
      .profile-banner {
  position: relative;
  height: 150px; /* or whatever height you need */
  background-color: #f0f0f0; /* optional background */
}

.profile-avatar {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 4rem; /* adjust icon size */
  color: #333; /* optional color */
}

    }
  </style>
</head>
<body>
  <!-- Navbar Section -->
  <nav class="navbar">
    <div class="navbar__container">
      <a href="welcome.php" id="navbar__logo">
        <img src="img/sh icon.png" alt="Sapphire Hotel Logo" class="navbar__logo-img" />
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
          <a href="profile.php" class="navbar__links active">Profile</a>
        </li>
        <li class="navbar__btn">
          <a href="logout.php" class="button">Log out</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Profile Content -->
  <div class="profile-container">
    <div class="profile-header">
      <h1>My Profile</h1>
    </div>
    
    <div class="profile-card">
  <div class="profile-banner">
    <div class="profile-avatar">
      <i class="bi bi-person-circle"></i>
    </div>
  </div>
</div>

      
      <div class="profile-content">
        <h2 class="profile-name"><?= htmlspecialchars($userData['name']) ?></h2>
        <p class="profile-email"><?= htmlspecialchars($userData['email']) ?></p>
        
        <div class="profile-details">
          <div class="detail-card">
            <h5>Member Since</h5>
            <p><?= date('F Y', strtotime($userData['created_at'] ?? 'now')) ?></p>
          </div>
          <div class="detail-card">
            <h5>Total Bookings</h5>
            <p><?= count($booking ?? []) ?></p>
          </div>
          <div class="detail-card">
            <h5>Loyalty Points</h5>
            <p>1,250</p>
          </div>
        </div>
      </div>
    </div>
    
  </div>
    <h2 class="section-title">Account Information</h2>
              <div class="profile-card" style="padding: 2rem;">
                <div class="profile-details" style="display: flex; justify-content: space-between; gap: 2rem; flex-wrap: wrap;">
                  
                  <!-- Full Name and Email -->
                  <div class="detail-card" style="text-align: left; min-width: 250px; flex: 1;">
                    <h5>Full Name</h5>
                    <p><?= htmlspecialchars($userData['name']) ?></p>

                    <h5 style="margin-top: 1.5rem;">Email Address</h5>
                    <p><?= htmlspecialchars($userData['email']) ?></p>
                  </div>

                  <!-- Account Type and Last Login -->
                  <div class="detail-card" style="text-align: left; min-width: 250px; flex: 1;">
                    <h5>Account Type</h5>
                    <p>Standard Member</p>

                    <h5 style="margin-top: 1.5rem;">Last Login</h5>
                    <p><?= date('M j, Y g:i A', strtotime('-3 hours')) ?></p>

                    <h5 style="margin-top: 1.5rem;">Password</h5>
                    <p>••••••••••</p>
                  </div>

                  <!-- Notifications -->
                  <div class="detail-card" style="text-align: left; min-width: 200px; flex: 1;">
                    <h5>Notifications</h5>
                    <?php if (!empty($notifications)) : ?>
                  <div class="notification-list">
                    <?php foreach ($notifications as $notification) : ?>
                      <div class="notification-item" style="padding: 1rem; border-bottom: 1px solid #eee; display: flex; align-items: flex-start;">
                        <div style="margin-right: 1rem; color: <?= $notification['type'] === 'booking' ? '#0d47a1' : '#ef5350' ?>;">
                          <i class="bi bi-<?= $notification['type'] === 'booking' ? 'calendar-check' : 'bell' ?>" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                          <p style="margin: 0; font-weight: 500;"><?= htmlspecialchars($notification['title']) ?></p>
                          <p style="margin: 0.3rem 0 0; color: var(--light-text); font-size: 0.9rem;">
                            <?= htmlspecialchars($notification['message']) ?>
                          </p>
                          <p style="margin: 0.3rem 0 0; color: var(--light-text); font-size: 0.8rem;">
                            <?= date('M j, Y g:i A', strtotime($notification['created_at'])) ?>
                          </p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                    <?php else : ?>
                  <div style="text-align: center; padding: 1.5rem;">
                    <i class="bi bi-bell" style="font-size: 2rem; color: #cfd8dc;"></i>
                    <p style="color: var(--light-text); margin-top: 0.5rem;">No notifications yet</p>
                  </div>
                <?php endif; ?>
  </div>

                </div>
                <h2 class="section-title">Recent Bookings</h2>
    
              <?php if (!empty($booking)) : ?>
                <?php foreach ($booking as $booking) : ?>
                  <div class="booking-card">
                    <div class="booking-header">
                      <div class="booking-title"><?= htmlspecialchars($booking['room_type']) ?></div>
                      <div class="booking-status status-confirmed">Confirmed</div>
                    </div>
                    
                    <div class="booking-details">
                      <div class="booking-detail">
                        <strong>Check-In</strong>
                        <?= htmlspecialchars($booking['check_in']) ?>
                      </div>
                      <div class="booking-detail">
                        <strong>Check-Out</strong>
                        <?= htmlspecialchars($booking['check_out']) ?>
                      </div>
                      <div class="booking-detail">
                        <strong>Guests</strong>
                        <?= htmlspecialchars($booking['guest_num']) ?>
                      </div>
                      <div class="booking-detail">
                        <strong>Total</strong>
                        ₱<?= number_format($booking['total_price'] ?? 350, 2) ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
            <div style="text-align: center; margin: 2rem 0;">
              <i class="bi bi-calendar-x" style="font-size: 2rem; color: #cfd8dc; margin-bottom: 1rem;"></i>
              <h3 style="color: var(--text-color); margin-bottom: 0.5rem;">No Bookings Yet</h3>
              <p style="color: var(--light-text); margin-bottom: 1.5rem;">
                You haven't made any reservations with us. Start exploring our rooms!
              </p>
              <a href="rooms.php" style="color: var(--primary-color); text-decoration: underline; font-weight: 500;">
                Browse Rooms
              </a>
           </div>
    <?php endif; ?>
  </div>

     <!-- Footer Section -->
    <footer class="footer">
      <div class="container">
        <p>© 2025 Sapphire Hotel. All rights reserved.</p>
        <p>John Paul Bon • Trisha Besa • Andrew Fajardo • Delia Portes • Maristela Yebra</p>
        <div class="social-links">
          <a href="#"><img src="img/facebook.png" alt="Facebook" /></a>
          <a href="#"><img src="img/twitter.png" alt="Twitter" /></a>
          <a href="#"><img src="img/instagram.png" alt="Instagram" /></a>
        </div>
      </div>
    </footer>

</body>
</html>
