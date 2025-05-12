<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "sapphire_hotel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $stmt = $conn->prepare("UPDATE user SET name=?, email=?, phone=? WHERE user_id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $user_id);
    
    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch current user data
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM user WHERE user_id = $user_id");
$userData = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - Sapphire Hotel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/styles.css">
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

  
  <div class="edit-profile-container">
    <h1>Edit Profile</h1>
    
    <?php if (isset($success)): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
      <div class="alert alert-error"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" class="form-control" 
               value="<?= htmlspecialchars($userData['name'] ?? '') ?>" required>
      </div>
      
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" 
               value="<?= htmlspecialchars($userData['email'] ?? '') ?>" required>
      </div>
      
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" class="form-control" 
               value="<?= htmlspecialchars($userData['phone'] ?? '') ?>">
      </div>
      
      <div class="form-group">
        <label>Member Since</label>
        <p><?= date('F Y', strtotime($userData['created_at'] ?? 'now')) ?></p>
      </div>
      
      <button type="submit" class="btn-save">Save Changes</button>
      <a href="profile.php" class="btn-cancel">Cancel</a>
    </form>
  </div>
  
  <!--footer-->
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