<php></php>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home - Sapphire Hotel</title>
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />

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
<section class="about" style="padding: 60px 20px; background-color: #f9fcff;">
  <div class="container" style="max-width: 1200px; margin: auto;">

  

    <!-- Flex container for light blue info cards -->
    <div style="
      display: flex;
      gap: 40px;
      flex-wrap: wrap;
      justify-content: center;
    ">
      
      <!-- Amenities Card -->
      <div style="display: flex; justify-content: center;">
  <div style="
    background-color: rgb(244, 247, 249);
    padding: 35px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    font-size: 22px;
    line-height: 1.8;
    width: 100%;
    max-width: 600px;
  " onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
    <ul style="list-style: none; padding: 0; margin: 0;">
      <li>🌟 Premium rooms designed for comfort and relaxation</li>
      <li>🍽️ Gourmet dining with local and international cuisine</li>
      <li>🌊 Rooftop infinity pool with breathtaking views</li>
      <li>💼 Modern business facilities for working professionals</li>
    </ul>
  </div>
</div>


      <!-- Welcome Message Card -->
      <div style="
        background-color:rgb(249, 249, 250);
        padding: 35px;
        border-radius: 16px;
        flex: 1 1 45%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        font-size: 22px;
        line-height: 1.8;
      " onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <p>
          Welcome to <strong>Sapphire Hotel</strong>, where luxury meets elegance. Located in the heart of the city, we offer stunning views, exceptional service, and elegant rooms tailored for your comfort.
        </p>
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
</php>
