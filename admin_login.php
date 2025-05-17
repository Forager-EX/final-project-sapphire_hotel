<?php
session_start();

// Database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sapphire_hotel");

    if ($conn->connect_error) {
        die("<script>alert('Database connection failed.');</script>");
    }

    // Get user input
    $name = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch admin details
    $stmt = $conn->prepare("SELECT admin_id, name, password FROM admin WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Verify password using password_verify (if hashed)
        if ($password === $admin['password']) {
            // Store session data
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['name'];

            // Redirect to admin dashboard
            header("Location: material-dashboard-master/dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        // Admin not found
        echo "<script>alert('Admin not found.');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - Sapphire Hotel</title>

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
  </style>
</head>
<body>

  <div class="login-container">
    <div class="logo-wrapper">
      <img src="img/logo.jpg" alt="GrandView Hotel Logo" class="login-logo" />
    </div>
    <form action="admin_login.php" method="POST">
      <input type="text" name="username" placeholder="Username or Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <div class="footer-link">
    Don't have an account? <a href="material-dashboard-master/register_admin.php">Register here</a>
    </div>

  </div>
  
</body>
</html>
