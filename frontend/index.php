<php></php>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sapphire Hotel</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar__container">
        <a href="index.php" id="navbar__logo">
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
            <a href="index.php" class="navbar__links">Home</a>
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
            <a href="login.php" class="button">Login/Sign-up</a>
          </li>
          
        </ul>
      </div>
    </nav>

    <!-- Hero Section -->
<div class="main" style="background-image: url('img/hotel.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100vh; display: flex; align-items: center; justify-content: center; color: white;">
  <div class="main__container">
    <div class="main__content">
      <h1><b>SAPPHIRE HOTEL</b></h1>
      <h3>Your Gateway to Relaxation and Elegance</h3>
      <button class="main_btn"><a href="booking.php">Book Now</a></button>
    </div>
  </div>
</div>
    <!-- About Section -->
<section class="about">
  <div class="container">
    <h2>About Sapphire Hotel</h2>

    <ul class="amenities-list">
      <li  style="font-size: 20px;">🌟 Premium rooms designed for comfort and relaxation</li>
      <li  style="font-size: 20px;">🍽️ Gourmet dining with local and international cuisine</li>
      <li  style="font-size: 20px;">🌊 Breathtaking views from our rooftop infinity pool</li>
      <li  style="font-size: 20px;">💼 Modern facilities perfect for business travelers</li>
    </ul>
    
    <p style="font-size: 20px;" >Welcome to Sapphire Hotel, where luxury meets elegance. Our hotel is dedicated to providing you with an unforgettable stay. Located in the heart of the city, we offer comfortable rooms, exceptional service, and stunning views.</p>
    <p style="font-size: 20px;" >Experience the warmth and hospitality of our team as we cater to your every need. Whether you're here for business or leisure, Sapphire Hotel promises a memorable experience.</p>
    <img src="img/about.jpg" alt="Sapphire Hotel Reception" class="about-image">
  </div>
</section>

    <!-- Footer Section -->
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

    <script src="js/app.js"></script>
  </body>
</html>
</php>
