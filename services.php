<?php
require("./db.php");
include("./session.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services - Sapphire Hotel</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/services.css" />
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <!-- Google Fonts -->
  </head>
  <body>
    <!-- Navbar (consistent with other pages) -->
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
            <a href="services.php" class="navbar__links active">Services</a>
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

    

    <!-- Services Grid -->
    <section class="services-grid">
      <div class="container">
        <div class="section-intro">
          <h2>Discover Our Offerings</h2>
          <p>Every Detail is Designed for your Comfort and Satisfaction</p>
        </div>

        <div class="services-container">
          <!-- Accommodation -->
          <div class="service-card">
            <div class="service-icon">
              <i class="fas fa-hotel"></i>
            </div>
            <div class="service-content">
              <h3>Luxurious Accommodation</h3>
              <p>
                Choose from our elegant Deluxe Rooms, spacious Suites, or
                comfortable Family Rooms, all equipped with premium amenities
                including:
              </p>
              <ul class="service-features">
                <li><i class="fas fa-wifi"></i> High-speed WiFi</li>
                <li><i class="fas fa-snowflake"></i> Climate control</li>
                <li><i class="fas fa-wine-bottle"></i> Minibar</li>
                <li><i class="fas fa-tv"></i> Smart TV</li>
              </ul>
            </div>
          </div>

          <!-- Pool -->
          <div class="service-card">
            <div class="service-icon">
              <i class="fas fa-swimming-pool"></i>
            </div>
            <div class="service-content">
              <h3>Infinity Pool</h3>
              <p>
                Our heated infinity pool offers breathtaking views and premium
                amenities:
              </p>
              <ul class="service-features">
                <li><i class="far fa-clock"></i> 6:00 AM - 10:00 PM daily</li>
                <li><i class="fas fa-umbrella-beach"></i> Poolside cabanas</li>
                <li><i class="fas fa-cocktail"></i> Pool bar service</li>
                <li><i class="fas fa-life-ring"></i> Lifeguard supervision</li>
              </ul>
            </div>
          </div>

          <!-- Dining -->
          <div class="service-card">
            <div class="service-icon">
              <i class="fas fa-utensils"></i>
            </div>
            <div class="service-content">
              <h3>Gourmet Dining</h3>
              <p>
                Experience culinary excellence at our award-winning restaurants:
              </p>
              <ul class="service-features">
                <li>
                  <i class="fas fa-coffee"></i> Complimentary breakfast buffet
                </li>
                <li><i class="fas fa-concierge-bell"></i> 24/7 room service</li>
                <li>
                  <i class="fas fa-wine-glass-alt"></i> Wine pairing dinners
                </li>
                <li>
                  <i class="fas fa-birthday-cake"></i> Special occasion catering
                </li>
              </ul>
            </div>
          </div>

          <!-- Spa -->
          <div class="service-card">
            <div class="service-icon">
              <i class="fas fa-spa"></i>
            </div>
            <div class="service-content">
              <h3>Sapphire Spa</h3>
              <p>Rejuvenate your senses with our premium spa services:</p>
              <ul class="service-features">
                <li><i class="fas fa-massage"></i> Therapeutic massages</li>
                <li><i class="fas fa-water"></i> Hydrotherapy</li>
                <li><i class="fas fa-leaf"></i> Organic treatments</li>
                <li><i class="fas fa-user-md"></i> Professional therapists</li>
              </ul>
            </div>
          </div>
          <!-- Fitness Center -->
<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-dumbbell"></i>
  </div>
  <div class="service-content">
    <h3>24/7 Fitness Center</h3>
    <p>
      Maintain your wellness routine with our fully-equipped facility:
    </p>
    <ul class="service-features">
      <li><i class="fas fa-heartbeat"></i> Cardio machines</li>
      <li><i class="fas fa-weight"></i> Strength training equipment</li>
      <li><i class="fas fa-yoga"></i> Yoga/Pilates studio</li>
      <li><i class="fas fa-user-tie"></i> Personal training sessions</li>
    </ul>
  </div>
</div>

<!-- Concierge Services -->
<div class="service-card">
  <div class="service-icon">
    <i class="fas fa-concierge-bell"></i>
  </div>
  <div class="service-content">
    <h3>Personal Concierge</h3>
    <p>
      Let our dedicated team enhance your stay with:
    </p>
    <ul class="service-features">
      <li><i class="fas fa-globe-americas"></i> Tour bookings & recommendations</li>
      <li><i class="fas fa-car-side"></i> Transportation arrangements</li>
      <li><i class="fas fa-utensils"></i> Exclusive restaurant reservations</li>
      <li><i class="fas fa-calendar-alt"></i> Event planning services</li>
    </ul>
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
