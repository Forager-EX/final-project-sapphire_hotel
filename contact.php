<?php
require("./db.php");
include("./session.php");

?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - Sapphire Hotel</title>

  <!-- Favicon (small icon in the browser tab) -->
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
  <!-- Optional high-res version for Retina / pinned tabs -->
  <link rel="icon" type="image/png" sizes="192x192" href="images/favicon-192.png" />
  <!-- Optional iOS home-screen icon -->
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />

  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/contact.css" />
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
            <a href="contact.pphp" class="navbar__links">Contact</a>
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

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact Us</h2>
    <p>Feel free to reach out to us for any inquiries or reservations.</p>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <!-- Address Section -->
      <div class="col-lg-6">
        <div class="info-item d-flex flex-column justify-content-center align-items-center">
          <i class="bi bi-geo-alt info-icon"></i>
          <h3>Address</h3>
          <p>Magsaysay Ave. Naga, Camarines Sur
</p>
          <!-- Google Maps Embed -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.467508888889!2d123.516987!3d13.756321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a88c9b8e2f80eb%3A0x9d28000000000000!2sNaga%20City%2C%20CamSur%2C%20Philippines!5e0!3m2!1sen!2sus!4v1692547200000!5m2!1s2!2s0x33a88c9b8e2f80eb%3A0x9d28000000000000"
            width="100%"
            height="300px"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="col-lg-6">
        <div class="contact-info-grid">
          <!-- Call Us -->
          <div class="info-item">
            <i class="bi bi-telephone-fill info-icon"></i>
            <h3>Call Us</h3>
            <p>+1 5589 55488 55</p>
          </div>

          <!-- Email Us -->
          <div class="info-item">
            <i class="bi bi-envelope-fill info-icon"></i>
            <h3>Email Us</h3>
            <p>info@sapphirehotel.com</p>
          </div>

          <!-- Operating Hours -->
          <div class="info-item">
            <i class="bi bi-clock-fill info-icon"></i>
            <h3>Operating Hours</h3>
            <p>Reception: 24 hours </p>
          </div>
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

    <!-- Main JS File -->
    <script src="js/app.js"></script>
  </body>
</html>
