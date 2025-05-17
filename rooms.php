<?php
require("./db.php");
include("./session.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms - Sapphire Hotel</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/rooms.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <style></style>
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

    <!-- Rooms Section -->
    <section class="rooms-section">
      <div class="container">
        <h2 class="section-title">Our Rooms</h2>
        <p class="section-subtitle">Experience comfort and luxury</p>

        <div class="card-container">
          <!-- Standard Room -->
          <div class="card">
            <div class="card-image">
              <img src="img/room1.jpg" alt="Standard Room" />
            </div>
            <div class="card-content">
              <h3>Standard</h3>
              <p>
                Comfortable queen bed with premium linens, work desk, and modern
                bathroom. Ideal for business travelers.
              </p>
              <ul class="amenities-list">
                <li><i class="fas fa-wifi"></i> High-speed WiFi</li>
                <li><i class="fas fa-snowflake"></i> Climate control</li>
              </ul>
              <a href="booking.php" class="book-now-button">Book Now</a>
            </div>
          </div>

          <!-- Deluxe Room -->
          <div class="card">
            <div class="card-image">
              <img src="img/room2.jpg" alt="Deluxe Room" />
            </div>
            <div class="card-content">
              <h3>Deluxe</h3>
              <p>
                Spacious king bed with sitting area, enhanced amenities, and
                city views. Perfect for relaxing stays.
              </p>
              <ul class="amenities-list">
                <li><i class="fas fa-wifi"></i> High-speed WiFi</li>
                <li><i class="fas fa-snowflake"></i> Climate control</li>
                <li><i class="fas fa-tv"></i> Smart TV</li>
              </ul>
              <a href="booking.php" class="book-now-button">Book Now</a>
            </div>
          </div>

          <!-- Exclusive Room -->
          <div class="card">
            <div class="card-image">
              <img src="img/room3.jpg" alt="Exclusive Room" />
            </div>
            <div class="card-content">
              <h3>Exclusive</h3>
              <p>
                Luxurious suite with separate living space, premium services,
                and executive lounge access.
              </p>
              <ul class="amenities-list">
                <li><i class="fas fa-wifi"></i> High-speed WiFi</li>
                <li><i class="fas fa-snowflake"></i> Climate control</li>
                <li><i class="fas fa-tv"></i> Smart TV</li>
                <li><i class="fas fa-wine-bottle"></i> Minibar</li>
              </ul>
              <a href="booking.php" class="book-now-button">Book Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>

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

    <script src="js/app.js"></script>
  </body>
</html>
