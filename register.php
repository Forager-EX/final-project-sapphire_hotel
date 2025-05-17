<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Sapphire Hotel</title>

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

    .register-container {
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

    .register-logo {
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
    input[type="email"],
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

<div class="register-container">
    <div class="logo-wrapper">
      <img src="img/logo.jpg" alt="GrandView Hotel Logo" class="register-logo" />
    </div>
    <form action="register.php" method="POST">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Register</button>
    </form>
    <div class="footer-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
  <?php
// Only run if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'sapphire_hotel'; // Replace with your DB name

    // Create connection
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and sanitize form data
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $createdAt = date('Y-m-d');

    // Prepare SQL query
    $sql = "INSERT INTO user (name, email, createdAt, password)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $createdAt, $password); // Use plain password

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }

    // Close
    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
