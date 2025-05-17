<?php
// Start the session
session_start();

// Include database connection
include('./db.php'); // Include your db.php file

// Check if the form is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    }

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password matches
    if ($user) {
        if ($password === $user['password']) { // Directly compare the passwords
            // Store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script type='text/javascript'>
                    alert('Password is incorrect.\\nEmail from DB: " . $user['email'] . "\\nStored password from DB: " . $user['password'] . "');
                    window.location.href = 'login.php?error=wrongpassword';
                  </script>";
            exit();
        }
    } else {
        header("Location: login.php?error=usernotfound");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Sapphire Hotel</title>

  <!-- Favicon (small icon in the browser tab) -->
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo.jpg" />
  <!-- Optional high-res version for Retina / pinned tabs -->
  <link rel="icon" type="image/png" sizes="192x192" href="images/favicon-192.png" />
  <!-- Optional iOS home-screen icon -->
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />

  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/contact.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('img/login bg.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .logo-wrapper {
      margin-bottom: 10px;
    }

    .login-logo {
      width: 180px;
      display: block;
      margin: 0 auto;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 12px 15px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 90%;
      padding: 12px;
      margin-top: 10px;
      background-color: #0066cc;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #005bb5;
    }

    .footer-link {
      margin-top: 15px;
      font-size: 14px;
    }

    .footer-link a {
      color: #0066cc;
      text-decoration: none;
    }

    .footer-link a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="logo-wrapper">
      <img src="img/logo.jpg" alt="Sapphire Hotel Logo" class="login-logo" />
    </div>

    <!-- Error Messages -->
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] === "wrongpassword") {
            echo "<p class='error-message'>Incorrect password.</p>";
        } elseif ($_GET['error'] === "usernotfound") {
            echo "<p class='error-message'>Email not found.</p>";
        } elseif ($_GET['error'] === "emptyfields") {
            echo "<p class='error-message'>Please fill in all fields.</p>";
        }
    }
    ?>

    <!-- Login Form -->
    <form action="login.php" method="POST">
      <input type="text" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>

    <div class="footer-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>

</body>
</html>
